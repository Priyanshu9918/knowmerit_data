@extends('layouts.teacher.master')
@section('content')
<style type="text/css">
.user-nav a.dropdown-toggle {
    display: block;
}

span.top-view-c2 {
    padding: 3px 6px;
}

.settings-inner-blk table tbody tr:last-child {
    border: 5px solid #009fff !important;
}

.dash-table td {
    padding: 1rem 35px !important;
}
.add-lesson-btn
{
    position: relative;
    top: 2%;
    z-index: 99;
}
.add-lesson-btn button {
    border: none;
    background-color: #feba00;
    border-radius: 7px;
    padding: 5px 15px;
    font-weight: 500;
    position: absolute;
    right: 0;
}
#Web
{
    display: none;
    padding: 0px;
    width: 100%;
    height: auto;
    text-align: center;
    background: #fff;
    position: fixed;
    top: 10%;
    left: 0%;
    background-color: #fff;
    overflow: scroll;
    height: 90vh;
    overflow-x: hidden;
    z-index: 99;

}
.cnclbtn
{
    display: flex;
    justify-content: end;
    padding: 20px 20px 0px 20px;
}
/*.popup-add {
    padding: 10px 100px 70px 100px;
    text-align: left;
}*/
.cnclbtn button#Web-cancel-btn {
    border: none;
    background-color: unset;
    font-size: 40px;
}
.webbtn-des
{
    text-align: center;
    padding: 15px 0px;
}
.popup-add label {
    font-size: 16px;
    font-weight: 500;
    color: #468dcb;
}
#game
{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1055;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;

}
</style>
@php
    $course_level = DB::table('courses')->where('id',$t_courses->id)->first();
