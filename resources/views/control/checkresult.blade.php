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
                                <form action="">
                                    <div class="form-group">
                                        <label>Select Student</label>
                                        <select name="student_id" id="students" class="form-control selec2bs4">
                                            <option selected disabled>... Loading Students ...</option>
                                        </select>
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

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/results.js') }}"></script>

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{ access_token() }}`
                }
            });

            function 

            $.ajax({
                method: 'get',
                url: api_url+`result/3`
            }).done(function(res) {
                $('#res_body').html(ResultTemplate(res.data, ''))
            }).fail(function(res) {
                console.log(res);
            })

        });
    </script>


@endsection
