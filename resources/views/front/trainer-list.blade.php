@extends('layouts.front.master')
@section('content')
    <style type="text/css">
        .range-slider {
            width: 100%;
            margin: auto;
            text-align: center;
            position: relative;
            height: 50px;
        }

        .range-slider svg,
        .range-slider input[type=range] {
            position: absolute;
            left: 0;
            bottom: 0;
        }

        input[type=number] {
            border: 1px solid #ddd;
            text-align: center;
            font-size: 1.6em;
            -moz-appearance: textfield;
        }

        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        input[type=number]:invalid,
        input[type=number]:out-of-range {
            border: 2px solid #ff6347;
        }

        input[type=range] {
            -webkit-appearance: none;
            width: 100%;
        }

        input[type=range]:focus {
            outline: none;
        }

        input[type=range]:focus::-webkit-slider-runnable-track {
            background: #2497e3;
        }

        input[type=range]:focus::-ms-fill-lower {
            background: #2497e3;
        }

        input[type=range]:focus::-ms-fill-upper {
            background: #2497e3;
        }

        input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            animate: 0.2s;
            background: #2497e3;
            border-radius: 1px;
            box-shadow: none;
            border: 0;
        }

        input[type=range]::-webkit-slider-thumb {
            z-index: 2;
            position: relative;
            box-shadow: 0px 0px 0px #000;
            border: 1px solid #2497e3;
            height: 18px;
            width: 18px;
            border-radius: 25px;
            background: #a1d0ff;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -7px;
        }

        input[type=range]::-moz-range-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            animate: 0.2s;
            background: #2497e3;
            border-radius: 1px;
            box-shadow: none;
            border: 0;
        }

        input[type=range]::-moz-range-thumb {
            z-index: 2;
            position: relative;
            box-shadow: 0px 0px 0px #000;
            border: 1px solid #2497e3;
            height: 18px;
            width: 18px;
            border-radius: 25px;
            background: #a1d0ff;
            cursor: pointer;
        }

        input[type=range]::-ms-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            animate: 0.2s;
            background: transparent;
            border-color: transparent;
            color: transparent;
        }

        input[type=range]::-ms-fill-lower,
        input[type=range]::-ms-fill-upper {
            background: #2497e3;
            border-radius: 1px;
            box-shadow: none;
            border: 0;
        }

        input[type=range]::-ms-thumb {
            z-index: 2;
            position: relative;
            box-shadow: 0px 0px 0px #000;
            border: 1px solid #2497e3;
            height: 18px;
            width: 18px;
            border-radius: 25px;
            background: #a1d0ff;
            cursor: pointer;
        }

        .range12 {
            display: flex;
            font-size: 7px;
        }

        .range-card {
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
            padding: 20px;
        }

        .page-content {
            background: #fafafa;
            padding: 114px 0 60px;
        }

        .ps {
            display: flex;
            justify-content: space-between;
        }
    </style>
    @php
        $tutors = Helper::tutors();
        $datacount = DB::table('tutors')
            ->where('status', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->count();
    @endphp

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="showing-list">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="d-flex align-items-center">

                                    <div class="show-result">

                                        <h4>Showing {{ $datacount }} results </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="show-filter add-course-info">
                                    <form action="#">
                                        <div class="row gx-2 align-items-center">
                                            <div class="col-md-4 col-item">
                                                <div class=" search-group" id="inst">
                                                    <i class="feather-search"></i>
                                                    {{-- <input type="text" class="form-control"
                                                        > --}}
                                                    <input type="text" id="search" name="search"
                                                        placeholder="Search our Instructor" class="form-control" />
                                                </div>
                                            </div>
                                            @php
                                                $results = DB::select(DB::raw("SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(language, ',', n.digit+1), ',', -1) language FROM tutors INNER JOIN (SELECT 0 digit UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) n ON LENGTH(REPLACE(language, ',' , '')) <= LENGTH(language)-n.digit;"));
                                            @endphp
                                            <div class="col-md-4 col-lg-6 col-item">
                                                <div class="form-group select-form mb-0">
                                                    <select class="form-select select" id="select">
                                                        <option>Instructor Speaks</option>
                                                        @foreach ($results as $row)
                                                            <option>{{ $row->language }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
                                                <!-- <h6>Availability</h6> -->
                                                <a href="javascript:" class="btn btn-primary avai"
                                                    style="background: unset;color: #000;">Availability</a>
                                            </div> --}}

                                            <div class="col-md-12" style="padding: 15px;">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                    class="col-border availability-table table-v">
                                                    <tbody>
                                                        <tr>
                                                            <th valign="middle" scope="col">&nbsp;</th>
                                                            <th valign="middle" scope="col" class="lrBorder">Sun</th>
                                                            <th valign="middle" scope="col" class="lrBorder">Mon</th>
                                                            <th valign="middle" scope="col" class="lrBorder">Tue</th>
                                                            <th valign="middle" scope="col" class="lrBorder">Wed</th>
                                                            <th valign="middle" scope="col" class="lrBorder">Thu</th>
                                                            <th valign="middle" scope="col" class="lrBorder">Fri</th>
                                                            <th valign="middle" scope="col" class="lrBorder">Sat</th>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" class="lrBorder">Morning</td>
                                                            <td valign="middle" avail="morning" avail2="morning"
                                                                day2="sun" day="sun" class="lrBorder avail">
                                                                <img src="assets/img/my-img/morning-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="morning" avail2="morning"
                                                                day2="mon" day="mon" class="lrBorder avail">
                                                                <img src="assets/img/my-img/morning-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="morning" avail2="morning"
                                                                day2="tue" day="tue" class="lrBorder avail">
                                                                <img src="assets/img/my-img/morning-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="morning" avail2="morning"
                                                                day2="wed" day="wed" class="lrBorder avail">
                                                                <img src="assets/img/my-img/morning-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="morning" avail2="morning"
                                                                day2="thu" day="thu" class="lrBorder avail">
                                                                <img src="assets/img/my-img/morning-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="morning" avail2="morning"
                                                                day2="fri" day="fri" class="lrBorder avail">
                                                                <img src="assets/img/my-img/morning-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="morning" avail2="morning"
                                                                day2="sat" day="sat" class="lrBorder avail">
                                                                <img src="assets/img/my-img/morning-icon1.png"
                                                                    width="32">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" class="lrBorder">Afternoon</td>
                                                            <td valign="middle" avail="afternoon" avail2="afternoon"
                                                                day2="sun" day="sun" class="lrBorder avail">
                                                                <img src="assets/img/my-img/day-icon1.png" width="32">
                                                            </td>
                                                            <td valign="middle" avail="afternoon" avail2="afternoon"
                                                                day2="mon" day="mon" class="lrBorder avail">
                                                                <img src="assets/img/my-img/day-icon1.png" width="32">
                                                            </td>
                                                            <td valign="middle" avail="afternoon" avail2="afternoon"
                                                                day2="tue" day="tue" class="lrBorder avail">
                                                                <img src="assets/img/my-img/day-icon1.png" width="32">
                                                            </td>
                                                            <td valign="middle" avail="afternoon" avail2="afternoon"
                                                                day2="wed" day="wed" class="lrBorder avail">
                                                                <img src="assets/img/my-img/day-icon1.png" width="32">
                                                            </td>
                                                            <td valign="middle" avail="afternoon" avail2="afternoon"
                                                                day2="thu" day="thu" class="lrBorder avail">
                                                                <img src="assets/img/my-img/day-icon1.png" width="32">
                                                            </td>
                                                            <td valign="middle" avail="afternoon" avail2="afternoon"
                                                                day2="fri" day="fri" class="lrBorder avail">
                                                                <img src="assets/img/my-img/day-icon1.png" width="32">
                                                            </td>
                                                            <td valign="middle" avail="afternoon" avail2="afternoon"
                                                                day2="sat" day="sat" class="lrBorder avail">
                                                                <img src="assets/img/my-img/day-icon1.png" width="32">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="middle" class="lrBorder">Evening</td>
                                                            <td valign="middle" avail="evening" avail2="evening"
                                                                day2="sun" day="sun" class="lrBorder avail">
                                                                <img src="assets/img/my-img/evening-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="evening" avail2="evening"
                                                                day2="mon" day="mon" class="lrBorder avail">
                                                                <img src="assets/img/my-img/evening-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="evening" avail2="evening"
                                                                day2="tue" day="tue" class="lrBorder avail">
                                                                <img src="assets/img/my-img/evening-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="evening" avail2="evening"
                                                                day2="wed" day="wed" class="lrBorder avail">
                                                                <img src="assets/img/my-img/evening-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="evening" avail2="evening"
                                                                day2="thu" day="thu" class="lrBorder avail">
                                                                <img src="assets/img/my-img/evening-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="evening" avail2="evening"
                                                                day2="fri" day="fri" class="lrBorder avail">
                                                                <img src="assets/img/my-img/evening-icon1.png"
                                                                    width="32">
                                                            </td>
                                                            <td valign="middle" avail="evening" avail2="evening"
                                                                day2="sat" day="sat" class="lrBorder avail">
                                                                <img src="assets/img/my-img/evening-icon1.png"
                                                                    width="32">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row data1">
                        @if (count($tutors) > 0)
                            @foreach ($tutors as $key => $row)
                                <?php $avtar = DB::table('users')
                                    ->where('id', $row->user_id)
                                    ->where('status', 1)
                                    ->first(); ?>
                                <div class="col-lg-12 d-flex">
                                    <div class="instructor-list flex-fill">
                                        <div class="instructor-img profile-img-certi">
                                            @if (isset($avtar->avatar))
                                                <a href="#">
                                                    <img class="img-fluid" alt
                                                        src="{{ asset('uploads/tutors/' . $avtar->avatar) }}">
                                                </a>
                                            @else
                                                <a href="#">
                                                    <img class="img-fluid" alt
                                                        src="{{ asset('assets/img/user/av.jpg') }}">
                                                </a>
                                            @endif
                                            @if ($row->is_verified == 1)
                                                <img class="certiimg" style="width: 20px;"
                                                    src="http://knowmerit.com/uploads/tutors/certified-logo.png">
                                            @endif
                                        </div>
                                        <div class="instructor-content">
                                            <div class="ps">
                                                <div class="tutor-t">
                                                    <h5 style="display: flex;"><a
                                                            href="{{ url('/instructor-profile', ['id' => $row->user_id]) }}">{{ $row->name }}</a>
                                                        <div class="rate" style="margin-left: 25px;">
                                                            <div class="rating">
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>

                                                            </div>
                                                        </div>
                                                    </h5>
                                                    <h6>Teacher</h6>
                                                </div>

                                                    <a href="javascript:void(0)" class="learn-more-five mb-4" id="contct">Contact</a>

                                            </div>
                                            <div class="instructor-info inst-info-list">
                                                <!-- <div class="rating-img d-flex align-items-center">
                                                    <i class="fa fa-language" aria-hidden="true"
                                                        style="margin-right: 4px"></i>
                                                    @php
                                                        $lanquage = explode(',', $row->language);
                                                        $lan = '';
                                                        foreach ($lanquage as $ln) {
                                                            $lan = $lan . ' , ' . $ln;
                                                        }
                                                    @endphp
                                                    <p>LANGUAGES : {{ $str1 = substr($lan, 2) }}</p>
                                                </div> -->
                                                <div class="course-view d-flex align-items-center ms-0">
                                                    <i class="feather-map-pin" style="margin-right: 4px"></i>
                                                    <p>LOCATION : {{ $row->location }}</p>
                                                </div>
                                                {{-- <div class="rating-img d-flex align-items-center">
                                                    <i class="fa fa-inr" aria-hidden="true"
                                                        style="margin-right: 4px"></i>
                                                    <p>RATE : {{ $row->charge_amount }}/Hour</p>
                                                </div> --}}

                                            </div>
                                            <div class="trainer-tag">
                                                <?php $cat = DB::table('categories')
                                                    ->where('id', $row->parent_id)
                                                    ->first(); ?>
                                                <h6 class="mb-0 text-dark"><b>Fields</b></h6>
                                                <ul class="trainer-l">
                                                    <li>{{ $cat->name ?? '' }}</li>
                                                </ul>
                                            </div>
                                            @if ($row->youtube_url != '')
                                                <div class="watch-video-block">
                                                    <button data-url="{{$row->youtube_url}}" id="watch-videos">Watch Video</button>
                                                </div>
                                            @endif
                                            <div class="featured-info-time d-flex align-items-center availability-datesdes">
                                                <div class="rate">
                                                    {{-- <span class=""><b>Availability:</b></span> --}}
                                                    @php
                                                        $availability = DB::table('availabilities')
                                                            ->where('user_id', $row->user_id)
                                                            ->pluck('day')
                                                            ->toArray();
                                                    @endphp
                                                    @if ($availability)
                                                        <span class=""><b>Availability:</b></span>
                                                    @else
                                                        <span class="d-none"><b>Availability:</b></span>
                                                    @endif

                                                    <span class="availableCourse">

                                                        @if (in_array('mon', $availability))
                                                            <span class="checked1">M</span>
                                                        @endif
                                                        @if (in_array('tue', $availability))
                                                            <span class="checked1">T</span>
                                                            @endif @if (in_array('wed', $availability))
                                                                <span class="checked1">W</span>
                                                                @endif @if (in_array('thu', $availability))
                                                                    <span class="checked1">Th</span>
                                                                @endif
                                                                @if (in_array('fri', $availability))
                                                                    <span class="checked1">F</span>
                                                                    @endif @if (in_array('sat', $availability))
                                                                        <span class="checked1">S</span>
                                                                        @endif @if (in_array('sun', $availability))
                                                                            <span class="checked1">Su</span>
                                                                        @endif
                                                    </span>

                                                </div>
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

                                                <div class="course-view d-inline-flex align-items-center">
                                                    <div class="course-price check-avai-link">
                                                        @if (Auth::check() && Auth::user()->user_type == 3)
                                                            <a href="javascript:void(0)" data-id="{{ $row->user_id }}"
                                                                data-class="{{ $cat->id }}"
                                                                data-sub="{{ $sub_cat->id }}" class="find_slot"
                                                                class="nav-link">
                                                                <i class="fa fa-calendar-check-o"></i> Check Availability
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0)" data-id="{{ $row->user_id }}"
                                                                data-class="{{ $cat->id }}"
                                                                data-sub="{{ $sub_cat->id }}" class="find_slot1"
                                                                class="nav-link">
                                                                <i class="fa fa-calendar-check-o"></i> Check Availability
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1>No Data Found</h1>
                        @endif
                    </div>
                </div>
                {{-- <div class="col-lg-3">

                </div> --}}
                <div class="col-lg-3">
                    <div class="filter-clear">
                        <div class="clear-filter d-flex align-items-center">
                            <h4><i class="feather-filter"></i>Filters</h4>
                            {{-- <div class="clear-text">
                                <p>CLEAR</p>
                            </div> --}}
                        </div>
                        <div class="card search-filter">
                            <div class="card-body">
                                <div class="filter-widget">
                                    <form action="{{ route('filter_category') }}" id="filter_category" method="get">

                                        <div class="categories-head d-flex align-items-center mb-2">
                                            <h4>Categories</h4>
                                            {{-- <i class="fas fa-angle-down"></i> --}}
                                        </div>
                                        @php
                                            $categories = Helper::categories();
                                        @endphp
                                        @foreach ($categories as $row)
                                            <?php if(!empty($filter_cat))
                                            { ?>
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="select_specialist[]"
                                                        value="{{ $row->id }}" <?php if (in_array($row->id, $filter_cat)) {
                                                            echo 'checked';
                                                        } ?>>
                                                    <span class="checkmark"></span>{{ $row->name }}
                                                </label>
                                            </div>

                                            <?php } else { ?>
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="select_specialist[]"
                                                        value="{{ $row->id }}">
                                                    <span class="checkmark"></span>{{ $row->name }}
                                                </label>
                                            </div>
                                            <?php } ?>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="watch-video-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px 10px 10px 10px;">
                <div class="modal-header">
                    <button id="watch-video-cancel" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div>
                    <a href="https://www.youtube.com/watch?v=d0wV9EC3t14"></a>
                     <iframe class="tube" id="ytube" width="100%" height="460" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                  </div> -->
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
    @foreach ($tutors as $key => $row)
        <form action="" method="" class="d-none" id="boking_form">
            <input type="hidden" id="class_id" name="class_id" value="">
            <input type="hidden" id="sub_id" name="sub_id" value="">
            <input type="hidden" id="teacher_id" name="teacher_id">
            @if (Auth::check())
                <input type="hidden" id="student_id" name="student_id"value="{{ auth()->user()->id }}">
            @endif
            {{-- <input type="hidden" id="student_id" name="student_id"value="{{ $row->user_id }}"> --}}
            <input type="hidden" id="date_time" name="date_time" value="">
        </form>
    @endforeach
