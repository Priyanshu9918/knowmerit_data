<style>
    .headborder {
        border-right: 1px solid #c5e2fb;
        padding: 0px 12px;
        height: 30px;
    }

    .enqui-task ul li a {
        font-size: 17px !important;
    }
</style>

<header class="header-three">
    <div class="header-fixed-three header-fixed">
        <nav class="navbar navbar-expand-lg header-nav-three scroll-sticky">
            <div class="container">
                <div class="navbar-header">
                    <a id="mobile_btn" href="javascript:">
                        <span class="bar-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </a>
                    <a href="{{ url('/') }}" class="navbar-brand logo">
                        <img src="{{ asset('assets/img/logo/logo.png') }}" class="img-fluid" alt="Logo">
                    </a>
                    @php
                        $ip = \Request::ip();
                        $data = \Location::get($ip);
                        $c_name = $data->countryCode ?? 'in';
                    @endphp
                    <ul class="nav header-navbar-rht align-items-center all-option-for-mobile">
                        <li class="nav-item">
                            <a href=""><img src="http://knowmerit.com/assets/img/icon/messages.svg"
                                    alt="img">
                                <span class="badge badge-danger notification-v">9</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class=""><span style="font-size: 23px;">🇮🇳</span></div>
                        </li>
                        <li class="nav-item noti-nav">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <img src="http://knowmerit.com/assets//img/my-img/web_img/customer-service-q.png"
                                    style="width: 22px;margin-right: 5px;margin-top: -4px;">
                            </a>
                            <div class="notifications dropdown-menu dropdown-menu-right mt-2">
                                <div class="topnav-dropdown-header">
                                    <a href="javascript:void(Tawk_API.toggle())" style="display: flex;">
                                        <div class="live-v"> </div>
                                        <div class="" style="margin-left: 10px">Live Chat</div>
                                    </a>
                                    <div style="display: flex;"><i class="fa fa-envelope" aria-hidden="true"
                                            style="color: #009fff;"></i> <a href="mailto: support@knowmerit.com"
                                            style="position: relative; top: -13px; left: 6px;">support@knowmerit.com</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>




                </div>

                <div class="main-menu-wrapper">
                    <div class="menu-header">
                        <a href="{{ url('/') }}" class="menu-logo">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>












                    <ul class="nav header-navbar-rht align-items-center all-option-for-mobile-menu">
                        @php
                            $tutor_id = Auth::user()->id;
                            $tutor = DB::table('coins_histories')
                                ->where('tutor_id', $tutor_id)
                                ->get();
                            $totalAmount = 0;
                        @endphp
                        @foreach ($tutor as $history)
                            @php
                                $totalAmount += $history->amount;
                            @endphp
                        @endforeach
                        <li class="nav-item">
                            @if (isset($totalAmount))
                                <a href=" {{ url('/teacher/teacher-coins-history') }}">
                                    <img src="{{ asset('assets/img/my-img/web_img/coin-img12.png') }}"
                                        style="width: 22px; margin-right: 3px; margin-top: -4px;">
                                    <span style="margin-left: 2px">{{ $totalAmount }}</span>
                                </a>
                            @else
                                <a href=" {{ url('/teacher/teacher-coins-history') }}">
                                    <img src="{{ asset('assets/img/my-img/web_img/coin-img12.png') }}"
                                        style="width: 22px; margin-right: 3px; margin-top: -4px;">
                                    <span style="margin-left: 2px">₹ 0</span>
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a href=" {{ url('/teacher/teacher-my-membership') }}">
                                <img src="http://knowmerit.com/assets//img/my-img/web_img/wallet-white.png"
                                    style="width: 22px;margin-right: 5px;margin-top: -4px;">
                            </a>
                        </li>


                    </ul>







                    <ul class="teacher-mobile-menu">
                        <li>
                            <a class="side-m" href="{{ url('teacher/teacher-instructor-dashboard') }}"><i
                                    class="feather-user me-1" style="margin-right: 9px;"></i>My Dashboard</a>
                        </li>
                        {{-- <li><a href="#" class="side-m"><i class="feather-map-pin" style="margin-right: 9px;"></i>Location (Set Your Location)</a></li> --}}
                        @if (!Auth::check())
                            <li><a href="{{ url('/create-teacher') }}" class="side-m"><i class="fa fa-envelope-open"
                                        aria-hidden="true" style="margin-right: 9px;"></i><span>Signup as a
                                        Tutor</span></a></li>
                            <li><a href="{{ url('/create-student') }}" class="side-m"><i class="fa fa-envelope-open"
                                        aria-hidden="true" style="margin-right: 9px;"></i><span>Signup as a
                                        Student</span></a></li>
                        @endif
                        @if (Auth::check())
                            <li><a href="{{ url('/trainer-list') }}" class="side-m"><i class="fa fa-user"
                                        aria-hidden="true" style="margin-right: 9px;"></i> Find a Tutor</a></li>
                        @endif
                        <li><a href="{{ url('/about') }}" class="side-m"><i class="fa fa-user" aria-hidden="true"
                                    style="margin-right: 9px;"></i>About Us</a></li>
                        <li><a href="{{ url('/faq') }}" class="side-m"><i class="fa fa-address-card"
                                    aria-hidden="true" style="margin-right: 9px;"></i>FAQs</a></li>
                        <li><a href="{{ url('/community') }}" class="side-m"><i class="fa fa-address-book"
                                    aria-hidden="true" style="margin-right: 9px;"></i> Community</a></li>
                        <li><a href="{{ url('/write-a-review') }}" class="side-m"><i class="fa fa-building"
                                    aria-hidden="true" style="margin-right: 9px;"></i> Write a review</a></li>
                        <li><a href="{{ url('/contact') }}" class="side-m"><i class="fa fa-pencil-square"
                                    aria-hidden="true" style="margin-right: 9px;"></i>Contact Us</a></li>
                        <li><a href="{{ url('student/logout') }}" class="side-m"><i class="fa fa-sign-out"
                                    aria-hidden="true" style="margin-right: 9px;"></i>Log Out</a></li>
                    </ul>




                </div>

                <ul class="nav header-navbar-rht align-items-center">
                    @php
                        $tutor_id = Auth::user()->id;
                        $tutor = DB::table('coins_histories')
                            ->where('tutor_id', $tutor_id)
                            ->get();
                        $totalAmount = 0;
                    @endphp
                    @foreach ($tutor as $history)
                        @php
                            $totalAmount += $history->amount;
                        @endphp
                    @endforeach
                    <li class="nav-item headborder">
                        @if (isset($totalAmount))
                            <a href=" {{ url('/teacher/teacher-coins-history') }}">
                                <img src="{{ asset('assets/img/my-img/web_img/coin-img12.png') }}"
                                    style="width: 22px; margin-right: 3px; margin-top: -4px;">
                                <span style="margin-left: 2px">{{ $totalAmount }}</span>
                            </a>
                        @else
                            <a href=" {{ url('/teacher/teacher-coins-history') }}">
                                <img src="{{ asset('assets/img/my-img/web_img/coin-img12.png') }}"
                                    style="width: 22px; margin-right: 3px; margin-top: -4px;">
                                <span style="margin-left: 2px">₹ 0</span>
                            </a>
                        @endif
                    </li>
                    <li class="nav-item headborder">
                        <a href=" {{ url('/teacher/teacher-my-membership') }}">
                            <img src="{{ asset('assets//img/my-img/web_img/wallet-q.png') }}"
                                style="width: 22px;margin-right: 5px;margin-top: -4px;">
                        </a>
                    </li>

                    {{-- <ul class="nav header-navbar-rht align-items-center">
                <li class="nav-item">
                       <img src="{{asset('assets//img/my-img/web_img/coin-img12.png')}}" style="width: 22px;margin-right: 5px;margin-top: -4px;"><span style="margin-left: 2px">133</span>
                    </li>
                    <li class="nav-item">
                       <img src="{{asset('assets//img/my-img/web_img/wallet-q.png')}}" style="width: 22px;margin-right: 5px;margin-top: -4px;">
                    </li> --}}
                    @if (Auth::check())
                        <li class="nav-item headborder">
                            @php
                                $total_msg = DB::table('ch_messages')
                                    ->where('seen', 0)
                                    ->where('to_id', Auth::user()->id)
                                    ->count('seen');
                            @endphp
                            <a href="{{ url('/chatify') }}"><img src="{{ asset('assets/img/icon/messages.svg') }}"
                                    alt="img">
                                <span class="badge badge-danger notification-v">{{ $total_msg ?? 0 }}</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item headborder">
                        <div class="flag">
                            @if (isset($c_name))
                                <span style="position:relative; left:-9px; top:-9px;"><x-dynamic-component
                                        component="flag-country-{{ strtolower($c_name) ?? 'in' }}" /></span>
                            @else
                                <span style="position:relative; left:-9px; top:-9px;"><x-dynamic-component
                                        component="flag-country-in" /></span>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item noti-nav headborder">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets//img/my-img/web_img/customer-service-q.png') }}"
                                style="width: 22px;margin-right: 5px;margin-top: -4px;">
                        </a>
                        <div class="notifications dropdown-menu dropdown-menu-right mt-2">
                            <div class="topnav-dropdown-header">
                                <a href="javascript:void(Tawk_API.toggle())" style="display: flex;">
                                    <div class="live-v"> </div>
                                    <div class="" style="margin-left: 10px">Live Chat</div>
                                </a>
                                <div style="display: flex;"><i class="fa fa-envelope" aria-hidden="true"
                                        style="color: #009fff;"></i> <a href="mailto: support@knowmerit.com"
                                        style="position: relative;
                  top: -13px;
                  left: 6px;">support@knowmerit.com</a>
                                </div>



                            </div>


                        </div>
                    </li>
                    @if (Auth::check() && Auth::user()->user_type == 2)
                        @php
                            $id = Auth::user()->id;
                            $avtar = DB::table('users')
                                ->where('id', $id)
                                ->where('status', 1)
                                ->first();
                        @endphp
                        <li class="nav-item" style="padding-left: 13px;">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="user-img">
                                    @if (Auth::user()->avatar == null)
                                        <img src="{{ asset('assets/img/user/av.jpg') }}" alt>
                                    @else
                                        <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt>
                                    @endif
                                    <span class="status online"></span>
                                </span>
                            </a>
                            <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        @if (Auth::user()->avatar == null)
                                            <img src="{{ asset('assets/img/user/av.jpg') }}" alt>
                                        @else
                                            <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}"
                                                alt="User Image" class="avatar-img rounded-circle">
                                        @endif
                                    </div>
                                    <div class="user-text">

                                        <h6>{{ ucwords(Str(Auth::user()->name) ?? 'Teacher') }}</h6>
                                        <p class="text-muted mb-0">Teacher</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{ url('/teacher/teacher-instructor-dashboard') }}"><i
                                        class="feather-user me-1"></i>My Dashboard</a>
                                <a class="dropdown-item math_pad" href="javascript:void(0)"><i
                                        class="feather-shopping-bag"></i> &nbsp; Math Pad</a>
                                @php
                                    $tutor_id = Auth::user()->id;
                                    $tutor = DB::table('tutors')
                                        ->where('user_id', $tutor_id)
                                        ->first();
                                @endphp
                                @if ($tutor->tutor_type == 'individual')
                                    <a class="dropdown-item"
                                        href="{{ route('teacher.dashboard.tutor.edit', ['id' => base64_encode(Auth::user()->id)]) }}"><i
                                            class="feather-users"></i> &nbsp; Profile</a>
                                @else
                                    <a class="dropdown-item"
                                        href="{{ route('teacher.dashboard.institute.edit', ['id' => base64_encode(Auth::user()->id)]) }}"><i
                                            class="feather-users"></i> &nbsp; Profile</a>
                                @endif

              <a class="dropdown-item" href="{{url('/teacher/teacher-my-membership')}}"><i class="fa fa-id-badge"></i> &nbsp; My Membership</a>
              <a class="dropdown-item" href="{{url('/teacher/teacher-coins-history')}}"><i class="fa fa-list-alt"></i> &nbsp; Coins History </a>
              <a class="dropdown-item" href="{{url('/teacher/teacher-setting')}}"><i class="fa fa-cog"></i> &nbsp;Setting</a>
              @php
                  $id = rand(100000,9999999);
              @endphp
              <!-- <a class="dropdown-item" href="{{ url('/teacher/question-list') }}"><i class="fa fa-book"></i> &nbsp;Question Bank</a> -->

                                <a class="dropdown-item" href="{{ url('student/logout') }}"><i
                                        class="feather-log-out me-1"></i> Logout</a>
                            </div>
                        </li>
                    @elseif(Auth::check() && Auth::user()->user_type == 3)
                        <li class="nav-item">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="user-img">
                                    <img src="{{ asset('assets/img/user/user11.jpg') }}" alt="">
                                    <span class="status online"></span>
                                </span>
                            </a>
                            <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
                                <div class="user-header">
                                    <div class="avatar avatar-sm">
                                        <img src="{{ asset('assets/img/user/user11.jpg') }}" alt="User Image"
                                            class="avatar-img rounded-circle">
                                    </div>
                                    <div class="user-text">
                                        <h6>{{ Auth::user()->first_name ?? 'student' }}</h6>
                                        <p class="text-muted mb-0">Student</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{ url('/teacher/teacher-dashboard') }}"><i
                                        class="feather-user me-1"></i>My Dashboard</a>


                                <a class="dropdown-item" href="#"><i class="feather-log-out me-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link login-three-head button" href="{{ url('/book-a-demo') }}"><span>Book a
                                    Demo Class</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link signin-three-head" href="{{ route('front.login') }}">Login</a>
                        </li>
                    @endif
                    <li>
                        <a id="" href="javascript:" onclick="openNav()">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</header>
