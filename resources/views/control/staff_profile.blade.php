@extends('layouts.app')

@section('page_title')
    Staff Profile
@endsection


@section('page_content')
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Staff Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Staff Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-secondary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('assets/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">Adeyinka Yusuf</h3>

                        <p class="text-muted text-center">Administrator</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><i class="fa fa-envelope" aria-hidden="true"></i></b> <a
                                    class="float-right">yusuf@schoolpetal.com</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-phone" aria-hidden="true"></i></b> <a
                                    class="float-right">2349038772366</a>
                            </li>
                        </ul>

                        <button class="btn btn-success btn-block"><b> <i class="fa fa-user-check"></i> Activate</b></button>
                        <button class="btn btn-danger btn-block"><b> <i class="fa fa-user-times"></i>
                                Deactivate</b></button>
                        <button class="btn btn-primary btn-block"><b> <i class="fas fa-edit    "></i> Edit
                                Profile</b></button>
                    </div>
                </div>
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <div class="align-items-center d-flex justify-content-between">
                            <h3 class="card-title">About</h3>
                            <button class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                        <p class="text-muted">Royal Brids, Ijapo Estate Akure</p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum
                            enim neque.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-secondary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings"
                                    data-toggle="tab">Settings</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="d-flex justify-content-between">
                                    <caption>Assigned Subjects</caption>
                                    <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#assignSubjectModal">assign subjects to adeyinka</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" >
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Mathematics</td>
                                            <td>JSS 1</td>
                                            <td>10, Jan, 22</td>
                                            <td>
                                                <div class="float-right">
                                                    <button class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    <a href="">view-result <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- <div class="table">
                                    <caption>Payment History</caption>
                                    <table class="table table-striped table-hover" >
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </table>
                                </div> --}}
                            </div>
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName"
                                                value="Adetinka Yusuf" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName"
                                                value="mail@gmail.com" disabled placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName"
                                                value="090000000000" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-secondary float-right">Submit</button>
                                        </div>
                                    </div>
                                </form>

                                <hr>
                                <h6>Manage User Permission</h6>
                                <form action="" class="row">
                                    <div class="col-md-3">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="upload_result">
                                            <label for="upload_result">
                                                Upload Result
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="manage_registrations">
                                            <label for="manage_registrations">
                                                Manage Registrations
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="make_payments">
                                            <label for="make_payments">
                                                Make Payments
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-secondary float-right">Update Permisson</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade" id="assignSubjectModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Assign Subject To Adeyinka</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row">
                        <div class="col-md-6 form-group">
                            <label>Subject</label>
                            <select name="subject_id" class="form-control select2bs4" >
                                <option selected disabled>Select Option</option>
                                <option value="">English</option>
                                <option value="">Mathematics</option>
                                <option value="">Biology</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Class</label>
                            <select name="subject_id" class="form-control select2bs4" >
                                <option selected disabled>Select Option</option>
                                <option value="">JSS 1</option>
                                <option value="">JSS 2</option>
                                <option value="">JSS 3</option>
                                <option value="">SSS 1</option>
                                <option value="">SSS 2</option>
                                <option value="">SSS 3</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <button type="button" class="btn btn-secondary float-right ">Assign Subject</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



@endsection
