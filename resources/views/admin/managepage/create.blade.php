@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manage Silder</h4>
                        <form action="{{ route('admin.manage-page.create') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                            @csrf

                            <div class="row gx-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label"><b>Name</b></label>
                                        <input class="form-control" type="text" name="name" placeholder="Enter Page name" />
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label"><b>Slug</b></label>
                                        <input class="form-control" type="text" name="slug" placeholder="Enter Slug name" />
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-slug"></p>
                                    </div>
                                </div> --}}
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label"><b>Choose Image</b></label>
                                        <input class="form-control" name="image" type="file" id="formFile" accept="image/*" multiple>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-image"></p>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label"><b>Description</b></label>
                                        <textarea class="form-control " id="summernote" id="description" name="description" ></textarea>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-description"></p>
                                    </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-primary submit mt-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('script')
    {{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
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
                            $('.submit').html('Save');
                        }, 2000);
                        //console.log(response);
                        if (response.success == true) {
                            //notify
                            toastr.success("Page Created successfully!");

                            // Swal.fire({
                            //     position: 'top-end',
                            //     icon: 'success',
                            //     title: 'user Created Successfully',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            //     })
                            window.setTimeout(function() {
                                window.location = "{{ url('/')}}" + "/admin/manage-page";
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
        });

    </script>
    @endpush
