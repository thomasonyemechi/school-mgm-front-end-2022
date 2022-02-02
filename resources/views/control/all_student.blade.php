@extends('layouts.app')

@section('page_title')
    Students
@endsection

@php
    $page = $_GET['page'] ?? 1;
@endphp


@section('page_content')
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Students</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-4 offset-md-8 mb-3">
                <form action="">
                    <div class="input-group input-group-">
                        <input type="search" name="student" class="form-control form-control-sm" placeholder="Search Student">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-default searchStudent">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" id="student_list_body" >

        </div>

        <div class="row">
            <div class="col-12 pageLinks">
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



            function fetchStudent()
            {
                page = '{{$page}}'
                $.ajax({
                    method: 'get',
                    url: api_url+'get_all_student?page='+page
                }).done(function (res) {
                    body = $('#student_list_body');
                    body.html(``);
                    res.data.data.forEach(stu => {
                        btn = (stu.status == 1) ? `<button type="button" class="btn btn-success btn-xs  btn-block"><b> <i class="fa fa-user-check"></i> Active</b></button>` :
                         `<button type="button" class="btn btn-danger btn-xs  btn-block"> <b><i class="fa fa-user-times"></i> Not Active</b></button>` ;
                        body.append(`
                            <div class=" col-lg-3 col-md-4">
                                <div class="card card-secondary card-outline">
                                    <div class="card-body pb-1 box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="${api_url_root+'assets/img/students/user.png'}" alt="${stu.firstname}">
                                        </div>
                                        <h3 class="profile-username text-center">${stu.surname + ' ' +stu.firstname}</h3>
                                        <p class="text-muted mb-0 text-center">${stu.class.class} <sup>${(stu.arm)? stu.arm.arm :''}</sup> | ${stu.sex}</p>
                                        ${btn}
                                        <div class="text-center">
                                            <a href="/control/student/${stu.id}">Go-to-profile <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    });
                    $('.pageLinks').html(dropPaginatedPages(res.data.links))
                }).fail(function (res) {
                    console.log(res);
                })
            }



            fetchStudent();

            $('.searchStudent').on('click', function(e) {
                e.preventDefault();

                btn = $(this)
                q = $('input[name="student"]').val();

                if(!q) { littleAlert('Pls add a search parameter', 1); return; }

                btn.attr('disabled', 'disabled');
                btn.html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`);

                $.ajax({
                    method: 'get',
                    url: api_url+'search_student/'+q
                }).done(function(res) {
                    console.log(res);
                    btn.removeAttr('disabled');
                    btn.html(`<i class="fa fa-search"></i>`);

                    if(res.data.length == 0) {
                        littleAlert(`No result found for this search <b> '${q}' </b>`, 1);
                        return;
                    }


                    body = $('#student_list_body');
                    body.html(`<div class=" col-12"><h3>Search Result for <b>'${q}'</b></h3></div>`);
                    res.data.forEach(stu => {
                        btn = (stu.status == 1) ? `<button type="button" class="btn btn-success btn-xs  btn-block"><b> <i class="fa fa-user-check"></i> Active</b></button>` :
                         `<button type="button" class="btn btn-danger btn-xs  btn-block"> <b><i class="fa fa-user-times"></i> Not Active</b></button>` ;
                        body.append(`
                            <div class=" col-lg-3 col-md-4">
                                <div class="card card-secondary card-outline">
                                    <div class="card-body pb-1 box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle"
                                                src="${api_url_root+'assets/img/students/user.png'}" alt="${stu.firstname}">
                                        </div>
                                        <h3 class="profile-username text-center">${stu.surname + ' ' +stu.firstname}</h3>
                                        <p class="text-muted mb-0 text-center">${stu.class.class} <sup>${(stu.arm)? stu.arm.arm :''}</sup> | ${stu.sex}</p>
                                        ${btn}
                                        <div class="text-center">
                                            <a href="/control/student/${stu.id}">Go-to-profile <i class="fas fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    });


                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btn.removeAttr('disabled');
                    btn.html(`<i class="fa fa-search"></i>`);
                })
            })

        })
    </script>


@endsection
