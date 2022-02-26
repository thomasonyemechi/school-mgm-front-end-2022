<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Result</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <script src="{{ asset('assets/js/littlealert.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

    <style>
        .profile_pics {
            width: 50px;
            height: 50px;
        }

        .object-cover {
            object-fit: cover;
        }


        .hide-print{
            display: none;
        }

        @media print {
            .btn-secondary {
                display: none ;
            }
        }

    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
            <div class="littleAlert"></div>


            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-12">
                            <div id="res_body">

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

        <script src="{{ asset('assets/js/adminlte.js') }}"></script>

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
                        print();
                    }).fail(function(res) {
                        console.log(res);
                        parseError(res.responseJSON);
                    })
                }

                checkResult();
            });
        </script>



</body>

</html>
