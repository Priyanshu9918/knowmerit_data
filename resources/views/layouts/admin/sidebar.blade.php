<style>
    .dropdown-container {
        display: none;
        background-color: #fafbff;
        padding-left: 8px;
    }

    /* Optional: Style the caret down icon */
    .fa-caret-down {
        float: right;
        padding-right: 8px;
    }
    .sidebar .nav .nav-item.active > .nav-link
    {
        color: #fff;
    }
    .sidebar .nav .nav-item.active > .nav-link i
    {
        color: #fff !important;
    }

    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 20px;
        color: #818181;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    .dropdown-container a {
        padding: 9px 8px 9px 16px;
        text-decoration: none;
        font-size: 0.875rem;
        line-height: 1;
        /* font-size: 20px; */
        color: #6C7383;
        display: block;
        border-bottom: 1px solid #dae7ff;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
    }

    button.dropdown-btn {
        color: inherit;
        display: inline-block;
        font-size: 0.875rem;
        line-height: 1;
        vertical-align: middle;
    }

    .nav-link:hover i {
        color: #fff !important;
    }

    .drop-d {
        position: absolute;
        top: 10px;
        right: 0;
    }

    i.fa.fa-angle-right {
        margin-right: 8px;
    }

    .sidebar {
        width: 250px !important;
    }
