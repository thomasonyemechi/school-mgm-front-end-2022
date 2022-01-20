@extends('layouts.app')

@section('page_title')
School Fee Management
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Fee</li>
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
                            Create Fee Category
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="createFeeCategory">
                            <div class=" form-group">
                                <label>Fee Category</label>
                                <input type="text" name="fee_category" class="form-control" placeholder="School Fee" >
                            </div>

                            <div class=" form-group">
                                <label>Fee Description</label>
                                <textarea name="description" class="form-control" col="2" placeholder="Describe fee category" ></textarea>
                            </div>

                            <div class=" form-group">
                                <button class="btn btn-secondary float-right createFeeCategory ">Create Fee Category</button>
                            </div>


                        </form>
                    </div>



                </div>
            </div>


            <div class="col-md-6 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Fee Categories
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Fee</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="fee_list">

                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </section>



    <div class="modal fade" id="editFeeModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Edit Fee Category </p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="updateFeeCategory">
                        <div class=" form-group">
                            <label>Fee Category</label>
                            <input type="text" name="fee_category" class="form-control" placeholder="School Fee" >
                            <input type="hidden" name="fee_id">
                        </div>

                        <div class=" form-group">
                            <label>Fee Description</label>
                            <textarea name="description" class="form-control" col="2" placeholder="Describe fee category" ></textarea>
                        </div>

                        <div class=" form-group">
                            <button class="btn btn-secondary float-right updateFeeCategory ">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function() {



            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });



            function cre() {
                $.ajax({
                    method: 'post',
                    url: api_url+'create_fee_category'
                });
            }


            function fetchFeeCategory() {
                $.ajax({
                    method: 'post',
                    url: api_url+'fetch_fee_category'
                }).done(function (res) {
                    console.log(res);
                    body = $('#fee_list');
                    body.html(``);
                    res.data.map(fee => {
                        body.append(`
                            <tr>
                                <td>${fee.fee}</td>
                                <td>${fee.description}</td>
                                <td><button class="btn btn-xs float-right btn-primary editFee" data-data='${JSON.stringify(fee)}'><i class="fas fa-edit "></i></button></td>
                            </tr>
                        `)
                    })
                }).fail(function (res) {
                    console.log(res);
                })
            }

            $('body').on('click', '.editFee', function() {
                data = $(this).data('data');
                console.log(data);
                modal = $('#editFeeModal');
                modal.modal('show');
                $(modal).find('input[name="fee_category"]').val(data.fee)
                $(modal).find('textarea[name="description"]').html(data.description)
                $(modal).find('input[name="fee_id"]').val(data.id)

            })


            fetchFeeCategory();


            $('#createFeeCategory').on('submit', function(e) {
                e.preventDefault()

                form = $(this)

                fee_category = $(form).find('input[name="fee_category"]').val()
                des = $(form).find('textarea[name="description"]').val()

                if(!fee_category || !des) { littleAlert('All fields are required', 1);  return ;}

                $.ajax({
                    method: 'post',
                    url: api_url+'create_fee_category',
                    data: {
                        fee: fee_category,
                        description: des
                    },
                    beforeSend:() => {
                        btnProcess('.createFeeCategory', 'Create Fee Category', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message)
                    btnProcess('.createFeeCategory', 'Create Fee Category', 'after')
                    fetchFeeCategory();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.createFeeCategory', 'Create Fee Category', 'after')
                })
            })

            $('#updateFeeCategory').on('submit', function (e) {
                e.preventDefault()
                modal = $('#editFeeModal');
                fee_category = $(modal).find('input[name="fee_category"]').val()
                des = $(modal).find('textarea[name="description"]').val()
                fee_id = $(modal).find('input[name="fee_id"]').val()

                if(!fee_category || !des) { littleAlert('All fields are required', 1); return; }

                console.log(des);

                $.ajax({
                    method: 'post',
                    url: api_url+'update_fee_category',
                    data: {
                        fee_id: fee_id,
                        fee: fee_category,
                        description: des
                    },
                    beforeSend:() => {
                        btnProcess('.updateFeeCategory', 'Update', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message)
                    btnProcess('.updateFeeCategory', 'Update', 'after');
                    fetchFeeCategory();
                    modal.modal('hide');
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.updateFeeCategory', 'Update', 'after')

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

        })
    </script>


@endsection
