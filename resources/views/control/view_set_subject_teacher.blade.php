@extends('layouts.app')

@section('page_title')
Subjects
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subject Teachers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Subject Teacher</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title ">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                Subject Teachers List
                            </h3>
                            <div class="d-flex justify-content-end">
                                <button data-toggle="modal" data-target="#assignSubjectModal" class="btn btn-secondary float-right btn-sm">
                                    Assign Subject
                                </button>
                            </div>
                        </div>


                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Class</th>
                                        <th>Teacher</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mathematics</td>
                                        <td>JSS 1</td>
                                        <td>Mr. Adepoju Salami Giwa</td>
                                        <td><button class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button> </td>
                                    </tr>
                                </tbody>
                            </table>
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
                    {{-- <h6 class="modal-title text-bold">Assign Subject</h6> --}}
                    <p class="modal-title text-bold">Assign Subject</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row">
                        <div class="col-md-4 form-group">
                            <label>Subject</label>
                            <select name="subject_id" class="form-control select2bs4" >
                                <option selected disabled>Select Option</option>
                                <option value="">English</option>
                                <option value="">Mathematics</option>
                                <option value="">Biology</option>
                            </select>
                        </div>


                        <div class="col-md-4 form-group">
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

                        <div class="col-md-4 form-group">
                            <label>Teacher</label>
                            <select name="teacher_id" class="form-control select2bs4" style="width: 100%;" >
                                <option selected disabled>Select Option</option>
                                <option value="">Mr Adewole Salami Giwa</option>
                                <option value="">Jasper Gideon</option>
                                <option value="">Lugard Sapare</option>
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