</style>
<nav class="sidebar sidebar-offcanvas " id="sidebar">
    <ul class="nav">
        @if (Auth::user()->user_type != '0')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <?php
            $childs = Helper::get_user_permission();
            $permissions = DB::table('action_masters')
                ->whereIn('id', $childs)
                ->where('parent_id', 0)
                ->orderBy('display_order', 'desc')
                ->get();
            ?>
            @foreach ($permissions as $item)
                @if ($item->action == '/user')
                    <?php $active = 'admin/user'; ?>
                @endif
                @if ($item->action == '/role')
                    <?php $active = 'admin/role'; ?>
                @endif
                @if ($item->action == '/booking')
                    <?php $active = 'admin/booking'; ?>
                @endif
                @if ($item->action == '/payment')
                    <?php $active = 'admin/payment'; ?>
                @endif
                @if ($item->action == '/member_ship_plan')
                    <?php $active = 'admin/member_ship_plan'; ?>
                @endif
                @if ($item->action == '/benifit')
                    <?php $active = 'admin/benifit'; ?>
                @endif
                @if ($item->action == '/teacher')
                    <?php $active = 'admin/teacher'; ?>
                @endif
                @if ($item->action == '/mcq')
                    <?php $active = 'admin/mcq'; ?>
                @endif
                @if ($item->action == '/faq')
                    <?php $active = 'admin/faq'; ?>
                @endif
                @if ($item->action == '/community')
                    <?php $active = 'admin/community'; ?>
                @endif
                @if ($item->action == '/write-a-review')
                    <?php $active = 'admin/write-a-review'; ?>
                @endif
                @if ($item->action == '/manage-banner')
                    <?php $active = 'admin/manage-banner'; ?>
                @endif
                @if ($item->action == '/category')
                    <?php $active = 'admin/category'; ?>
                @endif
                @if ($item->action == '/count')
                    <?php $active = 'admin/count'; ?>
                @endif
                @if ($item->action == '/testimonial')
                    <?php $active = 'admin/testimonial'; ?>
                @endif
                @if ($item->action == '/featured')
                    <?php $active = 'admin/featured'; ?>
                @endif
                @if ($item->action == '/blog')
                    <?php $active = 'admin/blog'; ?>
                @endif
                @if ($item->action == '/whyknowmerits')
                    <?php $active = 'admin/whyknowmerits'; ?>
                @endif
                @if ($item->action == '/aboutus-point')
                    <?php $active = 'admin/aboutus-point'; ?>
                @endif
                @if ($item->action == '/about-us')
                    <?php $active = 'admin/about-us'; ?>
                @endif
                @if ($item->action == '/dashboard')
                    <?php $active = 'admin/dashboard'; ?>
                @endif
                @if ($item->action == '/contact_headers')
                    <?php $active = 'admin/contact_headers'; ?>
                @endif
                @if ($item->action == '/contact_masters')
                    <?php $active = 'admin/contact_masters'; ?>
                @endif
                @if ($item->action == '/contact_sec_fsts')
                    <?php $active = 'admin/contact_sec_fsts'; ?>
                @endif
                @if ($item->action == '/contact_sec_scnds')
                    <?php $active = 'admin/contact_sec_scnds'; ?>
                @endif
                @if ($item->action == '/enquiery')
                    <?php $active = 'admin/enquiery'; ?>
                @endif



                @if ($item->action == '/manage-page')
                    <?php $active = 'admin/manage-page'; ?>
                @endif
                @if ($item->action == '/membership-teacher')
                    <?php $active = 'admin/membership-teacher'; ?>
                @endif
                @if ($item->action == '/referral')
                    <?php $active = 'admin/referral'; ?>
                @endif
                @if ($item->action == '/footer')
                    <?php $active = 'admin/footer'; ?>
                @endif

                <li class="nav-item @if (Session::get('active') == '{{ $item->action_title }}') active @endif">
                    <a class="nav-link" href="{{ url($active) }}">
                        <i class="icon-paper menu-icon"></i>
                        <span class="menu-title">{{ $item->action_title }}</span>
                    </a>
                </li>
            @endforeach
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" style="position:relative">
                <button class="dropdown-btn nav-link {{ in_array(Request::segment(2), ['manage-banner', 'category', 'count', 'testimonial', 'featured', 'blog', 'whyknowmerits']) ? 'active' : '' }}">
                    <i class="fa fa-dashboard menu-icon" style="font-size: 1rem; line-height: 1; margin-right: 1rem; color: #6C7383;"></i>
                    Home Management
                    <i class="fa fa-caret-down drop-d"></i>
                </button>
                <div class="dropdown-container" @if(in_array(Request::segment(2), ['manage-banner', 'category', 'count', 'testimonial', 'featured', 'blog', 'whyknowmerits'])) style="display: block;" @endif>
                    <a class="{{ Request::segment(2) == 'manage-banner' ? 'text-primary' : '' }}" href="{{ route('admin.manage-banner') }}">
                        <i class="fa fa-angle-right"></i> Banner Management
                    </a>
                    <a class="{{ Request::segment(2) == 'category' ? 'text-primary' : '' }}" href="{{ route('admin.category') }}">
                        <i class="fa fa-angle-right"></i> Category Management
                    </a>
                    <a class="{{ Request::segment(2) == 'count' ? 'text-primary' : '' }}" href="{{ route('admin.count') }}">
                        <i class="fa fa-angle-right"></i> Count Management
                    </a>
                    <a class="{{ Request::segment(2) == 'testimonial' ? 'text-primary' : '' }}" href="{{ route('admin.testimonial') }}">
                        <i class="fa fa-angle-right"></i> Testimonial Manage
                    </a>
                    <a class="{{ Request::segment(2) == 'featured' ? 'text-primary' : '' }}" href="{{ route('admin.featured') }}">
                        <i class="fa fa-angle-right"></i> Featured Manage
                    </a>
                    <a class="{{ Request::segment(2) == 'blog' ? 'text-primary' : '' }}" href="{{ route('admin.blog') }}">
                        <i class="fa fa-angle-right"></i> Blog Management
                    </a>
                    <a class="{{ Request::segment(2) == 'whyknowmerits' ? 'text-primary' : '' }}" href="{{ route('admin.whyknowmerits') }}">
                        <i class="fa fa-angle-right"></i> Why Know Merit
                    </a>
                </div>
            </li>


            <li class="nav-item  {{ in_array(Request::segment(2), ['boutus-point', 'about-us']) ? 'active' : '' }}" style="position:relative">
                <button class="dropdown-btn nav-link"><i class="fa fa-dashboard menu-icon"
                        style="font-size: 1rem;
                    line-height: 1;
                    margin-right: 1rem;
                    color: #6C7383;"></i>
                   About Us Management
                    <i class="fa fa-caret-down drop-d"></i>
                </button>
                <div class="dropdown-container" @if(in_array(Request::segment(2), ['aboutus-point', 'about-us'])) style="display: block;" @endif>
                    <a class="{{ Request::segment(2) == 'aboutus-point' ? 'text-primary' : '' }}"  href="{{ route('admin.aboutus-point') }}"><i class="fa fa-angle-right"></i>Aboutus
                        Point</a>
                    <a class="{{ Request::segment(2) == 'about-us' ? 'text-primary' : '' }}"  href="{{ route('admin.about-us') }}"><i class="fa fa-angle-right"></i>About us
                        Management</a>
                </div>
            </li>
            <li class="nav-item {{Request::segment(2) == 'user' ? 'active' : ''  }}">
                <a class="nav-link " href="{{ route('admin.user') }}">
                    <i class="fa fa-user menu-icon"></i>
                    <span class="menu-title">User Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'role' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.role') }}">
                    <i class="fa fa-adjust menu-icon"></i>
                    <span class="menu-title">Role Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'teacher' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.tutor') }}">
                    <i class="fa fa-user-circle menu-icon"></i>
                    <span class="menu-title">Teacher Management</span>
                </a>
            </li>

            <li class="nav-item {{Request::segment(2) == 'student_manegement_two' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.student_manegement_two') }}">
                    <i class="fa fa-user-circle menu-icon"></i>
                    <span class="menu-title">Student Management</span>
                </a>
            </li>
            <!-- <li class="nav-item {{Request::segment(2) == 'mcq' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.mcq') }}">
                    <i class="fa fa-question-circle menu-icon"></i>
                    <span class="menu-title">MCQs Management</span>
                </a>
            </li> -->
            <li class="nav-item {{Request::segment(2) == 'issue' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.issue') }}">
                    <i class="fa fa-user-circle menu-icon"></i>
                    <span class="menu-title">User Issues</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 's_attendace' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.s_attendace') }}">
                    <i class="fa fa-user-circle menu-icon"></i>
                    <span class="menu-title">User Attendance</span>
                </a>
            </li>
            <!-- <li class="nav-item {{Request::segment(2) == 't_attendace' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.t_attendace') }}">
                    <i class="fa fa-user-circle menu-icon"></i>
                    <span class="menu-title">Teacher Attendance</span>
                </a>
            </li> -->
            <li class="nav-item {{Request::segment(2) == 'course-bank' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.course-bank') }}">
                    <i class="fa fa-question-circle menu-icon"></i>
                    <span class="menu-title">Course Bank</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'landingdatas' ? 'active' : ''  }}">
                <a class="nav-link " href="{{ route('admin.landingdatas') }}">
                    <i class="fa fa-user menu-icon"></i>
                    <span class="menu-title">Enquiry Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'booking' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.booking') }}">
                    <i class="fa fa-book menu-icon"></i>
                    <span class="menu-title">Booking Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'payment' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.payment') }}">
                    <i class="fa fa-credit-card menu-icon"></i>
                    <span class="menu-title">Student Payment</span>
                </a>
            </li>

            <li class="nav-item {{Request::segment(2) == 'member_ship_plan' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.member_ship_plan') }}">
                    <i class="fa fa-address-card menu-icon"></i>
                    <span class="menu-title">Membership Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'benifit' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.benifit') }}">
                    <i class="fa fa-address-card menu-icon"></i>
                    <span class="menu-title">Benefits Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'faq' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.faq') }}">
                    <i class="fa fa-question-circle menu-icon"></i>
                    <span class="menu-title">FAQ Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'community' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.community') }}">
                    <i class="fa fa-users menu-icon"></i>
                    <span class="menu-title">Community Management</span>
                </a>
            </li>

            <li class="nav-item {{Request::segment(2) == 'write-a-review' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.write-a-review') }}">
                    <i class="fa fa-info-circle menu-icon"></i>
                    <span class="menu-title">Write A Review</span>
                </a>
            </li>

            <li class="nav-item {{ in_array(Request::segment(2), ['contact_headers', 'contact_masters','contact_sec_fsts','contact_sec_scnds','enquiery']) ? 'active' : '' }}"  style="position:relative">
                <button class="dropdown-btn nav-link"><i class="fa fa-dashboard menu-icon"
                        style="font-size: 1rem;
                    line-height: 1;
                    margin-right: 1rem;
                    color: #6C7383;"></i>
                    Contact Master
                    <i class="fa fa-caret-down drop-d"></i>
                </button>
                <div class="dropdown-container" @if ( in_array(Request::segment(2), ['contact_headers', 'contact_masters','contact_sec_fsts','contact_sec_scnds','enquiery'])) style="display: block;"  @endif>
                <a class="{{ Request::segment(2) == 'contact_headers' ? 'text-primary' : '' }}" href="{{ route('admin.contact_headers') }}"><i class="fa fa-angle-right"></i>Contact Header Section</a>
                <a class="{{ Request::segment(2) == 'contact_masters' ? 'text-primary' : '' }}" href="{{ route('admin.contact_masters') }}"><i class="fa fa-angle-right"></i>Contact Master</a>
                <a class="{{ Request::segment(2) == 'contact_sec_fsts' ? 'text-primary' : '' }}" href="{{ route('admin.contact_sec_fsts') }}"><i class="fa fa-angle-right"></i>Contact Us</a>
                <a class="{{ Request::segment(2) == 'contact_sec_scnds' ? 'text-primary' : '' }}" href="{{ route('admin.contact_sec_scnds') }}"><i class="fa fa-angle-right"></i>Contact Us Bottom Part</a>
                <a class="{{ Request::segment(2) == 'enquiery' ? 'text-primary' : '' }}" href="{{ route('admin.enquiery') }}"><i class="fa fa-angle-right"></i>Contact Us Enquiry</a>

                </div>
            </li>


            <li class="nav-item {{Request::segment(2) == 'manage-page' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.manage-page') }}">
                    <i class="fa fa-info-circle menu-icon"></i>
                    <span class="menu-title">Page Manage</span>
                </a>
            </li>

            <li class="nav-item {{Request::segment(2) == 'membership-teacher' ? 'active' : ''  }} ">
                <a class="nav-link" href="{{ route('admin.membership.teacher') }}">
                    <i class="fa fa-address-card menu-icon"></i>
                    <span class="menu-title">Membership Teacher</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'referral' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.referral') }}">
                    <i class="fa fa-address-card menu-icon"></i>
                    <span class="menu-title">Referral Management</span>
                </a>
            </li>
            <li class="nav-item {{Request::segment(2) == 'footer' ? 'active' : ''  }}">
                <a class="nav-link" href="{{ route('admin.footer') }}">
                    <i class="fa fa-address-card menu-icon"></i>
                    <span class="menu-title">Footer Menu Management</span>
                </a>
            </li>
           



    </ul>
    @endif
</nav>



