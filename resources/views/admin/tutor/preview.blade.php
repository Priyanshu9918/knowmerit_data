@extends('layouts.admin.master1')
@section('content')
<style type="text/css">
.theiaStickySidebar {
    display: none;
}

.container {
    max-width: 100%;
}

.page-content.instructor-page-content.createteacher {
    padding: 75px 0 0px !important;
}

div#preview-section {
    padding: 10px;
}

.profile-title h3 i {
    margin-right: 25px;
    margin-left: 5px;
}

</style>
@php $video11 = DB::table('course_videos')->where('lession_id',$lession->id)->orderBy('created_at', 'asc')->get();
$audio11 = DB::table('course_audio')->where('lession_id',$lession->id)->orderBy('created_at', 'asc')->get();
$iframe11 = DB::table('course_iframes')->where('lession_id',$lession->id)->orderBy('created_at', 'asc')->get();
$presentaion = DB::table('course_presentations')->where('lession_id',$lession->id)->orderBy('created_at',
'desc')->get();
$Assign = DB::table('course_assignments')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
$Scrom = DB::table('course_scroms')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
$Quiz = DB::table('course_quizzes')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
$Web = DB::table('course_web_contents')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
@endphp
<div class="col-xl-10 col-lg-10 col-md-12" style="background-color: #f6f6f6; height: auto;">
    <div id="preview-section" class="profile-details preview-page">
        <div class="profile-title">
            <h3><a href="{{url('/admin/course-details12',$course->id)}}"><i class="fa fa-angle-left"
                        aria-hidden="true"></i></a> {{$course->title}}
            </h3>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="preview-tap-div" style="height: 100%;">
                    <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'lesson-list')">
                            <img src="../../assets/img/icon/play.svg" alt="" style="filter: invert(1);"> Lesson List
                        </button>
                       <!--  <button class="tablinks" onclick="openCity(event, 'question-answer')">
                            <img style="width: 25px;" src="../../assets/img/homework.png" alt=""> Assignment </button> -->
                    </div>
                    <div id="lesson-list" class="tabcontent">
                        <h5 id="chapter-togg">
                            <i class="fa fa-book" aria-hidden="true" style="flex-basis: 10%;"></i>
                            <span style="flex-basis: 82%;"> {{$chapture->title ?? ''}}</span>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </h5>
                        <div class="lesson-open-togg">
                            <h6 id="lesson-toggle" class="nav-item dropdown dropdown-account">
                                <a class="nav-link">
                                    <i class="fa fa-columns" style="flex-basis: 10%;"></i>
                                    <span style="flex-basis: 81%; color:#22100D;">{{$lession->title ?? ''}}</span>
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                                <!-- <i class="fa fa-columns"></i> &nbsp; &nbsp; &nbsp; &nbsp; {{$lession->title ?? ''}}<i class="fa fa-angle-down" style="margin-left: 120px;" aria-hidden="true"></i></a> -->
                            </h6>
                            <ul id="list-lesson" class="dropdown-menu dropdown-side" style="display: block; width:100%">
                            @if(count($video11) > 0)
                                @foreach($video11 as $video1)
                                    <li>
                                        <a href="javascript:void(0)" id="video" data-id="{{$video1->id}}">
                                            <i class="fa fa-stop-circle" aria-hidden="true"></i>
                                            {{$video1->title ?? 'Video'}}
                                        </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="video" data-id="{{$video1->id}}">
                                    <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit-video" data-type="video" data-id="{{$video1->id}}">
                                    <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                    </li>
                                @endforeach
                                @endif
                                @if(count($audio11) > 0)
                                @foreach($audio11 as $audio1)
                                <li>
                                    <a href="javascript:void(0)" id="audio" data-id="{{$audio1->id}}">
                                        <i class="fa fa-volume-up" aria-hidden="true"></i>
                                        {{$audio1->title ?? 'Audio'}}
                                    </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="audio" data-id="{{$audio1->id}}">
                                    <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit-audio" data-type="audio" data-id="{{$audio1->id}}">
                                    <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                </li>
                                @endforeach
                                @endif
                                @if(count($iframe11) > 0)
                                @foreach($iframe11 as $iframe1)
                                <li>
                                    <a href="javascript:void(0)" id="iframe" data-id="{{$iframe1->id}}">
                                        <i class="fas fa-square" aria-hidden="true"></i>
                                        {{$iframe1->title ?? 'iframe'}}
                                    </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="iframe" data-id="{{$iframe1->id}}">
                                    <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit_iframe" data-type="iframe" data-id="{{$iframe1->id}}">
                                    <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                </li>
                                @endforeach
                                @endif
                                @if(count($presentaion) > 0)
                                {{-- <li>
                                        <a href="javascript:void(0) #exam" data-bs-toggle="collapse">
                                          <i class="fa-solid fa-file" aria-hidden="true"></i> Presentation | Document
                                        </a>
                                      </li>
                                  <ul class="collapse" id="exam">
                                @foreach($presentaion as $presentaions)
                                  <li class="collapse-item">
                                    <a href="javascript:void(0)" id="view_presentation" data-id="{{$presentaions->id}}"> <i
                                                class="fa-solid fa-book" aria-hidden="true"></i> {{$presentaions->file ?? ''}}
                                            </a>
                                    <i class="fa fa-times" ></i>
                                  </li>
                                @endforeach
                                </ul>--}}
                                  @foreach($presentaion as $presentaions)
                                  <li>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="view_presentation"
                                        data-id="{{$presentaions->id}}">
                                        <i class="fa-solid fa-file" aria-hidden="true"></i>
                                        {{$presentaions->title ?? $presentaions->file}}
                                        <!-- <i class="fa fa-pencil"style="padding: 15px;"></i> -->
                                    </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="presentation" data-id="{{$presentaions->id}}">
                                        <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit_presentation" data-type="presentation" data-id="{{$presentaions->id}}">
                                        <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                    </a>
                                  </li>
                                  @endforeach
                                @endif
                                @if(count($Assign) > 0)
                                {{-- <li>
                                    <a href="javascript:void(0) #exam1" data-bs-toggle="collapse">
                                      <i class="fa fa-file-text-o" aria-hidden="true"></i> Assignment
                                    </a>
                                  </li>
                                  <ul class="collapse" id="exam1">
                                                @foreach($Assign as $Assigns)

                                    <li class="collapse-item">
                                      <a href="javascript:void(0)" id="view_assign" data-id="{{$Assigns->id}}"> <i
                                              class="fa-solid fa-book" aria-hidden="true"></i> {{$Assigns->title ?? $Assigns->file}}
                                          </a>
                                          </li>
                                @endforeach </ul>--}}
                                  @foreach($Assign as $Assigns)
                                  <li>
                                      <a href="javascript:void(0)" data-bs-toggle="collapse" id="view_assign"
                                          data-id="{{$Assigns->id}}">
                                          <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                          {{$Assigns->title ?? $Assigns->file}}
                                      </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="assign" data-id="{{$Assigns->id}}">
                                        <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                    <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit_assign" data-type="assign" data-id="{{$Assigns->id}}">
                                        <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                  </li>
                                  @endforeach
                                @endif
                                @if(count($Scrom) > 0)
                                {{-- <li>
                                  <a href="javascript:void(0) #exam2" data-bs-toggle="collapse">
                                    <i class="fa fa-file-text-o" aria-hidden="true"></i> SCORM | cmi5
                                  </a>
                                </li>
                                <ul class="collapse" id="exam2">
                                              @foreach($Scrom as $Scroms)

                                  <li class="collapse-item">
                                    <a href='{{url('/uploads/Scrom/'.$Scroms->title.'/res/index.html')}}' target="_blank"> <i
                                            class="fa-solid fa-book" aria-hidden="true"></i> {{$Scroms->title ?? $Scroms->file}}
                                        </a>
                                        </li> @endforeach </ul>--}}
                                  @foreach($Scrom as $Scroms)
                                      <li>
                                        <a href="javascript:void(0)" data-bs-toggle="collapse" id="view_scrom"
                                            data-id="{{$Scroms->id}}">
                                            <i class="fa-solid fa-book" aria-hidden="true"></i>
                                            {{$Scroms->title ?? $Scroms->file}}
                                        </a>
                                        <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="scrom" data-id="{{$Scroms->id}}">
                                        <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                        <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit-scrom" data-type="scrom" data-id="{{$Scroms->id}}">
                                        <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                      </li>
                                  @endforeach
                                  @endif
                                  @if(count($Quiz) > 0)
                                      @foreach($Quiz as $Quizs)
                                      <li>
                                        <a href="/admin/question-preview/{{ base64_encode($Quizs->u_id) }}?page=1" target="_blank">
                                              <i class="fa-solid fa-question" aria-hidden="true"></i> {{$Quizs->title ?? 'quiz1'}}
                                          </a>
                                            <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="quiz" data-id="{{$Quizs->id}}">
                                            <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                            <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit_quiz" data-type="quiz" data-id="{{$Quizs->id}}">
                                            <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                      </li>
                                      @endforeach
                                  @endif
                                  @if(count($Web) > 0)
                                      @foreach($Web as $Webs)
                                      <li>
                                          <a href="javascript:void(0)" data-bs-toggle="collapse" id="view_web" data-id="{{$Webs->id}}">
                                              <i class="fa-solid fa-bars" aria-hidden="true"></i> {{$Webs->title ?? 'Web-content'}}
                                          </a>
                                        <a href="javascript:void(0)" data-bs-toggle="collapse" id="del_presentation" data-type="web" data-id="{{$Webs->id}}">
                                        <i class="fa fa-times" style="padding: 15px; color:red;"></i> </a>
                                        <a href="javascript:void(0)" data-bs-toggle="collapse" id="edit-web" data-type="web" data-id="{{$Webs->id}}">
                                        <i class="fa fa-edit" style="padding: 15px; color:green;"></i> </a>
                                      </li>
                                      @endforeach
                                  @endif
                            <!-- <li><i class="fa fa-file-text-o" aria-hidden="true"></i> Content</li> -->
                            </ul>
                        </div>
                    </div>
                    <div id="question-answer" class="tabcontent">

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="preview-img-video play" id="disdata" style="height: 100%;">
                    <video width="100%" height="500" controls id="vido1" class="d-none">
                        <source class="vido" src="" type="video/mp4"> Your browser does not support the video tag.
                    </video>
                    <iframe class="tube d-none" id="ytube" width="100%" height="500px" src="" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <audio controls id="audo1" class="d-none">
                        <source class="audo" src="" type="audio/ogg"> Your browser does not support the audio element.
                    </audio>
                    <iframe id="iframe1" class="d-none idata" src="" width="100%" height="500px" frameborder="0"
                        allowfullscreen></iframe>
                    <div class="row d-none" id="sata1" style="left: 20px; bottom: 119px;  position: relative;"></div>
                    <div class="row d-none" id="sata12" style="left: 20px; bottom: 119px;  position: relative;"></div>
                    <iframe id="quz1" class="d-none idata1" src="" width="100%" height="500px" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <div class="row d-none" id="wb1" style="left: 20px; bottom: 119px;  position: relative;"></div>
                </div>
                <!-- <div class="d-none" id="scrom1"></div> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="schedule-calendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {{-- style="max-width:70%;" --}}
        <div class="modal-content selectplan">
            <div class="modal-header">
                <!-- <span>
                    <i class="fa-solid fa-chevron-left"></i>
                </span> -->
                <!-- <h1 class="modal-title fs-5">Schedule your lessons</h1> -->
                <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body time-frame" style="width:100%">
                <div class="d-none" id="scrom1"></div>
                {{-- <div class="container">
                  <button class="btn btn-primary btn-prev"> prev</button>
                  <button class="btn btn-primary btn-today">Today</button>
                  <button class="btn btn-primary btn-nxt"> nxt</button>
                  <div id="container" style="height: 600px;"></div>
                </div> --}}
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

