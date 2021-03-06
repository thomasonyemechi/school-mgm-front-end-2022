@extends('layouts.app')

@section('page_title')
    Check Result
@endsection


@section('page_content')


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Check Result</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Check Result</li>
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
                                <form id="sub_form">
                                    <div class="form-group">
                                        <label>Select Student</label>
                                        <select name="student_id" id="students" class="form-control select2bs4">
                                            <option selected disabled>... Loading Students ...</option>
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


            $('#sub_form').on('submit', function(e) {
                e.preventDefault();
                student = $('#students').val();
                location.href = `/control/result/check/${student}`
            })

            function fetchStudent() {
                $.ajax({
                    method: 'get',
                    url: api_url+'fetch_students'
                }).done(function (res) {
                    console.log(res);
                    li = $('#students')
                    li.html(`<option selected disabled>...Select Student...</option>`);
                    res.data.forEach(std => {
                        li.append(`<option value="${std.id}">${std.surname} ${std.firstname} ${std.othername} | ${(std.class) ? std.class.class : ''} <sup>${(std.arm) ? std.arm.arm : ''}, ${std.sex}</sup></option>`)
                    });
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchStudent();

            function checkResult()
            {
                student_id = `{{$student_id}}`
                if(student_id == 0){ littleAlert('Pls select a student to check result', 1); return; }
                $.ajax({
                    method: 'get',
                    url: api_url+`result/${student_id}`
                }).done(function(res) {
                    console.log(res);
                    $('#res_body').html(ResultTemplate(res.data, ''))
                }).fail(function(res) {
                    console.log(res);
                    parseError(res.responseJSON);
                })
            }

            checkResult();

        });
    </script>


@endsection
