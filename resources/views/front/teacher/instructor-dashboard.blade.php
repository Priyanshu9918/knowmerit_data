@extends('layouts.teacher.master')
@section('content')

    <style type="text/css">
        .user-nav a.dropdown-toggle {
            display: block;
        }

        .modal-body {
            height: 257px;
            width: 500px;
            background-color: #f1faff;
        }

        .profile-share .btn-success {
            padding: 1px 13px;
            font-size: 13px;
        }

        .for-margin {
            margin: 20px;
        }

        .category-tab ul li a.active {
            border-radius: 0;
            border-bottom: 3px solid #009fff;
            color: #ffffff;
            background-color: #009fff;
            border-radius: 10px;
            padding: 5px 10px !important;
        }

        .enquiri span {
            font-size: 10px;
            background-color: #009fff;
            color: #fff;
            padding: 2px 4px;
            border-radius: 10px;
            position: absolute;
            top: 20%;
        }

        .enquiri {
            position: relative;
        }

        .tab-content {
            height: 70vh;
            overflow: scroll;
            overflow-x: hidden;
        }

        .datetimeli input[type="date"]::-webkit-datetime-edit-text,
        .datetimeli input[type="date"]::-webkit-datetime-edit-month-field,
        .datetimeli input[type="date"]::-webkit-datetime-edit-day-field,
        .datetimeli input[type="date"]::-webkit-datetime-edit-year-field {
            color: red;
        }
    </style>
    @php
        $id = Auth::user()->id;
        $Ecount = DB::table('bookclassenquiries')
            ->where('teacher_id', $id)
            ->where('status', 1)
            ->count();
        $user1 = DB::table('tutors')
            ->where('user_id', $id)
            ->first();
        if (isset($user1->category)) {
            $cat = explode(',', $user1->category);
            $student_enquiry2222 = DB::table('book_a_classes')
                ->whereIn('category', $cat)
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->get();
            // dd($student_enquiry2222);
        } else {
            $student_enquiry2222 = [];
        }
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
                                $data = DB::table('users')
                                    ->where('id', $id)
                                    ->first();
                                $datacon = DB::table('countries')
                                    ->where('id', $data->country)
                                    ->first();
                                $datatime = DB::table('time_zones')
                                    ->where('id', $data->timezone)
                                    ->first();
                            @endphp
                            <h4><a href="">{{ $datacon->name ?? '' }}</a></h4>
                            <p>{{ $datatime->timezone ?? '' }}</p>
                        </div>
                    </div>
                    @php
                        $user_id = Auth::user()->id;
                        $user1 = DB::table('users')
                            ->where('id', $user_id)
                            ->first();
                        $timezone = DB::table('time_zones')
                            ->where('id', $user1->timezone ?? 195)
                            ->first();
                        $tz = $timezone->timezone;
                        $timestamp = time();
                        $dt = new DateTime('now', new DateTimeZone($tz));
                        $dt1 = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                        $dt->setTimestamp($timestamp);
                    @endphp
                    <div class="profile-share d-flex align-items-center justify-content-center">
                        <p class="head-time-des">{{ $dt->format('h:ia') }} (UTC {{ $timezone->raw_offset }}.00)</p>
                        <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#timezone">Edit</a>
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
                                        <form action="{{ route('teacher.timezone2.create') }}" method="POST"
                                            id="teacher2Frm">
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
                                                <select class="form-select" aria-label="Default select example"
                                                    name="timezone3" id="timezone_id3">
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
                <div class="course-group mb-0 d-flex mt-3 mb-3"
                    style="background-color: #fff; padding: 22px; border-radius: 5px;">
                    <a href="{{ url('/teacher/calendar', ['id' => base64_encode(Auth::user()->id)]) }}" class="iconpadding">
                        <i class="fa fa-calendar icnfirst"></i>
                        <span> Availability</span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            @php
                $total_msg = DB::table('ch_messages')
                    ->where('seen', 0)
                    ->where('to_id', Auth::user()->id)
                    ->count('seen');
            @endphp
            <div class="col-md-3 col-sm-12">
                <div class="course-group mb-0 d-flex mt-3 mb-3"
                    style="background-color: #fff; padding: 22px; border-radius: 5px;">
                    <a href="{{ url('chatify') }}" class="iconpadding">
                        <i class="fa fa-comments icnfirst"></i>
                        <span> My Inbox</span>
                        <span class="spancunt">{{ $total_msg ?? 0 }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row pb-4" style="background-color: #4f94cf12; border-radius: 10px;">
            <!-- <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="course-group mb-0 d-flex mt-4 mb-4"
                            style="background-color: #fff; padding: 16px; border-radius: 5px;">
                            <div class="course-group-img d-flex align-items-center">
                                <div class="course-name">
                                    @php
                                        $id = Auth::user()->id;
                                        $data = DB::table('users')
                                            ->where('id', $id)
                                            ->first();
                                        $datacon = DB::table('countries')
                                            ->where('id', $data->country)
                                            ->first();
                                        $datatime = DB::table('time_zones')
                                            ->where('id', $data->timezone)
                                            ->first();
                                    @endphp
                                    <h4><a href="">{{ $datacon->name ?? '' }}</a></h4>
                                    <p>{{ $datatime->timezone ?? '' }}</p>
                                </div>
                            </div>
                            @php
                                $user_id = Auth::user()->id;
                                $user1 = DB::table('users')
                                    ->where('id', $user_id)
                                    ->first();
                                $timezone = DB::table('time_zones')
                                    ->where('id', $user1->timezone ?? 195)
                                    ->first();
                                $tz = $timezone->timezone;
                                $timestamp = time();
                                $dt = new DateTime('now', new DateTimeZone($tz));
                                $dt1 = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
                                $dt->setTimestamp($timestamp);
                            @endphp
                            <div class="profile-share d-flex align-items-center justify-content-center">
                                <p class="head-time-des">{{ $dt->format('h:ia') }} (UTC {{ $timezone->raw_offset }}.00)</p>
                                <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#timezone">Edit</a>
                                
                                @php
                                    $country = DB::table('countries')->get();
                                @endphp
                                <div class="modal" id="timezone">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            
                                            <div class="modal-header">
                                                <h4 class="modal-title" style="font-size: 18px;">Select Country And TimeZone</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            
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
                        <div class="course-group mb-0 d-flex mt-4 mb-4" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                            <a href="{{ url('/teacher/calendar', ['id' => base64_encode(Auth::user()->id)]) }}" class="iconpadding">
                                <i class="fa fa-calendar icnfirst"></i>
                                <span> Availability</span>
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="course-group mb-0 d-flex mt-4 mb-4" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                            <a href="{{ url('chatify') }}"  class="iconpadding">
                                <i class="fa fa-comments icnfirst"></i>
                                <span> Chats</span>
                                <span class="spancunt">4</span>
                            </a>
                        </div>
                    </div>
                </div> -->

            <div class="category-tab tickets-tab-blk enqui-task enqui12 teacherdashboardblock1">
                <ul class="nav nav-justified ">
                    <li class="nav-item"><a href="#upcoming" class="nav-link active" data-bs-toggle="tab"> UPCOMING</a>
                    <li class="nav-item"><a href="#past" class="nav-link enquiri" data-bs-toggle="tab"> PREVIOUS </a>
                    </li>
                    <!--  <li class="nav-item">{{-- <a href="#enquiries" class="nav-link enquiri" data-bs-toggle="tab"><i  style="margin-right: 3px;
                        color: #fcc62a;" class="fa fa-question-circle-o" aria-hidden="true"></i> Enquiries </a> --}}
                            <a href="#enquiries" class="nav-link enquiri" data-bs-toggle="tab" id="enquiry123"><i style="margin-right: 3px;
                            color: #fcc62a;" class="fa fa-question-circle-o" aria-hidden="true"></i> Enquiries
                                <span>{{ $Ecount }}</span></a>

                        </li> -->
                </ul>

                <ul class="datetimeli">
                    <li>
                        <label>From: </label>
                        <input type="date" name="start_time" placeholder="04/01/2024">
                    </li>
                    <li>
                        <label>To: </label>
                        <input type="date" name="end_time" placeholder="04/01/2024">
                    </li>
                    <li>
                        <select>
                            <option>Today</option>
                            <option>Tomorrow</option>
                            <option>10/01/2024</option>
                        </select>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="past">
                    <!-- <div class="noenquery">
                        <span class="noupcom">There is no upcoming session </span>
                    </div> -->
                    @php
                        $today1245 = Carbon\Carbon::now();
                        $dt1 = new \DateTime($today1245, new \DateTimeZone('UTC'));
                        $student_enquiry1 = App\Models\BookSession::where('teacher_id', auth()->user()->id)
                            ->where('end_time', '<', $dt1)
                            ->orderBy('start_time', 'ASC')
                            ->get();
                        $user_data = App\Models\BookSession::where('teacher_id', auth()->user()->id)
                            ->where('end_time', '<', $dt1)
                            ->orderBy('id', 'Desc')
                            ->pluck('student_id');
                        $us12e = DB::table('users')
                            ->whereIn('id', $user_data)
                            ->where('status', 1)
                            ->get();
                    @endphp
                    @if (count($us12e) > 0)
                        <div class="settings-top-widget ">
                            <div class="row">
                                <div class="top-headingg">
                                    <h3>Your Past Session</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 for_demo">
                                    <div class="settings-widget border-0">
                                        <div class="settings-inner-blk p-0 bg-transparent">
                                            <div class="comman-space pb-0 shadow-none">
                                                <div class="settings-tickets-blk course-instruct-blk table-responsive">
                                                    <table class="table table-nowrap mb-0">
                                                        <tbody>
                                                            @foreach ($student_enquiry1 as $st2)
                                                                @php

                                                                    $st3 = DB::table('students')
                                                                        ->where('user_id', $st2->student_id)
                                                                        ->first();
                                                                    // dd($st3);
                                                                    if (isset($st3)) {
                                                                        $avtar = DB::table('users')
                                                                            ->where('id', $st3->user_id)
                                                                            ->where('status', 1)
                                                                            ->first();

                                                                        $avtar1 = DB::table('users')
                                                                            ->where('id', Auth::user()->id)
                                                                            ->where('status', 1)
                                                                            ->first();
                                                                        $timezone = DB::table('time_zones')
                                                                            ->where('id', $avtar1->timezone ?? 195)
                                                                            ->first();

                                                                        $today124 = date('Y-m-d h:i A');
                                                                        $time_from_t145 = new \DateTime($today124, new \DateTimeZone('UTC'));
                                                                        $today = $time_from_t145;

                                                                        $time_from_t1 = new \DateTime($st2->start_time, new \DateTimeZone('UTC'));
                                                                        $time1 = $time_from_t1->format('Y-m-d h:i A');

                                                                        $time_from_t12 = new \DateTime($st2->end_time, new \DateTimeZone('UTC'));
                                                                        $e_time12 = $time_from_t12;

                                                                        if (isset($avtar)) {
                                                                            $cred = DB::table('credits')
                                                                                ->where('student_id', $st2->student_id)
                                                                                ->where('teacher_id', Auth::user()->id)
                                                                                ->where('class_id', $st2->class_id)
                                                                                ->where('sub_id', $st2->sub_id)
                                                                                ->first();
                                                                            if (isset($st2)) {
                                                                                $category1 = DB::table('categories')
                                                                                    ->where('id', $st2->class_id)
                                                                                    ->first();
                                                                                $subcat1 = DB::table('categories')
                                                                                    ->where('id', $st2->sub_id)
                                                                                    ->first();
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                                @if (isset($avtar))
                                                                    <tr style="border-bottom: 1px solid #e5dede;"
                                                                        class=" bg-white">
                                                                        <div class="tab12">
                                                                            <td>
                                                                                <a href="javascript:void(0)"
                                                                                    id="student2"
                                                                                    data-id="{{ $avtar->id }}"
                                                                                    data-cl="{{ $cred->class_id ?? 1 }}"
                                                                                    data-sub="{{ $cred->sub_id ?? 2 }}">
                                                                                    <div
                                                                                        class="sell-table-group d-flex align-items-center">
                                                                                        <div
                                                                                            class="sell-group-img student-news">
                                                                                            @if (isset($category1))
                                                                                                @if ($category1->image)
                                                                                                    <img src="{{ asset('uploads/categories/' . $category1->image) }}"
                                                                                                        class="img-fluid s-list"
                                                                                                        alt="">
                                                                                                @else
                                                                                                    <img src="{{ asset('assets//img/my-img/web_img/10.png') }}"
                                                                                                        class="img-fluid s-list"
                                                                                                        alt="">
                                                                                                @endif
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="sell-tabel-info">
                                                                                            <div
                                                                                                style="font-size: 20px;display: flex;">
                                                                                                @if (isset($subcat1->name))
                                                                                                    {{ $category1->name ?? '' }}
                                                                                                    -
                                                                                                    {{ $subcat1->name ?? '' }}
                                                                                                @else
                                                                                                    {{ $category1->name ?? '' }}
                                                                                                @endif
                                                                                            </div>
                                                                                            <span>{{ date('M d, Y h:i:sa', strtotime($time1)) }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </a>
                                                                            </td>

                                                                            <td style="text-align: end;"><img
                                                                                    src="{{ asset('assets/img/course/av.jpeg') }}"
                                                                                    style="width: 30px;" class="img-fluid"
                                                                                    alt=""><br>
                                                                                {{ $avtar->first_name ?? '' }}</td>
                                                                            @if ($st2->is_cancelled == 1)
                                                                                <td style="text-align: center;"><span
                                                                                        class="badge info-low"
                                                                                        style="color: #fff;border-radius: 7px!important;">Cancelled</span>
                                                                                </td>
                                                                            @else
                                                                                @if ($e_time12 < $today)
                                                                                    <td style="text-align: center;">
                                                                                        <span class="badge info-low"
                                                                                            style="color: #fff;border-radius: 7px!important;">Completed</span>
                                                                                    </td>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="no-up">
                                <div class="noenquery for-margin">
                                    <img src="{{ asset('no-data.gif') }}" alt="Girl in a jacket">
                                </div>
                                <div style="text-align:center;padding-top: 25px;">
                                    <span class="noupcom">There is no Past session </span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div id="data2"></div>
                </div>
                <div class="tab-pane fade" id="enquiries">
                    <!-- No Enquiry Task Start -->
                    @if (count($student_enquiry2222) > 0)
                        <div class="notify-sec">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="mt-2">Enquiries
                                    </h5>
                                    @foreach ($student_enquiry2222 as $st1)
                                        @php 
                                            $st = DB::table('book_a_classes')->where('id', $st1->id)->first();
                                         @endphp 
                                        @php
                                            $avtar = DB::table('users')
                                                ->where('id', $st->user_id)
                                                ->where('status', 1)
                                                ->first();
                                            // dd($avtar);
                                            $category = DB::table('categories')
                                                ->where('id', $st->category)
                                                ->where('status', 1)
                                                ->first();
                                            if (isset($st->sub_category)) {
                                                $subcat = DB::table('categories')
                                                    ->where('id', $st->sub_category)
                                                    ->where('status', 1)
                                                    ->first();
                                            }
                                        @endphp
                                        <div class="notify-item notify-msg">
                                            <div class="row align-items-center">
                                                <div class="col-md-9">
                                                    <div class="notify-content">
                                                        @if (isset($avtar->avatar))
                                                            <a href="#">
                                                                <img class="avatar-img semirounded-circle"
                                                                    src="{{ asset('uploads/tutors/' . $avtar->avatar) }}"
                                                                    alt="User Image">
                                                            </a>
                                                        @else
                                                            <a href="#">
                                                                <img class="avatar-img semirounded-circle"
                                                                    src="{{ asset('assets/img/user/av.jpg') }}"
                                                                    alt="User Image">
                                                            </a>
                                                        @endif
                                                        <div class="notify-detail">
                                                            <h6><a href="#">{{ $st->first_name ?? '' }}<br>
                                                                </a><span
                                                                    class="text-dark">{{ date('M d, Y ', strtotime($st->created_at)) }}</span>
                                                            </h6>
                                                            @if (isset($subcat->name))
                                                                <p class="cat-en">
                                                                    {{ $category->name ?? '' }} ,
                                                                    {{ $subcat->name ?? '' }}
                                                                </p>
                                                            @else
                                                                <p class="cat-en">
                                                                    {{ $category->name ?? '' }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-md-end">
                                                        @if (isset($st))
                                                            <a href="{{ url('/chatify/' . $st->user_id) }}"
                                                                class="btn">Chat</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="no-up">
                                <div class="no-enquiries">
                                    <img src="{{ asset('assets/img/my-img/enquiry123.1.png') }}" class="noenque">
                                    <h3 class="mt-4">No Enquiry Task </h3>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- All Enquiries End -->
                </div>
                <div class="tab-pane fade active show" id="upcoming">
                    @php
                        $today124 = Carbon\Carbon::now();
                        $dt = new \DateTime($today124, new \DateTimeZone('UTC'));
                        $student_enquiry12 = App\Models\BookSession::where('teacher_id', auth()->user()->id)
                            ->where('end_time', '>', $dt)
                            ->where('teacher_url', '<>', null)
                            ->orderBy('start_time', 'ASC')
                            ->get();
                        $user_data1 = App\Models\BookSession::where('teacher_id', auth()->user()->id)
                            ->where('end_time', '>', $dt)
                            ->orderBy('id', 'Desc')
                            ->pluck('student_id');
                        $us12e1 = DB::table('users')
                            ->whereIn('id', $user_data1)
                            ->where('status', 1)
                            ->get();
                    @endphp
                    @if (count($us12e1) > 0)
                        <div class="row">
                            <div class="mt-5 top-headingg">
                                <h3>Your Classrooms</h3>
                                <!-- <div class="top-class">
                                                <div class="top-view-c">
                                                    <h4>1:1</h4>
                                                </div>
                                                <div class="top-view-c1">
                                                    <h4>1:M</h4>
                                                </div>
                                            </div>
                                            <div class="right-icon"> <a href=""> <i class="feather-search icon-right"></i>
                                                </a> <a href=""> <i class="fa fa-calendar icon-right" aria-hidden="true"></i>
                                                </a> <a href=""> <i class="fa fa-plus icon-right" aria-hidden="true"></i> </a>
                                            </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 for_demo">
                                <div class="settings-widget border-0">
                                    <div class="settings-inner-blk p-0 bg-transparent">
                                        <div class="comman-space pb-0 shadow-none">
                                            <div class="settings-tickets-blk course-instruct-blk table-responsive">
                                                <table class="table table-nowrap mb-0">
                                                    <tbody>
                                                        @foreach ($student_enquiry12 as $key => $st212)
                                                            @php

                                                                $st3 = DB::table('students')
                                                                    ->where('user_id', $st212->student_id)
                                                                    ->where('status', 1)
                                                                    ->first();
                                                                if (isset($st3)) {
                                                                    $avtar = DB::table('users')
                                                                        ->where('id', $st3->user_id)
                                                                        ->where('status', 1)
                                                                        ->first();

                                                                    $avtar1 = DB::table('users')
                                                                        ->where('id', Auth::user()->id)
                                                                        ->where('status', 1)
                                                                        ->first();

                                                                    $timezone = DB::table('time_zones')
                                                                        ->where('id', $avtar1->timezone ?? 195)
                                                                        ->first();

                                                                    $ex_time1 = Carbon\Carbon::now()->addHour(2);
                                                                    $ex_time = new \DateTime($ex_time1, new \DateTimeZone('UTC'));
                                                                    $ex_time->setTimezone(new \DateTimeZone($timezone->timezone));
                                                                    $ex_t_date = $ex_time;

                                                                    $today22 = Carbon\Carbon::now();
                                                                    $time_from_t145 = new \DateTime($today22, new \DateTimeZone('UTC'));
                                                                    $time_from_t145->setTimezone(new \DateTimeZone($timezone->timezone));
                                                                    $today1 = $time_from_t145;

                                                                    $time_from_t1 = new \DateTime($st212->start_time, new \DateTimeZone('UTC'));
                                                                    $time_from_t1->setTimezone(new \DateTimeZone($timezone->timezone));
                                                                    $s_time = $time_from_t1;

                                                                    $time_from_t133 = new \DateTime($st212->start_time, new \DateTimeZone('UTC'));
                                                                    $time_from_t133->setTimezone(new \DateTimeZone($timezone->timezone));
                                                                    $time128 = $time_from_t133->format('Y-m-d h:i A');

                                                                    if (isset($avtar)) {
                                                                        $cred = DB::table('credits')
                                                                            ->where('student_id', $st212->student_id)
                                                                            ->where('teacher_id', Auth::user()->id)
                                                                            ->where('class_id', $st212->class_id)
                                                                            ->where('sub_id', $st212->sub_id)
                                                                            ->first();
                                                                        if (isset($st212)) {
                                                                            $category = DB::table('categories')
                                                                                ->where('id', $st212->class_id)
                                                                                ->first();
                                                                            // dd($category);
                                                                            $subcat = DB::table('categories')
                                                                                ->where('id', $st212->sub_id)
                                                                                ->first();
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            @if (isset($avtar))
                                                                <tr style="border-bottom: 1px solid #e5dede;"
                                                                    class=" bg-white">
                                                                    <div class="tab12">
                                                                        <td>
                                                                            <a href="javascript:void(0)" id="student1"
                                                                                data-id="{{ $avtar->id }}"
                                                                                data-cl="{{ $cred->class_id ?? 1 }}"
                                                                                data-sub="{{ $cred->sub_id ?? 1 }}">
                                                                                <div
                                                                                    class="sell-table-group d-flex align-items-center">
                                                                                    <div
                                                                                        class="sell-group-img student-news">
                                                                                        @if (isset($category))
                                                                                            @if ($category->image)
                                                                                                <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                                                                                    class="img-fluid s-list"
                                                                                                    alt="">
                                                                                            @else
                                                                                                <img src="{{ asset('assets//img/my-img/web_img/10.png') }}"
                                                                                                    class="img-fluid s-list"
                                                                                                    alt="">
                                                                                            @endif
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="sell-tabel-info">
                                                                                        <div
                                                                                            style="font-size: 20px;display: flex;">
                                                                                            @if (isset($subcat->name))
                                                                                                {{ $category->name ?? '' }}
                                                                                                -
                                                                                                {{ $subcat->name ?? '' }}
                                                                                            @else
                                                                                                {{ $category->name ?? '' }}
                                                                                            @endif
                                                                                        </div>
                                                                                        <span>{{ date('M d, Y h:i:sa', strtotime($time128)) }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </td>

                                                                        <td style="text-align: center;"><img
                                                                                src="{{ asset('assets/img/course/av.jpeg') }}"
                                                                                class="img-fluid" style="width: 30px"
                                                                                alt=""><br>
                                                                            <b>{{ $avtar->first_name ?? '' }}</b>
                                                                        </td>
                                                                        <!-- <td style="float: right;"> <a href="{{ $st212->student_url }}"><span
                                                                        class="badge info-low">Join Class</span> </a> </td> -->
                                                                        @if ($st212->is_cancelled == 1)
                                                                            <td style="text-align: center;"><span
                                                                                    class="badge info-low"
                                                                                    style="color: #fff;border-radius: 7px!important;">cancelled</span>
                                                                            </td>
                                                                        @else
                                                                            @if ($s_time < $today1)
                                                                                <td style="text-align: center;"><a
                                                                                        href="{{ $st212->teacher_url }}"><span
                                                                                            class="badge info-low"
                                                                                            style="color: #fff;border-radius: 7px!important;background-color: #009fff;">Join
                                                                                            Now</span></a></td>
                                                                            @else
                                                                                <td style="text-align: center;"
                                                                                    id="demo1{{ $st212->id }}">
                                                                                    @if ($ex_t_date <= $s_time)
                                                                                        <i id="cancel-reshed"
                                                                                            data-id="{{ $st212->id }}"
                                                                                            class="fa fa-times-circle close-v"
                                                                                            style="font-size:24px;color: #ff0909;">
                                                                                        </i>
                                                                                    @endif
                                                                                    <span class="badge info-low"
                                                                                        style="color: #fff;background-color: #f96d41;border-radius: 7px!important;">Starts
                                                                                        in <span
                                                                                            id="demo{{ $st212->id }}">
                                                                                        </span></span>
                                                                                </td>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                    <script>
                                                                        // Set the date we're counting down to
                                                                        var countDownDate{{ $st212->id }} = new Date("{{ $time128 }}").getTime();
                                                                        // Update the count down every 1 second
                                                                        var x{{ $st212->id }} = setInterval(function() {
                                                                            // Get today's date and time
                                                                            var now = new Date().getTime();
                                                                            // Find the distance between now and the count down date
                                                                            var distance = countDownDate{{ $st212->id }} - now;
                                                                            // Time calculations for days, hours, minutes and seconds
                                                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                                            // Output the result in an element with id="demo"
                                                                            document.getElementById('demo{{ $st212->id }}').innerHTML = days + "d " + hours + "h " +
                                                                                minutes + "m " + seconds + "s ";
                                                                            // If the count down is over, write some text
                                                                            if (distance < 0) {
                                                                                clearInterval(x{{ $st212->id }});
                                                                                document.getElementById('demo1{{ $st212->id }}').innerHTML =
                                                                                    '<a href="{{ $st212->teacher_url }}"><span class="badge info-low" style="color: #fff;border-radius: 7px!important;background-color: #009fff;">Join</span></a>';
                                                                            }
                                                                        }, 1000);
                                                                    </script>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="no-up">
                                <div class="noenquery for-margin">
                                    <img src="{{ asset('no-data.gif') }}" alt="Girl in a jacket">
                                </div>
                                <div style="text-align:center;padding-top: 25px;">
                                    <span class="noupcom">There is no Upcoming session</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div id="data1"></div>
                </div>
                <!-- Your Classrooms listing End -->
                <!-- Your Classrooms Details start -->
                <div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div id="reshedule-cancel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type="hidden" name="class_id123" value="" id="cncl_cls">
                <div class="modal-body">
                    <h5>Manage Booking Class</h5>
                    <button class="find_slot">Reschedule</button>
                    <button class="cancle1" style="background-color: red;">Cancel</button>
                </div>
            </div>

        </div>
    </div>
    <div id="confirm-cancel" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button id="cancel-btn-cancel" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h3>Are You Sure <br>You Want to Cancel?</h3>
                    <button>Ok</button>
                    <button style="background-color: red;">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="schedule-calendar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            {{-- style="max-width:70%;" --}}
            <div class="modal-content selectplan">
                <div class="modal-header">
                    <span><i class="fa-solid fa-chevron-left"></i></span>
                    <h1 class="modal-title fs-5">Schedule your lessons</h1>
                    <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
        <input type="hidden" id="session_id" name="session_id" value="">
        <input type="hidden" id="class_id" name="class_id" value="">
        <input type="hidden" id="sub_id" name="sub_id" value="">
        <input type="hidden" id="teacher_id" name="teacher_id" value="{{ auth()->user()->id }}">
        <input type="hidden" id="student_id" name="student_id" value="">
        <input type="hidden" id="date_time" name="date_time" value="">
    </form>

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).on("click", "#cancel-reshed", function() {
            var active = $(this).attr('data-id');
            $('#cncl_cls').val(active);
            $('#reshedule-cancel').modal('show');
        });
        $("#cancel-btn").on("click", function() {
            $('#reshedule-cancel').modal('hide');
        })
    </script>
    <script type="text/javascript">
        // $('.tab-value').click(function() {
        //     var t = $(this).text();
        //     $('#addbtn').html('Add' + t);
        // });
        $(document).on("click", ".find_slot", function() {
            var active = $('#cncl_cls').val();
            $.ajax({
                url: "{{ route('teacher.r_cal') }}",
                type: 'GET',
                data: {
                    id: active,
                },
                dataType: 'json',
                success: function(data) {
                    $('#class_id').val(data.class_id);
                    $('#sub_id').val(data.sub_id);
                    $('#student_id').val(data.student_id);
                    $('#session_id').val(data.session_id);
                    $('.time-frame').html(data.html);
                    $('#schedule-calendar').modal('show');

                    setTimeout(() => {
                        cal_init();
                    }, 200);
                }
            });

        });
        $(document).on('change', '.sub_category', function() {
            var id = $('#sub_category').val();
            $.ajax({
                type: "get",
                url: "{{ route('teacher.mcq-list') }}",
                data: {
                    'category': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.success == true) {
                        $("#test_title").empty();
                        $.each(data.value, function(key, value) {
                            $("#test_title").append('<option value="' + value.id + '">' +
                                value.mcq_title + '</option>');
                        });
                    }
                    if (data.success == false) {
                        $("#test_title").empty();
                    }
                }
            });
        });

        $(document).ready(function() {

            $(document).on('click', '.cancle1', function() {
                var active = $('#cncl_cls').val();
                Swal.fire({
                    title: 'Do you want to cancel the class?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $('.pre-loader').show();
                        $.ajax({
                            url: "{{ route('teacher.cancleclass') }}",
                            type: "get",
                            data: {
                                'active': active,
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.success == true) {
                                    window.location = "{{ url('/') }}" +
                                        "/teacher/teacher-instructor-dashboard";
                                    $('.pre-loader').hide();
                                }

                            }
                        });
                    }
                })
            });

            $(document).on('click', '#student1', function(event) {
                var id = $(this).attr('data-id');
                var class_id = $(this).attr('data-cl');
                var sub = $(this).attr('data-sub');
                $.ajax({
                    url: "{{ route('teacher.dash') }}",
                    type: "get",
                    data: {
                        'active': id,
                        'class': class_id,
                        'sub': sub
                    },
                    success: function(response) {
                        console.log(response);
                        $('#data1').replaceWith(response);
                    }
                });
            });
            $(document).on('click', '#student2', function(event) {
                var id = $(this).attr('data-id');
                var class_id = $(this).attr('data-cl');
                var sub = $(this).attr('data-sub');
                $.ajax({
                    url: "{{ route('teacher.dash') }}",
                    type: "get",
                    data: {
                        'active': id,
                        'class': class_id,
                        'sub': sub
                    },
                    success: function(response) {
                        console.log(response);
                        $('#data2').replaceWith(response);
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
                $('#learnMore123').modal('show');
                $('#category12').val('test');
                $('#head12').text('Add Tests');
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
                            toastr.success("Document Created successfully!");

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
                            toastr.success("Video Created successfully!");

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
        $(document).on('submit', 'form#createFrm12', function(event) {
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
                        toastr.success("MCQs Created successfully!");

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

        $(document).on('change', '.country', function() {
            var id = $('#country_id3').val();
            $.ajax({
                type: "post",
                url: "{{ route('timezone-list') }}",
                data: {
                    'country_id': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#timezone_id3").empty();
                    $("#timezone_id3").html('<option value="">Select Timezone</option>');
                    $.each(data, function(key, value) {
                        $("#timezone_id3").append('<option value="' + value.id + '">' + value
                            .timezone + '</option>');
                    });
                    $('#tiz4').removeClass('d-none');
                }
            });
        });

        $(document).on('submit', 'form#teacher2Frm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

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

                        toastr.success("Timezone updated Successfully");

                        // Swal.fire({
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: 'TimeZone Updated Successfully',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        //     })
                        window.setTimeout(function() {
                            // window.location = "{{ url('/') }}" + "/student/my-classes";
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
        $(document).on('click', '#enquiry123', function(event) {
            $.ajax({
                url: "{{ route('teacher.enqdata') }}",
                type: "get",
                data: {
                    'active': 'hello',
                },
                success: function(response) {
                    if (response.success == true) {

                    }
                }
            });
        });
    </script>
@endpush