<div class="sidenav" id="mySidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    {{-- <a href="#" class="side-m"><i class="feather-map-pin" style="margin-right: 9px;"></i>Location (Set Your Location)</a> --}}
    @if (!Auth::check())
        <a href="{{ url('/create-teacher') }}" class="side-m"><i class="fa fa-envelope-open" aria-hidden="true"
                style="margin-right: 9px;"></i><span>Signup as a Tutor</span></a>
        <a href="{{ url('/create-student') }}" class="side-m"><i class="fa fa-envelope-open" aria-hidden="true"
                style="margin-right: 9px;"></i><span>Signup as a Student</span></a>
    @endif
    @if (Auth::check())
        {{-- <a href="{{url('/trainer-list')}}" class="side-m"><i class="fa fa-user" aria-hidden="true" style="margin-right: 9px;"></i> Find a Tutor</a> --}}
    @endif
    <a href="{{ url('/trainer-list') }}" class="side-m"><i class="fa fa-user" aria-hidden="true"
            style="margin-right: 9px;"></i> Find a Tutor</a>
    <a href="{{ url('/about') }}" class="side-m"><i class="fa fa-user" aria-hidden="true"
            style="margin-right: 9px;"></i>About Us</a>
    <a href="{{ url('/faq') }}" class="side-m"><i class="fa fa-address-card" aria-hidden="true"
            style="margin-right: 9px;"></i>FAQs</a>
    <a href="{{ url('/community') }}" class="side-m"><i class="fa fa-address-book" aria-hidden="true"
            style="margin-right: 9px;"></i> Community</a>
    <a href="{{ url('/blog') }}" class="side-m"><i class="fa fa-address-book" aria-hidden="true"
            style="margin-right: 9px;"></i> Blogs</a>
    <a href="{{ url('/write-a-review') }}" class="side-m"><i class="fa fa-building" aria-hidden="true"
            style="margin-right: 9px;"></i> Write a review</a>
    <a href="{{ url('/contact-us') }}" class="side-m"><i class="fa fa-pencil-square" aria-hidden="true"
            style="margin-right: 9px;"></i>Contact Us</a>
    <a href="{{ url('student/logout') }}" class="side-m"><i class="fa fa-sign-out" aria-hidden="true"
            style="margin-right: 9px;"></i>Log Out</a>
</div>
<div class="modal fade" id="schedule-calendar12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {{-- style="max-width:70%;" --}}
        <div class="modal-content selectplan">
            <div class="modal-header">
                <span><i class="fa-solid fa-chevron-left"></i></span>
                <h1 class="modal-title fs-5">Math Pad</h1>
                <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body time-frame12 w-100" >
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
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
        $(document).on("click", ".math_pad", function() {
            setTimeout( function(){
                cal_init();
            }  , 1000 );
            $('#schedule-calendar12').modal('show');
            cal_init();
        });
        function cal_init(){
            var c_id = 1;
                $.ajax({
                    url: "{{ route('teacher.math-pad') }}",
                    type: 'GET',
                    data: {
                        c_id: c_id,
                    },
                    success: function(data) {
                        $('.time-frame12').html(data);
                    }
                });
            }
            </script>
