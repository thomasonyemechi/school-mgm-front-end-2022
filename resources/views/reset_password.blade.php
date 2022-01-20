<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Petal | Reset Password</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>School</b>Petal</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Reset your password, choose a strong password !!</p>

                <form action="/" method="post">
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="social-auth-links text-center mt-2 mb-3">
                                <button class="btn btn-block btn-primary">
                                    Rsest Password
                                </button>
                                <p class="float-left mt-2">
                                <a href="/login"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Login Here</a>
                              </p>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</body>

</html>
