@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Member Ship Plan</h4>
                        <form action="{{ route('admin.member_ship_plan.edit',['id'=>base64_encode($user->id)]) }}" method="POST" id="createFrm" enctype="multipart/form-data">
                            @csrf
                            <p class="card-description">
                                Personal info
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Amount</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="amount" name="amount" value="{{ $user->amount }}" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-amount"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">User_type</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="user_type"  style="color:black;" value="{{ $user->user_type }}">
                                                <option  style="color:black;" value="0" @if($user->user_type == 0) selected @endif>Student</option>
                                                <option  style="color:black;" value="1" @if($user->user_type == 1) selected @endif >Teacher</option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-user_type"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Benefits</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="benifits" value="">{{ $user->benifits }}</textarea>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-benifits"></p>
                                        </div>
                                    </div>
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
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> --}}
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"> -->
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
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
                            $('.submit').html('Update');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {

                            //notify
                            toastr.success("Members Created Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/')}}" + "/admin/member_ship_plan";
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
    </script>

    @endpush
