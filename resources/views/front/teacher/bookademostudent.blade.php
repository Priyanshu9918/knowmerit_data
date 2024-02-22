@extends('layouts.teacher.master')
@section('content')
<style type="text/css">
.student-list .instructor-list .instructor-content .rating-img,
.instructor-list .instructor-content .course-view {
    margin-bottom: 0px !important;
}

.student-list {
    padding: 10px 20px !important;
    margin-bottom: 15px !important;
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
.for-margin
{
    margin: 0%;
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
                        style="background-color: #fff; padding: 16px; border-radius: 5px;">
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
                    <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                        <a href="{{url('/teacher/calendar',['id'=>base64_encode(Auth::user()->id)])}}" class="iconpadding">
                            <i class="fa fa-calendar icnfirst"></i>
                            <span> Availability</span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                @php
                         $total_msg = DB::table('ch_messages')->where('seen', 0)->where('to_id', Auth::user()->id)->count('seen');
                        @endphp
                <div class="col-md-3 col-sm-12">
                    <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                        <a href="{{url('chatify')}}"  class="iconpadding">
                            <i class="fa fa-comments icnfirst"></i>
                            <span> My Inbox</span> 
                            <span class="spancunt">{{ $total_msg ?? 0 }}</span>
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
        $user_data = App\Models\Credit::where('teacher_id', auth()->user()->id)->orderBy('id', 'Desc')->pluck('student_id');
        $us12e = DB::table('users')->whereIn('id',$user_data)->where('status', 1)->get();
    @endphp
    <section class="student-section-des">

        <div class="row">

            <div class="col-lg-12">
                <div class="student-l">
                @if (count($us12e) > 0)
                @foreach ($student_enquiry1 as $st2)
                @php
                    $st3 = DB::table("students")->where('user_id',$st2->student_id)->first();
                    // dd($st2->student_id);
                    if(isset($st3)){
                        $avtar = DB::table('users')
                        ->where('id', $st3->user_id)
                        ->where('status', 1)
                        ->first();
                        if(isset($avtar)){
                            $cred = DB::table('credits')
                            ->where('student_id', $st3->user_id)->where('class_id',$st2->class_id)->where('teacher_id',Auth::user()->id)
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
                                <img src="{{asset('uploads/tutors/'.$avtar->avatar)}}" class="img-fluid s-list" alt="">
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
                    </a>
                    @php
                    $cat = DB::table('categories')
                        ->where('status', 3)
                        ->where('parent', 0)
                        ->first();
                    $sub_cat = DB::table('categories')
                        ->where('status', 3)
                        ->where('parent', 99999)
                        ->first();

                @endphp
                   @if (Auth::check() && Auth::user()->user_type == 2)
                    <a href="javascript:void(0)"
                    data-id="{{$st2->student_id}}"
                        data-class="{{$cat->id}}"
                        data-sub="{{$sub_cat->id}}"
                        class="discover-btn find_slot"
                        style="padding: 5px 15px;font-size: 14px;">Schedule Demo</a>
                        @endif
                    {{-- <div class="cat-count">
                        <span><i class="fa fa-arrow-circle-o-right" style="font-size: 22px; color: #009fff;"></i></span>
                    </div> --}}
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
                $student_enquiry123 = App\Models\Credit::where('teacher_id', auth()->user()->id)->orderBy('id', 'Desc')->get();
                $student_enquiry12 = App\Models\Credit::where('teacher_id', auth()->user()->id)->orderBy('id', 'Desc')->pluck('student_id');
                $us12 = DB::table('users')->whereIn('id',$student_enquiry12)->where('status', 1)->get();
            @endphp
        </div>
        {{-- <div class="col-lg-8" id="data1"> --}}
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
               {{-- <div class="row">
                     <div class="col-md-12 d-flex">
                        <div class="card instructor-card w-100" style="border: unset;
                                background-color: #fff3da;margin-bottom: 0;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="student-list flex-fill"
                                            style="background-color: #fff;align-items: unset;">
                                            <div class="student-img">
                                                @if (isset($avtar1->avatar))
                                                <img src="{{asset('uploads/tutors/'.$avtar1->avatar)}}"
                                                    class="img-fluid s-list" alt="" style="width: unset;
                                                        border-radius: 50%;">
                                                @else
                                                <img class="img-fluid s-list" src="{{ asset('assets/img/user/av.jpg') }}"
                                                    alt="User Image" style="width: unset;
                                                        border-radius: 50%;">
                                                @endif
                                            </div>
                                            <div class="student-content">
                                                <h5><a href="student-profile.html">{{ $avtar1->first_name ?? ''}}</a></h5>
                                                <!-- <h6>Grade KG </h6> -->
                                                <div class="featured-info-time d-flex align-items-center">
                                                    <div class="hours-time-two d-flex align-items-center">
                                                        <span><img
                                                                src="{{asset('assets//img/my-img/web_img/coin-img12.png')}}"
                                                                style="width: 22px;margin-right: 5px;margin-top: -4px;"></span>
                                                        <!-- <p>133</p> -->
                                                    </div>
                                                    <div class="course-view d-inline-flex align-items-center">
                                                        <div class="course-price">
                                                            <!-- <span style="background-color: #807f7f;
                                                    border-radius: 4px;padding: 2px;color: #fff;margin-left: 10px">1:4</span> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-md-4">
                                        <div class="sche">

                                            <a href="javascript:void(0)" data-id="{{$data1->student_id}}"
                                                data-class="{{$data1->class_id}}" data-sub="{{$data1->sub_id}}"
                                                class="discover-btn find_slot"
                                                style="padding: 5px 15px;font-size: 14px;">Schedule Class</a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>



                    </div> --}}
                    @endif
                    @endif
                    @endforeach
                {{--@php
                    if(isset($avtar1)){
                        $t_courses = DB::table('courses')->where('student_id',$avtar1->id)->get();
                    }
                @endphp
                @if(isset($t_courses))
                @foreach($t_courses as $s_crs)
                <div class="row">

                    <div id="instructor-box-dec" class="col-lg-6 col-md-6 d-flex mt-4">
                        <a href="{{url('/teacher/course-details12',$s_crs->id)}}">
                        <div class="instructor-box flex-fill ins-box1">
                            <div id="inst-img" class="instructor-img ins-img">
                                <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}"> -->
                                    <img class="img-fluid" alt=""
                                        src="{{asset('uploads/course/'.$s_crs->image)}}">
                               <!--  </a> -->
                                <div class="overlay icon">
                                  <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}" class="icon" title="User Profile"> -->
                                    <i class="fa fa-pencil"></i>
                                  <!-- </a> -->
                                  </div>
                            </div>
                            <div class="instructor-content">
                                <div class="text-v">
                                    <h5 style="font-size: 0.25rem;"><a
                                            href="{{url('/teacher/course-details12',$s_crs->id)}}"
                                            style="font-size: 16px">{{$s_crs->title ?? ''}}</a></h5>
                                </div>
                                <div class="instruct-stip d-flex align-items-center">
                                    <div class="course-stip progress-stip">
                                        <span class="per-cross" style="color: #000!important;font-size: 14px;">0%</span>
                                        <!-- <div class="progress-bar bg-success progress-bar-striped active-stip"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                    @endforeach
                    @endif
                </div>--}}
                @endif
            </div>
    </section>



</div>
</div>




  <!--   <div id="add-student-Modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-body">
                <ul>
                    <li><i class="fa fa-align-left" aria-hidden="true"></i> Web Content</li>
                    <li><i class="fa fa-video-camera" aria-hidden="true"></i> Video</li>
                    <li><i class="fa fa-volume-off" aria-hidden="true"></i> Audio</li>
                    <li><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> Presentation | Document</li>
                    <li><i class="fa fa-bars" aria-hidden="true"></i> SCORM | xAPI | cmi5</li>
                    <li><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> iFrame</li>
                    <li><i class="fa fa-file-text" aria-hidden="true"></i> Test</li>
                    <li><i class="fa fa-area-chart" aria-hidden="true"></i> Survey</li>
                    <li><i class="fa fa-book" aria-hidden="true"></i>Assignment</li>
                    <li><i class="fa fa-address-card-o" aria-hidden="true"></i> Instructor-led Training</li>
                    <li><i class="fa fa-bars" aria-hidden="true"></i> Section</li>
                    <li><i class="fa fa-clone" aria-hidden="true"></i> Clone from another course</li>
                    <li><i class="fa fa-link" aria-hidden="true"></i> Link from another course</li>

                </ul>
          </div>

        </div>

      </div>
    </div>

 -->











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

    <form action="" method="" class="d-none" id="boking_form">
        <input type="hidden" id="class_id" name="class_id" value="">
        <input type="hidden" id="sub_id" name="sub_id" value="">
        <input type="hidden" id="teacher_id" name="teacher_id" value="{{ auth()->user()->id }}">
        <input type="hidden" id="student_id" name="student_id" value="">
        <input type="hidden" id="date_time" name="date_time" value="">
    </form>
    @endsection
    @push('script')
    <script type="text/javascript">
       $(document).ready(function() {
        $(document).on("click", ".find_slot", function() {
            var c_id = $(this).attr('data-class');
            var s_id = $(this).attr('data-sub');
            var st_id = $(this).attr('data-id');
            $('#student_id').val(st_id);
            if (c_id == '') {
                alert('Please select at least 1 lession rule');
            } else {
                $.ajax({
                    url: "{{ route('teacher.student.cal') }}",
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

    });
    </script>




    @endpush
