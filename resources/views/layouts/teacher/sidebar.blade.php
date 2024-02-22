<style>
    /*.edit-img {
        position: absolute;
        right: 23%;
        margin-top: 10%;
    }*/

    
    /*.svg-inline--fa {
    color: #009fff;
    margin-right: 20px;
}*/

svg.svg-inline--fa.fa-bookmark.fa-w-12 {
    margin-left: 20px;
}
.settings-widget {
    border: 2px solid #468dcb75;
}
</style>
@php $current= Request::segment(2);
$id = Auth::user()->id;
    $avtar = DB::table('users') ->where('id', $id)->where('status', 1)->first();
    $tutor  = DB::table('tutors')->where('user_id',$id)->first();
@endphp
<div class="col-xl-3 col-lg-4 col-md-12 theiaStickySidebar">
    <div class="settings-widget dash-profile mb-3 profilebackimg">
        <div class="settings-menu p-2 formobview">
            <form action="{{ route('teacher.teacher_profile_update_img') }}" method="POST" id="createFrmprofile"
            enctype="multipart/form-data">
            @csrf
            <div class="profile-bg">
                <!-- <h5>Beginner</h5>
                <img src="assets/img/instructor-profile-bg.jpg" alt> -->
                <div class="">

                    {{-- <a href="#">
                    @if (isset($tutor->image))
                    <img src="{{ asset('uploads/tutors/' . $tutor->image) }}" alt="">
                    @else
                    <img class="img-fluid" alt src="{{ asset('assets/img/user/av.jpg') }}">
                    @endif
                    </a> --}}
                    {{-- @if(Auth::user()->avatar == null)
                        <a href="#">
                            <img src="{{asset('assets/img/user/av.jpg')}}" alt>
                        </a>
                    @else
                        <a href="#">
                            <img src="{{ asset('uploads/tutors/' .Auth::user()->avatar) }}"  alt>
                        </a>
                    @endif --}}
                  <!--   <a href="#">
                        @if(Auth::user()->avatar == null )
                        <div class="profile-imgchild">
                                <img class="img-fluid proimgdes12" alt src="{{ asset('assets/img/user/av.jpg') }}">
                                <label for="fileToUpload" class="edit-img imgiconpro"><i class="fa fa-edit proiconsec"></i></label>
                                <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" />
                            </div>
                        @else
                        <div class="profile-imgchild">
                            <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt="" class="proimgdes12">
                            <label for="fileToUpload" class="edit-img imgiconpro"><i class="fa fa-edit proiconsec"></i></label>
                            <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" />
                            
                        </div>
                        @endif
                        
                       
                    </a> -->
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="profile-textdes">
                            <div class="profile-name text-left sidebar-profile">
                                <h4>
                                    <a href="#">{{ ucwords(Str(Auth::user()->name) ?? '') }} </a>
                                </h4>
                                <p class="profile-desig">Teacher</p>
                                <!-- @if( $tutor->is_verified == 1 ) -->
                                <!-- <p>Certified</p> -->
                                <!-- <img src="{{ asset('uploads/tutors/certifiedlogoo.png') }}"> -->
                                <!-- @endif -->
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="gradeimglev">
                            <div class="profile-imgchild">
                                <div class="position-relative">
                                <img class="img-first" src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt="" class="proimgdes12">
                                <div class="chooeimgblk">
                                    <div style="margin-top: 40%;">
                                        <label for="fileToUpload" class="">Choose Image</label> 
                                    <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" />
                                    </div>
                                </div>
                                </div>
                                @if(isset($tutor) && $tutor->is_verified == 1)
                                <img class="img-second" src="{{ asset('uploads/tutors/certifiedlogoo.png') }}">
                                @endif
                                <div class="editiconmob"><label for="fileToUpload" class="edit-img imgiconpro"><i class="fa fa-edit proiconsec"></i></label>
                                <input type="file" name="avatar" class="form-control profile-img12 edit-img fileToUpload" id="fileToUpload" /></div>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="gardtext">
                            <h6>Grade/Level:</h6>
                            <div class="gradlevel">
                                <div class="gdlev"><p>K-2 </p></div>
                                <div class="gdlev"><p>3-5 </p></div>
                                <div class="gdlev"><p>6-8 </p></div>
                                <div class="gdlev"><p>9-12 </p></div>
                            </div>
                        </div>
                        @if($tutor->degree != null)
                        <div class="gardtext pt-3">
                            <h6>Qualification:</h6>
                            <p>{{$tutor->degree ?? ''}}</p>
                        </div>
                        @endif
                        @if($tutor->describe_experience != null)
                        <div class="gardtext">
                            <h6>Expertise:</h6>
                            <p>{{$tutor->describe_experience ?? ''}}</p>
                        </div>
                        @endif
                        @if($tutor->language != null)
                        <div class="gardtext">
                            <h6>Spoken Languages:</h6>
                            <!-- <p>English, Hindi, Marathi</p> -->
                            <p>{{$tutor->language ?? ''}}</p>
                        </div>
                        @endif
                        @if($tutor->location != null)
                        <div class="gardtext">
                            <h6>Location:</h6>
                            <p>{{$tutor->location ?? ''}}</p>
                        </div>
                        @endif
                        <div class="gardtext">
                            <h6>Region Focus:</h6>
                            <div class="gradlevel regionf">
                                <div class="gdlev"><p>US</p></div>
                                <div class="gdlev"><p>IND</p></div>
                                <div class="gdlev"><p>ROW</p></div>
                            </div>
                        </div>
                        @php 
                            $total_st = DB::table('credits')->where('teacher_id',$avtar->id)->pluck('student_id');
                            $us12e = DB::table('users')->whereIn('id',$total_st)->where('status', 1)->count();
                        @endphp
                        <div class="gardtext pt-3">
                            <h6>Active Students: <span><b>{{$us12e ?? 0}}</b></span></h6>
                        </div>
                    </div>
                </div>











            </div>
            </form>
            <!-- <div class="profile-group">
                <div class="profile-name text-left sidebar-profile">
                    <h4>
                        <a href="#">{{ ucwords(Str(Auth::user()->name) ?? '') }} </a>
                    </h4>
                    <p class="profile-desig">Teacher</p>
                    @if( $tutor->is_verified == 1 )
                    <p>Certified</p>
                    <img src="{{ asset('uploads/tutors/certified-logo.png') }}">
                    @endif
                </div>
            </div> -->
        </div>
    </div>
    <div class="settings-widget account-settings">
        <div class="settings-menu">
            <!-- <h3>DASHBOARD</h3> -->
            <ul>
                <li class="nav-item {{ Request::segment(2) == 'teacher-instructor-dashboard'  ? 'active' : ''}}">
                    <a href="{{ url('/teacher/teacher-instructor-dashboard')}}" class="nav-link">
                        <i class="feather-home"></i> Dashboard </a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'student'  ? 'active' : ''}}">
                    <a href="{{url('/teacher/student')}}" class="nav-link ">
                        <i class="fa fa-user-circle-o"></i> Student </a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'book-a-demo'  ? 'active' : ''}}">
                    <a href="{{url('/teacher/book-a-demo')}}" class="nav-link ">
                        <i class="feather-book"></i> Book a Demo </a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'question-list'  ? 'active' : ''}}">
                    <a href="{{ url('/teacher/question-list') }}" class="nav-link">
                        <i class="fa fa-question"></i> Quiz Generator </a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'payment-list'  ? 'active' : ''}}">
                    <a href="{{url('/teacher/payment-list')}}" class="nav-link">
                        <i class="fa fa-credit-card"></i>Payment </a>
                </li>

                <li class="nav-item {{ Request::segment(2) == 'attendance'  ? 'active' : ''}}">
                    <a href="{{url('/teacher/attendance')}}" class="nav-link">
                    <i class="fa fa-comments"></i> Attendance </a>
                 </li>
                <li class="nav-item {{ Request::segment(2) == 'math-pad'  ? 'active' : ''}} account-des">
                    <a href="javascript:void(0)" class="nav-link math_pad">
                    <i class="feather-circle"></i> Math Pad </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{url('/teacher/calendar',['id'=>base64_encode(Auth::user()->id)])}}" class="nav-link">
                        <i class="fa fa-hand-peace"></i> Availability  </a>
                </li> -->
                <li class="nav-item {{ Request::segment(2) == 'dashboard-community'  ? 'active' : ''}}">
                    <a href="{{url('/teacher/dashboard-community')}}" class="nav-link">
                        <i class="fa fa-users"></i> Community </a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'editor'  ? 'active' : ''}}">
                    <a href="{{url('/teacher/editor')}}" class="nav-link">
                        <i class="fa fa-file-code-o"></i> Code Editor </a>
                </li>

                <li id="account-list" class="nav-item dropdown dropdown-account account-des">
                    <a class="nav-link">
                        <i class="fa fa-user"></i> Account <i class="fa fa-angle-down" style="margin-left: 100px;"
                            aria-hidden="true"></i></a>
                    <ul id="account-child" class="dropdown-menu dropdown-side" style="display: none;">
                        <li>
                            <a href="{{ route('teacher.dashboard.institute.edit', ['id' => base64_encode(Auth::user()->id)]) }}" class="nav-link {{ Request::segment(2) == 'teacher-my-membership'  ? 'active' : ''}}">
                                 <i class="fa fa-id-badge"></i> Profile </a>
                        </li>
                        <li>
                            <a href="{{ url('/teacher/question-list') }}" class="nav-link {{ Request::segment(2) == 'teacher-my-membership'  ? 'active' : ''}}">
                                 <i class="fa fa-question-circle-o"></i> Quiz Generator</a>
                        </li>
                        <li>
                            <a href="{{url('/teacher/teacher-my-membership')}}" class="nav-link {{ Request::segment(2) == 'teacher-my-membership'  ? 'active' : ''}}">
                                 <i class="fa fa-id-badge"></i> My Membership </a>
                        </li>
                        <li>
                            <a href="{{url('/teacher/teacher-coins-history')}}" class="nav-link {{ Request::segment(2) == 'teacher-coins-history'  ? 'active' : ''}}">
                                 <i class="fa fa-list-alt"></i> Coins History </a>
                        </li>
                        <li>
                            <a href="{{url('/teacher/teacher-setting')}}" class="nav-link  {{ Request::segment(2) == 'teacher-setting'  ? 'active' : ''}}">
                                 <i class="fa fa-sliders"></i> Setting </a>
                        </li>
                    </ul>
                </li>


            </ul>
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
                        window.location = "{{ url('/teacher/teacher-instructor-dashboard') }}"
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
