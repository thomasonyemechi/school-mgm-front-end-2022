@extends('layouts.app')

@section('page_title')
    Class Fee
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 class_name">Class Fee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/control/class/{{$class_id}}">Class Profile</a></li>
                        <li class="breadcrumb-item active">Fees</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Fee</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="student_list">
                                    <tr>
                                        <td colspan="12"><div class="text-center"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i> Loading Fees ... </i></div></td>
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
            function studentsFees(class_id)
            {
                t_amt = 0; t_dis = 0; t = 0;
                $.ajax({
                    method: 'get',
                    url: api_url+'class_fee/'+class_id+'?page='+`{{ $_GET['page'] ?? 0 }}`
                }).done(function (res) {
                    $('.class_name').html(`Class Fee (${res.data.class.class})`)
                    body = $('#student_list')
                    body.html(``);
                    res.data.fees.data.map((fee, index) => {
                        t_amt += fee.amount;
                        t_dis += fee.discount;
                        t += fee.total;
                        body.append(`
                            <tr>
                                <td>${index+1}</td>
                                <td>${fee.student.surname + ' '+ fee.student.firstname}</td>
                                <td>${fee.fee_cat.fee}</td>
                                <td>${moneyFormat(fee.amount)}</td>
                                <td>${moneyFormat(fee.discount)}</td>
                                <td>${moneyFormat(Math.abs(fee.total))}</td>
                                <td>${formatDate(fee.created_at)}</td>
                            </tr>
                        `)
                    })

                    body.append(`
                        <tr>
                            <th colspan="3"></th>
                            <th>${moneyFormat(Math.abs(t_amt))}</th>
                            <th>${moneyFormat(Math.abs(t_dis))}</th>
                            <th>${moneyFormat(Math.abs(t))}</th>
                            <th></th>
                        </tr>
                    `);

                    link_body = $('#page_links');
                    link_body.html(dropPaginatedPages(res.data.fees.links))

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


                }).fail(function (res) {
                    parseError(res.responseJSON)
                })
            }


            studentsFees(class_id);
        })
    </script>



@endsection
