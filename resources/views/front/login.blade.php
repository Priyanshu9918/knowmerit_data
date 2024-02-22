<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Know Merit</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
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
                                <a href="{{url('/')}}"><img src="{{asset('assets/img/logo/logo.png')}}" class="img-fluid" alt="Logo"></a>
                                <div class="back-home">
                                    <a href="{{url('/')}}">Back to Home</a>
                                </div>
                            </div>
                            <h1>Sign into Your Account</h1>
							<div class="row">
								<div class="col-12">
									@if(Session::has('message'))
									<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
									@endif
								</div>
							</div>
							<form method="post" action="{{route('user.dologin')}}" class="singin-form">
                        		@csrf
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input type="email" class="form-control"  name="email" placeholder="Enter your email address" value="{{ old('email') }}">
									@error('email')
										<p class="text-danger" role="alert">
											<strong>{{ $message }}</strong>
										</p>
									@enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" name="password" id="password" placeholder="Enter your password here">
                                        <span class="feather-eye toggle-password"></span>
                                    </div>
                                </div>
								@error('password')
									<p class="text-danger" role="alert">
										<strong>{{ $message }}</strong>
									</p>
								@enderror
                                <div class="forgot">
                                    <span><a class="forgot-link" href="{{ route('ForgetPasswordGet') }}">Forgot Password ?</a></span>

                                </div>
                                <!-- <div class="remember-me">
                                    <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                        <input type="checkbox" name="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> -->
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-start" type="submit">Sign In</button>
                                </div>
                                <div class="text-center mt-2">
                                    <p class="mb-0">New User ? <a id="stucher-btn" href="" style="color: #009fff;">Create an Account</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="stucher-logmodal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius:20px 20px 20px 20px;">
                <div class="modal-header" style="border-radius: 20px 20px 0px 0px;">
                    <button id="stucher-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="border-radius: 0px 0px 20px 20px;">
                    <!--  <img src="{{asset('assets/img/my-img/stucher-image.jpg')}}">
                  <div class="stucher">

                      <a href="">SignUp as a Teacher</a>
                      <a href="{{url('/create-student')}}">SignUp as a Student</a>
                  </div> -->
                  <div class="row">
                        <div class="col-md-6" style="">
                           <div class="teacher-login stucher">
                            <img src="{{asset('assets/img/my-img/teacher-signup.png')}}">
                                <a href="{{url('/create-teacher')}}">SignUp as a Teacher</a>
                           </div>

                        </div>
                        <div class="col-md-6">
                            <div class="student-login stucher">
                                <img src="{{asset('assets/img/my-img/student-signup.png')}}">
                                <a href="{{url('/create-student')}}">SignUp as a Student</a>
                           </div>
                        </div>

                  </div>
                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>
        </div>
    </div>




    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>

    <script src="{{asset('assets/js/script.js')}}"></script>



    <script src="http://merit.techsaga.live/assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
            $(document).on('click', '#stucher-btn', function() {
                $('#stucher-logmodal').modal('show');
                return false;
            });
            $(document).on('click', '#stucher-cancel-btn', function() {
                $('#stucher-logmodal').modal('hide');
            })

    </script>






</body>

</html>
