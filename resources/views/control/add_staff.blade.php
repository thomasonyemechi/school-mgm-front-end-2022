@extends('layouts.app')

@section('page_title')
Add Staff
@endsection
@php
    $page = isset($_GET['page']) ? $_GET['page'] : 1 ;
@endphp


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Staff</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Add Staff</li>
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
                                Staff List
                            </h3>
                            <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addStaffModal"> Add Staff</button>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="staff_list_body">

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


    <div class="modal fade" id="addStaffModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Add Staff </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row" id="addStaffForm">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Thomas Gideon">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="staff@schoolpetal.com">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="09000000000">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Role</label>
                            <select name="role" class="form-control select2bs4" style="width: 100%;" >
                                <option selected disabled>Select Role</option>
                                <option value="8">Accountant</option>
                                <option value="9">Administrator</option>
                                <option value="7">Teacher</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <button type="submit" class="btn btn-secondary float-right addStaff ">Add Staff</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>


    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });


            function fetchStaffSummaryInfo()
            {
                page = '{{$page}}'
                $.ajax({
                    method: 'get',
                    url: api_url+'get_all_staffs?page='+page
                }).done(function (res) {
                    body = $('#staff_list_body')
                    body.html(``);


                    res.data.data.map((staff, index) => {
                        body.append(`
                            <tr>
                                <td>${(index + 1) + ((page-1) * 100)}</td>
                                <td>${staff.name}</td>
                                <td>${staff.email}</td>
                                <td>${staff.phone}</td>
                                <td>${staff_role(staff.role)}</td>
                                <td>
                                    <div class="float-right">
                                        <a href="/control/staff_profile/${staff.id}" > Profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                                    </div>
                                </td>
                            </tr>
                        `);
                    })

                    link_body = $('#page_links')
                    link_body.html(dropPaginatedPages(res.data.links));



                }).fail(function(res) {
                    console.log(res);
                });
            }


            fetchStaffSummaryInfo();


            setTimeout(() => {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    "paging": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }, 2500);


            $('#addStaffForm').on('submit', function(e) {
                e.preventDefault();
                form = $(this)

                name = $(form).find('input[name="name"]').val();
                email = $(form).find('input[name="email"]').val();
                phone = $(form).find('input[name="phone"]').val();
                role = $(form).find('select[name="role"]').val();

                if(!email || !phone || !name || !role){ littleAlert('All fields are required', 1); return }

                $.ajax({
                    method: 'post',
                    url: api_url+'add_staff',
                    data: {
                        name: name,
                        email: email,
                        phone: phone,
                        role: role
                    },
                    beforeSend:() => {
                        btnProcess('.addStaff', 'Add Staff', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    btnProcess('.addStaff', 'Add Staff', 'after');
                    form[0].reset();
                    $('#addStaffModal').modal('hide');
                    fetchStaffSummaryInfo();
                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.addStaff', 'Add Staff', 'after');
                });


            })

        })
    </script>





@endsection
