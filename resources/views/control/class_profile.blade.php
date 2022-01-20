@extends('layouts.app')

@section('page_title')
    Class Profile
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Class Profile (JSS 1)</h1>
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
                        <h3>150</h3>

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
                        <h3>$ 125,950</h3>

                        <p>Assigned Fee</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/control/class/fees/class_id" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>$ 105,250</h3>

                        <p>Reveived Payments</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/control/class/payments/class_id" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>65</h3>

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
                        <h3 class="card-title ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            JSS 1 Students
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Jasper Benzene Cynthia</td>
                                        <td>C</td>
                                        <td>Female</td>
                                        <td>10, Jan, 21</td>
                                        <td>
                                            <div class="float-right">
                                                <a href="#" > Go-to-profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </section>


    {{-- <div class="modal fade" id="createClassModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Create Class </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row">
                        <div class="col-md-6 form-group">
                            <label>Category</label>
                            <select name="subject_id" class="form-control select2bs4" >
                                <option selected disabled>Select Class Category</option>
                                <option value="">JSS</option>
                                <option value="">PRY</option>
                                <option value="">SSS</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Level</label>
                            <select name="level" class="form-control select2bs4" style="width: 100%;" >
                                <option selected disabled>Select Level</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value={{$i}}> {{$i}} </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <button type="button" class="btn btn-secondary float-right ">Create Class</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div> --}}




@endsection
