@extends('layouts.app')

@section('page_title')
Daily Fee Payments
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daily Fee Payments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Daily Fee Payments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-body">
                        <form action="" class="row">
                            <div class=" col-md-4 form-group">
                                <label>Select Day</label>
                                <input type="date" class="form-control">
                            </div>
                        </form>
                    </div>
                </div>


                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Payments (10, Jan 2022)
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
                                        <th>Fee</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Tolani Onyemechi</td>
                                        <td>SSS 3</td>
                                        <td>Sport Due</td>
                                        <td>$ 7, 500</td>
                                        <td>10, Jan 2022 | 10:15 am</td>
                                        <td>School Admin</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3 mb-2">
                            <div class="card-tools">
                                <ul class="pagination pagination-">
                                  <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                                  <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>

                </div>



            </div>

        </div>
    </section>


@endsection
