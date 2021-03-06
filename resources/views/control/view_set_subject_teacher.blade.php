@extends('layouts.app')

@section('page_title')
Subjects
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subject Teachers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Subject Teacher</li>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title ">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                Subject Teachers List
                            </h3>
                            <div class="d-flex justify-content-end">
                                <button data-toggle="modal" data-target="#assignSubjectModal" class="btn btn-secondary float-right btn-sm">
                                    Assign Subject
                                </button>
                            </div>
                        </div>


                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th>Teacher</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="sub_body">
                                    <tr>
                                        <td>1</td>
                                        <td>Mathematics</td>
                                        <td>JSS 1</td>
                                        <td>Mr. Adepoju Salami Giwa</td>
                                        <td><button class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="assignSubjectModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h6 class="modal-title text-bold">Assign Subject</h6> --}}
                    <p class="modal-title text-bold">Assign Subject</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row" id="assignSubject">
                        <div class="col-md-4 form-group">
                            <label>Subject</label>
                            <select name="subject" class="form-control select2bs4" >
                                <option selected disabled>Select Option</option>
                                <option value="">English</option>
                                <option value="">Mathematics</option>
                                <option value="">Biology</option>
                            </select>
                        </div>


                        <div class="col-md-4 form-group">
                            <label>Class</label>
                            <select name="class" class="form-control select2bs4" >
                                <option selected disabled>Select Option</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Teacher</label>
                            <select name="user" id="user" class="form-control select2bs4" style="width: 100%;" >
                                <option selected disabled>Select Option</option>
                                <option value="">Mr Adewole Salami Giwa</option>
                                <option value="">Jasper Gideon</option>
                                <option value="">Lugard Sapare</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <button type="submit" class="btn btn-secondary float-right assignSubject">Assign Subject</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });



            function fetchTable() {
                $.ajax({
                    method: 'get',
                    url: api_url+`fetch_subject_teacher?page={{$_GET['page'] ?? 1 }}`
                }).done(function(res) {
                    console.log(res);
                    body = $('#sub_body');
                    body.html(``);
                    res.data.data.map((sub, index) => {
                        body.append(`
                            <tr>
                                <td>${index+1}</td>
                                <td>${sub.subject.subject}</td>
                                <td>${sub.class.class}</td>
                                <td>${sub.teacher.name}</td>
                                <td><button class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                            </tr>
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchTable();

            function fetchRequirements() {
                $.ajax({
                    method: 'get',
                    url: api_url+'assign_subject_req'
                }).done(function(res) {
                    console.log(res);

                form = $('#assignSubject');
                subject = $(form).find('select[name="subject"]');
                clas = $(form).find('select[name="class"]');
                user = $('#user').find('select[name="user"]');
                console.log(user);

                subject.html(`<option selected disabled>Select Subject</option>`);
                res.data.subjects.map(sub => {
                    subject.append(`<option value="${sub.id}">${sub.subject}</option>`)
                })

                clas.html(`<option selected disabled>Select Class</option>`);
                res.data.classes.map(cla => {
                    clas.append(`<option value="${cla.id}">${cla.class}</option>`)
                })

                user.html(`<option selected disabled>Select teacher</option>`);
                res.data.users.map(tea => {
                    user.append(`<option value="${tea.id}">${tea.name}</option>`)
                })

                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchRequirements();

            $('#assignSubject').on('submit', function(e) {
                e.preventDefault();
                form = $(this);
                subject_id = $(form).find('select[name="subject"]').val();
                class_id = $(form).find('select[name="class"]').val();
                user_id = $(form).find('select[name="user"]').val();
                if(!subject_id || !class_id || !user_id) { littleAlert('Pls fill out all fields', 1); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'assign_subject_to_teacher',
                    data: {
                        subject_id: subject_id,
                        user_id: user_id,
                        class_id: class_id
                    },
                    beforeSend:() => {
                        btnProcess('.assignSubject', 'Assign Subject', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.assignSubject', 'Assign Subject', 'after');
                    console.log(res);
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.assignSubject', 'Assign Subject', 'after');
                    console.log(res);
                })
            })
        })
    </script>

@endsection
