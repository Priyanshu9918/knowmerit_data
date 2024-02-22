@extends('layouts.admin.master')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Benefits</h4>
                        <form action="{{ route('admin.benifit.create') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                            @csrf
                            <p class="card-description">
                                Personal info
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Name</label>
                                        <div class="col-sm-8">
                                            <select  class="form-control" name="m_id" id="m_id">
                                            <option value="">Select</option>
                                                @if(count($amount)>0)
                                                @foreach ($amount as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Title</label>
                                        <div class="col-sm-8">
                                            <input type ="text" class="form-control" name="title" />
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Benifits</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id ="summernote" name="benifits"></textarea>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-benifits"></p>
                                        </div>
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
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"> --}}
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
                            toastr.success("Benifits Created Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/')}}" + "/admin/benifit";
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
        CKEDITOR.replace('summernote', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
    </script>

    @endpush