@endphp
<div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #fff; border-radius: 10px;">
    <!-- <div class="add-lesson-btn">
        <h6 style="background-color: #f4f4f4;
    padding: 7px;"> My Courses / <a href="">{{$t_courses->title}}</a>
        </h6>
        <button id="add-lesson">+ Add Chapter</button>
    </div> -->
    <!-- <div class="add-lesson-btn">
        @if($course_level->teacher_id == 1)
            <a href="javascript:void(0)" id="delete_c" data-id="{{$t_courses->id}}" data-sid="{{$st_id}}"><span class="circle-icon ciricon2" title="Delete Course"><i class="fa fa-times" aria-hidden="true" ></i></span></a>
        @else
            <a href="{{url('teacher/edit-course',$t_courses->id)}}"><span class="circle-icon ciricon1" style="right: 5%;" id="edit" title="Edit Course"><i class="fa fa-pencil" aria-hidden="true" ></i></span></a>

            <a href="javascript:void(0)" id="delete_c" data-id="{{$t_courses->id}}" data-sid="{{$st_id}}"><span class="circle-icon ciricon2" style="right: 1%;" title="Delete Course"><i class="fa fa-times" aria-hidden="true" ></i></span></a>

            <a href="javascript:void(0)" id="add-lesson" data-id="" data-sid=""><span class="circle-icon ciricon2" style="right: 9.5%;" title="Delete Course"><i class="fa fa-plus" aria-hidden="true"></i></span></a>
            
            
        @endif
    </div> -->
    <section class="transform-section-five" style="padding: 0px 0 0px;">

        <div class="row" style="background-color: #8ca9bb33; padding-top: 12px; border-radius: 10px;">
            <div class="col-lg-4 col-md-4 col-sm-12 aos-init aos-animate" data-aos="fade-down">
                <div style="width: 100%; height: 180px;">
                    <img class="img-fluid stu-img-des" alt="" src="{{asset('uploads/course/'.$t_courses->image)}}">
                </div>
                <!-- <div class="about-button more-details mt-3">
                    <a href="#" class="discover-btn" style="width: 100%; border-radius: 7px;padding: 4px;">Resume Course </a>
                </div> -->

            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 aos-init aos-animate" data-aos="fade-down">
                <div class="header-five-title mb-0 mt-2 fortitlendaddchap">
                        <h2 style="font-size: 19px;">{{$t_courses->title}}</h2>

                        <div class="addchapterntn">
                        @if($course_level->teacher_id != 1)
                            <a href="javascript:void(0)" id="add-lesson" data-id="" data-sid="" class="chaptaddbtn"><span style="" title="Delete Course"><img class="alliconimg" src="../../../assets/img/plus-design.png"></span></a>

                            <a href="{{url('teacher/edit-course',$t_courses->id)}}" id="edit" class="chapteditbtn"><span style="" title="Edit Course"><img class="alliconimg" src="../../../assets/img/edit-sign.png"></span></a>

                            <a href="javascript:void(0)" id="delete_c" data-id="{{$t_courses->id}}" data-sid="{{$st_id}}" class="chaptdeletebtn"><span  style="" title="Delete Course"><img class="alliconimg" src="../../../assets/img/cancel-sign.png"></span></a>
                        @endif
                        </div>
                    </div>
                    <div class="career-five-content mb-2">
                        <p class="mb-0">{!!$t_courses->description!!}</p>
                    </div>
            </div>


            <div class="col-md-3 col-sm-12">
                <div class="coursescoreassignment">
                    <p><strong>Scored Points: </strong>000000</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="coursescoreassignment">
                    <p><strong>Completed Assignments: </strong>0000</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="coursescoreassignment">
                    <p><strong>Pending Assignments: </strong>000</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="coursescoreassignment">
                    <img class="alliconimg" src="../../../assets/img/file-sign.png">
                </div>
            </div>


        </div>


        <div class="allchaplesson">
            <div class="row">
            <div class="col-lg-11 col-md-11 col-sm-12 aos-init aos-animate" data-aos="fade-down">
                <div class="transform-access-content">
                    
                   <!--  <div class="row">
                        <div class="col-sm-6">
                            <h5 class="subs-title">Content</h5>
                        </div>

                    </div> -->
                    @php
                        $lession = DB::table('lessions')->where('course_id',$t_courses->id)->get();
                    @endphp
                    @if(count($lession)>0)
                        @foreach($lession as $key=>$lessions)
                        <div class="course-card">
                            <div style="position: relative;">
                                <h6 class="cou-title">
                                    <a class="collapsed title-course" data-bs-toggle="collapse" href="#collapseOne{{$lessions->id}}"
                                        aria-expanded="false">{{$lessions->title}}</a>
                                        @if($course_level->teacher_id != 1)
                                        <span class="circle-icon ciricon1" style="right: 11%;" id="edit" data-id="{{$lessions->id}}" title="Edit Lecture"><img class="alliconimg" src="../../../assets/img/edit-sign.png"></span>
                                        <span class="circle-icon ciricon2" style="right: 15%;" id="plus" data-id="{{$lessions->id}}" title="Add Lession"><img class="alliconimg" src="../../../assets/img/plus-design.png"></span>
                                        <span class="circle-icon ciricon3" title="Delete Lession" id="delete" data-id="{{$lessions->id}}"><img class="alliconimg" src="../../../assets/img/cancel-sign.png"></span>
                                        @endif
                                    </div>
                                </h6>
                            <div id="collapseOne{{$lessions->id}}" class="card-collapse collapse @if($key == 0)show @endif" style="">
                                <ul>
                                    @php
                                        $lecture = DB::table('lectures')->where('lession_id',$lessions->id)->get();
                                    @endphp
                                    @if(count($lecture)>0)
                                        @foreach($lecture as $lectures)
                                        <li>



                                            <div>
                                                <p>{{$lectures->title}}</p>
                                            </div>
                                            <div>
                                            @if($course_level->teacher_id != 1)
                                                <a href="javascript:void(0)" class="chapt-lession-addbtn" data-id="{{$lectures->id}}" id="add-student"><span style="" title="Add Course1"><img class="alliconimg" src="../../../assets/img/plus-design.png"></span></a>
                                                <a href="javascript:void(0)" class="chapt-lession-editbtn" data-id="{{$lectures->id}}" id="edit1"><span style="" title="Edit Course1"><img class="alliconimg" src="../../../assets/img/edit-sign.png"></span></a>
                                                <a href="javascript:void(0)" class="chapt-lession-deletebtn" data-id="{{$lectures->id}}" id="delete1"><span  style="" title="Delete Course1"><img class="alliconimg" src="../../../assets/img/cancel-sign.png"></span></a>
                                            @endif
                                                <a href="{{url('/teacher/preview',$lectures->id)}}" class="chapt-lession-arrowbtn"><span  style="" title="Preview"><img class="alliconimg" src="../../../assets/img/arrow-sign.png"></span></a>
                                            </div>




                                            <!-- <p><img src="assets/img/icon/play.svg" alt="" class="me-2">{{$lectures->title}}</p>
                                            <div class="img-wicon">
                                            @if($course_level->teacher_id != 1)
                                                <div class="all-icons">
                                            <span class="circle-icon" style="right: 120%;" title="Add Lession Content"><i id="add-student" class="fa fa-plus" id="edit1" aria-hidden="true" data-id="{{$lectures->id}}"></i></span>
                                            <span class="circle-icon" style="right: 63%;" title="Edit Lession"><i class="fa fa-pencil" id="edit1" aria-hidden="true" data-id="{{$lectures->id}}"></i></span>
                                            <span class="circle-icon" title="Delete Lession"><i class="fa fa-times" aria-hidden="true" id="delete1" data-id="{{$lectures->id}}"></i></span>
                                                </div>
                                                @endif<br>
                                            <a href="{{url('/teacher/preview',$lectures->id)}}">Preview</a>
                                            </div> -->
                                        </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12 d-flex align-items-end">

                <div class="sideaddarrodiv text-center" style="margin-left: -10px">
                    <div class="addarrow" id="addarrodivblk"  style="display: none;">
                        <div class="mb-3">
                            <a href="{{url('/teacher/preview1',['st_id' => request()->st_id, 'id' => $t_courses->id])}}" id="" class="chapt-lession-side-arrowbtn"><span style="" title="Preview"><img class="alliconimg" src="../../../assets/img/arrow-sign.png"></span></a>
                        </div>
                        <div class="mb-4">
                            <a href="javascript:void(0)" id="add-game" data-id="{{$t_courses->id}}" class="chapt-lession-side-addbtn"><span style="" title="Add Course"><img class="alliconimg" src="../../../assets/img/plus-design.png"></span></a>
                        </div>
                    </div>
                    <div class="gamegameicon" id="gamegameiconblk">
                        <a href="javascript:void(0)" id="" class=""><span style="" ><img class="alliconimg" src="../../../assets/img/game-sign.png"></span></a>
                    </div>
                </div>
            </div>
        </div>


    </section>





    <div id="add-student-lesson" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('teacher.create-lession1')}}" method="POST" id="createFrm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="student_id" value="{{$t_courses->student_id}}">
                        <input type="hidden" name="teacher_id" value="{{$t_courses->teacher_id}}">
                        <input type="hidden" name="course_id" value="{{$t_courses->id}}">
                            <div>
                                <label>Add Chapter</label>
                                <input class="form-control" type="text" name="title" placeholder="Lesson">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                            </div>
                            <button>Submit</button>
                        </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
