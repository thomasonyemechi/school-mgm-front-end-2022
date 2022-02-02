@extends('layouts.app')

@section('page_title')
Students
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Students</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            Register Student
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="registerStudent" class="row">
                            <div class=" col-md-4 form-group">
                                <label>Guardian <span class="text-danger">*</span></label>
                                <select id="guardian" class="form-control select2bs4">

                                </select>
                            </div>

                            <div class=" col-md-4 form-group">
                                <label>Prospective Class <span class="text-danger">*</span></label>
                                <select id="class" class="form-control select2bs4">
                                </select>
                            </div>

                            <div class=" col-md-4 form-group">
                                <label>Class Arm <span class="text-danger">*</span></label>
                                <select id="arm" class="form-control select2bs4">
                                </select>
                            </div>


                            <div class=" col-md-3 form-group">
                                <label>Surname <span class="text-danger">*</span></label>
                                <input type="text" name="surname" class="form-control" placeholder="Lekki, Nigeria" >
                            </div>
                            <div class=" col-md-3 form-group">
                                <label>Firstname <span class="text-danger">*</span></label>
                                <input type="text" name="firstname" class="form-control" placeholder="mail@gmail.com" >
                            </div>
                            <div class=" col-md-3 form-group">
                                <label>Othernames</label>
                                <input type="text" name="othernames" class="form-control" placeholder="090000000000" >
                            </div>
                            <div class=" col-md-3 form-group">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control select2bs4">
                                    <option disabled selected>Select Gender</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Reg Number</label>
                                <input type="text" name="reg" class="form-control" placeholder="choose Registrarion Number" >
                            </div>

                            <div class="col-md-8">
                                <button class="btn btn-secondary float-right mt-4 registerStudent ">Register Student</button>
                            </div>
                        </form>
                    </div>



                </div>


                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-clock" aria-hidden="true"></i>
                            Recently Registered Students
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Gurdian</th>
                                        <th>Gender</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="student_list_body">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });


            function fetchStudent()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'fetch_recently_registered_student'
                }).done(function (res) {
                    body = $('#student_list_body');
                    body.html(``)
                    res.data.map((stu, index) => {
                        body.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${stu.surname+ ' ' + stu.firstname}</td>
                                <td>${stu.class.class ?? ''} <sup>${(stu.arm)? stu.arm.arm :''}</sup> </td>
                                <td><a href="/control/guardian_profile/${stu.guardian.id}" >${stu.guardian.guardian_name}</a></td>
                                <td>${stu.sex}</td>
                                <td>
                                    <div class="float-right">
                                        <a href="/control/student/${stu.id}">Profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                            </tr>
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }


            fetchStudent()


            function fetchReq()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'registration_requirements'
                }).done(function (res){
                    guardian = $('#guardian')
                    guardian.html(`<option disabled selected>Select Guardian</option>`)
                    res.data.guardians.map(guard => {
                        guardian.append(`<option value="${guard.id}">${guard.guardian_name} | ${guard.guardian_email}</option>`)
                    });

                    cla = $('#class')
                    cla.html(`<option disabled selected>Select Class</option>`)
                    res.data.classes.map(clas => {
                        cla.append(`<option value="${clas.id}">${clas.class}</option>`)
                    });

                    arms = $('#arm')
                    arms.html(`<option disabled selected>Select Arm</option>`)
                    res.data.arms.map(arm => {
                        arms.append(`<option value="${arm.id}">${arm.arm}</option>`)
                    });

                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchReq();


            $('#registerStudent').on('submit', function(e){
                e.preventDefault();

                form = $(this);

                surname = $(form).find('input[name="surname"]').val();
                firstname = $(form).find('input[name="firstname"]').val();
                othernames = $(form).find('input[name="othernames"]').val();
                reg = $(form).find('input[name="reg"]').val();
                gender = $(form).find('select[name="gender"]').val();
                guardian = $('#guardian').val();
                arm = $('#arm').val();
                clas = $('#class').val();

                if(!guardian || !surname || !firstname || !gender || !arm || !clas) {
                    littleAlert('Pls fill out the required field', 1);  return;
                }

                $.ajax({
                    method: 'post',
                    url: api_url+'create_student_profile',
                    data: {
                        guardian_id: guardian,
                        class_id: clas,
                        arm_id: arm,
                        firstname: firstname,
                        surname: surname,
                        othername: othernames,
                        registration_number: reg,
                        sex: gender
                    },
                    beforeSend:() => {
                        btnProcess('.registerStudent', 'Register Student', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.registerStudent', 'Register Student', 'after')

                    body = $('#student_list_body');
                    body.prepend(`
                        <tr>
                            <td>#</td>
                            <td>${surname+ ' ' + firstname}</td>
                            <td>...</sup> </td>
                            <td><a href="/control/guardian_profile/${guardian}" >...</a></td>
                            <td>${gender}</td>
                            <td>
                                <div class="float-right">
                                    <a href="#">Profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                </div>
                            </td>
                        </tr>
                    `)
                    form[0].reset();
                    fetchStudent();
                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.registerStudent', 'Register Student', 'after')
                })
            })



            setTimeout(() => {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    "paging": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": false,
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }, 2500);

        })
    </script>


@endsection