<div id="data-video-view" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <p>Videos</p> -->
                    <!-- <button id="video-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('admin.update-video')}}" method="POST" id="editvideo" enctype="multipart/form-data">
                        @csrf
                        <div id="video-data"></div>
                    </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
</div>

<div id="data-audio-view" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="audio-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('admin.update-audio')}}" method="POST" id="editaudio" enctype="multipart/form-data">
                        @csrf
                        <div id="audio-data"></div>
                    </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
</div>

<div id="iframe_view" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="iframe-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('admin.update-iframe')}}" method="POST" id="editiframe" enctype="multipart/form-data">
                        @csrf
                        <div id="iframe_data"></div>
                    </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
</div>

<div id="Presentation123" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="Presentation123-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('admin.update-presentation')}}" method="POST" id="editpresentation" enctype="multipart/form-data">
                        @csrf
                        <div id="presentation_data"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
<div id="Assign123" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="Assign123-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('admin.update-assign')}}" method="POST" id="editassign" enctype="multipart/form-data">
                        @csrf
                            <div id="assign-data"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<div id="scrom_view" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="Quiz-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                        <form action="{{route('admin.update-scrom')}}" method="POST" id="editscrom" enctype="multipart/form-data">
                                @csrf
                                <div id="scrom-data"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<div id="Quiz" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="Quiz-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                        <form action="{{route('admin.update-quiz')}}" method="POST" id="editquiz" enctype="multipart/form-data">
                                @csrf
                        <div id="quiz-data"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<div id="data-web-view" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="Web-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body" style="height: 640px;">
                    <div class="popup-add">
                    <form action="{{route('admin.update-web')}}" method="POST" id="editweb" enctype="multipart/form-data">
                        @csrf
                        <div id="web-data"></div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script><script  src="./script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
