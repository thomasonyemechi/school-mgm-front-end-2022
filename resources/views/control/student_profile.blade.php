@extends('layouts.app')

@section('page_title')
    Student Profile
@endsection


@section('page_content')
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Student Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-secondary card-outline">
                    <div class="card-body box-profile p-card">
                        <div class="text-center">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <i> Loading ... </i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-secondary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="#levies" data-toggle="tab">School Fees</a></li>
                            <li class="nav-item"><a class="nav-link" href="#result" data-toggle="tab">Result & Transcript</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>

                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="text-center">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    <i> Loading ... </i>
                                </div>
                            </div>

                            <div class="tab-pane" id="levies">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title text-bold">School Fees</h4>
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tr>
                                                    <th>Fee</th>
                                                    <th>Amount</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                </tr>

                                                <tr>
                                                    <td>Special Tutor Fee</td>
                                                    <td>$ 7,500</td>
                                                    <td>$ 300</td>
                                                    <td>$ 7,200</td>
                                                </tr>

                                                <tr>
                                                    <th></th>
                                                    <th>$ 7,500</th>
                                                    <th>$ 300</th>
                                                    <th>$ 7,200</th>
                                                </tr>

                                                <tr>
                                                    <th colspan="3">Balance Brought Foward</th>
                                                    <td>$ 10,500</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Amount Paid</th>
                                                    <th>$ 12,700</th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">Expected Payments</th>
                                                    <th>$ 5,000</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title text-bold">Recent Payments</h4>
                                    </div>
                                    <div class="card-body p-1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tr>
                                                    <th>Fee</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                </tr>

                                                <tr>
                                                    <td>Special Tutor Fee</td>
                                                    <td>$ 7,500</td>
                                                    <td>$ 300</td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane" id="result">
                                <h5>Result and Transcript</h5>
                                <a href="/control/gurdian_profile">Go-to-Profile <i
                                        class="fas fa-arrow-circle-right    "></i> </a>
                            </div>


                            <div class="tab-pane" id="settings">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="addPayment">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Add Payments </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row">
                        <div class="col-md-6 form-group">
                            <label>Fee Category</label>
                            <select name="subject_id" class="form-control select2bs4">
                                <option selected disabled>Select Fee Category</option>
                                <option value="">Tution Fee</option>
                                <option value="">Sport Levy</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" placeholder="Enter Amount i.e 15750">
                        </div>
                        <div class="col-12 form-group">
                            <button type="button" class="btn btn-secondary float-right ">Make Payment</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>



    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });


            function fetchStudent() {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_student/{{$student_id}}'
                }).done(function (res) {
                    console.log(res);
                    data = res.data
                    pc = $('.p-card')

                    status_btn = $(data.status == 0) ? `<button class="btn btn-success btn-block"><b> <i class="fa fa-user-check"></i> Activate</b></button>`
                     : `<button class="btn btn-success btn-block"><b> <i class="fa fa-user-times"></i> De-activate</b></button>`;
                    pc.html(`
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="${api_url_root+data.photo}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">${data.surname+' '+data.firstname+' '+data.othername}</h3>
                        <p class="text-muted text-center">${(data.class)? data.class.class :''}<sup>${(data.arm)? data.arm.arm :''}</sup> | ${data.sex}</p>
                        ${status_btn}
                        <a class="btn btn-primary btn-block" href="#settings" data-toggle="tab"><b> <i class="fas fa-edit"></i> Edit Profile</b></a>
                    `);

                    activityTap(data)
                    settingTab(data)
                }).fail(function (res) {
                    console.log(res);
                })
            }

            fetchStudent();



            function activityTap(data) {
                body = $('#activity')
                guard = data.guardian
                ot = JSON.parse(data.others)
                console.log(ot);
                body.html(`

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div><b>Registration No:</b> ${data.registration_number} </div>
                                <div><b>Admission Date:</b> ${formatDate(data.created_at)} </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><b>Date Of Birth:</b> 10, Jan 2022 </div>
                                <div><b>Admission Date:</b> 10, Jan 2022 </div>
                            </div>

                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><b>Username:</b> ${data.username} </div>
                                <div><b>Password:</b> ${data.pwd} </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-bold">Parent/ Guardian Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="{{ asset('assets/img/user4-128x128.jpg') }}" alt="User profile picture">
                                        </div>

                                        <h3 class="profile-username text-center">${guard.guardian_name}</h3>

                                        <p class="text-muted text-center">${guard.guardian_address}</p>

                                        <div class="text-center">
                                            <a href="/control/gurdian/${guard.id}">Go-to-profile <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="d-flex justify-content-between">
                                        <div><b>Father's Name:</b> ${guard.father_name} </div>
                                        <div><b>Father's Phone:</b> ${guard.father_phone} </div>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between">
                                        <div><b>Father's Occupation:</b> ${guard.father_occupation} </div>
                                        <div><b>Father's Address:</b> ${guard.father_office_address} </div>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between">
                                        <div><b>Mother's Name:</b> ${guard.mother_name} </div>
                                        <div><b>Mother's Phone:</b> ${guard.mother_phone} </div>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between">
                                        <div><b>Mother's Occupation:</b> ${guard.mother_occupation} </div>
                                        <div><b>Mother's Address:</b> ${guard.mother_address} </div>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between">
                                        <div><b>Guardian's Name:</b> ${guard.guardian_name} </div>
                                        <div><b>Guardian's Phone:</b> ${guard.guardian_phone} </div>
                                    </div>

                                    <hr>

                                    <div class="d-flex justify-content-between">
                                        <div><b>Guardian's Email:</b> ${guard.guardian_email} </div>
                                        <div><b>Guardian's Address:</b> ${guard.guardian_address} </div>
                                    </div>



                                    <hr>

                                    <h5 class="text-muted">Send SMS To Gurdian</h5>

                                    <form action="">
                                        <div class="form-group">
                                            <textarea name="" id="" rows="2" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary" onclick="return confirm('Balance reminder will be sent to this gurdian')" > <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Balance Reminder SMS</button>
                                            <button class="btn btn-secondary float-right"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Send </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-bold"> Miscellanous Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div><b>Blood Group:</b> ${ot.blood_group ?? ''} </div>
                                <div><b>Geno Type:</b> ${ot.genotype ?? ''} </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <div><b>Ailment:</b> ${ot.ailment ?? 'None'} </div>
                                <div><b>Disablity:</b> ${ot.disability ?? 'None'} </div>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <div><b>Previosu School:</b> ${ot.previous_school ?? 'None'} </div>
                                <div><b>Reason For leaving:</b> ${ot.reason_for_leaving ?? 'None'} </div>
                            </div>

                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Related Student(s)</h3>
                        </div>
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Gender</th>
                                        <th></th>
                                    </tr>
                                    <tr id="related_students">
                                        <td colspan="12"><div class="text-center">
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                            <i> Loading ... </i></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                `)
            }


            function settingTab(data){
                body = $('#settings')
                guard = data.guardian
                ot = JSON.parse(data.others)
                console.log(ot);
                body.html(`
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-bold">Edit Basic Info</h4>
                    </div>
                    <div class="card-body">
                        <form action="" class="row">
                            <div class=" col-md-4 form-group">
                                <label>Surname</label>
                                <input type="text" class="form-control" value="${data.surname}" placeholder="Surname">
                            </div>

                            <div class=" col-md-4 form-group">
                                <label>Firstname</label>
                                <input type="text" class="form-control" value="${data.firstname}" placeholder="Firstname">
                            </div>

                            <div class=" col-md-4 form-group">
                                <label>Othernames</label>
                                <input type="text" class="form-control" value="${data.othername}" placeholder="Othernames">
                            </div>

                            <div class=" col-md-6 form-group">
                                <label>Gurdian</label>
                                <select name="" class="form-control select2bs4" id="">
                                    <option selected value="${guard.id}">${guard.guardian_name} | ${guard.guardian_email}</option>
                                </select>
                            </div>
                            <div class=" col-md-2 form-group">
                                <label>Gender</label>
                                <select name="" class="form-control select2bs4" id="">
                                    <option selected>${data.sex}</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>Registration Number</label>
                                <input type="text" class="form-control" value="${data.registration_number}-121" placeholder="Registration Number">
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-secondary float-right ">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-bold">Class & Arm</h4>
                    </div>
                    <div class="card-body">
                        <form action="" class="row">
                            <div class="col-md-4 form-group">
                                <label>Class</label>
                                <select name="" id="" class="form-control  select2bs4">
                                    <option selected value="${(data.class) ? data.class.id : ''}">${(data.class) ? data.class.class : ''}</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Arm</label>
                                <select name="" class="form-control select2bs4">
                                    <option selected value="${(data.arm) ? data.arm.id : ''}">${(data.arm) ? data.arm.arm : ''}</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="text-white">.</label>
                                <button class="btn btn-secondary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-bold">Change Authentication Details</h4>
                    </div>
                    <div class="card-body">
                        <form id="auth_det" class="row">
                            <div class="col-md-4 form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" value="${data.username}" placeholder="Enter Username">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Password</label>
                                <input type="number" class="form-control" name="password" value="${data.pwd}" placeholder="4-6 Digits">
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="text-white">.</label>
                                <button class="btn btn-secondary btn-block auth_det">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-bold">Edit Other Info</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" class="row" id="miscellanous">
                            <div class="col-md-3 form-group">
                                <label>Blood Group</label>
                                <input type="text" class="form-control" name="blood_group" value="${ot.blood_group}" placeholder="Enter Blood Group ie O-">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Geno Type</label>
                                <input type="text" class="form-control" name="genotype" value="${ot.genotype}" placeholder="Enter Genetype i.e AA">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Ailment</label>
                                <input type="text" class="form-control" name="ailment" value="${ot.ailment}" placeholder="Enter if any">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Disability</label>
                                <input type="text" class="form-control" name="disability" value="${ot.disability}" placeholder="Enter if any">
                            </div>


                            <div class="col-md-6 form-group">
                                <label>Previous School Attended</label>
                                <input type="text" class="form-control" name="previous_school" value="${ot.previous_school}" placeholder="">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Reason For Leaving Previous School</label>
                                <textarea name="reason_for_leaving" rows="2" class="form-control" >${ot.reason_for_leaving}</textarea>
                            </div>

                            <div class="col-md-12 ">
                                <button type="button" class="btn btn-secondary float-right miscellanous">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                `)
            }



            $('body').on('click', '.auth_det', function(e) {
                e.preventDefault();
                form = $('#auth_det')
                username = $(form).find('input[name="username"]').val()
                pass = $(form).find('input[name="password"]').val();

                // console.log(username, pass);
                // return;
                if(!username || !pass){ littleAlert('The username and password field is required', 1); return; }
                $.ajax({
                    method: 'post',
                    url: api_url+'student/update_authdetails',
                    data: {
                        username: username,
                        password: pass,
                        student_id: '{{$student_id}}',
                    },
                    beforeSend:() => {
                        btnProcess('.auth_det', 'Submit', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.auth_det', 'Submit', 'after');
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.auth_det', 'Submit', 'after');
                })
            })



            $('body').on('click', '.miscellanous', function(e) {
                e.preventDefault();
                console.log('huey');
                form = $('#miscellanous');
                $.ajax({
                    method: 'post',
                    url: api_url+'student/update_miscellaneous',
                    data: {
                        blood_group: $(form).find('input[name="blood_group"]').val(),
                        genotype: $(form).find('input[name="genotype"]').val(),
                        disability: $(form).find('input[name="disability"]').val(),
                        ailment: $(form).find('input[name="ailment"]').val(),
                        student_id: '{{$student_id}}',
                        previous_school: $(form).find('input[name="previous_school"]').val(),
                        reason_for_leaving: $(form).find('input[name="reason_for_leaving"]').val(),
                    },
                    beforeSend:() => {
                        btnProcess('.miscellanous', 'Submit', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.miscellanous', 'Submit', 'after');
                    fetchStudent();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.miscellanous', 'Submit', 'after');
                })
            })


        })
    </script>


@endsection