@endsection
@push('script')
    <script type="text/javascript">
        $(document).on('click', '#watch-videos', function() {
            var url = $(this).attr('data-url');
            $("#ytube").attr('src',url);
            $('#watch-video-modal').modal('show');
        });
        $(document).on('click', '#watch-video-cancel', function() {
            $('#watch-video-modal').modal('hide');
        })
    </script>




    <script type="text/javascript">
        $(document).ready(function() {
            $("input:checkbox").change(function() {
                $("#filter_category").submit();
            })
        });
        $(document).on('keyup', '#search', function(event) {
            var dt = $('#search').val();
            $.ajax({
                url: "{{ route('search_teacher') }}",
                type: "get",
                data: {
                    'active': 1,
                    'data': dt,
                },
                success: function(response) {
                    console.log(response);
                    $('.data1').replaceWith(response);
                }
            });
        });
        $(document).on('click', '#contct', function(event) {
            $.ajax({
                url: "{{ route('ct_page') }}",
                type: "get",
                data: {
                    'active': 1,
                },
                success: function(response) {
                if(response.success == true){
                    window.location = "{{ url('/') }}" + "/user/login";
                }
                if(response.success1 == true){
                    window.location = "{{ url('/') }}" +"/chatify";
                }
                }
            });
        });
        $('#select').on('change', function() {
            var dtt = $('#select').val();
            $.ajax({
                url: "{{ route('search_teacher_lan') }}",
                type: "get",
                data: {
                    'active': 1,
                    'data': dtt,
                },
                success: function(response) {
                    console.log(response);
                    $('.data1').replaceWith(response);
                }
            });
        });
        $('#selectcat').on('change', function() {

            var dtcat = $('#selectcat').val();
            $.ajax({
                url: "{{ route('search_teacher_cat') }}",
                type: "get",
                data: {
                    'active': 1,
                    'data': dtcat,
                },
                success: function(response) {
                    console.log(response);
                    $('.data1').replaceWith(response);
                }
            });
        });
        $(document).ready(function() {
            $(document).on("click", ".find_slot", function() {
                var c_id = $(this).attr('data-class');
                var s_id = $(this).attr('data-sub');
                var t_id = $(this).attr('data-id');
                $('#teacher_id').val(t_id);
                if (c_id == '') {
                    alert('Please select at least 1 lession rule');
                } else {
                    $.ajax({
                        url: "{{ route('student.cal123') }}",
                        type: 'GET',
                        data: {
                            c_id: c_id,
                            s_id: s_id,
                            t_id: t_id
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
            $(document).on("click", ".find_slot1", function() {
                var c_id = $(this).attr('data-class');
                var s_id = $(this).attr('data-sub');
                var t_id = $(this).attr('data-id');
                $('#teacher_id').val(t_id);
                if (c_id == '') {
                    alert('Please select at least 1 lession rule');
                } else {
                    $.ajax({
                        url: "{{ route('cal1234') }}",
                        type: 'GET',
                        data: {
                            c_id: c_id,
                            s_id: s_id,
                            t_id: t_id
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
@endpush
