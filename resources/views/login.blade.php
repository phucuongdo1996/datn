<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.6.1.min.css')}}">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login/css/util.css') }}">
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('images/login/background_login_2.jpeg');">
        <div class="wrap-login100">
            <div class="login100-form validate-form">
					<span class="login100-form-logo">
						<i class="fas fa-user"></i>
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						ĐĂNG NHẬP
                </span>

                <div class="" style="margin-bottom: 1em">
                    <input class="form-control" type="text" name="username" placeholder="Tài khoản">
                </div>

                <div class="" style="margin-bottom: 2em">
                    <input class="form-control" type="text" name="username" placeholder="Mật khẩu">
                </div>

                <div class="container-login100-form-btn">
                    <a href="{{ route(TOP) }}">
                        <button class="login100-form-btn">
                            Đăng nhập
                        </button>
                    </a>
                </div>

                <div class="text-center p-t-90">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('css/login/vendor/animsition/js/animsition.min.js') }}"></script>
<script src="{{ asset('css/login/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('css/login/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('css/login/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('css/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('css/login/vendor/countdowntime/countdowntime.js') }}"></script>
<script src="js/main.js"></script>

</body>
</html>