<script src="{{asset('/ckeditor/ckeditor/ckeditor.js')}}"></script>
<script>
$(document).ready(function() {

            CKEDITOR.replace('dialogQuestionText', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });

    $(document).on('click', '#edit_iframe', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-data') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#iframe_data').replaceWith(response);
                        $('#iframe_view').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editiframe', function(event) {
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
                            toastr.success("Iframe Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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

            $(document).on('click', '#edit_presentation', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-presentation') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#presentation_data').replaceWith(response);
                        $('#Presentation123').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editpresentation', function(event) {
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
                            toastr.success("Presentation Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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
            $(document).on('click', '#edit_assign', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-assign') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#assign-data').replaceWith(response);
                        $('#Assign123').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editassign', function(event) {
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
                            toastr.success("Assignment Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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
            $(document).on('click', '#edit_quiz', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-quiz') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#quiz-data').replaceWith(response);
                        $('#Quiz').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editquiz', function(event) {
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
                            toastr.success("Quiz Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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
            $(document).on('click', '#edit-web', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-web') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#web-data').replaceWith(response);
                        $('#data-web-view').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editweb', function(event) {
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
                            toastr.success("Web Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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
            $(document).on('click', '#edit-audio', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-audio') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#audio-data').replaceWith(response);
                        $('#data-audio-view').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editaudio', function(event) {
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
                            toastr.success("Audio Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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

            $(document).on('click', '#edit-video', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-video') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#video-data').replaceWith(response);
                        $('#data-video-view').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editvideo', function(event) {
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
                            toastr.success("Video Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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

            $(document).on('click', '#edit-scrom', function(event) {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                $.ajax({
                    url: "{{ route('admin.edit-scrom') }}",
                    type: "get",
                    data: {
                        'id': id,
                        'type': type,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#scrom-data').replaceWith(response);
                        $('#scrom_view').modal('show');
                    }
                });
            });
            $(document).on('submit', 'form#editscrom', function(event) {
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
                            toastr.success("Scrom Updated Successfully");
                            // redirect to google after 5 seconds
                            window.setTimeout(function() {
                                // window.location = "{{ url('/') }}" +
                                //     "/teacher/payment-list";
                                location.reload();
                            }, 2000);

                        }
                        //show the form validates error
                        if (response.success == false) {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error1-' + error_text).html(response.errors[control]);
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

            $(document).on('click', '#del_presentation', function() {
                var id = $(this).attr('data-id');
                var type = $(this).attr('data-type');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your Topic.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('admin.delete-data') }}";
                        var requestData = {
                            "_token": "{{ csrf_token() }}",
                            'id' : id,
                            'type' : type,
                        };
                        $.ajax({
                            type: 'POST',
                            url: ajaxUrl,
                            data: requestData,
                            success: function(response) {
                                if (response.success == true) {
                                    Swal.fire({
                                        title: 'Topic Deleted!',
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
    $(document).on('click', '#video', function(event) {
        $('#audo1').get(0).pause();
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-video') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    var url = "{{url('/')}}" + '/uploads/c_video/' + response.value.video;
                    $(".vido").attr('src', url);
                    $('#audo1').addClass('d-none');
                    $('#vido1').removeClass('d-none');
                    $('#iframe1').addClass('d-none');
                    $('#ytube').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#iframe1').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#disdata').removeClass('bg1');
                    $('#scrom1').addClass('d-none');
                    $('#quz1').addClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#wb1').addClass('d-none');
                    $(".play video")[0].load();
                }
                if (response.success1 == true) {
                    var url = response.value.link;
                    $(".tube").attr('src', url);
                    $('#audo1').addClass('d-none');
                    $('#vido1').addClass('d-none');
                    $('#ytube').removeClass('d-none');
                    $('#iframe1').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#disdata').removeClass('bg1');
                    $('#scrom1').addClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#quz1').addClass('d-none');
                    $('#wb1').addClass('d-none');
                    $(".play video")[0].load();
                }
            }
        });
    });
    $(document).on('click', '#audio', function(event) {
        $('#vido1').get(0).pause();
        //stop youtube video
        var videoURL = $('#ytube').prop('src');
        videoURL = videoURL.replace("&autoplay=1", "");
        $('#ytube').prop('src','');
        $('#ytube').prop('src',videoURL);
        //******** */
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-audio') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    var url = "{{url('/')}}" + '/uploads/c_audio/' + response.value.audio;
                    $(".audo").attr('src', url);
                    $('#vido1').addClass('d-none');
                    $('#audo1').removeClass('d-none');
                    $('#ytube').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#iframe1').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#disdata').addClass('bg1');
                    $('#scrom1').addClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#quz1').addClass('d-none');
                    $('#wb1').addClass('d-none');
                    $(".play audio")[0].load();
                    $(".play iframe")[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
                }
            }
        });
    });
    $(document).on('click', '#iframe', function(event) {
        $('#vido1').get(0).pause();
        //stop youtube video
        var videoURL = $('#ytube').prop('src');
        videoURL = videoURL.replace("&autoplay=1", "");
        $('#ytube').prop('src','');
        $('#ytube').prop('src',videoURL);
        //******** */
        $('#audo1').get(0).pause();

        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-iframe') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    var url = response.value.url;
                    $(".idata").attr('src', url);
                    $('#iframe1').removeClass('d-none');
                    $('#vido1').addClass('d-none');
                    $('#audo1').addClass('d-none');
                    $('#ytube').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#disdata').removeClass('bg1');
                    $('#scrom1').addClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#wb1').addClass('d-none');
                    $('#quz1').addClass('d-none');
                }
            }
        });
    });
    $(document).on('click', '#view_presentation', function(event) {
        $('#vido1').get(0).pause();
        //stop youtube video
        var videoURL = $('#ytube').prop('src');
        videoURL = videoURL.replace("&autoplay=1", "");
        $('#ytube').prop('src','');
        $('#ytube').prop('src',videoURL);
        //******** */
        $('#audo1').get(0).pause();
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-presentation') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').removeClass('d-none');
                $('#sata12').addClass('d-none');
                $('#disdata').removeClass('bg1');
                $('#scrom1').addClass('d-none');
                $('#disdata').removeClass('d-none');
                $('#quz1').addClass('d-none');
                $('#wb1').addClass('d-none');
                $('#sata1').replaceWith(response);
            }
        });
    });
    $(document).on('click', '#view_assign', function(event) {
        $('#vido1').get(0).pause();
        //stop youtube video
        var videoURL = $('#ytube').prop('src');
        videoURL = videoURL.replace("&autoplay=1", "");
        $('#ytube').prop('src','');
        $('#ytube').prop('src',videoURL);
        //******** */
        $('#audo1').get(0).pause();
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-assign') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').addClass('d-none');
                $('#scrom1').addClass('d-none');
                $('#sata12').removeClass('d-none');
                $('#disdata').removeClass('bg1');
                $('#disdata').removeClass('d-none');
                $('#quz1').addClass('d-none');
                $('#wb1').addClass('d-none');
                $('#sata12').replaceWith(response);
            }
        });
    });
    $(document).on('click', '#view_scrom', function(event) {
        $('#vido1').get(0).pause();
        //stop youtube video
        var videoURL = $('#ytube').prop('src');
        videoURL = videoURL.replace("&autoplay=1", "");
        $('#ytube').prop('src','');
        $('#ytube').prop('src',videoURL);
        //******** */
        $('#audo1').get(0).pause();
        $('#schedule-calendar').modal('show');
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-scrom') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').addClass('d-none');
                $('#sata12').addClass('d-none');
                $('#scrom1').removeClass('d-none');
                $('#quz1').addClass('d-none');
                $('#disdata').addClass('d-none');
                $('#wb1').addClass('d-none');
                $('#scrom1').replaceWith(response);
            }
        });
    });
    $(document).on('click', '#view_quiz', function(event) {
        $('#vido1').get(0).pause();
        //stop youtube video
        var videoURL = $('#ytube').prop('src');
        videoURL = videoURL.replace("&autoplay=1", "");
        $('#ytube').prop('src','');
        $('#ytube').prop('src',videoURL);
        //******** */
        $('#audo1').get(0).pause();
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-quiz') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                if (response.success == true) {
                    var url = response.value.url;
                    $(".idata1").attr('src', url);
                    $('#iframe1').addClass('d-none');
                    $('#vido1').addClass('d-none');
                    $('#audo1').addClass('d-none');
                    $('#ytube').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#scrom1').addClass('d-none');
                    $('#quz1').removeClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#wb1').addClass('d-none');
                    $("#quz1")[0].load();
                }
            }
        });
    });
    $(document).on('click', '#view_web', function(event) {
        $('#vido1').get(0).pause();
        //stop youtube video
        var videoURL = $('#ytube').prop('src');
        videoURL = videoURL.replace("&autoplay=1", "");
        $('#ytube').prop('src','');
        $('#ytube').prop('src',videoURL);
        //******** */
        $('#audo1').get(0).pause();
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('admin.d-web') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').addClass('d-none');
                $('#sata12').addClass('d-none');
                $('#scrom1').addClass('d-none');
                $('#quz1').addClass('d-none');
                $('#disdata').removeClass('d-none');
                $('#wb1').removeClass('d-none');
                $('#wb1').replaceWith(response);
                }
        });
    });
});
</script>
<script>
function openCity(evt, cityName) {
    // alert(cityName);
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    if (cityName == 'lesson-list') {
        var element = document.getElementById("disdata");
        element.classList.remove("d-none");
    }
    if (cityName == 'question-answer') {
        var element = document.getElementById("disdata");
        element.classList.add("d-none");
    }
}
</script>
<script type="text/javascript">
$('#lesson-toggle').on("click", function() {
    $('#list-lesson').toggle();
})
</script>
<script type="text/javascript">
$('#chapter-togg').on("click", function() {
    $('.lesson-open-togg').toggle();
})
</script>
@endpush
