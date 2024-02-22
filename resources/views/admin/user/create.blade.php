@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User</h4>
                            <form action="{{ route('admin.user.create') }}" method="POST" id="createFrm"
                                enctype="multipart/form-data">
                                @csrf
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">First Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="first_name"
                                                    name="first_name" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-first_name"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Last Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="last_name"
                                                    name="last_name" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-last_name"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Contact Number</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="phone" id="phone" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-phone"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">role</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="role">
                                                    @foreach ($role as $roles)
                                                        <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-role"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" name="email" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-email"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group row" style="position: inherit;">
                                            <label class="col-sm-4 col-form-label">Password</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="password" name="password"
                                                    autocomplete="current-password" id="password">
                                                <i class="far fa-eye" id="togglePassword"
                                                    style="margin-top: -28px; cursor: pointer; position: absolute;right: 0;margin-right: 20px;"></i>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-password"></p>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password">

                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-password"></p>
                                        </div>
                                    </div>
                                </div> --}}
                                </div>

                                <div class="card" style="background:white;">
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="btn btn-success submit mr-2">Submit</button>
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
        {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {
                //on change country

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
                $('#first_name, #last_name').on('keypress', function(e) {
                    var $this = $(this);
                    var regex = /^[A-Za-z ]+$/;
                    var inputChar = String.fromCharCode(e.which);

                    if (!regex.test(inputChar)) {
                        e.preventDefault();
                    }
                });

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

                $('#tutor_email').on('blur', function() {
                    var email = $(this).val();
                    if (email) {
                        $.ajax({
                            url: "{{ route('check-email') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                email: email
                            },
                            success: function(response) {
                                if (response.exists) {
                                    $('#error-tutor_email').html('Email already exists.');
                                } else {
                                    $('#error-tutor_email').html('');
                                }
                            }
                        });
                    }
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
                                $('.submit').html('Submit');
                            }, 2000);
                            //console.log(response);
                            if (response.success == true) {

                                //notify
                                toastr.success("User Created Successfully");
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" + "/admin/user";
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
        </script>
    @endpush