</div>
<!-- edit lession -->
<div id="add-student-lecture" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Lecture</h5>
                    <button id="add-student-lecture-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body student-lec-submit">
                    <div class="popup-add">
                    <form action="{{route('teacher.create-lecture')}}" method="POST" id="createFrm1" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lession" id="lession123" value="">
                            <div>
                                <label>Lecture</label>
                                <input class="form-control" type="text" name="title" placeholder="Lecture">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-title"></p>
                            </div>
                            <div>
                                <label>Description</label>
                                <input class="form-control" type="text" name="description" placeholder="Description">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-description"></p>
                            </div>
                            <button>Submit</button>
                        </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
</div>

<div id="edit-student-lesson" class="modal fade modal-edit-less" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Lession</h5>
                    <button id="edit-student-lesson-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body student-lec-submit">
                    <div class="popup-add" id="data12">

                    </div>
                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>
        </div>
</div>
<div id="edit-student-lecture" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Lecture</h5>
                    <button id="edit-student-lecture-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body student-lec-submit">
                    <div class="popup-add" id="data123">

                    </div>
                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>
        </div>
</div>

<div id="game" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button id="game-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('teacher.create-game')}}" method="POST" id="gameCreate" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course" id="courseid0">
                            <div>
                                <label>Game Title</label>
                                <input class="form-control" type="text" name="title" placeholder="Enter Game Title">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                            </div>
                            <div>
                                <label>Add Url</label>
                                <input type="hidden" name="id" id="lession_123">
                                <input class="form-control" type="text" name="url" placeholder="Enter Game Url">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-url"></p>
                            </div>
                            <div style="text-align: center; margin-top: 15px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>


                </div>
                <!-- <div class="modal-footer">
          </div> -->
            </div>

        </div>
