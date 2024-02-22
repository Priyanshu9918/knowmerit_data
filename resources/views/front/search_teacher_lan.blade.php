<div class="row data1">
    @if (count($tutors) > 0)
        @foreach ($tutors as $key => $row)
            <?php $avtar = DB::table('users')
                ->where('id', $row->user_id)
                ->where('status', 1)
                ->first(); ?>
            <div class="col-lg-12 d-flex">
                <div class="instructor-list flex-fill">
                    <div class="instructor-img">
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
                            @if (Auth::check())
                            <a href="{{ url('chatify', ['id' => $row->user_id]) }}"
                                class="learn-more-five mb-4">Contact</a>
                            @else
                            <a href="{{ url('user/login') }}"
                                class="learn-more-five mb-4">Contact</a>
                            @endif

                        </div>
                        <div class="instructor-info">
                            <div class="rating-img d-flex align-items-center">
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
                            </div>
                            <div class="course-view d-flex align-items-center ms-0">
                                <i class="feather-map-pin" style="margin-right: 4px"></i>
                                <p>LOCATION : {{ $row->location }}</p>
                            </div>
                            <div class="rating-img d-flex align-items-center">
                                <i class="fa fa-inr" aria-hidden="true"
                                    style="margin-right: 4px"></i>
                                <p>RATE : {{ $row->charge_amount }}/Hour</p>
                            </div>

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
                        <div class="featured-info-time d-flex align-items-center">
                            <div class="rate">
                                <span class=""><b>Availability:</b></span>
                                @php
                                    $availability = DB::table('availabilities')
                                        ->where('user_id', $row->user_id)
                                        ->pluck('day')
                                        ->toArray();
                                @endphp
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
                                            data-sub="{{ $sub_cat->id }}"
                                            class="find_slot" class="nav-link">
                                            <i class="fa fa-calendar-check-o"></i> Check Availability </a>
                                            @else
                                        <a href="javascript:void(0)" data-id="{{ $row->user_id }}"
                                            data-class="{{ $cat->id }}"
                                            data-sub="{{ $sub_cat->id }}"
                                            class="find_slot1" class="nav-link">
                                            <i class="fa fa-calendar-check-o"></i> Check Availability </a>
                                            @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <div class="row">
        <div class="no-up">
            <div class="no-upcomimg"> <img src="{{ asset('assets/img/my-img/clipboard1.png') }}">
                <h3 class="mt-4">No Data Found</h3>
            </div>
        </div>
    </div>    @endif
</div>
