<style>
    /*.edit-img {
        position: absolute;
        right: 23%;
        margin-top: 10%;
        /* justify-content: center; 
    }*/

    .profile-img12 {
        width: 12%;
        visibility: hidden;
    }
    .svg-inline--fa {
    color: #009fff;
    margin-right: 20px;
}

svg.svg-inline--fa.fa-bookmark.fa-w-12 {
    margin-left: 20px;
}

.profile-name dashb-prof
{
    color: #468dcb;
    font-size: 14px;
    margin-bottom: 20px;
    font-weight: 500;
}
.settings-widget
{
	border: 2px solid #468dcb75;
}


.editimgdes
{
    position: relative;
}

.overlaychooseimg {
    position: absolute;
    top: 0%;
    left: 0%;
    font-size: 10px;
    font-weight: 600;
    width: 100%;
    height: 100%;
    background-color: #686868ad;
    border-radius: 5px;
    display: none;
}
.editimgdes:hover .overlaychooseimg
{
    display: block;
}
.overlaychooseimg label.edit-img {
    font-size: 12px;
    color: #ffffff;
    margin-top: 40px;
    margin-left: 12px;
    font-weight: 700;
}
</style>
@php
$current = Request::segment(2);
    $id = Auth::user()->id;
    $avtar = DB::table('users') ->where('id', $id)->where('status', 1)->first();

@endphp
<div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
    <!-- <div class="settings-widget dash-profile mb-3">
        <div class="settings-menu p-0 formobview">
            <form action="{{ route('student.student_profile_update_img') }}" method="POST" id="createFrmprofile"
                enctype="multipart/form-data">
                @csrf
                <div class="profile-bg">
                    {{-- <h5>Beginner</h5> --}}
                    <div class="">
                        <a href="#">
                            @if (isset($avtar->avatar))
                            <div class="profile-imgchild">
                                <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt="" class="proimgdes12">
                                <label for="fileToUpload" class="edit-img imgiconpro"><i class="fa fa-edit proiconsec"></i></label>
                                <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" />
                            </div>
                            
                            @else
                            <div class="profile-imgchild">
                                <img class="img-fluid proimgdes12" alt src="{{ asset('assets/img/user/av.jpg') }}">
                                <label for="fileToUpload" class="edit-img imgiconpro"><i class="fa fa-edit proiconsec"></i></label>
                                <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" />
                            </div>
                            
                            @endif
                            
                        </a>
                    </div>
                </div>
            </form>
            <div class="profile-group">
                <div class="profile-name">
                    <h4>
                        <a href="#">{{ Auth::user()->first_name ?? 'student' }}</a>
                    </h4>
                    <p class="dashb-prof">Student</p>
                </div>
            </div>
        </div>
    </div> -->





    <div class="student-profile-section">
        <div class="student-profile-img">
        <form action="{{ route('student.student_profile_update_img') }}" method="POST" id="createFrmprofile"
                enctype="multipart/form-data">
                @csrf
                <div class="profile-bg">
                    {{-- <h5>Beginner</h5> --}}
                    <div class="">
                        <a href="#">
                            @if (isset($avtar->avatar))
                            <div class="profile-imgchild editimgdes">
                                <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt="" class="proimgdes12">
                                
                                <div class="overlaychooseimg">
                                    <label for="fileToUpload" class="edit-img">choose Image</label>
                                    <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" />
                                </div>
                            </div>
                            
                            @else
                            <div class="profile-imgchild">
                                <img class="img-fluid proimgdes12" alt src="{{ asset('assets/img/user/av.jpg') }}">
                                <label for="fileToUpload" class="edit-img imgiconpro"><i class="fa fa-edit proiconsec"></i></label>
                                <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" />
                            </div>
                            
                            @endif
                            
                        </a>
                    </div>
                </div>
            </form>        
        </div>
        <div class="student-profile-text">
            <h4>
                <a href="#">{{ Auth::user()->first_name ?? 'student' }}</a>
            </h4>
            <p class="studt-id">ID - S0000</p>
            <div class="iconsstudent">
                <p><img src="../../../assets/img/diamond.png"><span>2500</span></p>
                <p style="margin-left: 5px;"><img src="../../../assets/img/circle.png"><span>2500</span></p>
            </div>
        </div>
        
    </div>

    <div class="student-profile-section">
      <div class="badge-certi">
          <p><span><img src="../../../assets/img/insurance.png"> My Badges</span> <span class="countnum">001</span></p>
          <p><span><img src="../../../assets/img/quality.png"> My Certificates</span> <span class="countnum">001</span></p>
          <!-- <p> My Badges <span>001</span></p>
          <p> My Certificates <span>001</span></p> -->
      </div>
      <div>
          
      </div>  
    </div>


    <div class="settings-widget account-settings">
        <div class="settings-menu">

            <ul>
                <li class="nav-item {{ Request::segment(2) == 'student-dashboard' ? 'active' : '' }}">
                    <a href="/student/student-dashboard" class="nav-link">
                        <i class="feather-home"></i> Dashboard </a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'teacher' ? 'active' : '' }}">
                    <a href="/student/teacher" class="nav-link">
                        <i class="feather-book"></i>Book Class</a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'question-list' ? 'active' : '' }}">
                <a href="{{ url('/student/question-list') }}" class="nav-link">
                <i class="fa fa-cog"></i>  My Quiz </a>
             </li>
            <li class="nav-item {{ Request::segment(2) == 'attendance' ? 'active' : '' }}">
                <a href="/student/attendance" class="nav-link">
                <i class="feather-shopping-bag"></i> Attendance </a>
             </li>
             <li class="nav-item {{ Request::segment(2) == 'student-my-class'  ? 'active' : ''}}">
                <a href="/student/student-my-class" class="nav-link">
                <i class="feather-shopping-bag"></i> My Courses </a>
             </li>
             <li class="nav-item {{ Request::segment(2) == 'math-pad'  ? 'active' : ''}}">
                <a href="javascript:void(0)" class="nav-link math_pad">
                <i class="feather-circle"></i> Math Pad </a>
             </li>
             <li class="nav-item {{ Request::segment(2) == 'editor'  ? 'active' : ''}}">
                <a href="{{url('/student/editor')}}" class="nav-link">
                <i class="feather-circle"></i> Code Editor </a>
             </li>
             <li class="nav-item {{ Request::segment(2) == 'chatify'  ? 'active' : ''}}">
                <a href="{{url('chatify')}}" class="nav-link">
                <i class="fa fa-comments"></i> Chats </a>
             </li>
             <li class="nav-item {{ Request::segment(2) == 'student-refer-earn'  ? 'active' : ''}}">
                <a href="/student/student-refer-earn" class="nav-link">
                <i class="feather-book"></i>  Refer &amp; Earn </a>
             </li>
             <li class="nav-item {{ Request::segment(2) == 'student-setting'  ? 'active' : ''}}">
                <a href="{{url('/student/student-setting')}}" class="nav-link">
                <i class="fa fa-cog"></i> Setting </a>
             </li>

             <li id="account-list" class="nav-item dropdown dropdown-account account-des">
                    <a class="nav-link">
                        <i class="fa fa-user"></i> Account <i class="fa fa-angle-down" style="margin-left: 100px;"
                            aria-hidden="true"></i></a>
                    <ul id="account-child" class="dropdown-menu dropdown-side" style="display: none;">
                        <li>
                            <a href="{{ route('teacher.dashboard.tutor.edit', ['id' => base64_encode(Auth::user()->id)]) }}" class="nav-link {{ Request::segment(2) == 'teacher-my-membership'  ? 'active' : ''}}">
                                 <i class="fa fa-id-badge"></i> Profile </a>
                        </li>
                        <li>
                            <a href="" class="nav-link {{ Request::segment(2) == 'teacher-my-membership'  ? 'active' : ''}}">
                                 <i class="fa fa-question-circle-o"></i> Q&A </a>
                        </li>
                    </ul>
                </li>

             {{-- <li class="nav-item {{ Request::segment(2) == 'change-password'  ? 'active' : ''}}">
                <a href="/student/change-password" class="nav-link">
                <i class="fa fa-list-alt"></i> Change Password</a>
             </li> --}}
