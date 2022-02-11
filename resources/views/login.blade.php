<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Petal | Sign In</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <script src="{{ asset('assets/js/littlealert.js') }}"></script>
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

</head>
@include('layouts.inc.alert_top')
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>School</b>Petal</a>
            </div>

            <div class="littleAlert"></div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="#" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icheck-primary">
                                <p class="mb-1 float-right ">
                                    <a href="/forgot_password">Forgot Password?</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="social-auth-links text-center mt-2 mb-3">
                                <button type="button" id="login" class="btn btn-block btn-primary">
                                    Sign In
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#login').on('click',  function() {
                email = $('input[name="email"]').val();
                password = $('input[name="password"]').val();

                //check empty
                if(!email || !password)
                {
                    littleAlert('All fileds are required', 1);
                    return;
                }

                ///regex email
                if(!email){ littleAlert('Pls enter a valid email address',1); return; }
                $.ajax({
                    method: 'post',
                    url: 'http://127.0.0.1:8000/api/login/staff',
                    data: {
                        email: email,
                        password: password
                    },
                    beforeSend: () => {
                        btnProcess('#login', 'Sign In', 'before');
                    }
                }).done(function (res) {
                    console.log(res);
                    littleAlert(res.message)
                    $.ajax({
                        method: 'post',
                        url: '/session_login_infomation',
                        data: { data: res }
                    })
                    location.href = '/control/dashboard';
                }).fail( function (res) {
                    console.log(res);
                    parseError(res.responseJSON);
                    btnProcess('#login', 'Sign In', 'after');

                });


            })
        })
    </script>
</body>

</html>
