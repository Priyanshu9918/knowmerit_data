<div class="row data12">
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
                                                    <tr style="border-bottom: 1px solid #e5dede;" class=" bg-white">
                                                        <div class="tab12">
                                                            <td>
                                                                <a href="javascript:void(0)" id="student1" data-id="{{ $avtar->id }}" data-cl="{{ $cred->class_id ?? 1 }}" data-sub="{{ $cred->sub_id ?? 1 }}">
                                                                    <div class="sell-table-group d-flex align-items-center">
                                                                        <div class="sell-group-img student-news">
                                                                            @if (isset($category))
                                                                            @if ($category->image)
                                                                            <img src="{{ asset('uploads/categories/' . $category->image) }}" class="img-fluid s-list" alt="">
                                                                            @else
                                                                            <img src="{{ asset('assets//img/my-img/web_img/10.png') }}" class="img-fluid s-list" alt="">
                                                                            @endif
                                                                            @endif
                                                                        </div>
                                                                        <div class="sell-tabel-info">
                                                                            <div style="font-size: 20px;display: flex;">
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

                                                            <td style="text-align: center;"><img src="{{ asset('assets/img/course/av.jpeg') }}" class="img-fluid" style="width: 30px" alt=""><br>
                                                                <b>{{ $avtar->first_name ?? '' }}</b>
                                                            </td>
                                                            <!-- <td style="float: right;"> <a href="{{ $st212->student_url }}"><span
                                                                        class="badge info-low">Join Class</span> </a> </td> -->
                                                            @if ($st212->is_cancelled == 1)
                                                            <td style="text-align: center;"><span class="badge info-low" style="color: #fff;border-radius: 7px!important;">cancelled</span>
                                                            </td>
                                                            @else
                                                            @if ($s_time < $today1) <td style="text-align: center;"><a href="{{ $st212->teacher_url }}"><span class="badge info-low" style="color: #fff;border-radius: 7px!important;background-color: #009fff;">Join
                                                                        Now</span></a></td>
                                                                @else
                                                                <td style="text-align: center;" id="demo1{{ $st212->id }}">
                                                                    @if ($ex_t_date <= $s_time) <i id="cancel-reshed" data-id="{{ $st212->id }}" class="fa fa-times-circle close-v" style="font-size:24px;color: #ff0909;">
                                                                        </i>
                                                                        @endif
                                                                        <span class="badge info-low" style="color: #fff;background-color: #f96d41;border-radius: 7px!important;">Starts
                                                                            in <span id="demo{{ $st212->id }}">
                                                                            </span></span>
                                                                </td>
                                                                @endif
                                                                @endif
                                                        </div>
                                                        <script>
                                                            // Set the date we're counting down to
                                                            var countDownDate {
                                                                {
                                                                    $st212 - > id
                                                                }
                                                            } = new Date("{{ $time128 }}").getTime();
                                                            // Update the count down every 1 second
                                                            var x {
                                                                {
                                                                    $st212 - > id
                                                                }
                                                            } = setInterval(function() {
                                                                // Get today's date and time
                                                                var now = new Date().getTime();
                                                                // Find the distance between now and the count down date
                                                                var distance = countDownDate {
                                                                    {
                                                                        $st212 - > id
                                                                    }
                                                                } - now;
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
                                                                    clearInterval(x {
                                                                        {
                                                                            $st212 - > id
                                                                        }
                                                                    });
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
                    <div class="data12"></div>

            </div>                   