<!--
                <li id="account-list" class="nav-item dropdown dropdown-account">
                    <a class="nav-link">
                        <i class="fa fa-user"></i> Account <i class="fa fa-angle-down" style="margin-left: 100px;"
                            aria-hidden="true"></i></a>
                    <ul id="account-child" class="dropdown-menu dropdown-side" style="display: none;">
                        <li>
                            <a href="/student/student-profile"
                                class="nav-link {{ Request::segment(2) == 'student-profile' ? 'active' : '' }}">
                                <i class="fa fa-id-badge"></i> Profile </a>
                        </li>
                        <li>
                            <a href="{{ url('/student/change-password') }}"
                                class="nav-link {{ Request::segment(2) == 'change-password' ? 'active' : '' }}">
                                <i class="fa fa-list-alt"></i>Change Password </a>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
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
                   {{-- <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>--}}
                </div>
            </div>
        </div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).on("click", ".math_pad", function() {
        $('#schedule-calendar12').modal('show');
        cal_init();
        setTimeout( function(){
            cal_init();
        }  , 1000 );
    });
    function cal_init(){
        var c_id = 1;
            $.ajax({
                url: "{{ route('student.math-pad') }}",
                type: 'GET',
                data: {
                    c_id: c_id,
                },
                success: function(data) {
                    $('.time-frame12').html(data);
                }
            });
        }
    $(document).on('change', 'form#createFrmprofile', function(event) {
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
                    toastr.success("Profile Image Updated Successfully");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        window.location = "{{ url('/student/student-dashboard') }}"
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
</script>


