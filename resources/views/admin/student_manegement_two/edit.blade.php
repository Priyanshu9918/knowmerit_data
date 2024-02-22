@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student Classes</h4>
                            <form action="{{ route('admin.student_manegement_two.edit', ['id' => base64_encode($user->id)]) }}"
                                method="POST" id="createFrm" enctype="multipart/form-data">
                                @csrf
                                <p class="card-description">
                                    Personal info
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Name</b></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                value="{{ $user->first_name }}" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-first_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Email</b></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $user->email }}" readonly />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-email"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Phone</b></label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $user->phone }}" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-phone"></p>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Classes Type</b></label>
                                            <input type="text" class="form-control" id="classes_choice" name="classes_choice"
                                            value="{{ $user->classes_choice }}" readonly/>
                                            {{-- <select class="form-control" id="classes_choice" name="classes_choice">
                                                <option value="">classes type</option>
                                                <option value="online_class"
                                                    @if ($user->classes_choice == 'online_class') selected @endif>Live Interactive
                                                    Online Class</option>
                                                <option value="home_class"
                                                    @if ($user->classes_choice == 'home_class') selected @endif>Offline at my Home and
                                                    nearby Classes</option>
                                                </option>
                                            </select>
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-classes_choice"></p>
                                    </div> --}}
                                    <div class="col-md-6">
                                        @php
                                            $member_ship = DB::table('member_ship_plans')
                                                ->where('status', 1)
                                                ->get();
                                        @endphp
                                        <div class="form-group ">
                                            <label class="col-sm-12 col-form-label"><b>Payment</b></label>

                                            <input type="text" class="form-control" id="payment_status" name="payment_status"
                                            value="{{ $user->payment_status }}" readonly/>

                                            {{-- <select class="form-control" id="payment_status" name="payment_status">
                                                @foreach ($member_ship as $mb)
                                                    <option value="{{ $mb->benifits }}"
                                                        @if ($mb->benifits == $user->payment_status) selected @endif>
                                                        {{ $mb->benifits }}</option>
                                                @endforeach
                                                <option value="Continue without prime benifits">Continue without prime
                                                    benifits</option>

                                                </option>
                                            </select> --}}
                                        </div>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-classes_choice"></p>
                                    </div>
                                </div>
                                <div class="card" style="background:white;">
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" class="btn btn-success submit mr-2">Update</button>
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
        <script>
            $(document).ready(function() {
                //on change country
                $('#first_name').on('keypress', function(e) {
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
                                $('.submit').html('Update');
                            }, 2000);
                            //console.log(response);
                            if (response.success == true) {

                                //notify
                                toastr.success("Student Updated Successfully");
                                // redirect to google after 5 seconds
                                window.setTimeout(function() {
                                    window.location = "{{ url('/') }}" +
                                        "/admin/student_manegement_two";
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
            // $(document).ready(function() {
            //     $('.summernote').summernote();
            // });
            // $(document).on('change', '.category', function() {
            //     var id = $('#category').val();
            //     $.ajax({
            //         type: "get",
            //         url: "{{ route('admin.sub-category-list') }}",
            //         data: {
            //             'category': id,
            //             "_token": "{{ csrf_token() }}"
            //         },
            //         success: function(data) {
            //             $("#sub_category").empty();
            //             $("#sub_category").html('<option value="">Select sub category</option>');
            //             $.each(data, function(key, value) {
            //                 $("#sub_category").append('<option value="' + value.id + '">' + value
            //                     .name + '</option>');
            //             });
            //         }
            //     });
            // });
        </script>
    @endpush
