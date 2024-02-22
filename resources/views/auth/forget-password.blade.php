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
                            <img src="assets/img/forget-password-img.png" class="img-fluid" alt="Logo">
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
                        <h1>Forgot Password ?</h1>
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                        <div class="reset-password">
                            <p>Enter your email to reset your password.</p>
                        </div>
                        <form action="{{ route('ForgetPasswordPost') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input id="email" name="email" class="form-control" placeholder="Enter your email address">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <div class="d-grid">
                                <button class="btn btn-start" name="recover-submit" value="Reset Password" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</html>
