@extends('layouts.app')

@section('page_title')
    Result Setup
@endsection

@section('page_content')
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Result Setup</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Result Setup</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Continous Accessment Scores
                        </h3>
                    </div>
                    <div class="card-body">
                        <form class="row" id="updateCa">
                            <div class="col-md-4 col-6 form-group">
                                <label>CA 1</label>
                                <input type="number" name="ca1" class="form-control" placeholder="CA 1">
                            </div>
                            <div class="col-md-4 col-6 form-group">
                                <label>CA 2</label>
                                <input type="number" name="ca2" class="form-control" placeholder="CA 2">
                            </div>
                            <div class="col-md-4 col-6 form-group">
                                <label>CA 3</label>
                                <input type="number" name="ca3" class="form-control" placeholder="CA 3">
                            </div>
                            <div class="col-md-6 col-6 form-group">
                                <label>Exam</label>
                                <input type="number" name="exam" class="form-control" placeholder="Exam">
                            </div>
                            <div class="col-md-6 col-12 form-group">
                                <button class="btn btn-secondary mt-md-4 float-right updateCa">Save</button>
                            </div>
                        </form>
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
                    'Authorization': `Bearer {{ access_token() }}`
                }
            });


            $('#updateCa').on('submit', function(e) {
                e.preventDefault();
                form = $(this);
                ca1 = parseInt($(form).find('input[name="ca1"]').val())
                ca2 = parseInt($(form).find('input[name="ca2"]').val())
                ca3 = parseInt($(form).find('input[name="ca3"]').val())
                exam = parseInt($(form).find('input[name="exam"]').val())
                console.log(ca1, ca2, ca3, exam);
                total = ca1+ca2+ca3+exam;
                if(total != 100) { littleAlert('The sum of the socres must be equal to 100',1); return;}
                $.ajax({
                    method: 'post',
                    url: api_url+'update_ca',
                    data: {
                        ca1: ca1,
                        ca2: ca2,
                        ca3: ca3,
                        exam: exam
                    },
                    beforeSend:() => {
                        btnProcess('.updateCa', '', 'before')
                    }
                }).done(function(res) {
                    littleAlert(res.message);
                    btnProcess('.updateCa', 'Save', 'after')
                    console.log(res);
                }).fail(function(res) {
                    console.log(res);
                    parseError(res.responseJSON);
                    btnProcess('.updateCa', 'Save', 'after')
                })
            })

            function fetchCa() {
                $.ajax({
                    method: 'get',
                    url: api_url+'ca'
                }).done(function(res) {
                    console.log(res);
                    ca = res.data
                    form = $('#updateCa')
                    $(form).find('input[name="ca1"]').val(`${(ca) ? ca.ca1 : 0}`)
                    $(form).find('input[name="ca2"]').val(`${(ca) ? ca.ca2 : 0}`)
                    $(form).find('input[name="ca3"]').val(`${(ca) ? ca.ca3 : 0}`)
                    $(form).find('input[name="exam"]').val(`${(ca) ? ca.exam : 0}`)
                }).fail(function(res) {
                    console.log(res);
                })
            }

            fetchCa();




        })
    </script>

@endsection
