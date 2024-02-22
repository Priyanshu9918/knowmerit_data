@extends('layouts.teacher.master')
@section('content')
    <style>
        .weeklist div.fw-bold:first-child {
            flex-basis: 20%;
        }

        .weeklist .fa-plus {
            cursor: pointer;
        }

        .weeklist {
            border: 1px solid #e9ecef;
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
            position: relative;
        }

        .f-basis-45 {
            flex-basis: 45%;
        }

        .filter-menu {
            display: none;
            position: absolute;
            top: 40px;
            background: #fff;
            padding: 15px 20px;
            border: 1px solid #00000029;
            right: -50px;
            z-index: 99;
            box-shadow: 2px 2px 8px #0000001f;
        }

        /*.nav-tabs{
      width: fit-content;
      background-color: #009fff;
      margin: auto;
      border-radius: 10px;
       overflow: hidden;
      border-bottom:none;
     }
     .nav-tabs .nav-link{
      color: #fff;
      border: 4px solid #009fff !important;
      
      border-radius: 10px;
      font-weight: 600;
     }*/
        .text-danger,
        .dropdown-menu>li>a.text-danger {
            color: #fbb116 !important;
        }

        /*.nav-tabs .nav-link.active {
        color: #009fff!important;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
        border: 4px solid #009fff !important;
        border-radius: 10px;
    }*/
        .toastui-calendar-panel.toastui-calendar-time {
            height: 550px !important;
        }

        .toastui-calendar-event-time {
            width: 100% !important;
            left: 0px !important;
            margin-left: 0px !important;
        }

        #home {
            overflow: scroll;
            overflow-x: hidden;
            //height: 88vh;
        }

        .web11 {
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
            position: relative;
            left: 615px;
        }

        .red-fs-22 {
            font-size: 22px;
            color: red;
        }
        .carrowbtn{
            border-radius: 30px;
            height: 30px;
            padding: 0;
            width: 30px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/css/date-style.css') }}">

    <div class="col-xl-9 col-lg-8 ">
        
        <div class="row" style="background-color: #4f94cf12; border-radius: 10px; margin-bottom: 10px;" >
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
        <div  class="row" style="background-color: #4f94cf12; border-radius: 10px;">
        @if (Session::has('success'))
            <div class="alert alert-success my-toast">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger my-toast">{{ Session::get('error') }}</div>
        @endif


        <div class="forcalendertab d-flex justify-content-between align-items-center mt-3">

            <ul class="nav nav-tabs justify-content-center align-items-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Availability </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">Calendar</button>
                </li>
            </ul>
            <ul>
                <li><button type="submit" class="btn btn-primary" style="width:200px" id="sub_data">Submit</button></li>
            </ul>
            <div class="calendar-today-des" style="display:none;">
                <button class="btn btn-primary carrowbtn btn-prev"> <i class="fa-solid fa-arrow-left"></i></button>
                <button class="btn btn-primary btn-today">Today</button>
                <button class="btn btn-primary carrowbtn btn-nxt"> <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
        <!-- <div class="web11 d-flex justify-content-between	">
                        <button type="submit" class="btn btn-primary" style="width:200px" id="sub_data">Submit</button>
                    </div> -->
        <div class="tab-content px-4" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8 calen-padding">
                        <h3>Set your weekly hours</h3>
                        <form action="{{ route('teacher.availability.update', ['id' => base64_encode($user_id)]) }}"
                            method="post">
                            @csrf
                            <input type="hidden" id="user_id" name="user_id" value="{{ $user_id ?? '' }}">
                            <div class="weeklist d-flex justify-content-between	">
                                <div class="fw-bold">Sunday</div>
                                @if (count($times1) == 0)
                                    <div class="text-danger un-lable">Unavailable</div>
                                @endif
                                <div class="input-date-box">
                                    <div class="appendboxDate" data-id="1">
                                        @if (count($times1) > 0)
                                            @foreach ($times1 as $day)
                                                <div
                                                    class="slot-item d-flex align-items-center justify-content-between mb-3">
                                                    @php
                                                        $time_from = date('Y-m-d') . ' ' . $day->time_from;
                                                        $time_to = date('Y-m-d') . ' ' . $day->time_to;

                                                        $time_from_t1 = new \DateTime($time_from, new \DateTimeZone('UTC'));
                                                        $time_to_t1 = new \DateTime($time_to, new \DateTimeZone('UTC'));

                                                        $time_from_t1->setTimezone(new \DateTimeZone($tz));
                                                        $time_to_t1->setTimezone(new \DateTimeZone($tz));

                                                        $tf_time = $time_from_t1->format('h:i A');
                                                        $tt_time = $time_to_t1->format('h:i A');
                                                    @endphp
                                                    <input type="text" placeholder="From :"
                                                        class="form-control timepicker f-basis-45" name="f1[]"
                                                        value="{{ $tf_time }}" />
                                                    <label class="m-0">-</label>
                                                    <input type="text" placeholder="To :"
                                                        class="form-control timepicker f-basis-45" name="t1[]"
                                                        value="{{ $tt_time }}" />
                                                    <i class="fa-solid fa-trash removeMon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class=" d-flex ">
                                    <div class="pe-2"><i class="fa-solid addItembtn fa-plus" data-f="f1[]"
                                            data-t="t1[]"></i></div>
                                    <div class="pe-2 filterbtn"><i class="fa-solid fa-rotate"></i></div>
                                    <div class="filter-menu" data-id="1">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Monday
                                                <input class="form-check-input" type="checkbox" value="2">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Tuesday
                                                <input class="form-check-input" type="checkbox" value="3">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Wednesday
                                                <input class="form-check-input" type="checkbox" value="4">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Thursday
                                                <input class="form-check-input" type="checkbox" value="5">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Friday
                                                <input class="form-check-input" type="checkbox" value="6">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Saturday
                                                <input class="form-check-input" type="checkbox" value="7">
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-filled ap-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weeklist d-flex justify-content-between">
                                <div class="fw-bold">Monday</div>
                                @if (count($times2) == 0)
                                    <div class="text-danger un-lable">Unavailable</div>
                                @endif

                                <div class="input-date-box">
                                    <div class="appendboxDate" data-id="2">
                                        @if (count($times2) > 0)
                                            @foreach ($times2 as $day)
                                                <div
                                                    class="slot-item d-flex align-items-center justify-content-between mb-3">
                                                    @php
                                                        $time_from = date('Y-m-d') . ' ' . $day->time_from;
                                                        $time_to = date('Y-m-d') . ' ' . $day->time_to;

                                                        $time_from_t1 = new \DateTime($time_from, new \DateTimeZone('UTC'));
                                                        $time_to_t1 = new \DateTime($time_to, new \DateTimeZone('UTC'));

                                                        $time_from_t1->setTimezone(new \DateTimeZone($tz));
                                                        $time_to_t1->setTimezone(new \DateTimeZone($tz));

                                                        $tf_time = $time_from_t1->format('h:i A');
                                                        $tt_time = $time_to_t1->format('h:i A');
                                                    @endphp
                                                    <input type="text" placeholder="From :"
                                                        class="form-control timepicker f-basis-45" name="f2[]"
                                                        value="{{ $tf_time }}" />
                                                    <label class="m-0">-</label>
                                                    <input type="text" placeholder="To :"
                                                        class="form-control timepicker f-basis-45" name="t2[]"
                                                        value="{{ $tt_time }}" />
                                                    <i class="fa-solid fa-trash removeMon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class=" d-flex ">
                                    <div class="pe-2"><i class="fa-solid addItembtn fa-plus" data-f="f2[]"
                                            data-t="t2[]"></i></div>
                                    <div class="pe-2 filterbtn"><i class="fa-solid fa-rotate"></i></div>
                                    <div class="filter-menu" data-id="2">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Sunday
                                                <input class="form-check-input" type="checkbox" value="1">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Tuesday
                                                <input class="form-check-input" type="checkbox" value="3">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Wednesday
                                                <input class="form-check-input" type="checkbox" value="4">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Thursday
                                                <input class="form-check-input" type="checkbox" value="5">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Friday
                                                <input class="form-check-input" type="checkbox" value="6">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Saturday
                                                <input class="form-check-input" type="checkbox" value="7">
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-filled ap-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weeklist d-flex justify-content-between	">
                                <div class="fw-bold">Tuesday</div>
                                @if (count($times3) == 0)
                                    <div class="text-danger un-lable">Unavailable</div>
                                @endif

                                <div class="input-date-box">
                                    <div class="appendboxDate" data-id="3">
                                        @if (count($times3) > 0)
                                            @foreach ($times3 as $day)
                                                <div
                                                    class="slot-item d-flex align-items-center justify-content-between mb-3">
                                                    @php
                                                        $time_from = date('Y-m-d') . ' ' . $day->time_from;
                                                        $time_to = date('Y-m-d') . ' ' . $day->time_to;

                                                        $time_from_t1 = new \DateTime($time_from, new \DateTimeZone('UTC'));
                                                        $time_to_t1 = new \DateTime($time_to, new \DateTimeZone('UTC'));

                                                        $time_from_t1->setTimezone(new \DateTimeZone($tz));
                                                        $time_to_t1->setTimezone(new \DateTimeZone($tz));

                                                        $tf_time = $time_from_t1->format('h:i A');
                                                        $tt_time = $time_to_t1->format('h:i A');
                                                    @endphp
                                                    <input type="text" placeholder="From :"
                                                        class="form-control timepicker f-basis-45" name="f3[]"
                                                        value="{{ $tf_time }}" />
                                                    <label class="m-0">-</label>
                                                    <input type="text" placeholder="To :"
                                                        class="form-control timepicker f-basis-45" name="t3[]"
                                                        value="{{ $tt_time }}" />
                                                    <i class="fa-solid fa-trash removeMon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class=" d-flex ">
                                    <div class="pe-2"><i class="fa-solid addItembtn fa-plus" data-f="f3[]"
                                            data-t="t3[]"></i></div>
                                    <div class="pe-2 filterbtn"><i class="fa-solid fa-rotate"></i></div>
                                    <div class="filter-menu" data-id="3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Sunday
                                                <input class="form-check-input" type="checkbox" value="1">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Monday
                                                <input class="form-check-input" type="checkbox" value="2">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Wednesday
                                                <input class="form-check-input" type="checkbox" value="4">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Thursday
                                                <input class="form-check-input" type="checkbox" value="5">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Friday
                                                <input class="form-check-input" type="checkbox" value="6">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Saturday
                                                <input class="form-check-input" type="checkbox" value="7">
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-filled ap-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weeklist d-flex justify-content-between	">
                                <div class="fw-bold">Wednesday</div>
                                @if (count($times4) == 0)
                                    <div class="text-danger un-lable">Unavailable</div>
                                @endif

                                <div class="input-date-box">
                                    <div class="appendboxDate" data-id="4">
                                        @if (count($times4) > 0)
                                            @foreach ($times4 as $day)
                                                <div
                                                    class="slot-item d-flex align-items-center justify-content-between mb-3">
                                                    @php
                                                        $time_from = date('Y-m-d') . ' ' . $day->time_from;
                                                        $time_to = date('Y-m-d') . ' ' . $day->time_to;

                                                        $time_from_t1 = new \DateTime($time_from, new \DateTimeZone('UTC'));
                                                        $time_to_t1 = new \DateTime($time_to, new \DateTimeZone('UTC'));

                                                        $time_from_t1->setTimezone(new \DateTimeZone($tz));
                                                        $time_to_t1->setTimezone(new \DateTimeZone($tz));

                                                        $tf_time = $time_from_t1->format('h:i A');
                                                        $tt_time = $time_to_t1->format('h:i A');
                                                    @endphp
                                                    <input type="text" placeholder="From :"
                                                        class="form-control timepicker f-basis-45" name="f4[]"
                                                        value="{{ $tf_time }}" />
                                                    <label class="m-0">-</label>
                                                    <input type="text" placeholder="To :"
                                                        class="form-control timepicker f-basis-45" name="t4[]"
                                                        value="{{ $tt_time }}" />
                                                    <i class="fa-solid fa-trash removeMon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class=" d-flex ">
                                    <div class="pe-2"><i class="fa-solid addItembtn fa-plus" data-f="f4[]"
                                            data-t="t4[]"></i></div>
                                    <div class="pe-2 filterbtn"><i class="fa-solid fa-rotate"></i></div>
                                    <div class="filter-menu" data-id="4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Sunday
                                                <input class="form-check-input" type="checkbox" value="1">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Monday
                                                <input class="form-check-input" type="checkbox" value="2">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Tuesday
                                                <input class="form-check-input" type="checkbox" value="3">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Thursday
                                                <input class="form-check-input" type="checkbox" value="5">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Friday
                                                <input class="form-check-input" type="checkbox" value="6">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Saturday
                                                <input class="form-check-input" type="checkbox" value="7">
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-filled ap-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weeklist d-flex justify-content-between	">
                                <div class="fw-bold">Thursday</div>
                                @if (count($times5) == 0)
                                    <div class="text-danger un-lable">Unavailable</div>
                                @endif

                                <div class="input-date-box">
                                    <div class="appendboxDate" data-id="5">
                                        @if (count($times5) > 0)
                                            @foreach ($times5 as $day)
                                                <div
                                                    class="slot-item d-flex align-items-center justify-content-between mb-3">
                                                    @php
                                                        $time_from = date('Y-m-d') . ' ' . $day->time_from;
                                                        $time_to = date('Y-m-d') . ' ' . $day->time_to;

                                                        $time_from_t1 = new \DateTime($time_from, new \DateTimeZone('UTC'));
                                                        $time_to_t1 = new \DateTime($time_to, new \DateTimeZone('UTC'));

                                                        $time_from_t1->setTimezone(new \DateTimeZone($tz));
                                                        $time_to_t1->setTimezone(new \DateTimeZone($tz));

                                                        $tf_time = $time_from_t1->format('h:i A');
                                                        $tt_time = $time_to_t1->format('h:i A');
                                                    @endphp
                                                    <input type="text" placeholder="From :"
                                                        class="form-control timepicker f-basis-45" name="f5[]"
                                                        value="{{ $tf_time }}" />
                                                    <label class="m-0">-</label>
                                                    <input type="text" placeholder="To :"
                                                        class="form-control timepicker f-basis-45" name="t5[]"
                                                        value="{{ $tt_time }}" />
                                                    <i class="fa-solid fa-trash removeMon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class=" d-flex ">
                                    <div class="pe-2"><i class="fa-solid addItembtn fa-plus" data-f="f5[]"
                                            data-t="t5[]"></i></div>
                                    <div class="pe-2 filterbtn"><i class="fa-solid fa-rotate"></i></div>
                                    <div class="filter-menu" data-id="5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Sunday
                                                <input class="form-check-input" type="checkbox" value="1">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Monday
                                                <input class="form-check-input" type="checkbox" value="2">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Tuesday
                                                <input class="form-check-input" type="checkbox" value="3">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Wednesday
                                                <input class="form-check-input" type="checkbox" value="4">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Friday
                                                <input class="form-check-input" type="checkbox" value="6">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Saturday
                                                <input class="form-check-input" type="checkbox" value="7">
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-filled ap-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weeklist d-flex justify-content-between	">
                                <div class="fw-bold">Friday</div>
                                @if (count($times6) == 0)
                                    <div class="text-danger un-lable">Unavailable</div>
                                @endif

                                <div class="input-date-box">
                                    <div class="appendboxDate" data-id="6">
                                        @if (count($times6) > 0)
                                            @foreach ($times6 as $day)
                                                <div
                                                    class="slot-item d-flex align-items-center justify-content-between mb-3">
                                                    @php
                                                        $time_from = date('Y-m-d') . ' ' . $day->time_from;
                                                        $time_to = date('Y-m-d') . ' ' . $day->time_to;

                                                        $time_from_t1 = new \DateTime($time_from, new \DateTimeZone('UTC'));
                                                        $time_to_t1 = new \DateTime($time_to, new \DateTimeZone('UTC'));

                                                        $time_from_t1->setTimezone(new \DateTimeZone($tz));
                                                        $time_to_t1->setTimezone(new \DateTimeZone($tz));

                                                        $tf_time = $time_from_t1->format('h:i A');
                                                        $tt_time = $time_to_t1->format('h:i A');
                                                    @endphp
                                                    <input type="text" placeholder="From :"
                                                        class="form-control timepicker f-basis-45" name="f6[]"
                                                        value="{{ $tf_time }}" />
                                                    <label class="m-0">-</label>
                                                    <input type="text" placeholder="To :"
                                                        class="form-control timepicker f-basis-45" name="t6[]"
                                                        value="{{ $tt_time }}" />
                                                    <i class="fa-solid fa-trash removeMon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class=" d-flex ">
                                    <div class="pe-2"><i class="fa-solid addItembtn fa-plus" data-f="f6[]"
                                            data-t="t6[]"></i></div>
                                    <div class="pe-2 filterbtn"><i class="fa-solid fa-rotate"></i></div>
                                    <div class="filter-menu" data-id="6">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Sunday
                                                <input class="form-check-input" type="checkbox" value="1">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Monday
                                                <input class="form-check-input" type="checkbox" value="2">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Tuesday
                                                <input class="form-check-input" type="checkbox" value="3">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Wednesday
                                                <input class="form-check-input" type="checkbox" value="4">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Thursday
                                                <input class="form-check-input" type="checkbox" value="5">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Saturday
                                                <input class="form-check-input" type="checkbox" value="7">
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-filled ap-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weeklist d-flex justify-content-between	">
                                <div class="fw-bold">Saturday</div>
                                @if (count($times7) == 0)
                                    <div class="text-danger un-lable">Unavailable</div>
                                @endif

                                <div class="input-date-box">
                                    <div class="appendboxDate" data-id="7">
                                        @if (count($times7) > 0)
                                            @foreach ($times7 as $day)
                                                <div
                                                    class="slot-item d-flex align-items-center justify-content-between mb-3">
                                                    @php
                                                        $time_from = date('Y-m-d') . ' ' . $day->time_from;
                                                        $time_to = date('Y-m-d') . ' ' . $day->time_to;

                                                        $time_from_t1 = new \DateTime($time_from, new \DateTimeZone('UTC'));
                                                        $time_to_t1 = new \DateTime($time_to, new \DateTimeZone('UTC'));

                                                        $time_from_t1->setTimezone(new \DateTimeZone($tz));
                                                        $time_to_t1->setTimezone(new \DateTimeZone($tz));

                                                        $tf_time = $time_from_t1->format('h:i A');
                                                        $tt_time = $time_to_t1->format('h:i A');
                                                    @endphp
                                                    <input type="text" placeholder="From :"
                                                        class="form-control timepicker f-basis-45" name="f7[]"
                                                        value="{{ $tf_time }}" />
                                                    <label class="m-0">-</label>
                                                    <input type="text" placeholder="To :"
                                                        class="form-control timepicker f-basis-45" name="t7[]"
                                                        value="{{ $tt_time }}" />
                                                    <i class="fa-solid fa-trash removeMon"></i>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class=" d-flex ">
                                    <div class="pe-2"><i class="fa-solid addItembtn fa-plus" data-f="f7[]"
                                            data-t="t7[]"></i></div>
                                    <div class="pe-2 filterbtn"><i class="fa-solid fa-rotate"></i></div>
                                    <div class="filter-menu" data-id="7">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Sunday
                                                <input class="form-check-input" type="checkbox" value="1">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Monday
                                                <input class="form-check-input" type="checkbox" value="2">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Tuesday
                                                <input class="form-check-input" type="checkbox" value="3">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Wednesday
                                                <input class="form-check-input" type="checkbox" value="4">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Thursday
                                                <input class="form-check-input" type="checkbox" value="5">
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                Friday
                                                <input class="form-check-input" type="checkbox" value="6">
                                            </label>
                                        </div>
                                        <button type="button" class="btn btn-primary btn-filled ap-btn">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="weeklist d-flex justify-content-between	">
                                <button type="submit" class="btn btn-primary w-100 st12">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="calendertabeldes">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>SUNDAY</td>
                                        <td><span class="red-fs-22">•••••</span></td>
                                    </tr>
                                    <tr>
                                        <td>MONDAY</td>
                                        <td><span class="red-fs-22">•••••</span></td>
                                    </tr>
                                    <tr>
                                        <td>TUESDAY</td>
                                        <td><span class="red-fs-22">•••••</span></td>
                                    </tr>
                                    <tr>
                                        <td>WEDNESDAY</td>
                                        <td><span class="red-fs-22">•••••</span></td>
                                    </tr>
                                    <tr>
                                        <td>THRUSDAY</td>
                                        <td><span class="red-fs-22">•••••</span></td>
                                    </tr>
                                    <tr>
                                        <td>FRIDAY</td>
                                        <td><span class="red-fs-22">•••••</span></td>
                                    </tr>
                                    <tr>
                                        <td>SATURDAY</td>
                                        <td><span class="red-fs-22">•••••</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6 class="mt-5">My Booking Page: <span><svg style="width:15px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                              </svg>
                              </span></h6>
                            <p><a href="#">https://tutor.knowmerit.com/book</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                {{-- <div style=" min-height: 1500px;" id='calendar'></div> --}}
                <div class=" mt-4" style="height: 100% !important;">
                    <h3>Calendar</h3>
                    <div id="container" style="min-height: 600px !important;height:600px"></div>
                </div>
            </div>
        </div>
        <!-- //hiden input -->
        <form action="" method="" class="d-none" id="boking_form">
            <input type="hidden" id="class_id" name="class_id" value="">
            <input type="hidden" id="teacher_id" name="teacher_id" value="{{ $user_id }}">
            <input type="hidden" id="student_id" name="student_id" value="">
            <input type="hidden" id="date_time" name="date_time" value="">
            <input type="hidden" id="user_id" value="{{ $user_id }}">
        </form>
        </div>
    @endsection
</div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="height:290px;">
            <div class="modal-header" style="background:#dbdbdb;">
                <h4 class="fw-bold">BOOK Classes<span class="credit1"></span></h4>
            </div>
            <div class="modal-body flex-grow-0">
                <form action="" method="POST" id="createFrm">
                    @csrf
                    <input type="hidden" class="form-control" name="user_id" id="user1" value="" />
                    <input type="hidden" class="form-control" name="price_master" id="price_master"
                        value="" />
                    <div class="container">
                        <label class="fw-bold" for="">Students</label>
                        <select class="form-select std" aria-label="Default select example" name="std"
                            id="std_id">
                            <option>Select student</option>
                            @if (count($student_data) > 0)
                                @foreach ($student_data as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }} ( {{ $cat->email }} )
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="std1"></p>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="container" id="tiz">
                        <label class="fw-bold" for="time_id">Time</label>
                        <select class="form-select time" aria-label="Default select example" name="time"
                            id="time_id">
                        </select>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-time"></p>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="schedule-calendar" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {{-- style="max-width:70%;" --}}
        <div class="modal-content selectplan">
            <div class="modal-header">
                <span><a href="{{ URL::previous() }}"><i class="fa-solid fa-chevron-left"></i></a></span>
                <h1 class="modal-title fs-5">Schedule your lessons</h1>
                <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body time-frame">
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
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/date-script.js') }}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
    </script>
    <link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
    <script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.ie11.min.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //   var calendarEl = document.getElementById('calendar');

        //   var calendar = new FullCalendar.Calendar(calendarEl, {
        // 	timeZone: 'UTC',
        // 	dayMaxEvents: true, // allow "more" link when too many events
        // 	// events: 'https://fullcalendar.io/api/demo-feeds/events.json?overload-day'
        //     events: 'http://127.0.0.1:8000/sample.json'
        //   });

        //   calendar.render();
        // });
        // $(document).ready(function(){
        $(document).on('click', '#profile-tab', function() {

            // 	var calendarEl = document.getElementById('calendar');

            // 	  var calendar = new FullCalendar.Calendar(calendarEl, {
            // 		timeZone: 'UTC',
            // 		dayMaxEvents: true, // allow "more" link when too many events
            // 		// events: 'https://fullcalendar.io/api/demo-feeds/events.json?overload-day'
            //         events: 'http://127.0.0.1:8000/sample.json',
            //         initialView: 'timeGridWeek',
            // 	  });

            // 	  calendar.render();
            $('#container').html('');
            var x = setTimeout(() => {
                cal_init();
                $('.btn-today').click();
            }, 500);

        });
        $(document).on('click', '#sub_data', function() {
            $(".st12").click();
        });
        $(document).on('click', '#profile-tab', function() {
            $("#sub_data").addClass('d-none');
            $(".calendar-today-des").show();
            
        });
        $(document).on('click', '#home-tab', function() {
            $("#sub_data").removeClass('d-none');
            $(".calendar-today-des").hide();
        });


        $(document).on('click', '.addItembtn', function() {
            // $(".monday-div .slot-item").clone().appendTo("#monclonedata");
            let fname = $(this).data('f');
            let tname = $(this).data('t');
            var Sprnt = $(this).parent().parent().parent().find('.appendboxDate');
            var unLab = $(this).parent().parent().parent().find('.un-lable');
            var adhtml =
                `<div class="slot-item d-flex align-items-center justify-content-between mb-3">
                                <input type="text" placeholder="From :" class="form-control timepicker f-basis-45" name="` +
                fname +
                `" />
                                <label class="m-0">-</label>
                                <input type="text"  placeholder="To :" class="form-control timepicker f-basis-45" name="` +
                tname + `" />
                                <i class="fa-solid fa-trash removeMon"></i>
                            </div>`;
            Sprnt.append(adhtml);
            unLab.remove();
            $('.timepicker').mdtimepicker();
        });
        $(document).on('click', '.removeMon', function() {
            let clsName = $(this).parent().parent().parent();
            $(this).parent().remove();

            if (clsName.find('.slot-item').length <= 0) {
                $('<div class="text-danger un-lable">Unavailable</div>').insertBefore(clsName);
            }
        });
        $(document).on('click', '.filterbtn', function() {
            let th = $(this).next().data('id');
            $(this).next().toggle();
            $('div.filter-menu').each(function() {
                if ($(this).css('display') == 'block' && $(this).data('id') != th) {
                    $(this).css('display', 'none');
                }
            });
        });

        $(document).on('click', '.ap-btn', function() {

            var checkArr = [];
            var Sprnt = $(this).parent().parent().parent().find('.appendboxDate');
            $(this).parent().find("input[type=checkbox]:checked").each(function() {
                checkArr.push($(this).val());
                $(this).prop('checked', false);
            });


            $('.appendboxDate').each(function() {

                var temp = $(this).data('id');
                // var unLab   =
                if ($.inArray(temp.toString(), checkArr) >= 0) {
                    let fname = "f" + $(this).data('id') + "[]";
                    let tname = "t" + $(this).data('id') + "[]";

                    $(this).parent().parent().find('.un-lable').remove();
                    $(this).html(Sprnt.html());

                    $(this).find('input[type=text]').each(function(idx, el) {
                        let num = idx + 1;
                        if (num % 2 == 0) {
                            $(this).attr('name', tname);
                        } else {
                            $(this).attr('name', fname);
                        }
                    });
                }
            });
            $('.timepicker').mdtimepicker();
            $('.filter-menu').hide();

        });



        // });
    </script>

    <script>
        function cal_init() {
            var Cal = tui.Calendar;
            var calendar = new Cal('#container', {
                defaultView: 'week',
                taskView: false,
                id: 'cal1',
                isReadOnly: true,
            });
            calendar.setOptions({
                week: {
                    taskView: false,
                    eventView: ['time'],
                    defaultTimeDuration: 30,
                },
            });
            calendar.createEvents(@json($events));

            var timedEvent = calendar.getEvent('1', 'cal1'); // EventObject
            calendar.on('clickEvent', ({
                event
            }) => {
                console.log(event); // EventObject
                $('#date_time').val(event.body);

                console.log(event.attendees[0]);
                if (event.attendees[0] == 'B') {
                    Swal.fire({
                        title: 'Booked by ' + event.attendees[2],
                        text: 'Modal with a custom image.',
                        imageUrl: event.attendees[1],
                        imageWidth: 200,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    })
                }

            });

            $(document).on("click", ".btn-prev", function() {
                calendar.prev();
            });
            $(document).on("click", ".btn-nxt", function() {
                calendar.next();
            });
            $(document).on("click", ".btn-today", function() {
                calendar.today();
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.timepicker').mdtimepicker();
        });
        $(window).on("load", function() {
            cal_init();
        });
        $(document).on('change', '.std', function() {
            var std = $('#std_id').val();
            $.ajax({
                type: "get",
                data: {
                    'std': std,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success == true) {
                        $("#student_id").val(response.st_id);
                        var sizeOfArrray = response.data.length;
                        if (sizeOfArrray == 0) {
                            $('#std1').html(
                                'Student has not enough credits, Kindly ask to purchase classes.');
                        } else {
                            $('#std1').empty();
                            $("#time_id").empty();
                            $("#time_id").html('<option value="">Select Time</option>');
                            $.each(response.data, function(key, value) {
                                console.log(value.time);
                                $("#time_id").append('<option value="' + value.id + '">' + value
                                    .title + ' - ' + value.class + 'x classes - ' + value
                                    .time + 'min' + '</option>');
                            });
                        }
                    }
                    if (response.success == false) {
                        $('#std1').html(
                            'Student has not enough credits, Kindly ask to purchase classes.');
                        $("#time_id").empty();
                    }
                }
            });
        });
        $(document).on("change", ".time", function() {
            var c_id = $('#time_id').val();
            var t_id = $('#user_id').val();
            $.ajax({
                url: "{{ route('teacher.cal') }}",
                type: 'GET',
                data: {
                    c_id: c_id,
                    t_id: t_id
                },
                dataType: 'json',
                success: function(data) {
                    $("#class_id").val(data.class_id)
                    $('.time-frame').html(data.html);
                    $('#schedule-calendar').modal('show');

                    setTimeout(() => {
                        cal_init_book();
                    }, 800);
                }
            });
        });
    </script>
@endpush
