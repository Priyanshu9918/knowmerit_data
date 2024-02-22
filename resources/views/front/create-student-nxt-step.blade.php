<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Know Merit</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/fav.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <style>
        .login-wrapper .loginbox .img-logo {
            margin-bottom: 8px;
        }

        .accordion1 {
            padding: 0 0px 0px;
        }
    </style>
</head>

<body>
    @php
        $aa = Session::get('ist_id');
        $user = DB::table('users')->where('id', $aa)->first();
    @endphp
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
                            <form action="{{ route('front.student.createnxtstep') }}" method="POST" id="createFrm">
                                @csrf
                                <input type="hidden" id="bnft" name="bnft" />
                                <input type="hidden" id="price1" name="price1" />
                                <input type="hidden" class="form-control" name="user_id" value="{{ Session::get('ist_id') }}" id ="user_id">
                                <input type="hidden" id="first_name" name="first_name" value="{{ $user->first_name }}" />
                                <input type="hidden" id="email " name="email "  value="{{ $user->email }}" />
                                <input type="hidden" id="phone " name="phone "  value="{{ $user->phone }}" />

                                <fieldset class="field-card" style="display: block;">
                                    <div class="add-course-info">
                                        <div class="curriculum-info">


                                            <div id="accordion-six" class="accordion1">
                                                {{-- <div class="faq-grid">
                                                    <div class="faq-header">
                                                        <a class="collapsed faq-collapse" data-bs-toggle="collapse"
                                                            href="#collapseFour">
                                                            <i class="fas fa-align-justify"></i> Benefits
                                                        </a>
                                                    </div>
                                                    <div id="collapseFour" class="collapse show"
                                                        data-bs-parent="#accordion-one">
                                                        <div class="faq-body d-flex justify-content-between fqbody">
                                                            <p class="feature1">Feature your Learning Requirement and
                                                                Connect with Top Tutors </p>
                                                            <i class="fa fa-info-circle"
                                                                style="color: #b4b4b4;margin-top: 2px;margin-left: 2px;"></i>
                                                        </div>
                                                        <div class="faq-body d-flex justify-content-between fqbody">
                                                            <p class="feature1">Feature your Learning Requirement and
                                                                Connect with Top Tutors </p>
                                                            <i class="fa fa-info-circle"
                                                                style="color: #b4b4b4;margin-top: 2px;margin-left: 2px;"></i>
                                                        </div>
                                                        <div class="faq-body d-flex justify-content-between fqbody">
                                                            <p class="feature1">Feature your Learning Requirement and
                                                                Connect with Top Tutors </p>
                                                            <i class="fa fa-info-circle"
                                                                style="color: #b4b4b4;margin-top: 2px;margin-left: 2px;"></i>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="faq-grid">
                                                    @php
                                                        $benifits = Helper::benifits();
                                                    @endphp
                                                    <div class="faq-header" id="faq-hide">
                                                        <a class="collapsed faq-collapse"
                                                            data-bs-toggle="collapse"
                                                            href="#collapseFour">
                                                            <i
                                                                class="fas fa-align-justify"></i>
                                                            {{ $benifits->title ?? '' }}
                                                        </a>
                                                    </div>
                                                    <div
                                                        id="collapseFour"class="collapse show"data-bs-parent="#accordion-six">
                                                        {!! $benifits->benifits ?? '' !!}

                                                    </div>
                                                </div>
                                                @php
                                                    $member_ship = DB::table('member_ship_plans')
                                                        ->where('status', 1)->where('user_type',0)
                                                        ->get();
                                                @endphp

                                                @foreach ($member_ship as $m_ship)
                                                    <div class="featured-info-time d-flex align-items-center">
                                                        <div class="hours-time-two d-flex align-items-center">
                                                            <div class="radio ">
                                                                <label><input type="radio" class="Input_Id"
                                                                        data-id="1"
                                                                        data-value="{{ $m_ship->amount }}"
                                                                        name="payment_status"
                                                                        value="{{ $m_ship->benifits }}">
                                                                    <span
                                                                        style="margin-left: 10px">{{ $m_ship->benifits }}</span></label>
                                                            </div>
                                                        </div>
                                                        <div class="course-view d-inline-flex align-items-center">
                                                            <div class="course-price cprice1">
                                                                <h3>₹{{ $m_ship->amount }}</span>
                                                                </h3>
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endforeach
                                                <div class="featured-info-time d-flex align-items-center">
                                                    <div class="hours-time-two d-flex align-items-center">
                                                        <div class="radio Input_Id" data-id="2">
                                                            <label>
                                                                <input type="radio" name="payment_status"
                                                                    value="Continue without prime benifits"><span
                                                                    style="margin-left: 10px ; color:#009fff;">Continue
                                                                    without prime
                                                                    benefits</span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p class="sec"><i class="fa fa-lock"></i> 100% SECURE PAYMENT</p>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">

                                            <img src="assets/img/my-img/american-express.png"
                                                style="width:10%;object-fit: contain;">
                                            <img src="assets/img/my-img/MasterCard.png"
                                                style="width:10%;object-fit: contain;margin-left: 14px;">
                                            <img src="assets/img/my-img/visa-logo.png"
                                                style="width:10%;object-fit: contain;">
                                        </div>
                                        <div class="row">
                                            <div class="col-6" id="p_n">
                                                <div class="widget-btn">
                                                    <button type="submit" style="border: unset;background: unset;"><a href="javascript:void(0)"
                                                            class="btn btn-info-light float-right buy_now"
                                                            data-amount="100" data-id="7">Pay Now</a></button>
                                                </div>
                                            </div>
                                            <div class="col-6 d-none" id="p_l">
                                                <div class="widget-btn">
                                                    <button type="submit" class="btn btn-info-light ">Pay
                                                        later</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
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

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
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
                            window.location = "{{ url('/')}}" + "/student/student-dashboard";
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
        var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.buy_now', function(e) {
            var payment_status = $("input[name='payment_status']:checked").val();
            var amount = $('#price1').val();
            var user_id = $('#user_id').val();
            // var user_id = $('#user_id').val();
            var email  = $('#email ').val();
            var phone  = $('#phone ').val();
            var first_name  = $('#first_name ').val();
            var options = {
                "key": "{{ env('RAZAR_CLIENT_ID') }}",
                "amount": (amount * 100), // 2000 paise = INR 20
                "name": first_name,
                "description": "Payment",
                "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                "handler": function(response) {
                    window.location.href = SITEURL + '/' + 'paysuccesspayment?payment_id=' + response
                        .razorpay_payment_id  + '&amount=' + amount + '&user_id=' + user_id + '&payment_status=' + payment_status;
                },
                "prefill": {
                    "phone": '8887870982',
                    "email": 'email',
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
        /*document.getElementsClass('buy_plan1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
        }*/
        $(".Input_Id").on('change', function() {
            var id = $(this).attr("data-id");
            var price = $(this).attr("data-value");
            if (id == 1) {
                $("#price1").val(price);
                $("#p_n").removeClass("d-none");
                $("#p_l").addClass("d-none");
            }
            if (id == 2) {
                $("#p_l").removeClass("d-none");
                $("#p_n").addClass("d-none");
                $("#bnft").val("2");

            }
        });



// $(document).ready(function(){
//   $("#faq-hide").click(function(){
//     $("#collapseFour").toggle();
//   });

//   });
// });

    </script>
</body>
</html>
