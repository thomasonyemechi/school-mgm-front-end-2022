<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Petal | Sign Up</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <script src="{{ asset('assets/js/littlealert.js') }}"></script>
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="littleAlert"></div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>School</b>Petal</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register School</p>

                <form action="#" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="School Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-users"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="nick_name" class="form-control" placeholder="School Nick Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="School Phone">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="School Email">
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
                        <div class="col-12">
                            <div class="icheck-primary">
                                <p class="mb-1 float-left ">
                                    By signing up you agree to <a href="/terms"> terms and conditions </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="social-auth-links text-center mt-2 mb-3">
                                <button type="button" id="signup" class="btn btn-block btn-primary">
                                    Sign Up
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

            ('Hello world');

            $('#signup').on('click',  function() {
                email = $('input[name="email"]').val();
                password = $('input[name="password"]').val();
                phone = $('input[name="phone"]').val();
                name = $('input[name="name"]').val();
                nick_name = $('input[name="nick_name"]').val();

                console.log(email, password, phone, name, nick_name);


                //check empty
                if(!email || !password || !name || !nick_name || !phone)
                {
                    console.log('ero');
                    littleAlert('All fileds are required', 1);
                    return;
                }

                ///regex email
                if(!email){ littleAlert('Pls enter a valid email address',1); return; }

                $.ajax({
                    method: 'post',
                    url: 'http://127.0.0.1:8000/api/register/school',
                    data: {
                        email: email,
                        password: password,
                        name: name,
                        nick_name: nick_name,
                        phone: phone,
                    },
                    beforeSend: () => {
                        btnProcess('#signup', 'Sign In', 'before');
                    }
                }).done(function (res) {
                    littleAlert(res.message)
                    setTimeout(() => {
                        location.href = '/login';
                    }, 2500);
                }).fail( function (res) {
                    parseError(res.responseJSON);
                    btnProcess('#signup', 'Sign In', 'after');
                });
            })
        })
    </script>
</body>

</html>
