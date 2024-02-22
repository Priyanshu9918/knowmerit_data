@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Why Know Merit</h4>
                            <form action="{{ route('admin.whyknowmerits.edit', ['id' => base64_encode($whyknowmerits->id)]) }}"
                                method="POST" id="editFrm" enctype="multipart/form-data">
                                @csrf
                                <div class="row gx-3">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label  class="form-label"><b>Title</b></label>
                                            <input class="form-control" name="title" type="text" value="{{ $whyknowmerits->title }}" id="title">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label"><b>Description</b></label>
                                                <textarea id="mysummernote" class="form-control" id="description" name="description">{!! $whyknowmerits->description !!}</textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-description"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>One Image</b></label>
                                            <input class="form-control" name="one_image" type="file" id="formFile"
                                                accept="image/*">
                                            @if ($whyknowmerits->one_image)
                                                <img class="mt-2"
                                                    src="{{ asset('uploads/whyknowmerits/' . $whyknowmerits->one_image) }}"
                                                    width="100px" height="70px" alt="img">
                                            @endif
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-one_image"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>Icon Image</b></label>
                                            <input class="form-control" name="two_image" type="file" id="formFile"
                                                accept="image/*">
                                            @if ($whyknowmerits->two_image)
                                                <img class="mt-2"
                                                    src="{{ asset('uploads/whyknowmerits/' . $whyknowmerits->two_image) }}"
                                                    width="100px" height="70px" alt="img">
                                            @endif
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-two_image"></p>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary submit mt-2">Update</button>
                            </form>
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
                    $(document).on('submit', 'form#editFrm', function(event) {
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
                                    toastr.success("why know merits Updated Successfully");
                                    // Swal.fire({
                                    // position: 'top-end',
                                    // icon: 'success',
                                    // title: 'User Updated Successfully',
                                    // showConfirmButton: false,
                                    // timer: 1500
                                    // })
                                    // redirect to google after 5 seconds
                                    window.setTimeout(function() {
                                        window.location = "{{ url('/') }}" +
                                            "/admin/whyknowmerits";
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
                    CKEDITOR.replace('mysummernote', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
                });
            </script>
        @endpush