@extends('layouts.app')

@section('page_title')
    General Setup
@endsection

@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">General Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">General Setup</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-plus-square"></i>
                            Create Session
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" id="create_new_session">
                            <div class="form-group">
                                <label for="">Session</label>
                                <select id="session_id" class="form-control select2bs4">
                                    <option selected="selected" disabled>Choose Session</option>
                                    <option>{{ date('Y') - 1 }}/{{ date('Y') }}</option>
                                    <option>{{ date('Y') }}/{{ date('Y') + 1 }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-0 float-right">
                                <button type="submit"  class="btn btn-secondary create_session_btn">Create Session</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            Recent Sessions
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table id="example1" class="table mb-0 table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th colspan="2">Session</th>
                                    <th>Session Info</th>
                                </tr>
                            </thead>
                            <tbody id="session_body">


                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <div class="modal fade" id="editTermModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p  class="modal-title text-bold">Edit Term (2021/2022 Session, First Term)</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="updateTermForm">
                        <div class="form-group">
                            <label>Term Closes</label>
                            <input type="date" name="close" class="form-control">
                            <input type="hidden" name="term_id">
                        </div>

                        <div class="form-group">
                            <label>Next Term Begins</label>
                            <input type="date" name="resume" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Term Year</label>
                            <input type="number" name="year" class="form-control">
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-secondary save_updated_term_changes" >Save changes</button>
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




            function fetchSession()
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'get/session'
                }).done(function (res) {
                    body = $('#session_body')
                    body.html(``);
                    res.data.map(sess => {
                        terms = sess.terms

                        body_txt = '';
                        terms.forEach(term => {
                            btn = (term.status == 1) ?`Active`:`<button class="btn btn-xs btn-secondary activateTerm" data-id="${term.id}" title="Click to activate term">
                                <i class="fa fa-check" aria-hidden="true"></i> </button>` ;
                            body_txt += `
                                <tr ${ (term.status == 1) ? `class="bg-success"` : '' }>
                                    <td> ${term_text(term.term)} </td>
                                    <td> ${ term.close }</td>
                                    <td> ${ term.resume }</td>
                                    <th>
                                        <button class="btn btn-xs btn-primary editTermInfo" data-data='${ JSON.stringify(term) }'><i class="fas fa-edit"></i></button>
                                        ${btn}
                                    </th>
                                </tr>
                            `
                        });

                        console.log(body_txt);

                        body.append(`
                            <tr>
                                <td colspan="2">
                                    ${sess.session}
                                </td>
                                <td>
                                    <table class="table table-sm">
                                        <tr>
                                            <th>Term</th>
                                            <th>Closes</th>
                                            <th>Next-Term</th>
                                            <th></th>
                                        </tr>

                                        ${body_txt}

                                    </table>
                                </td>

                            </tr>

                        `)
                    });

                }).fail(function (res) {

                });
            }


            $('body').on('click', '.editTermInfo', function () {
                data = $(this).data('data') ;
                $('#editTermModal').modal('show');
                modal = $('#editTermModal');
                $('.modal-title').find(modal).html(`Edit Term (${data.session} Session, ${term_text(data.term)})`)
                $('input[name="term_id"]').val(data.id);
                $( modal ).find('input[name="year"]').val(data.year);
            });


            $('body').on('click', '.activateTerm', function() {
                term_id = $(this).data('id');
                if(!confirm('All activities will be switched to selected term !')) { return; }
                $(this).html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span>`)
                $('.activateTerm').attr('disabled', 'disabled');

                $.ajax({
                    method: 'post',
                    url: api_url+'activateterm',
                    data: {
                        term_id: term_id
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    fetchSession();
                }).fail(function (res) {
                    $(this).html(`<i class="fa fa-check" aria-hidden="true"></i>`)
                    $('.activateTerm').removeAttr('disabled');
                    parseError(res.responseJSON);
                })
                console.log(term_id);
            })



            $('#updateTermForm').on('submit', function (e) {
                e.preventDefault(); form = $('#updateTermForm')
                close = $( form ).find('input[name="close"]').val();
                resume = $( form ).find('input[name="resume"]').val();
                year = $( form ).find('input[name="year"]').val();
                if(!close || !resume || !year) { littleAlert('All fileds are required', 1); return }

                $.ajax({
                    method: 'post',
                    url: api_url+'update/term/info',
                    data: {
                        term_id: $(form).find('input[name="term_id"]').val(),
                        close: close,
                        resume: resume,
                        year: year
                    },
                    beforeSend: () => {
                        btnProcess('.save_updated_term_changes', 'Save Changes', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    btnProcess('.save_updated_term_changes', 'Save Changes', 'after');
                    fetchSession();
                    $('#editTermModal').modal('hide');
                }).fail(function (res) {
                    btnProcess('.save_updated_term_changes', 'Save Changes', 'after');
                    parseError(res.responseJSON);
                })
            })


            $('#create_new_session').on('submit', function(e) {
                e.preventDefault(); form = $('#create_new_session');
                session = $('#session_id').val();
                if(!session){ littleAlert('Pls select a session', 1); return }

                $.ajax({
                    method: 'post',
                    url: api_url+'create/session',
                    data: {
                        session: session
                    },
                    beforeSend :() => {
                        btnProcess('.create_session_btn', 'Create Session', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message);
                    btnProcess('.create_session_btn', 'Create Session', 'after');
                    fetchSession();
                }).fail(function (res) {
                    parseError(res.responseJSON);
                    btnProcess('.create_session_btn', 'Create Session', 'after');
                })
            });


        })



    </script>


@endsection
