@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About us</h4>
                            <form action="{{ route('admin.about-us.create') }}" method="POST" id="createFrm"
                                enctype="multipart/form-data">
                                <p class="card-description">
                                    Header About Us
                                </p>
                                @csrf
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Title</b></label>
                                            <input class="form-control" type="text" name="title"
                                                placeholder="Enter Community Title" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-title"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>Image</b></label>
                                            <input class="form-control" name="image" type="file" id="formFile"
                                                accept="image/*">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-image"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label"><b>Description</b></label>
                                                <textarea id="mysummernote" class="form-control " id="description" name="description"></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-description"></p>
                                            </div>
                                    </div>
                                </div>
                                <p class="card-description">
                                    Medium About Us
                                </p>
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Title</b></label>
                                            <input class="form-control" type="text" name="m_title"
                                                placeholder="Enter Community Title" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-m_title"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>Image</b></label>
                                            <input class="form-control" name="m_image" type="file" id="formFile"
                                                accept="image/*">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-m_image"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label"><b>Description</b></label>
                                                <textarea id="mysummernote1" class="form-control " id="description" name="m_description"></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-m_description"></p>
                                            </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label"><b>Rating Description</b></label>
                                            <textarea id="mysummernote3" class="form-control " id="description" name="r_description"></textarea>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-r_description"></p>
                                        </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label"><b>Rating No</b></label>
                                        <input class="form-control" type="text" name="m_rating"
                                            placeholder="Enter Community Rating" />
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-m_rating"></p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label"><b>Grade</b></label>
                                        <input class="form-control" type="text" name="m_grade"
                                            placeholder="Enter Community Rating" />
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-m_grade"></p>
                                    </div>
                                </div>
                                </div>
                                <p class="card-description">
                                    Bottom About Us
                                </p>
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Title</b></label>
                                            <input class="form-control" type="text" name="b_title"
                                                placeholder="Enter Community Title" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-b_title"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>Image</b></label>
                                            <input class="form-control" name="b_image" type="file" id="formFile"
                                                accept="image/*">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-b_image"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label"><b>Description</b></label>
                                                <textarea id="mysummernote2" class="form-control " id="description" name="b_description"></textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-b_description"></p>
                                            </div>
                                        </div>
                                </div>
                        </div>
                    </div>
                    <div class="card" style="background:white;">
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-primary submit mt-2">Save</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            //on change country

            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                var title = $('div.iti__selected-flag').attr('title');

                var form = $(this);
                var data = new FormData($(this)[0]);
                data.append("c_code", title);
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
                            toastr.success("AboutUs Created successfully!");

                            // Swal.fire({
                            //     position: 'top-end',
                            //     icon: 'success',
                            //     title: 'user Created Successfully',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            //     })
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/admin/about-us";
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
            // $('#mysummernote1').summernote({
            //     height: 150
            // });
            // $('#mysummernote2').summernote({
            //     height: 150
            // });
            // $('#mysummernote3').summernote({
            //     height: 150
            // })
            CKEDITOR.replace('mysummernote', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
            CKEDITOR.replace('mysummernote1', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
            CKEDITOR.replace('mysummernote2', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
            CKEDITOR.replace('mysummernote3', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
        });
    </script>
@endpush
