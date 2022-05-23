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
                    <a href="/control/class/teachers/{{$class_id}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                        </div>]
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



        })
    </script>



@endsection
