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
            padding: 10px 25px;
            color: #fff;
            border-radius: 30px;
        }
    </style>
    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
        <div id="add-video-section" class="profile-details add-lesson">
            <div class="profile-title">
                <h3>Add Video</h3>
            </div>
            @php 
                $link = DB::table('course_videos')->where('lession_id',$id)->select('id','link')->where('link','<>',null)->get();
                $video = DB::table('course_videos')->where('lession_id',$id)->select('id','video')->where('video','<>',null)->get();
            @endphp
            <div class="row">
                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error123"></p>
                <form action="{{route('admin.create-video')}}" method="POST" id="createFrm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" id="let_id" value="{{$id}}">
                    <div class="form-group">
                        <label>Video Title</label>
                        <input type="text" class="form-control" name="title" placeholder="" value="">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-link"></p>
                    </div>
                    <div class="form-group">
                        <label>Use Youtube Link</label>
                        <input type="text" class="form-control" name="link" placeholder="" value="">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-link"></p>
                    </div>

                    <div class="form-group">
                        <label>Use a Video</label>
                        <label class="uploaddes"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Choose a file to upload
                            <input type="file" class="form-control" name="video" accept="video/mp4,video/x-m4v,video/*">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-video"></p>
                        </label></div>
                    </div>
                    <div class="editor-page-btn">
                        <button type="submit">Submit</button>
                    </div>
                </form>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                @if(count($link))
                <div class="row">
                    <p>Youtube Link</p>
                        @foreach($link as $c_link)
                            <div class="col-md-3">
                                <div class="image-area" style="width:110px;">
                                    <a class="remove-image" data-id="{{$c_link->id }}" href="javascript:;" style="display: inline;">×</a>
                                    <iframe width="170" height="100" src="{{$c_link->link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if(count($video))
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                <div class="row">
                    <p>Videos</p>
                    @foreach($video as $c_video)
                            <div class="col-md-3">
                                <div class="image-area" style="width:110px;">
                                    <a class="remove-image" data-id="{{$c_video->id }}" href="javascript:;" style="display: inline;">×</a>
                                    <video width="170" height="100" controls>
                                    <source src="{{asset('uploads/c_video/'.$c_video->video)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
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
            $(document).on('click', '.remove-image', function() {
                var id = $(this).attr('data-id'); 
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your video.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('teacher.delete-video') }}";
                        var requestData = {
                            "_token": "{{ csrf_token() }}",
                            'id' : id,
                        };
                        $.ajax({
                            type: 'POST',
                            url: ajaxUrl,
                            data: requestData,
                            success: function(response) {
                                if (response.success == true) {
                                    Swal.fire({
                                        title: 'video Deleted!',
                                        icon: 'success',
                                    }).then(() => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting your account.',
                                    icon: 'error',
                                });
                            }
                        });
                    }
                });
            });
            $(document).on('submit', 'form#createFrm', function(event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                $('.pre-loader').show();
                var id = $('#let_id').val();
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
                            toastr.success("Video Added Successfully!");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                            // location.reload();
                            history.back();
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
                        if (response.success1 == false) {
                            $('#error123').html('Please enter link or video only one');
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
