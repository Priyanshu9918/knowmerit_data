@extends('layouts.student.master')
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
.transform-access-content .header-five-title {
    margin-bottom: 10px;
}
.coursescoreassignment img {
    width: 22px;
}
</style>
<div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #fff; border-radius: 10px;">
    <!-- <div class="add-lesson-btn">
        <h6 style="background-color: #f4f4f4;
    padding: 7px;"> My Courses / <a href="">{{$t_courses->title}}</a>
        </h6>
    </div> -->
    <section class="transform-section-five" style="padding: 0px 0 0px;">

        <div class="row" style="background-color: #8ca9bb33; padding-top: 12px; border-radius: 10px;">
            <div class="col-lg-4 col-md-4 col-sm-12 aos-init aos-animate" data-aos="fade-down">
                <div style="width: 100%; height: 180px;">
                    <img class="img-fluid stu-img-des" alt="" src="{{asset('uploads/course/'.$t_courses->image)}}">
                </div>
                @php
                    $id = '';
                    $c_id = '';
                    $lecture = DB::table('lessions')->where('course_id',$t_courses->id)->orderBy('created_at', 'desc')->get();
                    foreach($lecture as $lectures){
                        $lession = DB::table('lectures')->where('lession_id',$lectures->id)->orderBy('created_at', 'desc')->get();
                        if(isset($lession)){
                            foreach($lession as $key=>$lessions){
                                $c_videos = DB::table('course_videos')->where('lession_id',$lessions->id)->orderBy('created_at', 'desc')->first();
                                $c_audio = DB::table('course_audio')->where('lession_id',$lessions->id)->orderBy('created_at', 'desc')->first();
                                $c_iframe = DB::table('course_iframes')->where('lession_id',$lessions->id)->orderBy('created_at', 'desc')->first();
                                $presentation = DB::table('course_presentations')->where('lession_id',$lessions->id)->get();
                                $assignment = DB::table('course_assignments')->where('lession_id',$lessions->id)->get();
                                $scrom = DB::table('course_scroms')->where('lession_id',$lessions->id)->get();
                                $quiz = DB::table('course_quizzes')->where('lession_id',$lessions->id)->get();
                                $web = DB::table('course_web_contents')->where('lession_id',$lessions->id)->get();

                                if($c_videos){
                                    if($c_videos->is_completed == 0){
                                        $id = $c_videos->id;
                                        $c_id = $lessions->id;
                                        break;
                                    }
                                }
                                if($c_audio){
                                    if($c_audio->is_completed == 0){
                                        $id = $c_audio->id;
                                        $c_id = $lessions->id;
                                        break;
                                    }
                                }
                                if($c_iframe){
                                    if($c_iframe->is_completed == 0){
                                        $id = $c_iframe->id;
                                        $c_id = $lessions->id;
                                        break;
                                    }
                                }
                                if(count($presentation) > 0){
                                    foreach($presentation as $presentations){
                                        if($presentations->is_completed == 0){
                                            $id = $presentations->id;
                                            $c_id = $lessions->id;
                                            break;
                                        }
                                    }
                                }
                                if(count($assignment) > 0){
                                    foreach($assignment as $assignments){
                                        if($assignments->is_completed == 0){
                                            $id = $assignments->id;
                                            $c_id = $lessions->id;
                                            break;
                                        }
                                    }
                                }
                                if(count($scrom) > 0){
                                    foreach($scrom as $scroms){
                                        if($scroms->is_completed == 0){
                                            $id = $scroms->id;
                                            $c_id = $lessions->id;
                                            break;
                                        }
                                    }
                                }
                                if(count($quiz) > 0){
                                    foreach($quiz as $quizs){
                                        if($quizs->is_completed == 0){
                                            $id = $quizs->id;
                                            $c_id = $lessions->id;
                                            break;
                                        }
                                    }
                                }
                                if(count($web) > 0){
                                    foreach($web as $webs){
                                        if($webs->is_completed == 0){
                                            $id = $webs->id;
                                            $c_id = $lessions->id;
                                            break;                                                
                                        }
                                    }
                                }
                        }
                    }
                }
                @endphp
                <!-- <div class="about-button more-details mt-3">
                    @if($id != '')
                    <a href="{{url('/student/preview',$c_id)}}" class="discover-btn" style="width: 100%; border-radius: 7px; padding: 4px;">Resume Course </a>
                    @else
                    <a href="javascript:void(0)" class="discover-btn" style="width: 100%; border-radius: 7px; padding: 4px;">Completed Course </a>
                    @endif
                </div> -->

            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 aos-init aos-animate" data-aos="fade-down">
                <div class="transform-access-content">
                    <div class="header-five-title">
                        <h2 style="font-size: 19px; text-transform: capitalize;">{{$t_courses->title}}</h2>
                    </div>
                    <div class="career-five-content">
                        <p class="mb-0">{!!$t_courses->description!!}</p>
                    </div>
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
            <div class="col-md-1 col-sm-12">
                <div class="coursescoreassignment">
                    <img src="../../../assets/img/list.png">
                </div>
            </div>
            <div class="col-md-1 col-sm-12">
                <div class="coursescoreassignment">
                    <img src="../../../assets/img/to-do-list.png">
                </div>
            </div>
            <div class="col-md-1 col-sm-12">
                <div class="coursescoreassignment">
                    <img class="alliconimg" src="../../../assets/img/file-sign.png">
                </div>
            </div>



        </div>
        <div class="allchaplesson2">
            <div class="row">
                <div class="col-lg-11 col-md-11 col-sm-12 aos-init aos-animate" data-aos="fade-down">
                    <div class="transform-access-content">
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
                                
                                    </h6>
                                </div>
                                <div id="collapseOne{{$lessions->id}}" class="card-collapse collapse @if($key == 0)show @endif" style="">
                                    <ul>
                                        @php
                                            $lecture = DB::table('lectures')->where('lession_id',$lessions->id)->get();
                                        @endphp
                                        @if(count($lecture)>0)
                                            @foreach($lecture as $lectures) 
                                            <li>
                                                <p><img src="assets/img/icon/play.svg" alt="" class="me-2">{{$lectures->title}}</p>
                                                <div style="position: initial;">
                                               <!--  <a href="{{url('/student/preview',$lectures->id)}}">Preview</a> -->
                                               <a href="{{url('/student/preview',$lectures->id)}}" id="" class=""><span  style="">      
                                               	<img class="alliconimg" src="../../../assets/img/arrow-sign.png"></span></a>
                                                </div>
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
                                <a href="{{url('/student/preview1',$t_courses->id)}}" id="" class="chapt-lession-side-arrowbtn"><span style="" title="Preview"><img class="alliconimg" src="../../../assets/img/arrow-sign.png"></span></a>
                            </div>
                            <!-- <div class="mb-4">
                                <a href="javascript:void(0)" id="add-game" data-id="{{$t_courses->id}}" class="chapt-lession-side-addbtn"><span style="" title="Add Course"><img class="alliconimg" src="../../../assets/img/plus-design.png"></span></a>
                            </div> -->
                        </div>
                        <div class="gamegameicon" id="gamegameiconblk">
                            <a href="javascript:void(0)" id="" class=""><span style="" ><img class="alliconimg" src="../../../assets/img/game-sign.png"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <div id="add-student-lesson" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="popup-add">
                        <form>
                            <div>
                                <label>Add Lesson</label>
                                <input class="form-control" type="text" name="" placeholder="Lesson">
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







    @endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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






    $(document).on('click', '#gamegameiconblk', function() {
        $('#addarrodivblk').toggle(500);
    });
    </script>