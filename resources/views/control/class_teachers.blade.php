@extends('layouts.app')

@section('page_title')
    Class Subject Teachers
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 class_name">Subject Teachers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/control/class/{{ $class_id }}">Class Profile</a>
                        </li>
                        <li class="breadcrumb-item active">Subject Teachers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-body p-1">
                        <button data-toggle="modal" data-target="#assignSubjectModal"
                            class="btn btn-secondary float-right btn-sm mb-2">
                            Assign Subject
                        </button>
                        <div class="table-responsive">
                            <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Teacher</th>
                                        <th>Subjects</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="sub_class_body">
                                    <tr>
                                        <td colspan="12">
                                            <div class="text-center"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i> Loading Teachers ... </i></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="page_links22">

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
                    <p class="modal-title text-bold">Assign Subject</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" class="row" id="assignSubject">
                        <div class="col-md-4 form-group">
                            <label>Subject</label>
                            <select name="subject" class="form-control select2bs4">
                                <option selected disabled>Select Option</option>
                                <option value="">English</option>
                                <option value="">Mathematics</option>
                                <option value="">Biology</option>
                            </select>
                        </div>


                        <div class="col-md-4 form-group">
                            <label>Class</label>
                            <select name="class" class="form-control select2bs4">
                                <option selected disabled>Select Option</option>
                            </select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Teacher</label>
                            <select name="user" id="user" class="form-control select2bs4" style="width: 100%;">
                                <option selected disabled>Select Option</option>
                                <option value="">Mr Adewole Salami Giwa</option>
                                <option value="">Jasper Gideon</option>
                                <option value="">Lugard Sapare</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <button type="submit" class="btn btn-secondary float-right assignSubject">Assign
                                Subject</button>
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
                    'Authorization': `Bearer {{ access_token() }}`
                }
            });



            function fetchTableByClass() {
                $.ajax({
                    method: 'get',
                    url: api_url +
                        `fetch_subject_teacher/{{ $class_id ?? 0 }}?page={{ $_GET['page'] ?? 1 }}`
                }).done(function(res) {
                    $('.class_name').html(`Subject Teachers (${res.class.class})`)
                    body = $('#sub_class_body');
                    body.html(``);
                    res.data.data.map((sub, index) => {
                        body.append(`
                            <tr>
                                <td>${index+1}</td>
                                <td>${sub.teacher.name}</td>
                                <td>${sub.subject.subject}</td>
                                <td>${formatDate(sub.created_at)}</td>
                                <td>
                                    <button class="btn btn-xs btn-danger remove_subject" data-id="${sub.id}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <a class="btn btn-xs btn-info" href="/control/class/broad-sheet/${sub.id}"><i class="fas fa-eye"></i> Results</a>
                                </td>
                            </tr>
                        `)
                    })
                    $('#page_links22').html(dropPaginatedPages(res.data.links))
                }).fail(function(res) {})
            }

            fetchTableByClass();



            function fetchRequirements() {
                $.ajax({
                    method: 'get',
                    url: api_url + 'assign_subject_req'
                }).done(function(res) {
                    form = $('#assignSubject');
                    subject = $(form).find('select[name="subject"]');
                    clas = $(form).find('select[name="class"]');
                    userss = $('#user');

                    subject.html(`<option selected disabled>Select Subject</option>`);
                    res.data.subjects.map(sub => {
                        subject.append(`<option value="${sub.id}">${sub.subject}</option>`)
                    })

                    class_id = `{{ $class_id ?? 0 }}`

                    clas.html(`<option selected disabled>Select Class</option>`);
                    res.data.classes.map(cla => {
                        clas.append(
                            `<option value="${cla.id}" ${(class_id == cla.id) ? 'selected' : ''}>${cla.class}</option>`
                            )
                    })

                    userss.html(`<option selected disabled>Select teacher</option>`);
                    res.data.users.map(tea => {
                        userss.append(`<option value="${tea.id}">${tea.name}</option>`)
                    })

                }).fail(function(res) {})
            }

            fetchRequirements();

            $('#assignSubject').on('submit', function(e) {
                e.preventDefault();
                form = $(this);
                subject_id = $(form).find('select[name="subject"]').val();
                class_id = $(form).find('select[name="class"]').val();
                user_id = $(form).find('select[name="user"]').val();
                if (!subject_id || !class_id || !user_id) {
                    littleAlert('Pls fill out all fields', 1);
                    return;
                }

                $.ajax({
                    method: 'post',
                    url: api_url + 'assign_subject_to_teacher',
                    data: {
                        subject_id: subject_id,
                        user_id: user_id,
                        class_id: class_id
                    },
                    beforeSend: () => {
                        btnProcess('.assignSubject', 'Assign Subject', 'before');
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.assignSubject', 'Assign Subject', 'after');
                    $('#assignSubjectModal').modal('hide');
                    fetchTableByClass();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    btnProcess('.assignSubject', 'Assign Subject', 'after');
                })
            })


            $('body').on('click', '.remove_subject', function(e) {
                id = $(this).data('id');
                if (!confirm('Subject will be removed from this user!')) {
                    return;
                }
                $.ajax({
                    method: 'post',
                    url: api_url + 'remove_assigned_subject',
                    data: {
                        set_subject_id: id
                    },
                    beforeSend: () => {
                        $('.remove_subject').attr('disabled', 'disabled');
                        $(this).html(
                            `<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`
                            );
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    fetchTableByClass();
                }).fail(function(res) {
                    parseError(res.responseJSON);
                    $('.remove_subject').removeAttr('disabled');
                })
            })
        })
    </script>



@endsection
