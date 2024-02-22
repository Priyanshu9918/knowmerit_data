<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Know Merit</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/fav.png')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <style>
        .login-wrapper .loginbox .img-logo {
    margin-bottom: 8px;
        }
        </style>
</head>

<body>
    <div class="main-wrapper log-wrap">
        <div class="row">

            <div class="col-md-6 login-bg">
                <div class="owl-carousel login-slide owl-theme">
                    <div class="welcome-login">
                        <div class="login-banner">
                            <img src="{{asset('assets/img/my-img/login-img1.png')}}" class="img-fluid" alt="Logo">
                        </div>
                        <div class="mentor-course text-center">
                            <h2>Welcome to <br>Know Merit Courses.</h2>
                            <p>At KnowMerit, we bring together a world of knowledge at your fingertips. Our global teacher marketplace offers a diverse range of subjects, Outskills, and more, ensuring that every learner finds the perfect match for their educational journey.</p>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-md-6 login-wrap-bg">

                <div class="login-wrapper">
                    <div class="loginbox">
                        <div class="w-100">
                            <div class="img-logo">
                                <img src="{{asset('assets/img/logo/logo.png')}}" class="img-fluid" alt="Logo">
                                
                            </div>
                            <h1>Demo Classes</h1>
							<form action="instructor-dashboard.html">
                                <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input type="text" class="form-control" placeholder="Enter Your Full Name">
                                </div>
                                <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Your Email">
                                </div>
                                <div class="form-group">
                                <label class="form-control-label">Phone</label>
                                <input type="text" class="form-control" placeholder="Enter Your Phone">
                                </div>
                                <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <div class="pass-group">
                                <input type="password" class="form-control pass-input" placeholder="Enter Your Password">
                                <span class="feather-eye toggle-password"></span>
                                </div>
                                </div>
                                
                                
                                <div class="d-grid">
                                <button class="btn btn-primary btn-start" type="submit">Continue</button>
                                </div>
                                </form>
							
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
