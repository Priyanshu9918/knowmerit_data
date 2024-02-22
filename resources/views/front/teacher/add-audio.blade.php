@extends('layouts.teacher.master')
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
                <h3>Add Audio</h3>
            </div>
            <div class="row">
                <form action="{{route('teacher.create-audio')}}" method="POST" id="createFrm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" id="let_id" value="{{$id}}">
                    <div class="form-group">
                        <label>Audio Title</label>
                        <input type="text" class="form-control" name="title" placeholder="" value="">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                    </div>
                    <div class="form-group">
                        <label>Use a Audio</label>
                        <label class="uploaddes"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Choose a file to upload
                            <input type="file" class="form-control" name="audio" accept=".mp3,audio/*">
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-audio"></p>
                        </label>
                        </div>
                    </div>
                    <div class="editor-page-btn mt-3">
                        <button type="submit">Submit</button>
                    </div>


                </form>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                @php 
                    $audio = DB::table('course_audio')->where('lession_id',$id)->select('id','audio')->get();
                @endphp
                <div class="row">
                    @foreach($audio as $c_video)
                        <div class="col-md-3">
                            <div class="image-area" style="width:110px;">
                                <a class="remove-image" data-id="{{$c_video->id }}" href="javascript:;" style="display: inline;">×</a>
                                <audio controls><source src="{{asset('uploads/c_audio/'.$c_video->audio)}}" type="audio/ogg">Your browser does not support the audio element.</audio>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </div>
                    </div>
                    @endforeach
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
            //on change country
            $(document).on('click', '.remove-image', function() {
                var id = $(this).attr('data-id'); 
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your audio.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('teacher.delete-audio') }}";
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
                                        title: 'audio Deleted!',
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
                            toastr.success("Audio added Successfully!");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
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