</div>

<div id="iframe" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="iframe-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('teacher.create-iframe')}}" method="POST" id="iframeCreate" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lession" id="lession_id0" value="">
                            <div>
                                <label>Iframe Title</label>
                                <input class="form-control" type="text" name="title" value="" placeholder="Enter Iframe Url">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                            </div>
                            <div>
                                <label>Add Url</label>
                                <input type="hidden" name="id" id="lession_123" value="">
                                <input class="form-control" type="text" name="url" value="" placeholder="Enter Iframe Url">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-url"></p>
                            </div>
                            <button type="submit" class="btn subbtn">Submit</button>
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
                    <button id="Presentation123-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('teacher.create-presentaion')}}" method="POST" id="Presentation12" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lession_id" id="lession10" value="">
                            <div>
                                <label>Title</label>
                                <input class="form-control" type="text" name="title">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                            </div>
                            <div>
                                <label>Add file</label>
                                <input class="form-control" type="file" name="file" accept=".doc,.docx,.ppt,.pptx,.pdf">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-file"></p>
                            </div>
                            <button type="submit" class="btn subbtn">Submit</button>
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
                    <button id="Assign123-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                    <form action="{{route('teacher.create-assign')}}" method="POST" id="Assign12" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="lession_id" id="lession101" value="">
                            <div>
                                <label>Title</label>
                                <input class="form-control" type="text" name="title">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                            </div>
                            <div>
                                <label>Add file</label>
                                <input class="form-control" type="file" name="file" accept=".doc,.docx,.pdf">
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-file"></p>
                            </div>
                            <button type="submit" class="btn subbtn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<div id="Scrom" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="Scrom-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                        <form action="{{route('teacher.create-scrom')}}" method="POST" id="scromcreate" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="lession_id" id="lession_scrom" value="">
                                    <div>
                                        <label>Title</label>
                                        <input class="form-control" type="text" name="title">
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                    </div>
                                    <div class="mt-3">
                                        <label>upload file</label>
                                        <input class="form-control" type="file" name="file" >
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-file"></p>
                                    </div>
                                <button type="submit" class="btn subbtn">Submit</button>
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
                    <button id="Quiz-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                        <form action="{{route('teacher.create-quiz')}}" method="POST" id="quizcreate" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="lession_id" id="lession_quiz" value="">
                                    <div>
                                        <label>Title</label>
                                        <input class="form-control" type="text" name="title">
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                    </div>
                                    <div class="mt-3">
                                        <label>Url</label>
                                        <textarea class="form-control" name="url" ></textarea>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-url"></p>
                                    </div>
                                <button type="submit" class="btn subbtn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<div id="Web">
    <div class="cnclbtn">
    <button id="Web-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="popup-add">
        <form action="{{route('teacher.create-web')}}" method="POST" id="webcreate" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="lession_id" id="lession_web" value="">
                    <div>
                        <label>Title</label>
                        <input class="form-control" type="text" name="title1">
                        <p style="margin-bottom: 25px;" class="text-danger error_container" id="error1-title1"></p>
                    </div>
                    <div class="mt-3">
                        <label>Content</label>
                        <textarea class="form-control" name="content" id="dialogQuestionText"></textarea>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-content"></p>
                    </div>
                    <div class="webbtn-des">
                        <button type="submit" class="btn btn-primary subbtn">Submit</button>
                    </div>
        </form>
    </div>
</div>

