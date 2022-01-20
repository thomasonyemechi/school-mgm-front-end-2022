@extends('layouts.app')

@section('page_title')
    Student Profile
@endsection


@section('page_content')
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Student Profile</li>
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

                        <h3 class="profile-username text-center">Tolani Onyemechi</h3>

                        <p class="text-muted text-center">JSS 1<sup>C</sup> | Female</p>

                        {{-- <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><i class="fa fa-envelope" aria-hidden="true"></i></b> <a
                                    class="float-right">tolani@gmail.com</a>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fa fa-phone" aria-hidden="true"></i></b> <a
                                    class="float-right">2349038772366</a>
                            </li>
                        </ul> --}}

                        <button class="btn btn-success btn-block"><b> <i class="fa fa-user-check"></i> Activate</b></button>
                        <button class="btn btn-danger btn-block"><b> <i class="fa fa-user-times"></i>
                                Deactivate</b></button>
                        <a class="btn btn-primary btn-block" href="#settings" data-toggle="tab"><b> <i
                                    class="fas fa-edit    "></i> Edit Profile</b></a>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-secondary card-outline">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#gurdian"
                                    data-toggle="tab">Gurdian</a></li>
                            <li class="nav-item"><a class="nav-link" href="#result" data-toggle="tab">Result &
                                    Transcript</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings"
                                    data-toggle="tab">Settings</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div class="d-flex justify-content-between">
                                    <b>Levies</b>
                                    <button data-toggle="modal" data-target="#addPayment"
                                        class="btn btn-secondary mb-1 btn-xs">Add Payments</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <th>Fee</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                        </tr>

                                        <tr>
                                            <td>Special Tutor Fee</td>
                                            <td>$ 7,500</td>
                                            <td>$ 300</td>
                                            <td>$ 7,200</td>
                                        </tr>

                                        <tr>
                                            <th colspan="3">Balance Brought Foward</th>
                                            <td>$ 10,500</td>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Amount Paid</th>
                                            <th>$ 12,700</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Expected Payments</th>
                                            <th>$ 5,000</th>
                                        </tr>
                                    </table>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between">
                                    <b>Related Student(s)</b>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Gender</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Dumebi Onyemechi</td>
                                            <td>SSS 3</td>
                                            <td>Female</td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="">Go-to-profile <i class="fa fa-arrow-circle-right"
                                                            aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>


                            </div>



                            <div class="tab-pane" id="gurdian">
                                {{-- <h5>Gurdian Profile</h5> --}}

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ asset('assets/img/user4-128x128.jpg') }}" alt="User profile picture">
                                            </div>

                                            <h3 class="profile-username text-center">Tolani Onyemechi</h3>

                                            <p class="text-muted text-center">4th avenue, aliu street GRA Alagbaka Akure</p>

                                            <div class="text-center">
                                                <a href="/control/gurdian_profile">Go-to-profile <i class="fas fa-arrow-circle-right"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between"style="font-size: larger">
                                            <div >
                                                <i class="fa fa-envelope" aria-hidden="true"> </i>
                                                 mrstolani@schoolpetal.com
                                            </div>

                                            <div>
                                                <i class="fa fa-phone-alt" aria-hidden="true"></i>
                                                 09038772366
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between"style="font-size: larger">
                                            <div >
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                                 Lagos
                                            </div>

                                            <div>
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                                 Lagos South
                                            </div>
                                        </div>

                                        <hr>

                                        <h5 class="text-muted">Send SMS To Gurdian</h5>

                                        <form action="">
                                            <div class="form-group">
                                                <textarea name="" id="" rows="2" class="form-control"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary" onclick="return confirm('Balance reminder will be sent to this gurdian')" > <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Balance Reminder SMS</button>
                                                <button class="btn btn-secondary float-right"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Send </button>
                                            </div>
                                        </form>

                                        <h6 class="text-muted">Recently Sent SMS</h6>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Message</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>10 Jan, 2022</td>
                                                        <td> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum error pariatur esse cupiditate possimus aspernatur, perspiciatis vero enim quae alias dolorem obcaecati incidunt deserunt fugit beatae, laudantium molestias cum laboriosam. </td>
                                                    </tr>
                                                    <tr>
                                                        <td>10 Jan, 2022</td>
                                                        <td> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum error pariatur esse cupiditate possimus aspernatur, perspiciatis vero enim quae alias dolorem obcaecati incidunt deserunt fugit beatae, laudantium molestias cum laboriosam. </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="tab-pane" id="result">
                                <h5>Result and Transcript</h5>
                                <a href="/control/gurdian_profile">Go-to-Profile <i
                                        class="fas fa-arrow-circle-right    "></i> </a>
                            </div>


                            <div class="tab-pane" id="settings">
                                <h5 class="text-muted">Basic Info</h5>
                                <form action="" class="row">
                                    <div class=" col-md-4 form-group">
                                        <label>Surname</label>
                                        <input type="text" class="form-control" value="Onyemechi" placeholder="Surname">
                                    </div>

                                    <div class=" col-md-4 form-group">
                                        <label>Firstname</label>
                                        <input type="text" class="form-control" value="Tolani" placeholder="Firstname">
                                    </div>

                                    <div class=" col-md-4 form-group">
                                        <label>Othernames</label>
                                        <input type="text" class="form-control" value="Chioma" placeholder="Othernames">
                                    </div>

                                    <div class=" col-md-6 form-group">
                                        <label>Gurdian</label>
                                        <select name="" class="form-control select2bs4" id="">
                                            <option selected>Jasper Onyemechi | Onyemechi@gmail.com</option>
                                            <option value="">Aladetan Agbani | agbai@gmail.com</option>
                                        </select>
                                    </div>
                                    <div class=" col-md-2 form-group">
                                        <label>Gender</label>
                                        <select name="" class="form-control select2bs4" id="">
                                            <option selected>Female</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                    <div class=" col-md-4 form-group">
                                        <label>Registration Number</label>
                                        <input type="text" class="form-control" value="SCHOLL_1212-121" placeholder="Registration Number">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-secondary float-right ">Update</button>
                                    </div>
                                </form>

                                <hr>


                                <h5 class="text-muted">Class & Arm</h5>

                                <form action="" class="row">
                                    <div class="col-md-4 form-group">
                                        <label>Class</label>
                                        <select name="" id="" class="form-control  select2bs4">
                                            <option selected disabled>Select Option</option>
                                            <option>JSS 1</option>
                                            <option>JSS 2</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Arm</label>
                                        <select name="" class="form-control select2bs4">
                                            <option selected disabled>Select Option</option>
                                            <option value="">A</option>
                                            <option value="">B</option>
                                            <option value="">C</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="text-white">.</label>
                                        <button class="btn btn-secondary btn-block">Submit</button>
                                    </div>
                                </form>

                                <hr>

                                <h5 class="text-muted">Change Authentication Details</h5>

                                <form action="" class="row">
                                    <div class="col-md-4 form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="TOLANI2022" placeholder="Enter Username">
                                        <i class="text-danger">username already exist</i>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Password</label>
                                        <input type="number" class="form-control" value="2022" placeholder="4-6 Digits">
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label class="text-white">.</label>
                                        <button class="btn btn-secondary btn-block">Submit</button>
                                    </div>
                                </form>

                                <hr>

                                <h5 class="text-muted">Other Info</h5>

                                <form action="" class="row">
                                    <div class="col-md-3 form-group">
                                        <label>Blood Group</label>
                                        <input type="text" class="form-control" value="O+" placeholder="Enter Blood Group ie O-">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label>Geno Type</label>
                                        <input type="text" class="form-control" value="AA" placeholder="Enter Genetype i.e AA">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label>Ailment</label>
                                        <input type="text" class="form-control" value="None" placeholder="Enter if any">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label>Disability</label>
                                        <input type="text" class="form-control" value="None" placeholder="Enter if any">
                                    </div>


                                    <div class="col-md-6 form-group">
                                        <label>Previous School Attended</label>
                                        <input type="text" class="form-control" value="Ijapo High School" placeholder="">
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Reason For Leaving Previous School</label>
                                        <textarea name="" id="" rows="2" class="form-control">Graduation</textarea>
                                    </div>

                                    <div class="col-md-12 ">
                                        <button class="btn btn-secondary float-right">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="addPayment">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Add Payments </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row">
                        <div class="col-md-6 form-group">
                            <label>Fee Category</label>
                            <select name="subject_id" class="form-control select2bs4">
                                <option selected disabled>Select Fee Category</option>
                                <option value="">Tution Fee</option>
                                <option value="">Sport Levy</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" placeholder="Enter Amount i.e 15750">
                        </div>
                        <div class="col-12 form-group">
                            <button type="button" class="btn btn-secondary float-right ">Make Payment</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>





@endsection


