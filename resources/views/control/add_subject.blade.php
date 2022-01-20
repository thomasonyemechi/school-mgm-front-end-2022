@extends('layouts.app')

@section('page_title')
Subjects
@endsection

@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subjects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Subjects</li>
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
                        <h3 class="card-title">
                            <i class="fas fa-plus-square"></i>
                            Add Subject
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="addSubject">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Enter Subject name i.e Mathematics, Biology">
                            </div>
                            <div class="form-group mb-0 float-right">
                                <button class="btn btn-secondary addSubject">Add Subject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Subject List
                        </h3>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="subject_list_body">
                                    <tr>
                                        <td colspan="12"><div class="text-center"> <span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i>Loading Subjects ...</i> </div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="editSubjectModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p  class="modal-title text-bold">Edit Subject (Subject)</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="editSubjectForm">
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Enter Subject name i.e Mathematics, Biology">
                            <input type="hidden" name="subject_id">
                        </div>
                        <div class="form-group mb-0 float-right">
                            <button class="btn btn-secondary" id="updateSubject">Update Subject</button>
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


            function fetchSubject() {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_all_subject',
                }).done(function(res) {
                    body = $('#subject_list_body');
                    body.html(``);
                    res.data.map(sub => {
                        body.append(`
                            <tr>
                                <td>${sub.subject}</td>
                                <td>
                                    <div class="float-right">
                                        <button class="btn btn-xs btn-primary editSubject" data-data='${JSON.stringify(sub)}'><i class="fas fa-edit"></i></button>
                                    </div>
                                </td>
                            </tr>
                        `)
                    })
                }).fail(function (res) {
                    console.log(res);
                })
            }

            fetchSubject()

            $('body').on('click', '.editSubject', function () {
                data = $(this).data('data');
                modal = $('#editSubjectModal')
                modal.modal('show');
                $(modal).find('input[name="subject"]').val(data.subject);
                $(modal).find('input[name="subject_id"]').val(data.id);
                $(modal).find('.modal-title').html(`Edit Subject (${data.subject})`);
            })


            $('#addSubject').on('submit', function(e) {
                e.preventDefault();
                form = $('#addSubject')
                subject = $( form ).find('input[name="subject"]').val();
                if(!subject) { littleAlert('The subject field is required', 1); return; }

                $.ajax({
                    method: 'post',
                    url: api_url+'create_subject',
                    data: {
                        subject: subject
                    },
                    beforeSend: () => {
                        btnProcess('.addSubject', 'Add Subject', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    btnProcess('.addSubject', 'Add Subject', 'after');
                    $('#subject_list_body').prepend(`
                        <tr>
                            <td>${subject}</td>
                            <td>
                                <div class="float-right">
                                    <button class="btn btn-xs btn-primary" disabled><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                    `);
                    $("#addSubject")[0].reset();
                    fetchSubject();
                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.addSubject', 'Add Subject', 'after');
                })
            })


            $('#editSubjectForm').on('submit', function (e) {
                e.preventDefault();
                form = $('#editSubjectForm')
                subject = $(form).find('input[name="subject"]').val();
                subject_id = $(form).find('input[name="subject_id"]').val();
                if(!subject) {  littleAlert('The subject field is required', 1); return }

                $.ajax({
                    method: 'post',
                    url: api_url+'update_subject',
                    data: {
                        subject: subject,
                        subject_id: subject_id
                    },
                    beforeSend: () => {
                        btnProcess('#updateSubject', 'Update Subject', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    fetchSubject();
                    $('#editSubjectModal').modal('hide');
                    btnProcess('#updateSubject', 'Update Subject', 'after');
                }).fail(function (res) {
                    parseError(res.responseJSON)
                    btnProcess('#updateSubject', 'Update Subject', 'after');
                })
            })

        })
    </script>

@endsection
