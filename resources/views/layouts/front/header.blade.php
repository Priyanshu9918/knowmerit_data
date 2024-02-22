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
            <a href="{{url('/')}}" class="navbar-brand logo">
                <img src="{{asset('assets/img/logo/logo.png')}}" class="img-fluid" alt="Logo">
            </a>
            @php
                $ip = \Request::ip();
                $data = \Location::get($ip);
                $c_name = $data->countryCode ?? 'in';
            @endphp
            <!-- <a class="flagformob" href=""><img src="http://merit.techsaga.live/assets//img/my-img/web_img/flag.png"></a> -->


           <li class="nav-item noti-nav customer-serv-mob">
              <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://www.knowmerit.com/assets/img/my-img/web_img/customer-service-q.png">
              </a>
              <div class="notifications dropdown-menu dropdown-menu-right mt-2">
              <div class="topnav-dropdown-header mailchat">
                <div class="home-page-live-chat">
                  <a href="javascript:void(Tawk_API.toggle())" style="display: flex; align-items: baseline;"><span class="live-v"> </span>
                  <span class="" style="margin-left: 10px;">Live Chat</span></a>
                  </div>
                  <div class="home-page-email"><i class="fa fa-envelope" aria-hidden="true" style="color: #009fff;"></i> <a href="mailto: support@knowmerit.com" style="position: relative;
                  left: 6px;">support@knowmerit.com</a></div>

              </div>
              </div>
          </li>






            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{url('/')}}" class="menu-logo">
                    <img src="{{asset('assets/img/logo/logo.png')}}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                    </a>
                </div>

                <ul class="main-nav">


                <!-- <li class="login-link">
                <a href="javascript:" class=""><i class="fa fa-user" aria-hidden="true" style="margin-right: 9px;"></i>Dashboard<i class="fas fa-chevron-down" style="float: right;"></i></a>
                <ul class="submenu" style="display: none;">
                <li><div class="user-header">
                  <div class="avatar avatar-sm">
                  <img src="http://127.0.0.1:8000/assets/img/user/user11.jpg" alt="User Image" class="avatar-img rounded-circle">
                  </div>
                  <div class="user-text">
                  <h6 style="color:#fff">Vishal</h6>
                  <p class="text-muted mb-0" style="color:#fff!important">Teacher</p>
                  </div>
                  </div></li>
                <li><a class="dropdown-item" href="http://127.0.0.1:8000/teacher/teacher-instructor-dashboard"><i class="feather-user me-1"></i>My Dashboard</a></li>
                </ul>
                </li> -->



                  <!-- before login -->
                    @if(!Auth::check())
                      <li class="login-link logindem">
                        <a class="nav-link" href="{{url('book-a-demo')}}"><i class="fa fa-file" aria-hidden="true" style="margin-right: 9px;"></i><span>Book a Demo Class</span></a>
                      </li>
                      <li class="login-link logindem">
                        <a class="nav-link" href="{{url('user/login')}}"><i class="fa fa-sign-in" aria-hidden="true" style="margin-right: 9px;"></i>Login</a>
                      </li>
                    @endif

                    @if(Auth::check() && Auth::user()->user_type == 2)
                        <li class="login-link logindem">
                            <a class="nav-link" href="{{ url('teacher/teacher-instructor-dashboard') }}">
                                <i class="feather-user me-1" style="margin-right: 9px;"></i>
                                My Dashboard
                            </a>
                        </li>
                    @else
                        <li class="login-link logindem">
                            <a class="nav-link" href="{{ url('student/student-dashboard') }}">
                                <i class="feather-user me-1" style="margin-right: 9px;"></i>
                                My Dashboard
                            </a>
                        </li>
                    @endif







                <li class="login-link">
                {{-- <a href="#" class="side-m"><i class="feather-map-pin" style="margin-right: 9px;"></i>Location (Set Your Location)</a> --}}
                 </li>
                 <li class="login-link">
                 @if(!Auth::check())
                    <a href="{{url('/create-teacher')}}" class="side-m"><i class="fa fa-address-book" aria-hidden="true" style="margin-right: 9px;"></i><span>Signup as a Tutor</span></a>
                    <a href="{{url('/create-student')}}" class="side-m"><i class="fa fa-address-card" aria-hidden="true" style="margin-right: 9px;"></i><span>Signup as a Student</span></a>

                    @endif
                 </li>
                 <li class="login-link">
                 {{-- @if(Auth::check()) --}}
                 <a href="{{url('/trainer-list')}}" class="side-m"><i class="fa fa-user" aria-hidden="true" style="margin-right: 9px;"></i> Find a Tutor</a>
                {{-- @endif --}}

                </li>
                <li class="login-link">
                <a href="{{url('/about-us')}}" class="side-m"><i class="fa fa-user" aria-hidden="true" style="margin-right: 9px;"></i>About Us</a>
                </li>
                <li class="login-link">
                <a href="{{url('/faq')}}" class="side-m"><i class="fa fa-question-circle" aria-hidden="true" style="margin-right: 9px;"></i>FAQs</a>
                </li>
                <li class="login-link">
                <a href="{{url('/community')}}" class="side-m" ><i class="fa fa-users" aria-hidden="true" style="margin-right: 9px;"></i> Community</a>



                </li>
                 @if(Auth::check())

                <li class="login-link">
                <a href="{{url('/write-a-review')}}" class="side-m"><i class="fa fa-building" aria-hidden="true" style="margin-right: 9px;"></i> Write a review</a>
                </li>
                @endif

                <li class="login-link">
                <a href="{{url('/contact-us')}}" class="side-m"><i class="fa fa-pencil-square" aria-hidden="true" style="margin-right: 9px;"></i>Contact Us</a>
                </li>
                <li class="login-link">
                    @if(Auth::check())
                    <a href="{{ url('student/logout') }}" class="side-m"><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 9px;"></i>Log Out</a>
                    @endif
                </li>
                </ul>
            </div>
            <ul class="nav header-navbar-rht align-items-center">
            <li class="nav-item">
                <div class="flag">
                  @if(isset($c_name))
                  <span style="position:relative; left:-9px; top:-9px;"><x-dynamic-component component="flag-country-{{ strtolower($c_name) ?? 'in' }}" /></span>
                  @else
                  <span style="position:relative; left:-9px; top:-9px;"><x-dynamic-component component="flag-country-in" /></span>
                  @endif
                </div>
            </li>
