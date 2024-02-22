<!DOCTYPE html>
<html lang="en">

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
    <style>
        .login-wrapper .loginbox .img-logo {
            margin-bottom: 8px;
        }
        #pageloader {
            background: rgba(247, 250, 247, 0.8);
            display: none;
            height: 100%;
            position: fixed;
            width: 100%;
            z-index: 9999;
        }

        #pageloader img {
            left: 50%;
            margin-left: -32px;
            margin-top: -32px;
            position: absolute;
            top: 50%;
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
                            <img src="{{ asset('assets/img/my-img/login-img1.png') }}" class="img-fluid" alt="Logo">
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
                                <img src="{{ asset('assets/img/logo/logo.png') }}" class="img-fluid" alt="Logo">
                            </div>
                            <h1>Signup as a Student</h1>
                            <form action="{{ route('front.student.create') }}" method="POST" id="createFrm">
                                @csrf
                                @if(request()->has('ref'))
                                <input type="hidden" name="referral_code" id="referral_code" value="{{request()->get('ref')}}">
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label">Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        placeholder="Enter Your Full Name" id="first_name">
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-first_name"></p>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Email</label>
                                    <input type="text" class="form-control" name="email"
                                        placeholder="Enter Your Email" id="email">
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email">
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Phone</label>
                                    <input type="number" class="form-control phone_code" name="phone"
                                        placeholder="Enter Your Phone" id="phone">
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone">
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" name="password"
                                            placeholder="Enter Your Password" id="password">
                                        <span class=" toggle-password"><i class="far fa-eye" id="togglePassword"></i></span>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-password"></p>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-start next_btn1"
                                        type="submit">Continue</button>
                                </div>
                            </form>
                            <div class="text-center mt-2">
                                    <p class="mb-0">You already have an account ? <a href="{{url('/user/login')}}" style="color: #009fff;">Log in</a>
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/plugins/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/plugins/swiper/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js?r=5426'></script>
    <script src='https://assets.codepen.io/16327/ScrollTrigger.min.js?v=3.8.0c'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"
        rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<div id="pageloader">
   <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
</div>
    <script>
         $('#first_name').keypress(function (e) {
        var regex = new RegExp(/^[a-zA-Z\s]+$/);
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else {
            e.preventDefault();
            return false;
        }
    });
        $(document).ready(function() {
            $("#createFrm").on("submit", function() {
                $("#pageloader").fadeIn();
            }); //submit
        });
        $(document).ready(function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function(e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
            });
            $('#email').on('blur', function() {
                var email = $(this).val();
                if (email) {
                    $.ajax({
                        url: "{{ route('checkstudent-email') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: email
                        },
                        success: function(response) {
                            if (response.exists) {
                                $('#error-email').html('Email already exists.');
                            } else {
                                $('#error-tutor_email').html('');
                            }
                        }
                    });
                }
            });
        });
        $(document).ready(function() {
            $('#phone').on('keypress', function(e) {
                var $this = $(this);
                var regex = new RegExp("^[0-9\b]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                // for 10 digit number only
                if ($this.val().length > 9) {
                    e.preventDefault();
                    return false;
                }
                if (e.charCode < 54 && e.charCode > 47) {
                    if ($this.val().length == 0) {
                        e.preventDefault();
                        return false;
                    } else {
                        return true;
                    }
                }
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
            });
        });
        var phone_number = window.intlTelInput(document.querySelector(".phone_code"), {
            separateDialCode: true,
            preferredCountries: ["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });
        $(document).on('submit', 'form#createFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
            $('.form-control').addClass('disabled-link');
            $('.error-control').addClass('disabled-link');
            if ($('.submit').html() !== loadingText) {
                $('.submit').html(loadingText);
            }
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Save');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success("About us point Created Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" +
                                "/create-student-nxt-step";
                        }, 2000);

                    }
                    //show the form validates error
                    if (response.success == false) {
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                            // $('#error-'+error_text).html(response.errors[error_text][0]);
                            // console.log('#error-'+error_text);
                        }
                        // console.log(response.errors);
                    }
                },
                error: function(response) {
                    // alert("Error: " + errorThrown);
                    console.log(response);
                }
            });
            event.stopImmediatePropagation();
            return false;
        });
    </script>
</body>

</html>
