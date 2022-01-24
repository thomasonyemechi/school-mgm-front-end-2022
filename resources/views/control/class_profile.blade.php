@extends('layouts.app')

@section('page_title')
    Class Profile
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 class_name">Class Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Class Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="students">0</h3>

                        <p>Students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">See All <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="t_fee">0</h3>

                        <p>Assigned Fee</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/control/class/fee/{{$class_id}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="t_pay">0</h3>
                        <p>Reveived Payments</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/control/class/payments/{{$class_id}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="teachers">0</h3>

                        <p>Subject Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/control/class/teachers/class_id" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title student_list ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Students
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Arm</th>
                                        <th>Gender</th>
                                        <th>Added</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="student_list">
                                    <tr>
                                        <td colspan="12"><div class="text-center"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                            <i> Loading Students ... </i></div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="page_links">

                        </div>
                    </div>

                </div>


            </div>

        </div>
    </section>



    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });

            const class_id = `{{$class_id}}`

            function fetchClassSummary() {
                $.ajax({
                    method: 'get',
                    url: api_url+'class_summary/'+class_id
                }).done(function(res) {
                    data = res.data;
                    $('.class_name').html(`Class Profile (${res.data.class.class})`)
                    $('.students').html(data.students)
                    $('.teachers').html(data.teachers);
                    $('.t_fee').html(moneyFormat(Math.abs(data.fee)));
                    $('.t_pay').html(moneyFormat(data.pay));
                    $('.student_list').html(`<i class="fa fa-list-alt" aria-hidden="true"></i> ${data.class.class} Students`);
                }).fail(function (res) {
                    if(res.status == 404) {
                        littleAlert('This class does not exist', 1);
                        setTimeout(() => {
                            location.href="/control/create_class"
                        }, 2000);
                    }
                })
            }

            fetchClassSummary();
            function students(class_id)
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'class_students/'+class_id+'?page='+`{{ $_GET['page'] ?? 0 }}`
                }).done(function (res) {
                    console.log(res);

                    body = $('#student_list')
                    body.html(``);
                    res.data.data.map((stu, index) => {
                        status = (stu.status == 1) ? '<div class="badge bg-success">Active</div>' : '<div class="badge bg-danger">Not Active</div>' ;
                        body.append(`
                            <tr>
                                <td>${index+1}</td>
                                <td>${stu.surname + ' '+ stu.firstname}</td>
                                <td>${(stu.arm)? stu.arm.arm :''}</td>
                                <td>${stu.sex}</td>
                                <td>${formatDate(stu.created_at)}</td>
                                <td>${status}</td>
                                <td>
                                    <div class="float-right">
                                        <a href="/control/student_profile/${stu.id}" > Profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                                    </div>
                                </td>
                            </tr>
                        `)
                    })

                    links = res.data.links;
                    $('#page_links').html(dropPaginatedPages(res.data.links));
                }).fail(function (res) {
                    console.log(res);
                })
            }


            students(class_id);

        })
    </script>



@endsection
