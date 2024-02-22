@extends('layouts.teacher.master')
@section('content')
<style type="text/css">
.student-list .instructor-list .instructor-content .rating-img,
.instructor-list .instructor-content .course-view {
    margin-bottom: 0px !important;
}

.student-list {
    /*padding: 10px 20px !important;*/
    /*margin-bottom: 15px !important;*/
}

.instructor-list .instructor-content .rating-img,
.instructor-list .instructor-content .course-view {
    margin-bottom: 0px !important;
}

.student-info {
    padding-left: 5px;
}

.instructor-info i {
    color: #685F78;
}

.instructor-content h6 {
    color: #685F78;
    margin-bottom: 6px !important;
}

.category-box {
    margin-bottom: 11px;
    padding: 11px;
}
.category-tab ul li a.active {
    border-radius: 0;
    border-bottom: 3px solid #009fff;
    color: #ffffff;
    background-color: #009fff;
    border-radius: 10px;
    padding: 5px 10px !important;
}

</style>
@php
$id = Auth::user()->id;
$user1 = DB::table('tutors')
->where('user_id', $id)
->first();
$latitude = $user1->lat;
$longitude = $user1->lng;
$student_enquiry = DB::table('book_a_classes')
->select(
'book_a_classes.id',
DB::raw(
'6371 * acos(cos(radians(' .
$latitude .
"))
* cos(radians(book_a_classes.lat))
* cos(radians(book_a_classes.lng) - radians(" .
$longitude .
"))
+ sin(radians(" .
$latitude .
"))
* sin(radians(book_a_classes.lat))) AS distance",
),
)
->orderBy('created_at', 'Desc')
->get();
@endphp

<div class="col-xl-9 col-lg-8 col-md-12">

        <div class="row" style="background-color: #4f94cf12; border-radius: 10px; margin-bottom: 10px;">
                <div class="col-md-6 col-sm-12">
                    <div class="course-group mb-0 d-flex mt-3 mb-3"
                        style="background-color: #fff; padding: 10px; border-radius: 5px;">
                        <div class="course-group-img d-flex align-items-center">
                            <div class="course-name">
                                @php
                                $id = Auth::user()->id;
                                $data = DB::table('users')->where('id' ,$id)->first();
                                $datacon = DB::table('countries')->where('id',$data->country)->first();
                                $datatime = DB::table('time_zones')->where('id',$data->timezone)->first();
                                @endphp
                                <h4><a href="">{{ $datacon->name ?? '' }}</a></h4>
                                <p>{{ $datatime->timezone ?? '' }}</p>
                            </div>
                        </div>
                        @php
                        $user_id = Auth::user()->id;
                        $user1 = DB::table('users')->where('id',$user_id)->first();
                        $timezone = DB::table('time_zones')->where('id',$user1->timezone ?? 195)->first();
                        $tz = $timezone->timezone;
                        $timestamp = time();
                        $dt = new DateTime("now", new DateTimeZone($tz));
                        $dt1 = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                        $dt->setTimestamp($timestamp);
                        @endphp
                        <div class="profile-share d-flex align-items-center justify-content-center">
                            <p class="head-time-des">{{$dt->format('h:ia')}} (UTC {{$timezone->raw_offset}}.00)</p>
                            <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#timezone">Edit</a>
                            <!-- The Modal -->
                            @php
                            $country = DB::table('countries')->get();
                            @endphp
                            <div class="modal" id="timezone">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="font-size: 18px;">Select Country And TimeZone</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="{{ route('teacher.timezone2.create') }}" method="POST" id="teacher2Frm">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="sel1">Country</label>
                                                    <select class="form-select country" aria-label="Default select example"
                                                        name="country3" id="country_id3">
                                                        <option>Select country</option>
                                                        @if (count($country) > 0)
                                                        @foreach ($country as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group container d-none" id="tiz4">
                                                    <label for="sel1">TimeZone</label>
                                                    <select class="form-select" aria-label="Default select example" name="timezone3"
                                                        id="timezone_id3">
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 22px; border-radius: 5px;">
                        <a href="{{url('/teacher/calendar',['id'=>base64_encode(Auth::user()->id)])}}" class="iconpadding">
                            <i class="fa fa-calendar icnfirst"></i>
                            <span> Availability</span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 22px; border-radius: 5px;">
                        <a href="{{url('chatify')}}"  class="iconpadding">
                            <i class="fa fa-comments icnfirst"></i>
                            <span> My Inbox</span> 
                            <span class="spancunt">4</span>
                        </a>
                    </div>
                </div>
            </div>
<div class="row" style="background-color: #4f94cf12; border-radius: 10px;">


    <!-- <div class="profile-title">
        <h3>Student</h3>
    </div> -->
    @php
    $student_enquiry1 = App\Models\Credit::where('teacher_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
    // dd($student_enquiry1);
    $user_data = App\Models\Credit::where('teacher_id', auth()->user()->id)->orderBy('id', 'Desc')->pluck('student_id');
    $us12e = DB::table('users')->whereIn('id',$user_data)->where('status', 1)->get();
    @endphp
    <div class="category-tab tickets-tab-blk enqui-task mb-0 enqui12 teacherdashboardblock1">
        <ul class="nav nav-justified ">
            <li class="nav-item"><a href="#mystudents" class="nav-link active" data-bs-toggle="tab"> My students</a>
            <li class="nav-item"><a href="#batches" class="nav-link enquiri" data-bs-toggle="tab"> Batches </a></li>
          
        </ul>

    </div>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="mystudents">
            <section class="student-section-des">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="student-l pt-0">
                            <div class="mb-3">
                                <input type="search" class="form-control" id="search1" placeholder="Search">
                              </div>
                            @if (count($us12e) > 0)
                            @foreach ($student_enquiry1 as $st2)
                            @php
                            // dd( $st2);
                            $st3 = DB::table("students")->where('user_id',$st2->student_id)->first();
                            // dd( $st3);
        
                            if(isset($st3)){
                            $avtar = DB::table('users')
                            ->where('id', $st3->user_id)
                            ->where('status', 1)
                            ->first();
                            if(isset($avtar)){
                            $cred = DB::table('credits')
                            ->where('student_id',
                            $st3->user_id)->where('class_id',$st2->class_id)->where('teacher_id',Auth::user()->id)
                            ->first();
                            if(isset($cred))
                            {
                            $category = DB::table('categories')
                            ->where('id', $cred->class_id)
                            ->where('status', 1)
                            ->first();
                            if (isset($st->sub_category)) {
                            $subcat = DB::table('categories')
                            ->where('id', $cred->sub_id)
                            ->where('status', 1)
                            ->first();
                            }
                            }
                            }
                            }
                            @endphp
                            @if(isset($avtar))
                            <div class="category-box">
                                <a href="javascript:void(0)" id="student1" data-id="{{ $avtar->id }}">
                                    <div class="category-title">
                                        <div class="category-img">
                                            @if(isset($avtar))
                                            @if (isset($avtar->avatar))
                                            <img src="{{asset('uploads/tutors/'.$avtar->avatar)}}" class="img-fluid s-list"
                                                alt="">
                                            @else
                                            <img class="img-fluid s-list" src="{{ asset('assets/img/user/av.jpg') }}"
                                                alt="User Image">
                                            @endif
                                            @endif
                                        </div>
                                        @if(isset($avtar))
                                        <h5>{{ $avtar->first_name ?? '' }}</h5>
                                        @endif
                                    </div>
        
                                    <div class="cat-count">
                                        <span><i class="fa fa-arrow-circle-o-right"
                                                style="font-size: 22px; color: #009fff;"></i></span>
                                    </div>
                                </a>
                            </div>
                            @endif
                            @endforeach
                            @else
                            <div class="row">
                                <div class="no-up">
                                    <div class="noenquery for-margin">
                                        <img src="{{asset('no-data.gif')}}" alt="Girl in a jacket">
                                    </div>
                                    <div style="text-align:center;padding-top: 25px;">
                                        <span class="noupcom">There is no student assign </span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{--<div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>
                            <div class="category-box">
                                <div class="category-title">
                                    <div class="category-img">
                                        <img src="http://merit.techsaga.live/assets/img/course/course-10.jpg" class="img-fluid s-list" alt="">
                                    </div>
                                    <h5>Naveen-KG</h5>
                                </div>
                                <div class="cat-count">
                                    <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px;
                                    color: #009fff;"></i></span>
                                </div>
                            </div>--}}
                        </div>
                        @php
                        $student_enquiry123 = App\Models\Credit::where('teacher_id', auth()->user()->id)->orderBy('id',
                        'Desc')->get();
                        $student_enquiry12 = App\Models\Credit::where('teacher_id', auth()->user()->id)->orderBy('id',
                        'Desc')->pluck('student_id');
                        $us12 = DB::table('users')->whereIn('id',$student_enquiry12)->where('status', 1)->get();
                        @endphp
                    </div>
                    <div class="col-lg-8" id="data1">
                        @if (count($us12) > 0)
                        @foreach($student_enquiry123 as $key=>$data1)
                        @if($key == 0)
                        @php
                        $st31 = DB::table('students')
                        ->where('user_id', $data1->student_id)
                        ->first();
        
                        if(isset($st31)){
                        $avtar1 = DB::table('users')
                        ->where('id', $st31->user_id)
                        ->where('status', 1)
                        ->first();
                        }
                        @endphp
                        @if(isset($avtar1))
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <div class="card instructor-card w-100" style="border: unset;margin-bottom: 0;">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="col-md-8">
                                                <div class="student-list mb-0 p-0 border-0 flex-fill"
                                                    style="align-items: unset;">
                                                    <div class="student-img">
                                                        @if (isset($avtar1->avatar))
                                                        <img src="{{asset('uploads/tutors/'.$avtar1->avatar)}}"
                                                            class="img-fluid s-list" alt="" style="
                                                                border-radius: 50%;">
                                                        @else
                                                        <img class="img-fluid s-list"
                                                            src="{{ asset('assets/img/user/av.jpg') }}" alt="User Image" style="
                                                                border-radius: 50%;">
                                                        @endif
                                                    </div>
                                                    <div class="student-content">
                                                        <h5><a href="javascript:void(0)">{{ $avtar1->first_name ?? ''}}</a></h5>
                                                        <h6 class="mb-1">ID - </h6>
                                                        <h6 class="mb-1">Credits - </h6>
                                                        <!-- <div class="featured-info-time d-flex align-items-center">
                                                            <div class="hours-time-two d-flex align-items-center">
                                                                <span><img
                                                                        src="{{asset('assets//img/my-img/web_img/coin-img12.png')}}"
                                                                        style="width: 22px;margin-right: 5px;margin-top: -4px;"></span>
                                                                
                                                            </div>
                                                            <div class="course-view d-inline-flex align-items-center">
                                                                <div class="course-price">
                                                                   
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="col-md-4">
                                                <div class="d-flex flex-wrap justify-content-end ">
                                                    <div class="w-100 d-flex justify-content-between">
                                                        <a href="#"><img style="width: 25px;height: 25px;" class="mb-4" src="https://i.postimg.cc/prrxht26/4.jpg" alt="" /></a>
                                                        <a href="#"><img style="width: 25px;height: 25px;" class="mb-4" src="https://i.postimg.cc/vB3bZmdn/3.jpg" alt="" /></a>
                                                        <a href="#"><img style="width: 25px;height: 25px;" class="mb-4" src="https://i.postimg.cc/W32sVkxj/2.jpg" alt="" /></a>
                                                        <a href="#"><img style="width: 25px;height: 25px;" class="mb-4" src="https://i.postimg.cc/QMgjvb40/1.jpg" alt="" /></a>
                                                    </div>
                                                    <a href="javascript:void(0)" data-id="{{$data1->student_id}}"
                                                        data-class="{{$data1->class_id}}" data-sub="{{$data1->sub_id}}"
                                                        class="discover-btn find_slot w-100"
                                                        style="padding: 5px 15px;font-size: 14px;">Schedule Class</a>
                                                </div>
                                            </div>
        
        
                                        </div>
                                    </div>
                                </div>
        
        
        
                            </div>
                            @endif
                            @endif
                            @endforeach
                            @php
                            if(isset($avtar1)){
                            $st_data = DB::table('assign_courses')->where('student_id',$avtar1->id)->pluck('course_id');
                            if(isset($st_data)){
                                $t_courses = DB::table('courses')->whereIn('id',$st_data)->get();
                            }
                            }
                            @endphp
                            @if(isset($t_courses))
                            <div class="row">
                                @foreach($t_courses as $s_crs)
        
                                <div id="instructor-box-dec" class="col-lg-6 col-md-6 d-flex mt-4">
                                    <a href="{{url('/teacher/course-details12',['st_id' => $avtar1->id, 'id' => $s_crs->id])}}">
                                        <div class="instructor-box flex-fill ins-box1">
                                            <div id="inst-img" class="instructor-img ins-img">
                                                <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}"> -->
                                                <img class="img-fluid" alt="" src="{{asset('uploads/course/'.$s_crs->image)}}">
                                                <!--  </a> -->
                                                <div class="overlay icon">
                                                    <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}" class="icon" title="User Profile"> -->
                                                    <i class="fa fa-pencil"></i>
                                                    <!-- </a> -->
                                                </div>
                                            </div>
                                    </a>
                                    <a href="{{url('/teacher/course-details12',['st_id' => $avtar1->id, 'id' => $s_crs->id])}}" style="font-size: 16px">
                                        <div class="instructor-content">
                                            <div class="text-v">
                                                <h3 style="font-size: 17px; font-weight: 600;">{{$s_crs->title ?? ''}}</h3>
                                                @if(isset($s_crs->short_description))
                                                <h6 style="font-size: 15px">{!! substr($s_crs->short_description,0,50)?? ''
                                                    !!}...</h6>
                                                @endif
                                            </div>
        
                                            <div class="instruct-stip d-flex align-items-center">
                                                @php
                                                $total = Helper::PercentageCourse($s_crs->id);
                                                @endphp
                                                <div class="course-stip progress-stip">
                                                    @if($total == 0)
                                                    <span class="per-cross" style="color: #000!important">{{$total}}%</span>
                                                    @else
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: {{round($total)}}%;" aria-valuenow="{{round($total)}}"
                                                        aria-valuemin="0" aria-valuemax="100">{{round($total)}}%</div>
                                                    @endif
                                                    <!-- <span class="per-cross" style="color: #000!important;font-size: 14px;">0%</span> -->
                                                    <!-- <div class="progress-bar bg-success progress-bar-striped active-stip"></div> -->
                                                </div>
                                            </div>
                                        </div>
                                </div></a>
                            </div>
                            @endforeach
                            @endif
                            <div class="col-lg-12 col-md-12 d-flex justify-content-end">
                                
                                <div href="javascript:void(0)" class="position-relative" >
                                    <i class="fa fa-plus-circle" id="addbtnsforthis" ></i>
                                        <div class="addModaldetails bg-white position-absolute" style="display:none;" >
                                            <ul>
                                                <li><a href="javascript:void(0)" data-id="{{$avtar1->id}}" id="import_course"> Import Course</a></li>
                                                <li><a href="{{url('teacher/add-lession',$avtar1->id)}}" class="border-0"> Create Course</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                
                            </div>
                            <div id="iframe" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!-- <button id="iframe-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                                        </div>
                                        <div class="modal-body">
                                            <div class="popup-add">
                                            <form action="{{route('teacher.course-assign')}}" method="POST" id="coursecreate" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="student_id1" id="student_id1" value="">
                                                    @php 
                                                        $a_c_id = DB::table('assign_courses')->where('student_id', $avtar1->id)->pluck('course_id');
                                                        $data = DB::table('assign_teachers')->whereNotIn('course_id', $a_c_id)->get();
                                                    @endphp
                                                    <div>
                                                        <label>Select Courses</label>
                                                        <select class="form-control" name="course">
                                                            <option value="">Select Course</option>
                                                            @foreach ($data as $courses)
                                                                @php 
                                                                    $data1 = DB::table('courses')->where('id', $courses->course_id)->first();
                                                                @endphp
                                                                <option value="{{ $data1->id }}">{{ $data1->title }}</option>
                                                            @endforeach
                                                        </select>                                
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-course"></p>
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
                        </div>
                        @endif
            </div>
    </section>
</div>


</div>



    <div class="modal fade" id="schedule-calendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            {{-- style="max-width:70%;" --}}
            <div class="modal-content selectplan">
                <div class="modal-header">
                    <span><a href="{{ URL::previous() }}"><i class="fa-solid fa-chevron-left"></i></a></span>
                    <h1 class="modal-title fs-5">Schedule your lessons</h1>
                    <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body time-frame" style="width:100%">
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
</div>




 



    <form action="" method="" class="d-none" id="boking_form">
        <input type="hidden" id="class_id" name="class_id" value="">
        <input type="hidden" id="sub_id" name="sub_id" value="">
        <input type="hidden" id="teacher_id" name="teacher_id" value="{{ auth()->user()->id }}">
        <input type="hidden" id="student_id" name="student_id" value="">
        <input type="hidden" id="date_time" name="date_time" value="">
    </form>
    @endsection
    @push('script')



     <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script><script  src="./script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{asset('/ckeditor/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
    // $('.tab-value').click(function() {
    //     var t = $(this).text();
    //     $('#addbtn').html('Add' + t);
    // });
    $(document).ready(function() {

    $(document).on('click', '#import_course', function() {
        var st_id = $(this).attr('data-id');
        $('#student_id1').val(st_id);
        $('#iframe').modal('show');  
        $('#addModaldetails').modal('hide');
    });

    $(document).on('submit', 'form#coursecreate', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");
            var title = $('div.iti__selected-flag').attr('title');
            var form = $(this);
            var data = new FormData($(this)[0]);
            data.append("c_code", title);
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
                        toastr.success("Course Import successfully!");
                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'user Created Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        //     })
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

        $(document).on("click", ".find_slot", function() {
            var c_id = $(this).attr('data-class');
            var s_id = $(this).attr('data-sub');
            var st_id = $(this).attr('data-id');
            $('#student_id').val(st_id);
            if (c_id == '') {
                alert('Please select at least 1 lession rule');
            } else {
                $.ajax({
                    url: "{{ route('teacher.cal') }}",
                    type: 'GET',
                    data: {
                        c_id: c_id,
                        s_id: s_id,
                        st_id: st_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#class_id').val(data.class_id);
                        $('#sub_id').val(data.sub_id);
                        $('.time-frame').html(data.html);
                        $('#schedule-calendar').modal('show');

                        setTimeout(() => {
                            cal_init();
                        }, 200);
                    }
                });
            }
        });
        $(document).on('click', '#student1', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('teacher.dash1') }}",
                type: "get",
                data: {
                    'active': id,
                },
                success: function(response) {
                    console.log(response);
                    $('#data1').replaceWith(response);
                }
            });
        });
        $(document).on('click', '#video', function(event) {
            $('#addvideo').removeClass('d-none');
            $('#addhome').addClass('d-none');
            $('#addtest').addClass('d-none');
            $('#adddoc').addClass('d-none');
        });
        $(document).on('click', '#home', function(event) {
            $('#addvideo').addClass('d-none');
            $('#addhome').removeClass('d-none');
            $('#addtest').addClass('d-none');
            $('#adddoc').addClass('d-none');
        });
        $(document).on('click', '#test', function(event) {
            $('#addvideo').addClass('d-none');
            $('#addhome').addClass('d-none');
            $('#addtest').removeClass('d-none');
            $('#adddoc').addClass('d-none');
        });
        $(document).on('click', '#doc', function(event) {
            $('#addvideo').addClass('d-none');
            $('#addhome').addClass('d-none');
            $('#addtest').addClass('d-none');
            $('#adddoc').removeClass('d-none');
        });
        $(document).on('click', '#addvideo', function(event) {
            $('#learnMore1').modal('show');
            $('#category').val('video');
            $('#head').text('Add Video');
        });
        $(document).on('click', '#addhome', function(event) {
            $('#learnMore12').modal('show');
            $('#category1').val('homework');
            $('#head1').text('Add HomeWork');
        });
        $(document).on('click', '#addtest', function(event) {
            $('#learnMore12').modal('show');
            $('#category1').val('test');
            $('#head1').text('Add Tests');
        });
        $(document).on('click', '#adddoc', function(event) {
            $('#learnMore12').modal('show');
            $('#category1').val('document');
            $('#head1').text('Add Documents');
        });
        $(document).on('submit', 'form#createFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");
            var title = $('div.iti__selected-flag').attr('title');
            var form = $(this);
            var data = new FormData($(this)[0]);
            data.append("c_code", title);
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
                        toastr.success("AboutUs Created successfully!");
                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'user Created Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        //     })
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
            var title = $('div.iti__selected-flag').attr('title');
            var form = $(this);
            var data = new FormData($(this)[0]);
            data.append("c_code", title);
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
                        toastr.success("AboutUs Created successfully!");
                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'user Created Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        //     })
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
        $(document).on('click', '#addbtnsforthis', function() {
                $('.addModaldetails').toggle();
            });
    </script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).on("click","#add-student",function(){
        var id = $(this).attr('data-id');
        var url = '{{url('teacher/add-lession',':id')}}';
        url = url.replace('%3Aid', id);
        $(".pks").attr('href',url);
        $('#add-student-Modal').modal('show');
        return false;
        });
        $("#cancel-btn").on("click", function()
        {
            $('#add-student-Modal').modal('hide');
        })
    </script> -->




    @endpush