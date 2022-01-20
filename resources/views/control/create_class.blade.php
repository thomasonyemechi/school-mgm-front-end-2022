@extends('layouts.app')

@section('page_title')
Class
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Class</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Class</li>
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
                                Classes
                            </h3>
                            <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#createClassModal">Create Class</button>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Category</th>
                                        <th>Students</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="class_list_body">
                                    <tr>
                                        <td colspan="12"><div class="text-center"> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>Loading Classes ...</i> </div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </section>


    <div class="modal fade" id="createClassModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Create Class </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row" id="createClassForm">
                        <div class="col-md-6 form-group">
                            <label>Category</label>
                            <select name="category" id="category_list" class="form-control select2bs4" >
                                <div>Select Class Category</div>

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
                            <button type="submit" class="btn btn-secondary createClass float-right ">Create Class</button>
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


            function fethClassCategory()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_class_category'
                }).done(function (res) {
                    body = $('#category_list')
                    console.log(res);
                    body.html(``);
                    body.append(`<option> Select Class Category</option>`)
                    res.data.map(cat => {
                        body.append(`
                            <option value="${cat.id}" >${cat.category}</option>
                        `)
                    })
                }).fail(function (res) {
                })
            }

            function fectClasses() {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_class'
                }).done(function (res) {
                    body = $('#class_list_body')
                    body.html(``);


                    res.data.map(cla => {
                        body.append(`
                            <tr>
                                <td>${ cla.class }</td>
                                <td>${ cla.category }</td>
                                <td>${ cla.students }</td>
                                <td>
                                    <div class="align-items-center">
                                        <button class="btn btn-xs btn-default orderClass" data-id="${cla.id}" data-action="move_up" ><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <div class="float-right">
                                        <a href="/control/class_profile/${cla.id}"> class-profile <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                                    </div>
                                </td>
                            </tr>
                        `)
                    })
                }).fail(function (res) {
                })
            }
            fectClasses();
            fethClassCategory();

            $('body').on('click', '.orderClass', function () {
                class_id = $(this).data('id');
                action = $(this).data('action');
                $.ajax({
                    method: 'post',
                    url: api_url+'order_class',
                    data: {
                        class_id: class_id,
                        action: action
                    },
                    beforeSend:() => {
                        $(this).html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`)
                        $('.orderClass').attr('disabled', 'disabled');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    fectClasses();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    $('.orderClass').removeAttr('disabled');
                    $('.orderClass').html(`<i class="fa fa-arrow-circle-up" aria-hidden="true"></i>`)
                })
            })


            $('#createClassForm').on('submit', function(e) {
                e.preventDefault();
                form = $('#createClassForm')
                category_id = $(form).find('select[name="category"]').val();
                level = $(form).find('select[name="level"]').val();

                if(!category_id || !level) { littleAlert('All fields are required', 1); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'create_class',
                    data: {
                        category_id: category_id,
                        level: level
                    },
                    beforeSend:() => {
                        btnProcess('.createClass', 'Create Class', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message)
                    btnProcess('.createClass', 'Create Class', 'after');
                    fectClasses();
                    $('#createClassModal').modal('hide');
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.createClass', 'Create Class', 'after');
                })
            })
        })
    </script>

@endsection