<li class="nav-item noti-nav">
<a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
<img src="{{asset('assets//img/my-img/web_img/customer-service-q.png')}}" style="width: 22px;margin-right: 5px;margin-top: -4px;">
</a>
<div class="notifications dropdown-menu dropdown-menu-right mt-2">
<div class="topnav-dropdown-header mailchat">
  <div class="home-page-live-chat">
    <a href="javascript:void(Tawk_API.toggle())" style="display: flex; align-items: baseline;"><span class="live-v"> </span>
    <span class="" style="margin-left: 10px;">Live Chat</span></a>
    </div>
 <div class="home-page-email"><i class="fa fa-envelope" aria-hidden="true" style="color: #009fff;"></i> <a href="mailto: support@knowmerit.com" style="position: relative;
    left: 6px;">support@knowmerit.com</a></div>



</div>


</div>
</li>






            <!-- <li class="nav-item">
                <img src="http://merit.techsaga.live/assets//img/my-img/web_img/customer-service-q.png" style="width: 22px;margin-right: 5px;margin-top: -4px;">
            </li> -->
            @if(Auth::check() && Auth::user()->user_type == 2)
                <li class="nav-item">
                  <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="user-img">
                    @if(Auth::user()->avatar == null)
                    <img src="{{asset('assets/img/user/av.jpg')}}" alt>
                   @else
                      <img src="{{ asset('uploads/tutors/' .Auth::user()->avatar) }}"  alt>
                   @endif
                  <span class="status online"></span>
                  </span>
                  </a>
                  <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
                  <div class="user-header">
                  <div class="avatar avatar-sm">
                  {{-- <img src="{{asset('assets/img/user/user11.jpg')}}" alt="User Image" class="avatar-img rounded-circle"> --}}

                    @if(Auth::user()->avatar == null)
                    <img src="{{asset('assets/img/user/av.jpg')}}" alt>
                   @else
                      <img src="{{ asset('uploads/tutors/' .Auth::user()->avatar) }}"  alt="User Image" class="avatar-img rounded-circle">
                   @endif
                  </div>
                  <div class="user-text">
                  <h6>{{ ucwords(Str(Auth::user()->name) ?? 'Teacher') }}</h6>
                  <p class="text-muted mb-0">Teacher</p>
                  </div>
                  </div>
                  <a class="dropdown-item" href="{{url('/teacher/teacher-instructor-dashboard')}}"><i class="feather-user me-1"></i>My Dashboard</a>


                  <a class="dropdown-item" href="{{url('/student/logout')}}"><i class="feather-log-out me-1"></i> Logout</a>
                  </div>
                  </li>
                @elseif(Auth::check() && Auth::user()->user_type == 3)
                @php
                $id = Auth::user()->id;
                $avtar = DB::table('users')
                    ->where('id', $id)
                    ->where('status', 1)
                    ->first();
            @endphp

            <li class="nav-item">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    @if (isset($avtar->avatar))
                    <span class="user-img">
                        <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt="">
                        <span class="status online"></span>
                    </span>
                    @else
                    <span class="user-img">
                        <img src="{{ asset('assets/img/user/av.jpg') }}" alt="">
                        <span class="status online"></span>
                    </span>
                    @endif
                </a>
                <div class="users dropdown-menu dropdown-menu-right" data-popper-placement="bottom-end">
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            @if (isset($avtar->avatar))
                            <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt="User Image"
                                class="avatar-img rounded-circle">
                                @else
                                <img src="{{ asset('assets/img/user/user11.jpg') }}" alt="User Image"
                                class="avatar-img rounded-circle">
                                @endif
                        </div>
                        <div class="user-text">
                            <h6>{{ Auth::user()->first_name ?? 'student' }}</h6>
                            <p class="text-muted mb-0">Student</p>
                        </div>
                    </div>
                    <a class="dropdown-item" href="{{ url('/student/student-dashboard') }}"><i
                            class="feather-user me-1"></i>My Dashboard</a>
                    <a class="dropdown-item" href="{{ url('/student/logout') }}"><i
                            class="feather-log-out me-1"></i> Logout</a>
                </div>
            </li>
                @else
                <li class="nav-item">
                  <a class="nav-link login-three-head button" href="{{url('/book-a-demo')}}"><span>Book a Demo Class</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link signin-three-head" href="{{route('front.login')}}">Login</a>
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
@if(!Auth::check())
<a href="{{url('/create-teacher')}}" class="side-m"><i class="fa fa-envelope-open" aria-hidden="true" style="margin-right: 9px;"></i><span>Signup as a Tutor</span></a>
<a href="{{url('/create-student')}}" class="side-m"><i class="fa fa-users" aria-hidden="true" style="margin-right: 9px;"></i><span>Signup as a Student</span></a>

