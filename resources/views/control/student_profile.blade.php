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
                                <div class="text-center">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    <i> Loading ... </i>
                                </div>
                            </div>


                            <div class="tab-pane" id="result">
                                <div class="text-center">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    <i> Loading ... </i>
                                </div>
                            </div>


                            <div class="tab-pane" id="settings">
                                <div class="text-center">
                                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                    <i> Loading ... </i>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- <div class="modal fade" id="addPayment">
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
    </div> --}}


    <div class="modal fade" id="makePayment">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Make Payments </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="make_pay" class="row">
                        <div class="col-md-6 form-group">
                            <label>Fee Category</label>
                            <select name="fee_cat" id="fee_cat" class="form-control select2bs4">
                                <option selected disabled>Select Fee Category</option>
                                <option value="">Tution Fee</option>
                                <option value="">Sport Levy</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter Amount i.e 15750">
                        </div>
                        <div class="col-12 form-group">
                            <button type="submit" class="btn btn-secondary float-right make_pay">Make Payment</button>
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

                    setTimeout(() => {
                        fetchReq();
                    }, 2000);
                }).fail(function (res) {
                })
            }

            fetchStudent();



            function activityTap(data) {
                body = $('#activity')
                guard = data.guardian
                ot = JSON.parse(data.others)
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
                `)
            }


            function settingTab(data){
                body = $('#settings')
                guard = data.guardian
                ot = JSON.parse(data.others)
                body.html(`
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-bold">Edit Basic Info</h4>
                    </div>
                    <div class="card-body">
                        <form action="" id="basic_info" class="row">
                            <div class=" col-md-4 form-group">
                                <label>Surname </label>
                                <input type="text" name="surname" class="form-control" value="${data.surname}" placeholder="Surname">
                            </div>

                            <div class=" col-md-4 form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" value="${data.firstname}" placeholder="Firstname">
                            </div>

                            <div class=" col-md-4 form-group">
                                <label>Othernames</label>
                                <input type="text" name="othername" class="form-control" value="${data.othername}" placeholder="Othernames">
                            </div>

                            <div class=" col-md-6 form-group">
                                <label>Gurdian</label>
                                <select name="guardian" class="form-control select2bs4" id="select_guardian">
                                    <option selected value="${guard.id}">${guard.guardian_name} | ${guard.guardian_email}</option>
                                </select>
                            </div>
                            <div class=" col-md-2 form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control select2bs4" id="">
                                    <option selected>${data.sex}</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>Registration Number</label>
                                <input type="text" name="reg" class="form-control" value="${data.registration_number}" placeholder="Registration Number">
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-secondary float-right basic_info">Update</button>
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
                                <select name="" id="select_class" class="form-control  select2bs4">
                                    <option selected value="${(data.class) ? data.class.id : ''}">${(data.class) ? data.class.class : ''}</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Arm</label>
                                <select name="" id="select_arm" class="form-control select2bs4">
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

            function fetchReq()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'registration_requirements'
                }).done(function (res){
                    guardian = $('#select_guardian')
                    res.data.guardians.map(guard => {
                        guardian.append(`<option value="${guard.id}">${guard.guardian_name} | ${guard.guardian_email}</option>`)
                    });

                    cla = $('#select_class')
                    res.data.classes.map(clas => {
                        cla.append(`<option value="${clas.id}">${clas.class}</option>`)
                    });

                    arms = $('#select_arm')
                    res.data.arms.map(arm => {
                        arms.append(`<option value="${arm.id}">${arm.arm}</option>`)
                    });


                }).fail(function(res) {
                })
            }



            $('body').on('click', '.basic_info', function (e) {
                e.preventDefault();
                form = $('#basic_info')

                surname = $(form).find('input[name="surname"]').val();
                firstname = $(form).find('input[name="firstname"]').val();
                othername = $(form).find('input[name="othername"]').val()
                gender = $(form).find('select[name="gender"]').val();
                guard = $(form).find('select[name="guardian"]').val();
                reg = $(form).find('input[name="reg"]').val();

                if(!guard || !surname || !firstname || !gender) { littleAlert('Pls fill out the required fields'); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'student/update_basic_info',
                    data: {
                        surname: surname,
                        firstname: firstname,
                        othername: othername,
                        reg: reg,
                        gender: gender,
                        guardian_id: guard,
                        student_id: '{{$student_id}}',
                    },
                    beforeSend:() => {
                        btnProcess('.basic_info', 'Update', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.basic_info', 'Update', 'after');
                    fetchStudent();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.basic_info', 'Update', 'after');
                })
            })



            function fetchFee() {
                $.ajax({
                    method: 'get',
                    url: api_url+'student/fee_sum/{{$student_id}}'
                }).done(function(res) {
                    putFee(res.data);
                }).fail(function(res) {
                })
            }

            fetchFee();


            function putFee(data) {

                body = $('#levies')
                body.html(``);

                fee_str = ''; fee_amt = 0 ; fee_dis = 0; fee_total = 0;

                data.fees.forEach((fee, index) => {
                    fee_amt += fee.amount;
                    fee_dis += fee.discount;
                    fee_total += fee.total;
                    fee_str += `
                        <tr>
                            <td>${fee.fee_cat.fee}</td>
                            <td>${moneyFormat(fee.amount)}</td>
                            <td>${moneyFormat(fee.discount)}</td>
                            <td>${moneyFormat(Math.abs(fee.total))}</td>
                        </tr>
                    `
                })


                fee_str += `
                    <tr>
                        <th></th>
                        <th>${moneyFormat(fee_amt)}</th>
                        <th>${moneyFormat(fee_dis)}</th>
                        <th>${moneyFormat(Math.abs(fee_total))}</th>
                    </tr>
                `
                total_owing = Math.abs(fee_total) + Math.abs(data.brought_fwd);

                fee_str += `
                <tr>
                    <th colspan="3">Balance Brought Foward</th>
                    <td>${moneyFormat(Math.abs(data.brought_fwd))}</td>
                </tr>
                <tr>
                    <th colspan="3">Total Owing</th>
                    <th>${ moneyFormat(total_owing) }</th>
                </tr>
                <tr>
                    <th colspan="3">Amount Paid</th>
                    <th>${moneyFormat(data.amt_paid)}</th>
                </tr>
                <tr>
                    <th colspan="3">Expected Payments</th>
                    <th>${moneyFormat(total_owing - data.amt_paid)}</th>
                </tr>
                `


                pay_string = ''; pay_total = 0;

                data.pays.forEach((pay) => {
                    pay_total += pay.total;
                    pay_string += `
                        <tr>
                            <td>${((pay.fee_cat) ? pay.fee_cat.fee : 'General Payment')}</td>
                            <td>${moneyFormat(pay.total)}</td>
                            <td>${formatDate(pay.created_at)}</td>
                        </tr>
                    `
                });


                pay_string += `
                    <tr>
                        <th>Total</th>
                        <th colspan="2">${moneyFormat(pay_total)}</th>
                    </tr>
                `

                body.append(`
                <div><a href="javascript:;" data-toggle="modal" data-target="#makePayment" class="btn btn-secondary mb-3">Make Fee Payment  </a></div>
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


                                    ${ fee_str }


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
                                    ${pay_string}
                                </table>
                            </div>
                        </div>
                    </div>


                    <div><a href="/control/student/fee/{{$student_id}}" class="btn btn-block btn-secondary">View School Fee Details <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a></div>

                `)
            }



            $('body').on('click', '.make_pay', function(e) {
                e.preventDefault();
                form = $('#make_pay');
                fee_cat = $(form).find('select[name="fee_cat"]').val();
                amt = $(form).find('input[name="amount"]').val();
                if(!confirm(`Are you sure you want to make payment of ${moneyFormat(amt)} ? payment cannot be altered once submited.`)) { return; }
                $.ajax({
                    method: 'post',
                    url: api_url+'make_fee_payment',
                    data: {
                        student_id: '{{$student_id}}',
                        fee_cat_id: fee_cat,
                        amount: amt
                    },
                    beforeSend:() => {
                        btnProcess('.make_pay', 'Make Payment', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.make_pay', 'Make Payment', 'after');
                    fetchFee();
                    $('#makePayment').modal('hide');
                    form[0].reset();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.make_pay', 'Make Payment', 'after');
                })
            });


            function fetchResult() {
                $.ajax({
                    method: 'get',
                    url: api_url+'results/{{$student_id}}'
                }).done(function (res) {
                    console.log(res);
                    resultTab(res);
                }).fail(function(res) {
                    console.log(res);
                })
            }
            fetchResult();



            function resultTab(data) {

                body = $('#result')


                res_str = ''

                data.results.forEach((res, index) => {
                    res_str += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${res.session.session}</td>
                            <td>${term_text(res.term.term)}</td>
                            <td>${res.class.class}</td>
                            <td>${res.subjects}</td>
                            <td>${formatDate(res.created_at)}</td>
                            <td><a class="btn btn-xs btn-info" href="/control/view-result/${res.id}"><i class="fas fa-eye"></i> View</a></td>
                        </tr>
                    `
                })



                body.html(`

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Results</h3>
                        </div>
                        <div class="card-body p-1">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>#</th>
                                        <th>Session</th>
                                        <th>Term</th>
                                        <th>Class</th>
                                        <th>Subjects</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>


                                    ${ res_str }


                                </table>
                            </div>
                        </div>
                    </div>
                `)
            }


            function fetchFeeCategory() {
                $.ajax({
                    method: 'post',
                    url: api_url+'fetch_fee_category'
                }).done(function (res) {
                    console.log(res);
                    body = $('#fee_cat');
                    body.html(`<option disabled selected>Select Fee Category</option> <option value="0">General Payment</option>`);
                    res.data.map(fee => {
                        body.append(`
                            <option value="${fee.id}">${fee.fee}</option>
                        `)
                    })
                }).fail(function (res) {
                    console.log(res);
                })
            }

            fetchFeeCategory();

        })
    </script>


@endsection


