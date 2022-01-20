@extends('layouts.app')

@section('page_title')
    Gurdian Profile
@endsection


@section('page_content')


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Gurdian Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Gurdian Profile</li>
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

                        <h3 class="profile-username text-center">Mrs. Tolani Onyemechi</h3>

                        <p class="text-muted text-center">4th avenue, aliu street GRA Alagbaka Akure</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><i class="fa fa-envelope" aria-hidden="true"></i></b> <a
                                    class="float-right">tolani@gmail.com</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-phone" aria-hidden="true"></i></b> <a
                                    class="float-right">2349038772366</a>
                            </li>
                        </ul>

                        <button class="btn btn-success btn-block"><b> <i class="fa fa-user-check"></i> Activate</b></button>
                        <button class="btn btn-danger btn-block"><b> <i class="fa fa-user-times"></i>
                                Deactivate</b></button>
                        <a class="btn btn-primary btn-block" href="#settings"
                        data-toggle="tab"><b> <i class="fas fa-edit    "></i> Edit Profile</b></a>
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
                                    <caption>Students</caption>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" >
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Onyemechi Christianah</td>
                                            <td>JSS 1</td>
                                            <td>Female</td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="">Go-to-profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>Onyemechi Tofunmi</td>
                                            <td>SSS 1</td>
                                            <td>Female</td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="">Go-to-profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>Onyemechi Amechi</td>
                                            <td>Pry 4</td>
                                            <td>Male</td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="">Go-to-profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>


                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">
                                <form action="" class="row">
                                    <div class=" col-md-6 form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Gurdians name" >
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>Home Address</label>
                                        <input type="text" class="form-control" placeholder="Lekki, Nigeria" >
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" disabled placeholder="mail@gmail.com" >
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="090000000000" >
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>State of Origin</label>
                                        <input type="text" class="form-control" placeholder="Lagos" >
                                    </div>
                                    <div class=" col-md-6 form-group">
                                        <label>L.G.A</label>
                                        <input type="text" class="form-control" placeholder="ikeja" >
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-secondary float-right ">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
