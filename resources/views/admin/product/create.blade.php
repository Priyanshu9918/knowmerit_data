@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Create Product</h4>
                            <form action="{{ route('admin.products.create') }}" method="POST" id="createFrm"
                                enctype="multipart/form-data">
                                @csrf
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Title</label>
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
                                            <label class="col-sm-4 col-form-label">Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="last_name"
                                                    name="last_name" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-last_name"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Discount Price</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="phone" id="phone" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-phone"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Gross Weight</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="email" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-email"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="position: inherit;">
                                            <label class="col-sm-4 col-form-label">Net Weight</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="password"
                                                    autocomplete="current-password" id="password">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-password"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row" style="position: inherit;">
                                            <label class="col-sm-4 col-form-label">No Pcs</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="text" name="password"
                                                    autocomplete="current-password" id="password">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-password"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">About</label>
                                            <div class="col-sm-10">
                                            <textarea class="form-control" id="summernote" name="description_vishal" ></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-email"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Instruction</label>
                                            <div class="col-sm-10">
                                            <textarea class="form-control " id="summernote1" name="description" ></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-email"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Images</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" name="email" />
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-email"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Customize</label>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customizeCheckbox" name="email">
                                                    <label class="form-check-label" for="customizeCheckbox">Check to customize</label>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row g-4">

                                    <div class="col-md-3 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="batch_id" name="batch_id[]" class="form-control">
                                            <label for="batch_id">Title<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-batch_id_0">
                                        </p>

                                    </div>
                                    <div class="col-md-3 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="batch_name" name="batch_name[]"
                                                class="form-control">
                                            <label for="batch_name">price<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-batch_name_0"></p>
                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" id="start_date" name="start_date[]"
                                                class="form-control">
                                            <label for="start_date">pack<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-start_date_0">
                                        </p>

                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="file" id="end_date" name="end_date[]" class="form-control">
                                            <label for="end_date">image<b class="text-danger">*</b></label>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-end_date_0"></p>
                                    </div>

                                    <div class="col-md-2 pt-3">
                                        <button type="button" class="btn btn-primary add-area-btn1" data-id="Aaddress"
                                            id="add1"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="col-md-12" id="mt12">
                                    </div>
                                </div>
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
                //on change country
                $(document).ready(function() {
                    var i = 0;

                    $("#add1").click(function() {
                        ++i;
                        $("#mt12").append(`
                    <div class="row g-4" id="row${i}">
                        <div class="col-md-3 pt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" name="batch_id[]">
                                <label for="batch_id">Title<b class="text-danger">*</b></label>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container batch_id_${i}" id="error-batch_id_${i}"></p>
                        </div>
                        <div class="col-md-3 pt-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" name="batch_name[]">
                                <label for="batch_name">Price<b class="text-danger">*</b></label>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container batch_name_${i}" id="error-batch_name_${i}"></p>
                        </div>
                        <div class="col-md-2 pt-2">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="start_date" name="start_date[]" class="form-control">
                                                    <label for="start_date">Pack<b class="text-danger">*</b></label>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-start_date_0">
                                                </p>

                                            </div>
                                            <div class="col-md-2 pt-2">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="file" id="image" name="end_date[]"
                                                        class="form-control">
                                                    <label for="end_date">End Date<b class="text-danger">*</b></label>
                                                </div>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-end_date_0"></p>
                                            </div>
                        <div class="col-md-2 pt-2">
                            <p style="margin-bottom: 2px;" class="text-danger error_container Answer_error"></p>
                            <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    `);
                    });
                    $(document).on('click', '.btn_remove', function() {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id).remove();
                    });
                });
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
                                toastr.success("Product Created Successfully!");
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" + "/admin/products";
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

            $('textarea#summernote').summernote({
                tabsize: 2,
                height: 100,
                toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['help', ['help']]
                ],
            });
            
        </script>
    @endpush
