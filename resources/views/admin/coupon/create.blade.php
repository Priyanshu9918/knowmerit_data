@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Coupon</h4>
                            <form action="{{ route('admin.coupons.create') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                                @csrf
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Code Name</label>
                                            <input class="form-control code_name" type="text" name="code_name">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-code_name"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3">
                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Type *</label>
                                            <select class="form-control type" name="type">
                                                <option value="">-Select-</option>
                                                <option value="percentage">Percentage</option>
                                                <option value="fixed_amount">Fixed Amount</option>
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-type"></p>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Value *</label>
                                            <input class="form-control value" type="text" name="value">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-value"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Uses Limit *</label>
                                            <input class="form-control value" type="number" name="uses_limit" value="1" min="1">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-uses_limit"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Start Date *</label>
                                            <input class="form-control commonDatepicker start_date" type="date" id="start_date" name="start_date">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-start_date"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> Start Time *</label>
                                            <input class="form-control timepicker start_time" type="time" name="start_time">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-start_time"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>End Date *</label>
                                            <input class="form-control commonDatepicker end_date" type="date" id="end_date" name="end_date">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-end_date"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label> End Time *</label>
                                            <input class="form-control timepicker end_time" type="time" name="end_time">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-end_time"></p>
                                        </div>
                                    </div>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-all"></p>
                                <button type="submit" class="btn btn-primary submit mt-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')

<script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script>
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
                        $('.submit').html('Submit');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success("FAQs Created Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/')}}" + "/admin/faq";
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
        // $('#mysummernote').summernote({
        //     height: 150
        // });
        CKEDITOR.replace('mysummernote', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
    });
</script>


@endpush
