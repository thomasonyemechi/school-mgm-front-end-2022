@extends('layouts.app')

@section('page_title')
Category & Arms
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category & Arms</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Category & Arms</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            Add Class Category
                        </h3>
                    </div>
                    <div class="card-body pb-0">
                        <form action="" id="createClassCategory" >
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" name="category" class="form-control" placeholder="Enter Class Category i.e JSS, PRY, SSS">
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-secondary createClassCategory">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title ">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                Class Categories
                            </h3>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="category_list_body">
                                    <tr>
                                        <td colspan="12"><div class="text-center"> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>Loading Category ...</i> </div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>

            <div class="col-md-6 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            Add Class Arm
                        </h3>
                    </div>
                    <div class="card-body pb-0">
                        <form action="" id="createArm">
                            <div class="form-group">
                                <label>Arm</label>
                                <input type="text" name="arm" class="form-control" placeholder="Enter Class Arm i.e A, B, C">
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-secondary createArm">Add Arm</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title ">
                                <i class="fa fa-list-alt" aria-hidden="true"></i>
                                Class Arms
                            </h3>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Arm</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="arm_list_body">
                                    <tr>
                                        <td colspan="12"><div class="text-center"> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>Loading Arms ...</i> </div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="editClassCategoryModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Edit Class Category</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="editCategoryForm" >
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" placeholder="Enter Class Category i.e JSS, PRY, SSS">
                            <input type="hidden" name="category_id">
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-secondary updateCategory">Update Category</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editClassArmModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Edit Class Arm</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="editArmForm">
                        <div class="form-group">
                            <label>Arm</label>
                            <input type="text" name="arm" class="form-control" placeholder="Enter Class Amr i.e A, B, C">
                            <input type="hidden" name="arm_id">
                        </div>
                        <div class="form-group float-right">
                            <button class="btn btn-secondary updateArm">Update Arm</button>
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


            function fetchClassCategory()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_class_category'
                }).done(function (res) {
                    body = $('#category_list_body')
                    body.html(``);
                    res.data.map(cat => {
                        body.append(`
                            <tr>
                                <td>${cat.category}</td>
                                <td>
                                    <div class="float-right">
                                        <button class="btn btn-xs btn-primary editCategory" data-data='${JSON.stringify(cat)}'><i class="fa fa-edit" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                        `)
                    })
                }).fail(function (res) {
                    // parseError(res.rsponseJSON);
                })
            }

            fetchClassCategory();


            $('body').on('click', '.editCategory', function() {
                data = $(this).data('data');
                modal = $('#editClassCategoryModal')
                modal.modal('show')
                $(modal).find('input[name="category"]').val(data.category)
                $(modal).find('input[name="category_id"]').val(data.id)
                $(modal).find('.modal-title').html(`Edit Class Category (${data.category})`)
            })

            $('#editCategoryForm').on('submit', function (e) {
                e.preventDefault();
                form = $(this)
                category = $(form).find('input[name="category"]').val();
                category_id = $(form).find('input[name="category_id"]').val();
                if(!category) { littleAlert('The class category field is required', 1); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'update_class_category',
                    data: {
                        category: category,
                        category_id: category_id,
                    },
                    beforeSend: () => {
                        btnProcess('.updateCategory', 'Update Category', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    fetchClassCategory();
                    btnProcess('.updateCategory', 'Update Category', 'after')
                    $('#editClassCategoryModal').modal('hide')
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.updateCategory', 'Update Category', 'after')
                })
            })


            $('#createClassCategory').on('submit', function(e) {
                e.preventDefault();
                form = $('#createClassCategory')
                category = $(form).find('input[name="category"]').val();
                if(!category) { littleAlert('The class category field is required', 1); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'create_class_category',
                    data: { category: category },
                    beforeSend: () => {
                        btnProcess('.createClassCategory','Add Category', 'before')
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    fetchClassCategory();
                    btnProcess('.createClassCategory','Add Category', 'after')
                    $('#createClassCategory')[0].reset()
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.createClassCategory','Add Category', 'after')
                })
            })
        })
    </script>


    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });



            function fetchClassArm()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_class_arm'
                }).done(function(res) {
                    body = $('#arm_list_body')
                    body.html(``);
                    res.data.map(arm => {
                        body.append(`
                            <tr>
                                <td>${arm.arm}</td>
                                <td>
                                    <div class="float-right">
                                        <button class="btn btn-xs btn-primary editArm" data-data='${JSON.stringify(arm)}'><i class="fa fa-edit" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                            </tr>
                        `)
                    })
                }).fail(function (res) {
                })
            }
            fetchClassArm();

            $('body').on('click', '.editArm', function(){
                data = $(this).data('data');
                modal = $('#editClassArmModal')
                modal.modal('show');
                $(modal).find('input[name="arm"]').val(data.arm)
                $(modal).find('input[name="arm_id"]').val(data.id)
                $(modal).find('.modal-title').html(`Edit Class Arm (${data.arm})`)
            });


            $('#editArmForm').on('submit', function(e) {
                e.preventDefault();

                form = $('#editArmForm');
                arm = $(form).find('input[name="arm"]').val()
                arm_id = $(form).find('input[name="arm_id"]').val()

                if(!arm) { littleAlert('The arm field is required', 1); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'update_arm',
                    data: {
                        arm: arm,
                        arm_id: arm_id,
                    },
                    beforeSend:() => {
                        btnProcess('.updateArm', 'Update Arm', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    fetchClassArm();
                    btnProcess('.updateArm', 'Update Arm', 'after');
                    $('#editClassArmModal').modal('hide');
                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.updateArm', 'Update Arm', 'after');
                })
            })


            $('#createArm').on('submit', function(e) {
                e.preventDefault();
                form = $('#createArm');
                arm = $(form).find('input[name="arm"]').val()
                if(!arm) { littleAlert('The arm field is required', 1); return; }
                $.ajax({
                    method: 'post',
                    url: api_url+'create_arm',
                    data: {
                        arm: arm,
                    },
                    beforeSend:() => {
                        btnProcess('.createArm', 'Update Arm', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    fetchClassArm();
                    btnProcess('.createArm', 'Add Arm', 'after');
                    form[0].reset();
                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.createArm', 'Add Arm', 'after');
                })
            })

        })
    </script>



@endsection
