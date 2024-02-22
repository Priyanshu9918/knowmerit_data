@extends('layouts.admin.master1')
@section('content')

    <style type="text/css">
        .user-nav a.dropdown-toggle {
            display: block;
        }
        .editor-page-btn button 
        {
            border: none;
            background-color: #468dcb;
            color: #fff;
            border-radius: 7px !important;
            font-size: 14px;
            padding: 5px 15px;
            font-weight: 600;
        }
        .add-lesson .form-control 
        {
            min-height: auto;
            padding: 6px 10px;
        }
        .add-lesson .form-group 
        {
            display: grid;
        }
        .add-lesson .form-group textarea#summernote 
        {
            height: 140px;
            border: 1px solid #d6f0ff;
            border-radius: 4px;
        }
    </style>
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #4f94cf12; border-radius: 10px;">
        <div class="profile-details add-lesson">
            <!-- <div class="profile-title">
                <h3>Create Course</h3>
            </div> -->

            <div class="row">
                <form action="{{route('admin.update-course')}}" method="POST" id="editFrm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="form-group">
                        <label>Course Title</label>
                        <input type="text" class="form-control" name="title" placeholder="" value="{{$course->title ?? ''}}">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                    </div>
                    <div class="form-group">
                        <label>Course Image</label>
                        <input type="file" class="form-control" name="image">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-image"></p>
                    </div>
                    @if($course->image!=NULL && file_exists(public_path('uploads/course/'.$course->image)))
                        <div class="col-sm-6">
                            <div class="form-group">
                                <a href="{{asset('uploads/course/'.$course->image)}}" target="_blank">
                                    <img src="{{asset('uploads/course/'.$course->image)}}" width="100px" height="100px">
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea id="summernote" name="short_description">{{$course->short_description}}</textarea>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-short_description"></p>
                    </div>
                    <div class="form-group">
                        <label>Course Description</label>
                        <textarea id="summernote" name="description">{{$course->description}}</textarea>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-description"></p>
                    </div>
                    <div class="editor-page-btn">
                        <button type="submit">Submit</button>
                    </div>


                </form>
                
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

            $(document).on('submit', 'form#editFrm', function(event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                $('.pre-loader').show();

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
                            toastr.success("Course Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                window.location = "{{ url('/') }}" +
                                    "/admin/course-details12/{{$id}}";
                                // location.reload();
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
                            $('.pre-loader').hide();
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
