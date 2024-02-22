@extends('layouts.admin.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Blog</h4>
                            <form action="{{ route('admin.blog.edit',['id'=>base64_encode($blog->id)]) }}" method="POST" id="editFrm" enctype="multipart/form-data">
                            @csrf
                                <div class="row gx-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Title</b></label>
                                            <input type="text" class="form-control" name="title" value="{{$blog->title}}" id="basic-icon-default-fullname"/>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label"><b>Blog Image</b></label>
                                            <input type="file" class="form-control" name="image" id="basic-icon-default-fullname"/>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-image"></p>
                                        </div>
                                    </div>
                                    @if($blog->image!=NULL && file_exists(public_path('uploads/blogs/'.$blog->image)))
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <a href="{{asset('uploads/blogs/'.$blog->image)}}" target="_blank">
                                                    <img src="{{asset('uploads/blogs/'.$blog->image)}}" width="100px" height="100px">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label"><b>Blog Details Image</b></label>
                                            <input type="file" class="form-control" name="b_image" id="basic-icon-default-fullname"/>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error-b_image"></p>
                                        </div>
                                    </div>
                                    @if($blog->b_image!=NULL && file_exists(public_path('uploads/blogs/'.$blog->b_image)))
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <a href="{{asset('uploads/blogs/'.$blog->b_image)}}" target="_blank">
                                                    <img src="{{asset('uploads/blogs/'.$blog->b_image)}}" width="100px" height="100px">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label"><b>Short Description</b></label>
                                                <textarea type="text" class="form-control" id ="summernote1" name="short_description"  value="{{$blog->short_description}}"  id="basic-icon-default-fullname">{{$blog->short_description}}</textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-short_description"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label"><b>Description</b></label>
                                                <textarea class="" id ="summernote" name="long_description">{{$blog->long_description}}</textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-long_description"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="card" style="background:white;">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" class="btn btn-primary submit mt-2">Update</button>
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
         $(document).ready(function(){
        //on change country

        $(document).on('submit', 'form#editFrm', function (event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled',true);
            $('.form-control').attr('readonly',true);
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
                success: function (response) {
                    window.setTimeout(function(){
                        $('.submit').attr('disabled',false);
                        $('.form-control').attr('readonly',false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Update');
                      },2000);
                    //console.log(response);
                    if(response.success==true) {

                        //notify
                        toastr.success("Blog Updated Successfully");
                        // Swal.fire({
                        // position: 'top-end',
                        // icon: 'success',
                        // title: 'Blog Updated Successfully',
                        // showConfirmButton: false,
                        // timer: 1500
                        // })
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/')}}"+"/admin/blog";
                        }, 2000);

                    }
                    //show the form validates error
                    if(response.success==false ) {
                        for (control in response.errors) {
                           var error_text = control.replace('.',"_");
                           $('#error-'+error_text).html(response.errors[control]);
                           // $('#error-'+error_text).html(response.errors[error_text][0]);
                           // console.log('#error-'+error_text);
                        }
                        // console.log(response.errors);
                    }
                },
                error: function (response) {
                    // alert("Error: " + errorThrown);
                    console.log(response);
                }
            });
            event.stopImmediatePropagation();
            return false;
        });
    });
    CKEDITOR.replace('summernote', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
            CKEDITOR.replace('summernote1', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });
    </script>
@endpush
