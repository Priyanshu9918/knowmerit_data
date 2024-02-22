@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Demo Classes</h4>
                            <form action="{{ route('admin.student_manegment.create') }}" method="POST" id="createFrm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="bnft" name="bnft" />
                                <input type="hidden" id="price1" name="price1" />
                                <input type="hidden" name="user_type" value="3" />

                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Category</b></label>
                                            <select class="form-control category" id="category" name="category">
                                                <option value="">Select Category</option>
                                                @if (count($parent_categories) > 0)
                                                    @foreach ($parent_categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-category"></p>
                                    </div>
                                    <div class="col-md-3 d-none" id="s_n">
                                        <div class="form-group">
                                            <label class="col-sm-12 col-form-label"><b>Sub Category</b></label>
                                            <select class="form-control" name="sub_category" id="sub_category">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-categoty"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Location</b></label>
                                            <input type="text" class="form-control" id="pincode" name="pincode" />
                                            <div id="autocomplete-container"></div>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-pincode"></p>
                                            <input type="hidden" id="lat" name="lat" value="">
                                            <input type="hidden" id="lng" name="lng" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Name</b></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter Name"/>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-first_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Email</b></label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-email"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Image</b></label>
                                            <input type="file" class="form-control" name="avatar" id="avatar">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-avatar"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Password</b></label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-password"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Phone</b></label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Mobile Number" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-phone"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Classes Type</b></label>
                                            <select class="form-control" id="classes_choice" name="classes_choice">
                                                <option value="">classes type</option>
                                                <option value="online_class">Live Interactive Online Class</option>
                                                <option value="home_class">Offline at my Home and nearby Classes</option>
                                                </option>
                                            </select>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-classes_choice"></p>
                                    </div>
                                    <div class="col-md-4">
                                        @php
                                            $member_ship = DB::table('member_ship_plans')
                                                ->where('status', 1)
                                                ->get();
                                        @endphp
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Payment</b></label>

                                            @foreach ($member_ship as $mb)
                                                <div class="radio ">
                                                    <label><input type="radio" class="Input_Id" data-id="1"
                                                            data-value="{{ $mb->amount }}" name="payment_status"
                                                            value="{{ $mb->benifits }}">
                                                        <span style="margin-left: 10px">{{ $mb->benifits }}
                                                            ({{ $mb->amount }})
                                                        </span></label>
                                                </div>
                                            @endforeach
                                            <div class="radio Input_Id" data-id="2">
                                                <label>
                                                    <input type="radio" name="payment_status"
                                                        value="Continue without prime benifits"><span
                                                        style="margin-left: 10px ; color:#009fff;">Continue
                                                        without prime
                                                        benifits</span></label>
                                            </div>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-classes_choice"></p>
                                    </div>
                                </div>
                                <div class="card" style="background:white;">
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-center " id="p_l">
                                                <button type="submit" class="btn btn-success submit mr-2">Submit</button>
                                            </div>
                                            <div class="col-lg-12 text-center d-none" id="p_n">
                                                <button type="submit"><a href="javascript:void(0)"
                                                        class="btn btn-success btn-sm float-right buy_now"
                                                        data-amount="100" data-id="7">Pay</a></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('script')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="{{ asset('theme/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Bec1p6cCz6VvI3oRvWAyh0VBI9FOmw4&libraries=places&callback=initAutocomplete">
        </script>

        <script>
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
            ///////erro msg/////////////
            $(document).ready(function() {


                $(".buy_now").click(function() {
                    var avatar = $('#avatar').val();
                    var classes_choice = $('#classes_choice').val();
                    var pincode = $('#pincode').val();
                    var category = $('#category').val();
                    var first_name = $('#first_name').val();
                    var email = $('#email').val();
                    var phone = $('#phone').val();
                    var password = $('#password').val();
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
                if (first_name == '') {
                    $('#error-first_name').html('please enter  name');
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
                if (avatar == '') {
                    $('#error-avatar').html('please enter Image');
                    errors = true;
                }
                else {
                    $('#error-avatar').html('');
                }
                if (classes_choice == '') {
                    $('#error-classes_choice').html('please choice one class');
                    errors = true;
                }
                else {
                    $('#error-classes_choice').html('');
                }
                if (errors) {
                    return false;
                }

                });

            });
            ////////////////////////////////
            $(document).ready(function() {
                //on change country
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
                                $('.submit').html('Submit');
                            }, 2000);
                            //console.log(response);
                            if (response.success == true) {

                                //notify
                                toastr.success("Demo Classes Created Successfully");
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" +
                                        "/admin/student_manegment";
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
            $(document).ready(function() {
                $('.summernote').summernote();
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
                var avatar = $('#avatar').val();
                var email = $('#email').val();
                var category = $('#category').val();
                var sub_category = $('#sub_category').val();
                var pincode = $('#pincode').val();
                var lat = $('#lat').val();
                var lng = $('#lng').val();
                var amount = $('#price1').val();
                var classes_choice = $('#classes_choice').val();
                var payment_status = $("input[name='payment_status']:checked").val();
                var options = {
                    "key": "{{ env('RAZAR_CLIENT_ID') }}",
                    "amount": (amount * 100),
                    "name": first_name,
                    "description": "Payment",
                    "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                    "handler": function(response) {
                        window.location.href = SITEURL + '/' + 'admin/paysuccess?payment_id=' + response
                            .razorpay_payment_id + '&amount=' + amount + '&first_name=' + first_name +
                            '&phone=' + phone + '&email=' + email + '&category=' + category + '&sub_category=' +
                            sub_category + '&classes_choice=' + classes_choice + '&payment_status=' +
                            payment_status +
                            '&pincode=' + pincode + '&lat=' + lat + '&lng=' + lng + '&avatar=' + avatar;
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
            $(document).on('change', '.category', function() {
                var id = $('#category').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.sub-category-list') }}",
                    data: {
                        'category': id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success == true) {
                            $("#s_n").removeClass('d-none');
                            $("#sub_category").empty();
                            $.each(data.value, function(key, value) {
                                $("#sub_category").append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                        if (data.success == false) {
                            $("#s_n").addClass('d-none');
                        }
                    }
                });
            });
        </script>
    @endpush
