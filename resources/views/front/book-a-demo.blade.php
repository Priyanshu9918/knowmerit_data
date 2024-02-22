@extends('layouts.front.master')
@section('content')
    <style>
        .f-control {
            font-size: 14px !important;
            padding-left: 86px !important;
            margin-right: 10px;
        }

        .add-course-info .f-control {
            background: #FFFFFF;
            border: 1px solid #e9ecef;
            border-radius: 5px;
            min-height: 40px;
            width: 100%;
        }
    </style>
    @php
        $parent_cat = DB::table('categories')
            ->where('parent', 0)
            ->where('status', '<>', 2)
            ->get();
    @endphp
    <section class="home-three-slide d-flex align-items-center">
        <div class="container">
            <div class="row ">
                <div class="col-xl-6 col-lg-8 col-md-12 col-12 aos-init aos-animate" data-aos="fade-down">
                    <div class="home-three-slide-face">
                        <div class="home-three-slide-text">
                            <h1>Book a Demo</h1>
                            <p>Help your favourite Tutor or Institute win the Know Merit Excellence Award 2023</p>
                        </div>
                        <div class="banner-three-content">
                            <div class="card comment-sec">
                                <div class="card-body bookasession">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card" style="border:unset;margin-bottom: 0">
                                                <div class="widget-set">
                                                    <div class="widget-content multistep-form">
                                                        <form action="{{ route('front.create_demo_class') }}" method="POST"
                                                            id="createFrm" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" id="bnft" name="bnft" />
                                                            <input type="hidden" id="price1" name="price1" />
                                                            <input type="hidden" name="user_type" value="3" />
                                                            <fieldset id="first">
                                                                <div class="add-course-info">
                                                                    <div class="add-course-form">
                                                                        <div class="form-group">
                                                                            <select
                                                                                class="js-example-basic-single s_cat form-select"
                                                                                name="category" id="category">
                                                                                <option value="">Category</option>
                                                                                @foreach ($parent_cat as $category)
                                                                                    <option value="{{ $category->id }}">
                                                                                        {{ $category->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-category"></p>
                                                                        </div>
                                                                        <div class="form-group d-none" id="s_n">
                                                                            <select class="form-select" name="sub_category"
                                                                                id="sub_category">
                                                                                <option value="">Select Sub Category
                                                                                </option>
                                                                            </select>
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-category"></p>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <input class="form-control demoform"
                                                                                    name="pincode" type="text"
                                                                                    id="pincode"
                                                                                    placeholder="Enter the location">
                                                                                <p style="margin-bottom: 2px;"
                                                                                    class="text-danger error_container"
                                                                                    id="error-pincode"></p>
                                                                                <div id="autocomplete-container"></div>
                                                                                <input type="hidden" id="lat"
                                                                                    name="lat" value="">
                                                                                <input type="hidden" id="lng"
                                                                                    name="lng" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-btn">
                                                                        <a class="btn btn-info-light next_btn0"
                                                                            id="tab1">Continue</a>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="field-card">
                                                                <div class="add-course-info">
                                                                    <div class="add-course-form">
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Name.</label>
                                                                            <input type="text"
                                                                                class="form-control demoform"
                                                                                placeholder="Full Name" name="first_name"
                                                                                id="first_name">
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-first_name"></p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Email.</label>

                                                                            <input type="email"
                                                                                class="form-control demoform"
                                                                                placeholder="Email" name="email"
                                                                                id="email">
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-email"></p>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Profile Image.</label>

                                                                            <input type="file"
                                                                                class="form-control demoform" name="avatar"
                                                                                id="avatar"
                                                                                style="
                                                                                font-size: 21px!important">
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-avatar"></p>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Password.</label>
                                                                            <input type="password"
                                                                                class="form-control demoform"
                                                                                placeholder="Password" name="password"
                                                                                id="password">
                                                                                <i class="far fa-eye" id="togglePassword" style="position: absolute;margin-top: -28px;margin-right: 37px;right: 0;"></i>
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-password"></p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-control-label">Phone No.</label>
                                                                            <input type="number"
                                                                                class="f-control demoform phone_code"
                                                                                placeholder="Mobile Number" name="phone"
                                                                                id="phone" style="display:block;">
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-phone"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-btn">
                                                                        <a
                                                                            class="btn btn-info-light next_btn1">Continue</a>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="field-card">
                                                                <div class="add-course-info">
                                                                    <div class="add-course-form">
                                                                        <h6>How would you like to attend your classes</h6>
                                                                    </div>
                                                                    <div
                                                                        class="add-course-form d-flex justify-content-between">
                                                                        <div class="left-content d-flex">
                                                                            <i class="fa fa-desktop" aria-hidden="true"
                                                                                style="color: #a5a5a5;"></i>
                                                                            <p class="live-inter">Live Interactive Online
                                                                                Class
                                                                            </p>
                                                                        </div>
                                                                        <div class="right-content">
                                                                            <div class="checkbox classes_choice">
                                                                                <label><input type="checkbox"
                                                                                        name="classes_choice"
                                                                                        value="online_class"
                                                                                        id="online_class"></label>
                                                                            </div>
                                                                            <p style="margin-bottom: 2px;"
                                                                                class="text-danger error_container"
                                                                                id="error-online_class"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="add-course-form d-flex justify-content-between">
                                                                        <div class="highrated">
                                                                            <ul>
                                                                                <li><strong>Recommended</strong></li>
                                                                                <li><i class="fa fa-check"
                                                                                        style="color:#009fff;"></i> High
                                                                                    Rated Tutor</li>
                                                                                <li><i class="fa fa-check"
                                                                                        style="color:#009fff;"></i> Free
                                                                                    Demo Classes</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="add-course-form d-flex justify-content-between">
                                                                        <div class="left-content d-flex">
                                                                            <i class="feather-map-pin"
                                                                                style="color: #a5a5a5;"></i>

                                                                            <p class="live-inter">Offline at my Home and
                                                                                nearby Classes </p>
                                                                        </div>
                                                                        <div class="right-content">
                                                                            <div class="checkbox classes_choice">
                                                                                <label><input type="checkbox"
                                                                                        name="classes_choice"
                                                                                        value="home_class"
                                                                                        id="home_class"></label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <p style="margin-bottom: 2px;"
                                                                        class="text-danger error_container"
                                                                        id="error-home_class"></p>
                                                                    <div class="widget-btn">
                                                                        <a
                                                                            class="btn btn-info-light next_btn2">Continue</a>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                            <fieldset class="field-card">
                                                                <div class="add-course-info">
                                                                    <div class="curriculum-info">
                                                                        <div id="accordion-one" class="accordion1">
                                                                            <div class="faq-grid">
                                                                                @php
                                                                                    $benifits = Helper::benifits();
                                                                                @endphp
                                                                                <div class="faq-header">
                                                                                    <a class="collapsed faq-collapse"
                                                                                        data-bs-toggle="collapse"
                                                                                        href="#collapseFour">
                                                                                        <i
                                                                                            class="fas fa-align-justify"></i>
                                                                                        {{ $benifits->title ?? '' }}
                                                                                    </a>
                                                                                </div>
                                                                                <div
                                                                                    id="collapseFour"class="collapse show"data-bs-parent="#accordion-one">
                                                                                    {!! $benifits->benifits ?? '' !!}

                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $member_ship = DB::table('member_ship_plans')
                                                                                    ->where('status', 1)
                                                                                    ->where('user_type', 0)
                                                                                    ->get();
                                                                            @endphp

                                                                            @foreach ($member_ship as $m_ship)
                                                                                <div
                                                                                    class="featured-info-time d-flex align-items-center">
                                                                                    <div
                                                                                        class="hours-time-two d-flex align-items-center">
                                                                                        <div class="radio ">
                                                                                            <label><input type="radio"
                                                                                                    class="Input_Id"
                                                                                                    data-id="1"
                                                                                                    data-value="{{ $m_ship->amount }}"
                                                                                                    name="payment_status"
                                                                                                    value="{{ $m_ship->benifits }}">
                                                                                                <span
                                                                                                    style="margin-left: 10px">{{ $m_ship->benifits }}</span></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="course-view d-inline-flex align-items-center">
                                                                                        <div class="course-price cprice1">
                                                                                            <h3>₹{{ $m_ship->amount }}</span>
                                                                                            </h3>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            @endforeach
                                                                            <div
                                                                                class="featured-info-time d-flex align-items-center">
                                                                                <div
                                                                                    class="hours-time-two d-flex align-items-center">
                                                                                    <div class="radio Input_Id"
                                                                                        data-id="2">
                                                                                        <label>
                                                                                            <input type="radio"
                                                                                                name="payment_status"
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
                                                                        <P class="sec"><i class="fa fa-lock"></i> 100%
                                                                            SECURE PAYMENT</P>
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
                                                                                <button type="submit"><a
                                                                                        href="javascript:void(0)"
                                                                                        class="btn btn-info-light float-right buy_now"
                                                                                        data-amount="100"
                                                                                        data-id="7">Pay Now</a></button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 d-none" id="p_l">
                                                                            <div class="widget-btn">
                                                                                <button type="submit"
                                                                                    class="btn btn-info-light submit ">
                                                                                    Pay later</button>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-md-6 col-12 aos-init aos-animate" data-aos="fade-up">
                    <div class="girl-slide-img aos">
                        <img class="img-fluid" src="assets/img/slider/home-slider.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
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
        function initAutocomplete() {
            const locationInput = document.getElementById('pincode');
            const lat = document.getElementById('lat');
            const lng = document.getElementById('lng');
            const autocompleteContainer = document.getElementById('autocomplete-container');
            const autocomplete = new google.maps.places.Autocomplete(locationInput);
            const place = autocomplete.getPlace();
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                locationInput.value = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                lat.value = latitude;
                lng.value = longitude;

            });
        }

        $(document).ready(function() {
            let progressVal = 0;
            let businessType = 0;

            $(".next_btn0").click(function() {
                var pincode = $('#pincode').val();
                var category = $('#category').val();
                var errors = false;
                if (category == '') {
                    $('#error-category').html('please select category name');
                    errors = true;
                } else {
                    $('#error-category').html('');
                }
                if (pincode == '') {
                    $('#error-pincode').html('please enter location');
                    errors = true;
                }
                if (errors) {
                    return false;
                }
                $(this).parent().parent().parent().next().fadeIn('slow');
                $(this).parent().parent().parent().css({
                    'display': 'none'
                });
                progressVal = progressVal + 1;
                $('.progress-active').removeClass('progress-active').addClass('progress-activated').next()
                    .addClass('progress-active');
            });
            $(".next_btn1").click(function() {
                var first_name = $('#first_name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var avatar = $('#avatar').val();
                var password = $('#password').val();
                var errors = false;
                if (first_name == '') {
                    $('#error-first_name').html('please enter first name');
                    errors = true;
                } else {
                    $('#error-first_name').html('');
                }
                if (email == '') {
                    $('#error-email').html('please enter email address');
                    errors = true;
                } else {
                    $('#error-email').html('');
                }
                if (avatar == '') {
                    $('#error-avatar').html('please enter Image ');
                    errors = true;
                } else {
                    $('#error-avatar').html('');
                }
                if (password == '') {
                    $('#error-password').html('please enter password');
                    errors = true;
                } else {
                    $('#error-password').html('');
                }
                if (phone == '') {
                    $('#error-phone').html('please enter phone number');
                    errors = true;
                }
                if (errors) {
                    return false;
                }
                $(this).parent().parent().parent().next().fadeIn('slow');
                $(this).parent().parent().parent().css({
                    'display': 'none'
                });
                progressVal = progressVal + 1;
                $('.progress-active').removeClass('progress-active').addClass('progress-activated').next()
                    .addClass('progress-active');
            });

            $(".next_btn2").click(function() {
                if (document.getElementById('home_class').checked || document.getElementById('online_class')
                    .checked) {} else {
                    $('#error-home_class').html('Please select at least one');
                    return false;
                }
                $(this).parent().parent().parent().next().fadeIn('slow');
                $(this).parent().parent().parent().css({
                    'display': 'none'
                });
                progressVal = progressVal + 1;
                $('.progress-active').removeClass('progress-active').addClass('progress-activated').next()
                    .addClass('progress-active');
            });

            $(".prev_btn").click(function() {
                $(this).parent().parent().parent().prev().fadeIn('slow');
                $(this).parent().parent().parent().css({
                    'display': 'none'
                });
                progressVal = progressVal - 1;
                $('.progress-active').removeClass('progress-active').prev().removeClass(
                    'progress-activated').addClass('progress-active');
            });
            //SUBMIT CODE
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
                            $('.submit').html('Pay later');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {
                            //notify
                            toastr.success(
                                "The Course Added Succesfully <br>Admin will be Approve soon."
                            );
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/student/student-dashboard";
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
        });

        var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.buy_now', function(e) {
            var first_name = $('#first_name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var category = $('#category').val();
            var sub_category = $('#sub_category').val();
            var pincode = $('#pincode').val();
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var classes_choice = $("input[name='classes_choice']:checked").val();
            var payment_status = $("input[name='payment_status']:checked").val();
            var amount = $('#price1').val();
            var options = {
                "key": "{{ env('RAZAR_CLIENT_ID') }}",
                "amount": (amount * 100),
                "name": first_name,
                "description": "Payment",
                "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                "handler": function(response) {
                    window.location.href = SITEURL + '/' + 'paysuccess?payment_id=' + response
                        .razorpay_payment_id + '&amount=' + amount + '&first_name=' + first_name +
                        '&phone=' + phone + '&email=' + email + '&category=' + category + '&sub_category=' +
                        sub_category +
                        '&classes_choice=' + classes_choice + '&payment_status=' + payment_status +
                        '&pincode=' + pincode + '&lat=' + lat + '&lng=' + lng;
                },
                "prefill": {
                    "contact": phone,
                    "email": email,
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });

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
        var phone_number = window.intlTelInput(document.querySelector(".phone_code"), {
            separateDialCode: true,
            preferredCountries: ["in"],
            hiddenInput: "full",
            utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
        });
        $(document).on('change', '#category', function() {
            var id = $('#category').val();

            $.ajax({
                type: "get",
                url: "{{ route('student.sub-category-list') }}",
                data: {
                    'category': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.success == true) {
                        $("#s_n").removeClass('d-none');
                        $("#sub_category").empty();
                        $("#sub_category").append('<option value="">Select Sub Category</option>');
                        $.each(data.value, function(key, value) {
                            $("#sub_category").append('<option value="' + value.id + '">' +
                                value
                                .name + '</option>');
                        });
                    }
                    if (data.success == false) {
                        $("#s_n").addClass('d-none');
                    }
                }
            });
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Bec1p6cCz6VvI3oRvWAyh0VBI9FOmw4&libraries=places&callback=initAutocomplete"
        async defer></script>
@endpush
