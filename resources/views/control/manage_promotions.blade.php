@extends('layouts.app')

@section('page_title')
    Manage Promotions
@endsection

@php
    $page = isset($_GET['page']) ? $_GET['page'] : 1 ;
@endphp


@section('page_content')
<link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Promotions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Manage Promotions</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            All Classes
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class</th>
                                        <th>Students</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="class_body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span class="student_body">Students</span>
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="d-flex  justify-content-between">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="check_all" data-ck=0>
                                                    <label for="check_all"></label>
                                                </div>
                                                #
                                            </div>
                                        </th>
                                        <th>Student</th>
                                        <th>Gender</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="student_body">
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


            cla_id = `{{$class_id}}`

            function fetchClasses(){
                $.ajax({
                    method: 'get',
                    url: api_url+'get_class'
                }).done(function(res) {
                    console.log(res);
                    body = $('#class_body');
                    body.html(``)
                    res.data.map((cla, index) => {
                        body.append(`
                            <tr>
                                <td>${index+1}</td>
                                <td>${cla.class}</td>
                                <td>${cla.students}</td>
                                <td><a href="/control/managepromotion/${cla.id}">Manage</a></td>
                            </tr>
                        `)
                    })
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchClasses();


            function fetchStudent()
            {
                if(cla_id == 0 ) { return; }
                $.ajax({
                    method: 'get',
                    url: api_url+`class_students/${cla_id}?page={{$_GET['page'] ?? 1}}`
                }).done(function(res) {
                    console.log(res);
                    body = $('#student_body')
                    body.html(``);

                    $('.student_body').html(`Students (${res.class.class})`)

                    res.data.data.map((stu, index) => {
                        body.append(`
                            <tr>
                                <td class="text-center ">
                                    <div class="d-flex  justify-content-between">
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="pick" value="${stu.id}" id="reg${index}">
                                            <label for="reg${index}"></label>
                                        </div>
                                        ${index+1}
                                    </div>
                                </td>
                                <td>${stu.surname+ ' ' + stu.firstname}</td>
                                <td>${stu.sex}</td>
                                <td>
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-xs btn-success promote" data-id="${stu.id}">Promote</button>
                                    <button class="btn btn-xs btn-danger demote" data-id="${stu.id}">Demote</button>
                                <div>
                            </td>
                            </tr>
                        `)
                    })


                    body.append(`
                        <tr>
                            <td></td>
                            <th>With Selected </th>
                            <td colspan="2">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-success promote_all">Promote</button>
                                    <button class="btn btn-danger demote_all">Demote</button>
                                <div>
                            </td>
                        </tr>
                    `)



                    $('#page_links').html(dropPaginatedPages(res.data.links));
                }).fail(function(res) {
                    console.log(res);
                })
            }


            fetchStudent();


            $('body').on('click', '.promote_all', function(){
                perform('promote');
            })

            $('body').on('click', '.demote_all', function(){
                perform('demote');
            })



            $('#check_all').on('click', function(){
                val = $(this);
                val = val[0].checked;
                inputs = $('input[name="pick"]')
                inputs.map(inp => {
                    inp = inputs[inp];
                    inp.checked = val
                });


            })





            function perform(action)
            {
                url = (action == 'promote') ? 'promote_student' : 'demote_student' ;
                btn_id = (action == 'promote') ? '.promote_all' : '.demote_all' ;
                btn_text = (action == 'promote') ? 'Promote' : 'Demote' ;

                inputs = $('input[name="pick"]')
                data = [];
                inputs.map(inp => {
                    inp = inputs[inp];
                    if(inp.checked){
                        data.push(inp.value)
                    }
                });
                $.ajax({
                    method: 'post',
                    url: api_url+`${url}`,
                    data: {
                        data: data
                    },
                    beforeSend:() => {
                        btnProcess(btn_id, '', 'before')
                        $('.btn').attr('disabled', 'disabled')
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    fetchStudent();
                    fetchClasses();
                }).fail(function(res) {
                    parseError(res.responseJSON)
                    btnProcess(btn_id, btn_text, 'after')
                })
            }



            $('body').on('click', '.promote', function() {
                btn = $(this)
                id = btn.data('id');
                btn.html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`);
                performSingle(id, 'promote')
            })


            $('body').on('click', '.demote', function() {
                btn = $(this)
                id = btn.data('id');
                btn.html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`);
                performSingle(id, 'demote')
            })


            function performSingle(id, action)
            {
                url = (action == 'promote') ? 'promote_student' : 'demote_student' ;
                $.ajax({
                    method: 'post',
                    url: api_url+`${url}`,
                    data: {
                        data: [id]
                    },
                    beforeSend:() => {
                        $('.btn').attr('disabled', 'disabled')
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    fetchStudent();
                    fetchClasses();
                }).fail(function(res) {
                    parseError(res.responseJSON)
                })
            }




        })
    </script>


@endsection
