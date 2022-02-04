@extends('layouts.app')

@section('page_title')
Transaction Accross Date Range
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fee Detail</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Fee Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-secondary card-outline">
                            <div class="card-body">
                                <form action="" id="dateForm" class="row">
                                    <div class="col-6 form-group">
                                        <label>From</label>
                                        <input type="date" name="from" class="form-control">
                                    </div>

                                    <div class="col-6 form-group">
                                        <label>To</label>
                                        <input type="date" name="to" class="form-control">
                                    </div>

                                    <div class="col-12 form-group">
                                        <button class="btn btn-secondary float-right">View Transaction</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>

                    </div>
                </div>


                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span id="dis_date">Payments</span>
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Class</th>
                                        <th>Term</th>
                                        <th>Fee</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="transact_body">
                                    <tr>
                                        <td colspan="12"><div class="text-center">
                                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                            <i> Loading Transactions ... </i>

                                        </div></td>
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

            $('#dateForm').on('submit', function(e) {
                e.preventDefault();
                form = $(this);
                from = $(form).find('input[name="from"]').val();
                to = $(form).find('input[name="to"]').val();
                if(!form || !to){ littleAlert('All fields are required', 1); return; }
                location.href=`/control/fee/range/${from}/${to}`
                btnProcess('.dateForm', 'View Transaction', 'before');
            })


            function fetchTransaction() {
                from = '{{$from}}'; to = '{{$to}}';

                if(!from || !to) { littleAlert('Pls select date range', 1); $('#transact_body').html(``); return; }

                $.ajax({
                    method: 'get',
                    url: api_url+`transaction/range/{{$from}}/{{$to}}?page={{$_GET['page'] ?? 1}}`
                }).done(function(res) {
                    console.log(res);
                    createHistoryFeeBody(res);
                }).fail(function(res) {
                    console.log(res);
                })
            }


            fetchTransaction();


            function createHistoryFeeBody(data) {
                body = $('#transact_body');
                body.html(``);
                $('#dis_date').html(`${data.date} Fee Transactions`)
                data.data.data.map((tran, index) => {
                    amt = Math.abs(tran.total);
                    body.append(`

                        <tr>
                            <td>${index+1}</td>
                            <td>${tran.student.surname+' '+tran.student.firstname}</td>
                            <td>${tran.class.class}</td>
                            <td>${term_text(tran.term.term)}</td>
                            <td>${(tran.fee_cat) ? tran.fee_cat.fee : 'General Payment'}</td>
                            <td>${moneyFormat(amt)}</td>
                            <td>${(tran.type == 5) ? `<div class="badge bg-success">Fee Payment</div>` : `<div class="badge bg-danger">School Fee</div>`}</td>
                            <td>${formatDate(tran.created_at)}</td>
                            <td>${tran.creator.name}</td>
                            <td><a href="#"> <i class="fa fa-print" aria-hidden="true"></i> Receipt</a></td>
                        </tr>
                    `)
                })
                $('#page_links').html(dropPaginatedPages(data.data.links));
            }


        })
    </script>



@endsection
