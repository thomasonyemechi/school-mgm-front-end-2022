@extends('layouts.app')

@section('page_title')
    View Result
@endsection


@section('page_content')


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">View Result</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">View Result</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div id="res_body">

            </div>
        </div>
    </section>



    <div class="modal fade" id="updateRemark">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title text-bold">Update Remark</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" enctype="mu">
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

            function checkResult()
            {
                result_id = `{{$result_id}}`

                $.ajax({
                    method: 'get',
                    url: api_url+`viewer/result/${result_id}`
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
