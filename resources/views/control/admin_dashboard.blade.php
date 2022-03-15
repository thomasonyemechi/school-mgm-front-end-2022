@extends('layouts.app')

@section('page_title')
    Dashboard
@endsection

@section('page_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="assigned_fee">0</h3>

                        <p>Assigned Fee</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="reveived_payment">0</h3>

                        <p>Reveived Payments</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3 class="subject_teachers">0</h3>

                        <p>Subject Teachers</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Classes / Arms</span>
                        <span class="info-box-number classes">
                            0
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Subjects</span>
                        <span class="info-box-number subjects">0</span>
                    </div>
                </div>
            </div>
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Guardians</span>
                        <span class="info-box-number guardians">0</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Staffs</span>
                        <span class="info-box-number staffs">0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Fee Payment Chart
                        </h3>

                        <div class="card-tools">
                            <a href="#" class="text-secondary">See-More-Charts <i class="fa fa-arrow-circle-right"
                                    aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                          </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-users"></i>
                            Students
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix student_body">

                        </ul>
                    </div>
                </div>
            </div>

        </div>


    </section>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>


    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });


            $.ajax({
                method: 'get',
                url: api_url+`dashboard/param`
            }).done(function(res){
                console.log(res);
                $('.students').html(res.students)
                $('.subjects').html(res.subjects)
                $('.staffs').html(res.staffs)
                $('.assigned_fee').html(moneyFormat(res.assigned_fee))
                $('.reveived_payment').html(moneyFormat(res.reveived_payment))
                $('.subject_teachers').html(res.subject_teachers)
                $('.guardians').html(res.guardians)

                body = $('.student_body')
                res.recently_registered.forEach(stu => {
                    body.append(`
                        <li>
                            <img src="${api_url_root}${stu.photo}" alt="User Image">
                            <a class="users-list-name" href="/control/student/${stu.id}">${stu.surname + ' ' + stu.firstname}</a>
                            <span class="users-list-date">${stu.class.class}</span>
                        </li>
                    `)
                });


                labels2 = []
                data2 = []
                data3 = []

                res.pay_chart.forEach(p => {
                    console.log(p);
                    labels2.push(p.class.class)
                    data2.push(p.payment)
                    data3.push(p.fee)
                });

                console.log(labels2, data2);




                var areaChartData = {
                labels  : labels2,
                datasets: [
                    {
                    label               : 'Payments',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : data2
                    },
                    {
                    label               : 'Fees',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : false,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : data3
                    },
                ]
                }

                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChartData = $.extend(true, {}, areaChartData)
                var temp0 = areaChartData.datasets[0]
                var temp1 = areaChartData.datasets[1]
                barChartData.datasets[0] = temp1
                barChartData.datasets[1] = temp0

                var barChartOptions = {
                    responsive              : true,
                    maintainAspectRatio     : false,
                    datasetFill             : false
                }

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                })




            }).fail(function(res) {
                console.log(res);
            })
        })
    </script>



@endsection
