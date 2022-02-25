@extends('layouts.app')

@section('page_title')
    Class Result
@endsection


@section('page_content')


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Class Result</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Class Result</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="class_form">
                                    <div class="form-group">
                                        <label>Select Class</label>
                                        <select name="class_id" id="clases" class="form-control select2bs4">
                                            <option selected disabled>... Loading Classes ...</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-secondary float-right">Check Result</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <div id="res_body">

                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="modal fade" id="updateRemark">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Update Remark (Thomas Onyemechi)</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label>Principal Remark</label>
                            <input type="text" name="principal" class="form-control">
                            <input type="hidden" name="id">
                        </div>
                        <div class="form-group">
                            <label>Teacher Remark</label>
                            <input type="text" name="teacher" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary float-right updateRemark">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/results.js') }}"></script>

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{ access_token() }}`
                }
            });


            $('#class_form').on('submit', function(e) {
                e.preventDefault();
                student = $('#clases').val();
                location.href = `/control/result/class/${student}`
            })

            function fetchClasses() {
                $.ajax({
                    method: 'get',
                    url: api_url+'get_class'
                }).done(function (res) {
                    console.log(res);
                    li = $('#clases')
                    li.html(`<option selected disabled>...Select Class...</option>`);
                    res.data.forEach(cla => {
                        li.append(`<option value="${cla.id}">${cla.class}</option>`)
                    });
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchClasses();



            function checkResult()
            {
                class_id = `{{$class_id}}`
                if(class_id == 0){ littleAlert('Pls select a class to see result', 1); return; }
                $.ajax({
                    method: 'get',
                    url: api_url+`class/result/${class_id}`
                }).done(function(res) {
                    console.log(res);
                    res_body = $('#res_body')
                    res_body.html('');
                    if(res.data.length == 0) {
                        littleAlert('No result found in this class', 1); return;
                    }
                    res.data.forEach(sum => {
                        res_body.append(ResultTemplate(sum, ''))
                    });

                    res_body.append(`
                        <button class="mb-3 btn-lg float-right btn btn-secondary"><i class="fa fa-print" aria-hidden="true"></i> Print All Reuslt</button>
                    `);
                }).fail(function(res) {
                    console.log(res);
                    parseError(res.responseJSON);
                })
            }

            checkResult();



        });
    </script>


@endsection
