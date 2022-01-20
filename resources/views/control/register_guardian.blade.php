@extends('layouts.app')

@section('page_title')
Guardians
@endsection
@php
    $page = isset($_GET['page']) ? $_GET['page'] : 1 ;
@endphp


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Guardians</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Guardians</li>
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
                        <h3 class="card-title ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            Register Guardian
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="registerGuardian" class="row">
                            <div class=" col-md-4 form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Gurdians name" >
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>Home Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Lekki, Nigeria" >
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="mail@gmail.com" >
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="090000000000" >
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>State of Origin</label>
                                <input type="text" name="state" class="form-control" placeholder="Lagos" >
                            </div>
                            <div class=" col-md-4 form-group">
                                <label>L.G.A</label>
                                <input type="text" name="lga" class="form-control" placeholder="ikeja" >
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-secondary float-right registerGuardian" >Register Gurdian</button>
                            </div>
                        </form>
                    </div>



                </div>


                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Guardians List
                        </h3>
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
                                        <th>Address</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="guardian_body_list">

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


            function fetchParentSummary()
            {
                page = '{{$page}}'
                $.ajax({
                    method: 'get',
                    url: api_url+'fetch_guardians_info_summmary?page='+page
                }).done(function(res) {
                    body = $('#guardian_body_list');
                    body.html(``)
                    res.data.data.map((guard, index) => {
                        body.append(`
                            <tr>
                                <td>${index+1 + ((page-1) * 100)}</td>
                                <td>${guard.guardian_name}</td>
                                <td>${guard.guardian_email}</td>
                                <td>${guard.guardian_phone}</td>
                                <td>${guard.guardian_address}</td>
                                <td> <a href="/control/guardian_profile/${guard.id}"> Profile <i class="fa fa-arrow-circle-right"></i> </a> </td>
                            </tr>
                        `)
                    })

                    link_body = $('#page_links')
                    link_body.html(dropPaginatedPages(res.data.links));


                }).fail(function (res) {
                })
            }


            $('#registerGuardian').on('submit', function(e) {
                e.preventDefault();
                form = $(this);

                name = $(form).find('input[name="name"]').val();
                address = $(form).find('input[name="address"]').val();
                email = $(form).find('input[name="email"]').val();
                phone = $(form).find('input[name="phone"]').val();
                state = $(form).find('input[name="state"]').val();
                lga = $(form).find('input[name="lga"]').val();

                if(!name || !address || !email || !phone || !phone){
                    littleAlert('All fields are required', 1); return;
                }

                $.ajax({
                    method: 'post',
                    url: api_url+'create_guardian_profile',
                    data: {
                        guardian_name: name,
                        guardian_address: address,
                        guardian_email: email,
                        guardian_phone: phone,
                        state: state,
                        lga: lga,
                    },
                    beforeSend:() => {
                        btnProcess('.registerGuardian', 'Register Guardian', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.registerGuardian', 'Register Guardian', 'after')
                    body = $('#guardian_body_list');
                    body.prepend(`
                        <tr>
                            <td>#</td>
                            <td>${name}</td>
                            <td>${email}</td>
                            <td>${phone}</td>
                            <td>${address}</td>
                            <td> <a href="#"> Profile<i class="fa fa-arrow-circle-right"></i> </a> </td>
                        </tr>
                    `)

                    fetchParentSummary();
                    form[0].reset();


                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.registerGuardian', 'Register Guardian', 'after')
                })
            })






            setTimeout(() => {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    "paging": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": false,
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            }, 2500);

            fetchParentSummary();
        })
    </script>


@endsection