@endif

<a href="{{url('/trainer-list')}}" class="side-m"><i class="fa fa-user" aria-hidden="true" style="margin-right: 9px;"></i> Find a Tutor</a>
<a href="{{url('/about-us')}}" class="side-m"><i class="fa fa-user" aria-hidden="true" style="margin-right: 9px;"></i>About Us</a>
<a href="{{url('/faq')}}" class="side-m"><i class="fa fa-address-card" aria-hidden="true" style="margin-right: 9px;"></i>FAQs</a>
<a href="{{url('/community')}}" class="side-m" ><i class="fa fa-address-book" aria-hidden="true" style="margin-right: 9px;"></i> Community</a>
<a href="{{url('/blog')}}" class="side-m" ><i class="fa fa-address-book" aria-hidden="true" style="margin-right: 9px;"></i> Blogs</a>
<a href="{{url('/contact-us')}}" class="side-m"><i class="fa fa-pencil-square" aria-hidden="true" style="margin-right: 9px;"></i>Contact Us</a>
@if(Auth::check())
<a href="{{url('/write-a-review')}}" class="side-m"><i class="fa fa-building" aria-hidden="true" style="margin-right: 9px;"></i> Write a review</a>
<a href="{{ url('student/logout') }}" class="side-m"><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 9px;"></i>Log Out</a>
@endif
{{-- <a href="{{url('student/logout')}}" class="side-m"><i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 9px;"></i>Log Out</a> --}}
</div>
