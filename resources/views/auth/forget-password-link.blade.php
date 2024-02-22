<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Know Merit</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<style>
    .form-gap {
        padding-top: 70px;
    }

    input.btn.btn-lg.btn-primary.btn-block {
        background: #ffbb00;
        border: 1px solid #ffbb00;
        border-radius: 5px;
        padding: 12px 15px;
        font-weight: 700;
        color: #FFF;
    }

    .forget-arrow .owl-nav.disabled {
        display: none;
    }

    .owl-carousel {
        display: block;
    }

    .mentor-course h2 {
        font-size: 30px;
        color: #000000;
        font-weight: 500;
        margin: 0px 0px 20px;
    }
</style>

<body>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-md-6 login-bg">
                <div class="owl-carousel login-slide owl-theme aos forget-arrow" data-aos="fade-up">
                    <div class="welcome-login">
                        <div class="login-banner">
                            <img src="../assets/img/forget-password-img.png" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mentor-course text-center">
                            <h2>Welcome to <br>Know Merit Courses.</h2>
                            <p>At KnowMerit, we bring together a world of knowledge at your fingertips. Our global
                                teacher marketplace offers a diverse range of subjects, Outskills, and more, ensuring
                                that every learner finds the perfect match for their educational journey.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 login-wrap-bg">
                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="img-logo">
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo.png') }}"
                                    class="img-fluid" alt="Logo"></a>
                            <!-- <img src="assets/img/logo.svg" class="img-fluid" alt="Logo"> -->
                            <div class="back-home">
                                <a href="{{ url('/') }}">Back to Home</a>
                            </div>
                        </div>
                        <h1>Reset Password</h1>
                        <div class="reset-password">
                            <p>You can reset your password here.</p>
                        </div>
                        <form action="{{ route('ResetPasswordPost') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input id="email" name="email" placeholder="email address" class="form-control" type="hidden" value="{{$data->email ?? ''}}">
                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input id="password" name="password" placeholder="password" class="form-control"
                                    type="password" value="{{ old('password') }}">
                                    <i class="far fa-eye" id="togglePassword" style="position: absolute;margin-top: -5%;margin-right: 17%;right: 0;"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            <div class="form-group">
                                <label class="form-control-label">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation"
                                    placeholder="confirm password" class="form-control" type="password"
                                    value="{{ old('password_confirmation') }}">
                                    <i class="far fa-eye" id="togglePassword1" style="position: absolute; margin-top: -5%;margin-right: 17%;right: 0;"></i>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                            <div class="d-grid">
                                <button class="btn btn-start" type="submit" name="recover-submit"
                                    value="Reset Password">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
</body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<script>
       $(document).ready(function() {


        const togglePassword1 = document.querySelector('#togglePassword1');
             const password1 = document.querySelector('#password_confirmation');

             togglePassword1.addEventListener('click', function(e) {
                 // toggle the type attribute
                 const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                 password1.setAttribute('type', type);
                 // toggle the eye slash icon
                 // this.classList.toggle('fa-eye-slash');
                 $(this).toggleClass('fa fa-eye fa-eye-slash');
             });


            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                // this.classList.toggle('fa-eye-slash');
                $(this).toggleClass('fa fa-eye fa-eye-slash');
            });



        });
    </script>
</html>
