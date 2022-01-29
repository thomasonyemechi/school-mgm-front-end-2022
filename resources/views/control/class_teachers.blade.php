@extends('layouts.app')

@section('page_title')
    Class Subject Teachers
@endsection


@section('page_content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 class_name">Class Subject Teachers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/control/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/control/class/{{$class_id}}">Class Profile</a></li>
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
                    {{-- <div>

                    </div> --}}
                    <div class="card-body p-1">
                        <button class="btn btn-secondary float-right mb-2" >Assign Teacher</button>
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
                                <tbody id="teachers">
                                    <tr>
                                        <td colspan="12"><div class="text-center"><span class="spinner-border spinner-border-sm" aria-hidden="true"></span> <i> Loading Teachers ... </i></div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </section>



    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'Authorization': `Bearer {{access_token()}}`
                }
            });

            const class_id = `{{$class_id}}`
            function tecahers(class_id)
            {
                $.ajax({
                    method: 'get',
                    url: api_url+'class_teachers/'+class_id+'?page='+`{{ $_GET['page'] ?? 0 }}`
                }).done(function (res) {
                    $('.class_name').html(`Class Subjects Teachers (${res.data.class.class})`)
                    body = $('#teachers')
                    body.html(``);
                    res.data.teachers.map((tea, index) => {
                        body.append(`
                            <tr>
                                <td>${index+1}</td>
                            </tr>
                        `)
                    })



                    // $("#example1").DataTable({
                    //     "responsive": true, "lengthChange": false, "autoWidth": false,
                    //     "buttons": ["copy", "csv", "excel", "pdf", "print"],
                    //     "paging": false,
                    //     "searching": true,
                    //     "ordering": true,
                    //     "info": true,
                    //     "autoWidth": true,
                    //     "responsive": false,
                    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


                }).fail(function (res) {
                    parseError(res.responseJSON)
                })
            }


            tecahers(class_id);
        })
    </script>



@endsection