<div id="add-student-Modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button id="cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
          </div> -->
          @php
          $uid= base64_encode(rand(100000, 9999999));
        @endphp
          <div class="modal-body">
                <ul>
                    <li><a href="javascript:void(0)" id="Web1"><i class="fa fa-file-text" aria-hidden="true"></i> Content</li></a>
                    <li><a href="{{url('/teacher/add-video',$t_courses->id)}}" class="vido"><i class="fa fa-video-camera" aria-hidden="true"></i> Video</li></a>
                    <li><a href="{{url('/teacher/add-audio',$t_courses->id)}}" class="audo"><i class="fa fa-volume-off" aria-hidden="true"></i> Audio</li></a>
                    <li><a href="javascript:void(0)" id="i-frame"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> iFrame</li></a>
                    <li><a href="javascript:void(0)" id="Scrom1"><i class="fa fa-bars" aria-hidden="true"></i> SCORM | cmi5</li></a>
                    <li><a href="javascript:void(0)" id="Presentation"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>Document</li></a>
                    <li><a href="{{url('teacher/question-answer')}}" class="quiz12"><i class="fa fa-file-text" aria-hidden="true"></i> Quiz</li></a>
                    <li><a href="javascript:void(0)" id="Assign"><i class="fa fa-book" aria-hidden="true"></i>Assignment</li></a>
                </ul>
          </div>
          <!-- <div class="modal-footer">
          </div> -->
        </div>

      </div>
    </div>
    @endsection
    @push('script')

    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script><script  src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{asset('/ckeditor/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">

            CKEDITOR.replace('dialogQuestionText', {
                extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
                removeButtons: 'PasteFromWord'
            });

        $(document).on("click","#add-student",function(){
        var id = $(this).attr('data-id');
        $('#lession_id0').val(id);
        $('#lession10').val(id);
        $('#lession101').val(id);
        $('#lession_123').val(id);
        $('#lession_scrom').val(id);
        $('#lession_quiz').val(id);
        $('#lession_web').val(id);
        var url = '{{url('teacher/add-video',':id')}}';
        var url1 = '{{url('teacher/add-audio',':id')}}';

        var url2 = "{{ url('teacher/question-answer',$uid) }}"+'?course_id='+id;

        url = url.replace('%3Aid', id);
        url1 = url1.replace('%3Aid', id);
        url2 = url2.replace('%3Aid', id);
        $(".vido").attr('href',url);
        $(".audo").attr('href',url1);
        $(".quiz12").attr('href',url2);
        $('#add-student-Modal').modal('show');
        return false;
        });
        $("#cancel-btn").on("click", function()
        {
            $('#add-student-Modal').modal('hide');
        })
    </script>
    <script>
        $(document).ready(function() {
            //on change country
            $(document).on('click', '#plus', function() {
                var id = $(this).attr('data-id');
                $('#lession123').val(id);
                $('#add-student-lecture').modal('show');
            });
            $(document).on('click', '#add-student-lecture-cancel-btn', function() {
                $('#add-student-lecture').modal('hide');
            });


            $(document).on('click', '#delete', function() {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your Lession.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('teacher.delete-lession') }}";
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
                                        title: 'Lession Deleted!',
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
            $(document).on('click', '#delete1', function() {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your Lecture.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('teacher.delete-lecture') }}";
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
                                        title: 'Lecture Deleted!',
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
            $(document).on('click', '#delete_c', function() {
                var id = $(this).attr('data-id');
                var sid = $(this).attr('data-sid');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'you want to delete your Course.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, make your AJAX request here to delete the account
                        var ajaxUrl = "{{ route('teacher.delete-course') }}";
                        var requestData = {
                            "_token": "{{ csrf_token() }}",
                            'id' : id,
                            'sid' : sid,
                        };
                        $.ajax({
                            type: 'POST',
                            url: ajaxUrl,
                            data: requestData,
                            success: function(response) {
                                if (response.success == true) {
                                    Swal.fire({
                                        title: 'Course Deleted!',
                                        icon: 'success',
                                    }).then(() => {
                                        window.location = "{{ url('/') }}" +"/teacher/student";
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
                            toastr.success("Lession Created Successfully");
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

            $(document).on('submit', 'form#createFrm1', function(event) {
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
                            toastr.success("Lecture Created Successfully");
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

            $(document).on('click', '#edit1', function(event) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('teacher.edit-lecture') }}",
                    type: "get",
                    data: {
                        'active': id,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#data123').replaceWith(response);
                        $('#edit-student-lecture').modal('show');

                    }
                });
            });
            $(document).on('click', '#edit-student-lecture-cancel-btn', function(event) {
               $('#edit-student-lecture').modal('hide');
            });

            $(document).on('submit', 'form#createFrm1234', function(event) {
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
                            toastr.success("Lecture Updated Successfully");
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
            $(document).on('click', '#edit', function(event) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('teacher.edit-lession') }}",
                    type: "get",
                    data: {
                        'active': id,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#data12').replaceWith(response);
                        $('#edit-student-lesson').modal('show');
                    }
                });
            });
            $(document).on('click', '#edit-student-lesson-cancel-btn', function(event) {
              $('#edit-student-lesson').modal('hide');
            });



            $(document).on('submit', 'form#createFrm122', function(event) {
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
                            toastr.success("Lecture Updated Successfully");
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
        });
    </script>
    <script type="text/javascript">
    $('.tab-value').click(function() {
        var t = $(this).text();
        $('#addbtn').html('Add' + t);
    });
    </script>
    <script type="text/javascript">
    /*$("#add-lesson").on("click",function()
        {
        $('#add-student-lesson').modal('show');
        });
        $("#cancel-btn").on("click", function()
        {
            $('#add-student-lesson').modal('hide');
        })*/
    $(document).on('click', '#add-lesson', function() {
        $('#add-student-lesson').modal('show');
    });
    $(document).on('click', '#cancel-btn', function() {
        $('#add-student-lesson').modal('hide');
    })
    $(document).on('click', '#i-frame', function() {
        $('#iframe').modal('show');
        $('#add-student-Modal').modal('hide');
    });

    $(document).on('click', '#iframe-cancel-btn', function() {
        $('#iframe').modal('hide');
    });

    $(document).on('click', '#Presentation', function() {
        $('#Presentation123').modal('show');
        $('#add-student-Modal').modal('hide');
    });
    $(document).on('click', '#Presentation123-cancel-btn', function() {
        $('#Presentation123').modal('hide');
    });
    $(document).on('click', '#Assign', function() {
        $('#Assign123').modal('show');
        $('#add-student-Modal').modal('hide');
    });
    $(document).on('click', '#Assign123-cancel-btn', function() {
        $('#Assign123').modal('hide');
    });
    $(document).on('click', '#Scrom1', function() {
        $('#Scrom').modal('show');
        $('#add-student-Modal').modal('hide');
    });
    $(document).on('click', '#Quiz1', function() {
        $('#Quiz').modal('show');
        $('#add-student-Modal').modal('hide');
    });
    // $(document).on('click', '#Web1', function() {
    //     $('#Web').modal('show');
    //     $('#add-student-Modal').modal('hide');
    // });
    $(document).on('click', '#Web1', function() {
        $('#Web').fadeToggle();
        $('#add-student-Modal').modal('hide');
    })
    $(document).on('click', '#Scrom-cancel-btn', function() {
        $('#Scrom').modal('hide');
    });
    $(document).on('click', '#Quiz-cancel-btn', function() {
        $('#Quiz').modal('hide');
    });
    $(document).on('click', '#Web-cancel-btn', function() {
        $('#Web').modal('hide');
    });

    $(document).on('submit', 'form#iframeCreate', function(event) {
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
                    toastr.success("Iframe Created Successfully");
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
    $(document).on('submit', 'form#Presentation12', function(event) {
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
                    toastr.success("Presentation file uploaded Successfully.");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        location.reload();
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
    $(document).on('submit', 'form#Assign12', function(event) {
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
                    toastr.success("Assignment file uploaded Successfully.");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        location.reload();
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

    $(document).on('submit', 'form#scromcreate', function(event) {
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
                    toastr.success("Scrom uploaded Successfully!.");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        location.reload();
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

    $(document).on('submit', 'form#quizcreate', function(event) {
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
                    toastr.success("Quiz Added Successfully!.");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        location.reload();
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

    $(document).on('submit', 'form#webcreate', function(event) {
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
                    toastr.success("Web Added Successfully!.");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
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
    $(document).on('click', '#Web-cancel-btn', function() {
        $('#Web').hide();
    });


    $(document).on('click', '#gamegameiconblk', function() {
        $('#addarrodivblk').toggle(500);
    });

    $(document).on('click', '#add-game', function() {
        var id = $(this).attr('data-id');
        $('#courseid0').val(id);
        $('#game').modal('show');
    });

    $(document).on('submit', 'form#gameCreate', function(event) {
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
                    toastr.success("Games Created Successfully");
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






    </script>
@endpush
