@extends('layouts.student.master2')
@section('content')



<style type="text/css">
  .theiaStickySidebar
  {
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


@php
$video11 = DB::table('course_videos')->where('lession_id',$lession->id)->orderBy('created_at', 'asc')->get();
$audio11 = DB::table('course_audio')->where('lession_id',$lession->id)->orderBy('created_at', 'asc')->get();
$iframe11 = DB::table('course_iframes')->where('lession_id',$lession->id)->orderBy('created_at', 'asc')->get();
$presentaion = DB::table('course_presentations')->where('lession_id',$lession->id)->orderBy('created_at',
'desc')->first();
$Assign = DB::table('course_assignments')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->first();
$Scrom = DB::table('course_scroms')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->first();
$Quiz = DB::table('course_quizzes')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->first();
$Web = DB::table('course_web_contents')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->first();

$presentaion1 = DB::table('course_presentations')->where('lession_id',$lession->id)->orderBy('created_at',
'desc')->get();
$Assign1 = DB::table('course_assignments')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
$Scrom1 = DB::table('course_scroms')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
$Quiz1 = DB::table('course_quizzes')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
$Web1 = DB::table('course_web_contents')->where('lession_id',$lession->id)->orderBy('created_at', 'desc')->get();
@endphp
<input type="hidden" name="l_id" id="l_id" value="{{$lession->id}}">
<div class="col-xl-12 col-lg-12 col-md-12" style="background-color: #f6f6f6; height: 700px;">
    <div id="preview-section" class="profile-details preview-page">
        <div class="profile-title">
        <h3><a href="{{url('/student/course-details1',$course->id)}}"><i class="fa fa-angle-left" aria-hidden="true"></i></a> {{$course->title}}
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="preview-tap-div" style="height: 100%;">
                    <div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'lesson-list')"><img
                                src="../../assets/img/icon/play.svg" alt="" style="filter: invert(1);">Lesson
                            List</button>
                       <!--  <button class="tablinks" onclick="openCity(event, 'question-answer')"><img style="width: 25px;"
                                src="../../assets/img/homework.png" alt=""> Assignment</button> -->
                    </div>



                    <div id="lesson-list" class="tabcontent">
                        <h5 id="chapter-togg"><i class="fa fa-book" aria-hidden="true" style="flex-basis: 10%;"></i>
                            <span style="flex-basis: 82%;"> {{$chapture->title ?? ''}}</span><i class="fa fa-angle-down"
                                aria-hidden="true"></i></h5>

                        <div class="lesson-open-togg">
                            <h6 id="lesson-toggle" class="nav-item dropdown dropdown-account">
                                <a class="nav-link">
                                    <i class="fa fa-columns" style="flex-basis: 10%;"></i> <span
                                        style="flex-basis: 82%; color:#22100D;">{{$lession->title ?? ''}}</span><i
                                        class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <!-- <i class="fa fa-columns"></i> &nbsp; &nbsp; &nbsp; &nbsp; {{$lession->title ?? ''}}<i class="fa fa-angle-down" style="margin-left: 120px;" aria-hidden="true"></i></a> -->
                            </h6>
                            <ul id="list-lesson" class="dropdown-menu dropdown-side" style="display: block;">
                            @if(count($video11) > 0)
                                @foreach($video11 as $video1)
                                    <li>
                                        <a href="javascript:void(0)" id="video" data-id="{{$video1->id}}">
                                            <i class="fa fa-stop-circle" aria-hidden="true"></i>
                                            {{$video1->title ?? 'Video'}}
                                        </a>
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
                                </li>
                                @endforeach
                                @endif
                                @if(count($presentaion1) > 0)
                                {{--<li><a href="javascript:void(0) #exam" data-bs-toggle="collapse"><i class="fa-solid fa-file" aria-hidden="true"></i> Presentation | Document</li></a>
                                <ul class="collapse" id="exam">
                                @foreach($presentaion1 as $presentaions)
                                        <li class="collapse-item"><a href="javascript:void(0)" id="view_presentation" data-type="presentaion" data-id="{{$presentaions->id}}"><i
                                    class="fa-solid fa-book" aria-hidden="true"></i> {{$presentaions->file ?? ''}}</li>
                                </a>
                                @endforeach
                                </ul>--}}
                            @foreach($presentaion1 as $presentaions)
                            <li><a href="javascript:void(0)" data-bs-toggle="collapse" id="view_presentation"
                            data-type="presentaion" data-id="{{$presentaions->id}}"><i class="fa-solid fa-file" aria-hidden="true"></i>
                                    {{$presentaions->title ?? $presentaions->file}}</li></a>
                            @endforeach
                            @endif
                            @if(count($Assign1) > 0)
                            {{--<li><a href="javascript:void(0) #exam1" data-bs-toggle="collapse"><i class="fa fa-file-text-o" aria-hidden="true"></i> Assignment</li></a>
                               <ul class="collapse" id="exam1">
                               @foreach($Assign1 as $Assigns)
                                    <li class="collapse-item"><a href="javascript:void(0)" id="view_assign" data-id="{{$Assigns->id}}"><i
                                class="fa-solid fa-book" aria-hidden="true"></i>
                            {{$Assigns->title ?? $Assigns->file}}</a> </li>
                            @endforeach
                            </ul>--}}
                            @foreach($Assign1 as $Assigns)
                            <li><a href="javascript:void(0)" data-bs-toggle="collapse" id="view_assign" data-type="assign"
                                    data-id="{{$Assigns->id}}"><i class="fa fa-file-text-o" aria-hidden="true"></i>
                                    {{$Assigns->title ?? $Assigns->file}}</li></a>
                            @endforeach
                            @endif
                            @if(count($Scrom1) > 0)
                            {{--<li><a href="javascript:void(0) #exam2" data-bs-toggle="collapse"><i class="fa fa-file-text-o" aria-hidden="true"></i> SCORM | cmi5</li></a>
                               <ul class="collapse" id="exam2">
                               @foreach($Scrom1 as $Scroms)
                                    <li class="collapse-item"><a href='{{url('/uploads/Scrom/'.$Scroms->title.'/res/index.html')}}'
                            target="_blank"> <i class="fa-solid fa-book" aria-hidden="true"></i>
                            {{$Scroms->title ?? $Scroms->file}}</a></li>
                            @endforeach
                            </ul>--}}
                            @foreach($Scrom1 as $Scroms)
                            <li><a href="javascript:void(0)" data-bs-toggle="collapse" id="view_scrom" data-type="scrom"
                                    data-id="{{$Scroms->id}}"><i class="fa-solid fa-book" aria-hidden="true"></i>
                                    {{$Scroms->title ?? $Scroms->file}}</li></a>
                            @endforeach
                            @endif


                            @if(count($Quiz1) > 0)
                               @foreach($Quiz1 as $Quizs)

                               @php
                               $choise = DB::table('student_questions')->where('u_id',$Quizs->u_id)->first();
                            // $choise2 = DB::table('course_quizzes')->where('u_id',$Quizs->u_id)->first();
                            // dd($choise2);
                               @endphp
                               @if(isset($choise) && $choise->is_submitted == 1)
                               <li><a href="{{url('student/test-quiz-list',$Quizs->u_id) }}"><i class="fa-solid fa-question" aria-hidden="true"></i> {{$Quizs->title ?? 'quiz1'}}</li></a>
                               @else
                               <li><a href="/student/question-preview/{{ base64_encode($Quizs->u_id) }}?page=1" target="_blank"><i class="fa-solid fa-question" aria-hidden="true"></i> {{$Quizs->title ?? 'quiz1'}}</li></a>
                               @endif
                               @endforeach
                            @endif
                            @if(count($Web1) > 0)
                               @foreach($Web1 as $Webs)
                               <li><a href="javascript:void(0)" data-bs-toggle="collapse" id="view_web" data-type="web" data-id="{{$Webs->id}}"><i class="fa-solid fa-bars" aria-hidden="true"></i> {{$Webs->title ?? 'web-content'}}</li></a>
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
                <div id="statuscmpt"></div>
                <div class="preview-img-video play" id="disdata" style="height: 90%;">
                    <video width="100%" height="500px" controls id="vido1" class="d-none">
                        <source class="vido" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <iframe class="tube d-none" id="ytube" width="100%" height="500px" src="" frameborder="0"
                        allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <audio controls id="audo1" class="d-none">
                        <source class="audo" src="" type="audio/ogg">
                        Your browser does not support the audio element.
                    </audio>
                    <iframe style="max-width:100%" id="iframe1" class="d-none idata" src="" width="100%" height="500px"
                        frameborder="0" allowfullscreen></iframe>
                    <iframe style="max-width:100%" id="quz1" class="d-none idata1" src="" width="100%" height="500px" frameborder="0" allowfullscreen></iframe>
                    <div class="row d-none" id="sata1" style="left: 20px; bottom: 119px;  position: relative;"></div>
                    <div class="row d-none" id="sata12" style="left: 20px; bottom: 119px;  position: relative;"></div>
                    <div class="row d-none" id="wb1" style="left: 20px; bottom: 119px;  position: relative;"></div>
                </div>
                <!-- <div class="d-none" id="scrom1" ></div> -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="schedule-calendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {{-- style="max-width:70%;" --}}
        <div class="modal-content selectplan">
            <div class="modal-header">
                <!-- <span><i class="fa-solid fa-chevron-left"></i></span> -->
                <!-- <h1 class="modal-title fs-5">Schedule your lessons</h1> -->
                <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body time-frame" style="width:100%">
            <div id="scrm"></div>
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
@endsection
@push('script')
<script>
$(document).ready(function() {
    $(document).on('click', '#video', function(event) {
        $('#audo1').get(0).pause();
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#statuscmpt').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-video') }}",
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
                    $('#v_dis').removeClass('d-none');
                    $('#iframe1').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#as_dis').addClass('d-none');
                    $('#a_dis').addClass('d-none');
                    $('#v_dis').removeClass('d-none');
                    $('#i_dis').addClass('d-none');
                    $('#p_dis').addClass('d-none');
                    $('#as_dis1').addClass('d-none');
                    $('#a_dis1').addClass('d-none');
                    $('#v_dis1').removeClass('d-none');
                    $('#i_dis1').addClass('d-none');
                    $('#p_dis1').addClass('d-none');
                    $('#as_dis12').addClass('d-none');
                    $('#a_dis12').addClass('d-none');
                    $('#v_dis12').addClass('d-none');
                    $('#i_dis12').addClass('d-none');
                    $('#p_dis12').addClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#scrm').addClass('d-none');
                    $('#scrom1').addClass('d-none');
                    $('#scrm1').addClass('d-none');
                    $('#scrm12').addClass('d-none');
                    $('#quz1').addClass('d-none');
                    $('#qz').addClass('d-none');
                    $('#qz1').addClass('d-none');
                    $('#qz12').addClass('d-none');
                    $('#w').addClass('d-none');
                    $('#w1').addClass('d-none');
                    $('#w12').addClass('d-none');
                    $('#wb1').addClass('d-none');
                    $(".play video")[0].load();
                }
                if (response.success1 == true) {
                    var url = response.value.link;
                    $(".tube").attr('src', url);
                    $('#audo1').addClass('d-none');
                    $('#iframe1').addClass('d-none');
                    $('#vido1').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#as_dis').addClass('d-none');
                    $('#a_dis').addClass('d-none');
                    $('#v_dis').removeClass('d-none');
                    $('#i_dis').addClass('d-none');
                    $('#p_dis').addClass('d-none');
                    $('#as_dis1').addClass('d-none');
                    $('#a_dis1').addClass('d-none');
                    $('#v_dis1').removeClass('d-none');
                    $('#i_dis1').addClass('d-none');
                    $('#p_dis1').addClass('d-none');
                    $('#as_dis12').addClass('d-none');
                    $('#a_dis12').addClass('d-none');
                    $('#v_dis12').addClass('d-none');
                    $('#i_dis12').addClass('d-none');
                    $('#p_dis12').addClass('d-none');
                    $('#ytube').removeClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#scrm').addClass('d-none');
                    $('#scrom1').addClass('d-none');
                    $('#scrm1').addClass('d-none');
                    $('#scrm12').addClass('d-none');
                    $('#quz1').addClass('d-none');
                    $('#qz').addClass('d-none');
                    $('#qz1').addClass('d-none');
                    $('#qz12').addClass('d-none');
                    $('#w').addClass('d-none');
                    $('#w1').addClass('d-none');
                    $('#w12').addClass('d-none');
                    $('#wb1').addClass('d-none');
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
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#statuscmpt').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-audio') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    var url = "{{url('/')}}" + '/uploads/c_audio/' + response.value.audio;
                    $(".audo").attr('src', url);
                    $('#iframe1').addClass('d-none');
                    $('#vido1').addClass('d-none');
                    $('#audo1').removeClass('d-none');
                    $('#ytube').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#as_dis').addClass('d-none');
                    $('#a_dis').removeClass('d-none');
                    $('#v_dis').addClass('d-none');
                    $('#i_dis').addClass('d-none');
                    $('#p_dis').addClass('d-none');
                    $('#as_dis1').addClass('d-none');
                    $('#a_dis1').removeClass('d-none');
                    $('#v_dis1').addClass('d-none');
                    $('#i_dis1').addClass('d-none');
                    $('#p_dis1').addClass('d-none');
                    $('#as_dis12').addClass('d-none');
                    $('#a_dis12').addClass('d-none');
                    $('#v_dis12').addClass('d-none');
                    $('#i_dis12').addClass('d-none');
                    $('#p_dis12').addClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#scrm').addClass('d-none');
                    $('#scrom1').addClass('d-none');
                    $('#scrm1').addClass('d-none');
                    $('#scrm12').addClass('d-none');
                    $('#quz1').addClass('d-none');
                    $('#qz').addClass('d-none');
                    $('#qz1').addClass('d-none');
                    $('#qz12').addClass('d-none');
                    $('#w').addClass('d-none');
                    $('#w1').addClass('d-none');
                    $('#w12').addClass('d-none');
                    $('#wb1').addClass('d-none');
                    $(".play audio")[0].load();
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
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#statuscmpt').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-iframe') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                console.log(response);
                if (response.success == true) {
                    var url = response.value.url;
                    $(".idata").attr('src', url);
                    $('#as_dis').addClass('d-none');
                    $('#a_dis').addClass('d-none');
                    $('#v_dis').addClass('d-none');
                    $('#i_dis').removeClass('d-none');
                    $('#p_dis').addClass('d-none');
                    $('#iframe1').removeClass('d-none');
                    $('#vido1').addClass('d-none');
                    $('#audo1').addClass('d-none');
                    $('#ytube').addClass('d-none');
                    $('#sata12').addClass('d-none');
                    $('#sata1').addClass('d-none');
                    $('#as_dis1').addClass('d-none');
                    $('#a_dis1').addClass('d-none');
                    $('#v_dis1').addClass('d-none');
                    $('#i_dis1').removeClass('d-none');
                    $('#p_dis1').addClass('d-none');
                    $('#as_dis12').addClass('d-none');
                    $('#a_dis12').addClass('d-none');
                    $('#v_dis12').addClass('d-none');
                    $('#i_dis12').addClass('d-none');
                    $('#p_dis12').addClass('d-none');
                    $('#disdata').removeClass('d-none');
                    $('#scrm').addClass('d-none');
                    $('#scrom1').addClass('d-none');
                    $('#scrm1').addClass('d-none');
                    $('#scrm12').addClass('d-none');
                    $('#quz1').addClass('d-none');
                    $('#qz').addClass('d-none');
                    $('#qz1').addClass('d-none');
                    $('#qz12').addClass('d-none');
                    $('#w').addClass('d-none');
                    $('#w1').addClass('d-none');
                    $('#w12').addClass('d-none');
                    $('#wb1').addClass('d-none');
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
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#statuscmpt').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-presentation') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata12').addClass('d-none');
                $('#sata1').removeClass('d-none');
                $('#as_dis').addClass('d-none');
                $('#a_dis').addClass('d-none');
                $('#v_dis').addClass('d-none');
                $('#i_dis').addClass('d-none');
                $('#p_dis').removeClass('d-none');
                $('#as_dis1').addClass('d-none');
                $('#a_dis1').addClass('d-none');
                $('#v_dis1').addClass('d-none');
                $('#i_dis1').addClass('d-none');
                $('#p_dis1').removeClass('d-none');
                $('#as_dis12').addClass('d-none');
                $('#a_dis12').addClass('d-none');
                $('#v_dis12').addClass('d-none');
                $('#i_dis12').addClass('d-none');
                $('#p_dis12').addClass('d-none');
                $('#disdata').removeClass('d-none');
                $('#scrm').addClass('d-none');
                $('#scrom1').addClass('d-none');
                $('#scrm1').addClass('d-none');
                $('#scrm12').addClass('d-none');
                $('#quz1').addClass('d-none');
                $('#qz').addClass('d-none');
                $('#qz1').addClass('d-none');
                $('#qz12').addClass('d-none');
                $('#w').addClass('d-none');
                $('#w1').addClass('d-none');
                $('#w12').addClass('d-none');
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
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#statuscmpt').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-assign') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#as_dis').removeClass('d-none');
                $('#a_dis').addClass('d-none');
                $('#v_dis').addClass('d-none');
                $('#i_dis').addClass('d-none');
                $('#p_dis').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').addClass('d-none');
                $('#sata12').removeClass('d-none');
                $('#as_dis1').removeClass('d-none');
                $('#a_dis1').addClass('d-none');
                $('#v_dis1').addClass('d-none');
                $('#i_dis1').addClass('d-none');
                $('#p_dis1').addClass('d-none');
                $('#as_dis12').addClass('d-none');
                $('#a_dis12').addClass('d-none');
                $('#v_dis12').addClass('d-none');
                $('#i_dis12').addClass('d-none');
                $('#p_dis12').addClass('d-none');
                $('#disdata').removeClass('d-none');
                $('#scrm').addClass('d-none');
                $('#scrom1').addClass('d-none');
                $('#scrm1').addClass('d-none');
                $('#scrm12').addClass('d-none');
                $('#quz1').addClass('d-none');
                $('#qz').addClass('d-none');
                $('#qz1').addClass('d-none');
                $('#qz12').addClass('d-none');
                $('#w').addClass('d-none');
                $('#w1').addClass('d-none');
                $('#w12').addClass('d-none');
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
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#scrm').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-scrom') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#as_dis').addClass('d-none');
                $('#a_dis').addClass('d-none');
                $('#v_dis').addClass('d-none');
                $('#i_dis').addClass('d-none');
                $('#p_dis').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').addClass('d-none');
                $('#sata12').addClass('d-none');
                $('#as_dis1').addClass('d-none');
                $('#a_dis1').addClass('d-none');
                $('#v_dis1').addClass('d-none');
                $('#i_dis1').addClass('d-none');
                $('#p_dis1').addClass('d-none');
                $('#as_dis12').addClass('d-none');
                $('#a_dis12').addClass('d-none');
                $('#v_dis12').addClass('d-none');
                $('#i_dis12').addClass('d-none');
                $('#p_dis12').addClass('d-none');
                $('#scrm').removeClass('d-none');
                $('#scrom1').removeClass('d-none');
                $('#scrm1').removeClass('d-none');
                $('#scrm12').addClass('d-none');
                $('#quz1').addClass('d-none');
                $('#qz').addClass('d-none');
                $('#qz1').addClass('d-none');
                $('#qz12').addClass('d-none');
                $('#w').addClass('d-none');
                $('#w1').addClass('d-none');
                $('#w12').addClass('d-none');
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
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#statuscmpt').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-quiz') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                if (response.success == true) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#as_dis').addClass('d-none');
                $('#a_dis').addClass('d-none');
                $('#v_dis').addClass('d-none');
                $('#i_dis').addClass('d-none');
                $('#p_dis').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').addClass('d-none');
                $('#sata12').addClass('d-none');
                $('#as_dis1').addClass('d-none');
                $('#a_dis1').addClass('d-none');
                $('#v_dis1').addClass('d-none');
                $('#i_dis1').addClass('d-none');
                $('#p_dis1').addClass('d-none');
                $('#as_dis12').addClass('d-none');
                $('#a_dis12').addClass('d-none');
                $('#v_dis12').addClass('d-none');
                $('#i_dis12').addClass('d-none');
                $('#p_dis12').addClass('d-none');
                $('#scrm').addClass('d-none');
                $('#scrom1').addClass('d-none');
                $('#scrm1').addClass('d-none');
                $('#scrm12').addClass('d-none');
                $('#disdata').addClass('d-none');
                $('#qz').removeClass('d-none');
                $('#qz1').removeClass('d-none');
                $('#qz12').addClass('d-none');
                $('#quz1').removeClass('d-none');
                $('#disdata').removeClass('d-none');
                $('#w').addClass('d-none');
                $('#w1').addClass('d-none');
                $('#w12').addClass('d-none');
                $('#wb1').addClass('d-none');
                var url = response.value.url;
                $(".idata1").attr('src', url);
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
        var type = $(this).attr('data-type');
        var l_id = $('#l_id').val();
        $.ajax({
            url: "{{ route('student.d-compt') }}",
            type: "get",
            data: {
                'id': id,
                'type': type,
                'l_id':l_id
            },
            success: function(response) {
                $('#statuscmpt').replaceWith(response);
            }
        });
        $.ajax({
            url: "{{ route('student.d-web') }}",
            type: "get",
            data: {
                'id': id,
            },
            success: function(response) {
                $('#iframe1').addClass('d-none');
                $('#vido1').addClass('d-none');
                $('#as_dis').addClass('d-none');
                $('#a_dis').addClass('d-none');
                $('#v_dis').addClass('d-none');
                $('#i_dis').addClass('d-none');
                $('#p_dis').addClass('d-none');
                $('#audo1').addClass('d-none');
                $('#ytube').addClass('d-none');
                $('#sata1').addClass('d-none');
                $('#sata12').addClass('d-none');
                $('#as_dis1').addClass('d-none');
                $('#a_dis1').addClass('d-none');
                $('#v_dis1').addClass('d-none');
                $('#i_dis1').addClass('d-none');
                $('#p_dis1').addClass('d-none');
                $('#as_dis12').addClass('d-none');
                $('#a_dis12').addClass('d-none');
                $('#v_dis12').addClass('d-none');
                $('#i_dis12').addClass('d-none');
                $('#p_dis12').addClass('d-none');
                $('#scrm').addClass('d-none');
                $('#scrom1').addClass('d-none');
                $('#scrm1').addClass('d-none');
                $('#scrm12').addClass('d-none');
                $('#disdata').addClass('d-none');
                $('#qz').addClass('d-none');
                $('#qz1').addClass('d-none');
                $('#qz12').addClass('d-none');
                $('#quz1').addClass('d-none');
                $('#disdata').removeClass('d-none');
                $('#w').removeClass('d-none');
                $('#w1').removeClass('d-none');
                $('#w12').addClass('d-none');
                $('#wb1').removeClass('d-none');
                $('#wb1').replaceWith(response);
            }
        });
    });
    $(document).on('click', '.cmpt', function(event) {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        $.ajax({
            url: "{{ route('student.d-complete') }}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id,
                'type': type
            },
            success: function(response) {
                if (response.type == 'video') {
                    $('#v_dis12').removeClass('d-none');
                    $('#v_dis1').addClass('d-none');
                }
                if (response.type == 'audio') {
                    $('#a_dis12').removeClass('d-none');
                    $('#a_dis1').addClass('d-none');
                }
                if (response.type == 'iframe') {
                    $('#i_dis12').removeClass('d-none');
                    $('#i_dis1').addClass('d-none');
                }
                if (response.type == 'presentation') {
                    $('#p_dis12').removeClass('d-none');
                    $('#p_dis1').addClass('d-none');
                }
                if (response.type == 'assign') {
                    $('#as_dis12').removeClass('d-none');
                    $('#as_dis1').addClass('d-none');
                }
                if (response.type == 'scrom') {
                    $('#scrm12').removeClass('d-none');
                    $('#scrm1').addClass('d-none');
                }
                if (response.type == 'quiz') {
                    $('#qz12').removeClass('d-none');
                    $('#qz').addClass('d-none');
                }
                if (response.type == 'web') {
                    $('#w12').removeClass('d-none');
                    $('#w').addClass('d-none');
                }
            }
        });
    });
});
</script>
<script>
function openCity(evt, cityName) {
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
    if(cityName == 'lesson-list'){
      var element = document.getElementById("disdata");
      element.classList.remove("d-none");
    }
    if(cityName == 'question-answer'){
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
