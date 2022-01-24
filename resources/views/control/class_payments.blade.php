@extends('layouts.app')

@section('page_title')
    Class Payments
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 class_name">Class Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/control/class/{{$class_id}}">Class Profile</a></li>
                        <li class="breadcrumb-item active">Payments</li>
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
                                        <th>By</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody id="pay_list">
                                    <tr>
                                        <td colspan="12"><div class="text-center"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i> Loading Payment ... </i></div></td>
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
            function studentsPay(class_id)
            {
               t = 0;
                $.ajax({
                    method: 'get',
                    url: api_url+'class_payment/'+class_id+'?page='+`{{ $_GET['page'] ?? 0 }}`
                }).done(function (res) {
                    $('.class_name').html(`Class Payments (${res.data.class.class})`)
                    body = $('#pay_list')
                    body.html(``);
                    res.data.pays.data.map((pay, index) => {
                        t += pay.total;
                        body.append(`
                            <tr>
                                <td>${index+1}</td>
                                <td>${pay.student.surname + ' '+ pay.student.firstname}</td>
                                <td>${pay.fee_cat.fee}</td>
                                <td>${moneyFormat(pay.total)}</td>
                                <td></td>
                                <td>${formatDate(pay.created_at)}</td>
                            </tr>
                        `)
                    })

                    body.append(`
                        <tr>
                            <th colspan="3"></th>
                            <th>${moneyFormat(Math.abs(t))}</th>
                            <th colspan="2"></th>
                        </tr>
                    `);

                    link_body = $('#page_links');
                    link_body.html(dropPaginatedPages(res.data.pays.links))

                    // $("#example1").DataTable({
                    //     "responsive": true, "lengthChange": false, "autoWidth": false,
                    //     "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    //     "paging": false,
                    //     "searching": true,
                    //     "ordering": true,
                    //     "info": true,
                    //     "autoWidth": true,
                    //     "responsive": false,
                    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


                }).fail(function (res) {
                    parseError(res.responseJSON)
                })
            }


            studentsPay(class_id);
        })
    </script>



@endsection
