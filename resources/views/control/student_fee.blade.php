@extends('layouts.app')

@section('page_title')
Student Fee
@endsection
@php
    $page = isset($_GET['page']) ? $_GET['page'] : 1 ;
@endphp


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 name-title">Student Fee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="/control/student/{{$student_id}}">Profile</a></li>
                        <li class="breadcrumb-item active">Student Fee</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">

                <div class="card card-secondary card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title text-bold">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            School Fee and Payments
                        </h3>
                        <div class="p-0 m-0">
                            <form action="">
                                <select class="form-control select2bs4" name="" id="term" style="height: 15px">
                                    <option selected term>Select Term</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fee</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Total</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="transaction_list">
                                    <tr>
                                        <td colspan="12">
                                            <div class="text-center">
                                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                                <i> Loading Transactions... </i>
                                            </div>
                                        </td>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });


            function fetchFee()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_student_fee/{{$student_id}}/{{$term_id}}?page={{$page}}'
                }).done(function(res) {
                    body = $('#transaction_list');
                    body.html(``)
                    $('.name-title').html(`Student Fee (${res.data.student.surname+' '+res.data.student.firstname})`)
                    $('.card-title').html(`<i class="fa fa-list-alt" aria-hidden="true"></i> School Fee and Payments (${term_text(res.data.term.term)} ${res.data.term.session.session})`);
                    res.data.transactions.data.map((tran, index) => {
                        body.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${(tran.fee_cat) ? tran.fee_cat.fee : 'General Payment'}</td>
                                <td>${moneyFormat(tran.amount)}</td>
                                <td>${moneyFormat(tran.discount)}</td>
                                <td>${moneyFormat(Math.abs(tran.total))}</td>
                                <td>${(tran.type==1) ? '<div class="badge bg-danger">School Fee</div>' : '<div class="badge bg-success">Fee Payment</div>' }</td>
                                <td>${formatDate(tran.created_at)}</td>
                                <td><a href="javascript:;"><i class="fa fa-print" aria-hidden="true"></i> Receipt</a></td>
                            </tr>
                        `)
                    })

                    link_body = $('#page_links')
                    link_body.html(dropPaginatedPages(res.data.transactions.links));



                }).fail(function (res) {
                    littleAlert('Erorr Processing Request, Pls Reload page', 1);
                })
            }


            fetchFee();


            $('#term').on('change', function() {
                term = $(this).val();
                location.href=`/control/student/fee/{{$student_id}}/${term}`
            })

            function fetchTerm()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'get/session'
                }).done(function (res) {
                    tt = $('#term');
                    res.data.map(ses => {
                        ses_name = ses.session;
                        ses.terms.forEach(term => {
                            tt.append(`
                                <option value="${term.id}" ${(term.id == '{{$term_id}}') ? 'selected' : ''} >${term_text(term.term)} ${ses_name}</option>
                            `)
                        });
                    })
                })
            }

            fetchTerm()


            // setTimeout(() => {
            //     $("#example1").DataTable({
            //         "responsive": true, "lengthChange": false, "autoWidth": false,
            //         "buttons": ["copy", "csv", "excel", "pdf", "print"],
            //         "paging": false,
            //         "searching": true,
            //         "ordering": true,
            //         "info": true,
            //         "autoWidth": true,
            //         "responsive": false,
            //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // }, 2500);

        })
    </script>


@endsection
