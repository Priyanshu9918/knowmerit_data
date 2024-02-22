<div class="col-lg-8" id="data1">
                @php
                    $teacher = DB::table('students')->where('user_id',$data1->student_id)->first();
                    $avtar = DB::table('users')->where('id',$teacher->user_id)->where('status',1)->first();
                    $cat = DB::table('categories')->where('id',$data1->class_id)->first();
                    @endphp
                    @if(isset($avtar))
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <div class="card instructor-card w-100" style="border: unset;
                            background-color: #fff3da;margin-bottom: 0;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="student-list flex-fill" style="background-color: #fff;align-items: unset;">
                                            <div class="student-img">
                                                @if (isset($avtar->avatar))
                                                <img src="{{asset('uploads/tutors/'.$avtar->avatar)}}" class="img-fluid s-list" alt="" style="
                                                    border-radius: 50%;" >
                                                @else
                                                <img class="img-fluid s-list" src="{{ asset('assets/img/user/av.jpg') }}" alt="User Image" style="
                                                    border-radius: 50%;">
                                                @endif
                                            </div>
                                            <div class="student-content">
                                                <h5><a href="student-profile.html">{{$avtar->first_name ?? ''}}</a></h5>
                                                <!-- <h6>Grade KG </h6> -->
                                                <div class="featured-info-time d-flex align-items-center">
                                                 <div class="hours-time-two d-flex align-items-center">
                                                 <span><img src="{{asset('assets//img/my-img/web_img/coin-img12.png')}}" style="width: 22px;margin-right: 5px;margin-top: -4px;"></span>
                                                 <!-- <p>133</p> -->
                                                 </div>
                                                 <div class="course-view d-inline-flex align-items-center">
                                                 <div class="course-price">
                                                 <!-- <span style="background-color: #807f7f;
                                                border-radius: 4px;padding: 2px;color: #fff;margin-left: 10px">1:4</span> -->
                                                 </div>
                                                 </div>
                                                 </div>
                                        </div>
                                    </div>
                                </div>
                               
                               <div class="col-md-4">
                        <div class="sche">

                               <a  href="javascript:void(0)" data-id="{{$data1->student_id}}" data-class="{{$data1->class_id}}" data-sub="{{$data1->sub_id}}" class="discover-btn find_slot" style="padding: 5px 15px;font-size: 14px;">Schedule Class</a>
                           </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @php
                    $st_data = DB::table('assign_courses')->where('student_id',$data1->student_id)->pluck('course_id');
                    if(isset($st_data)){
                        $t_courses = DB::table('courses')->whereIn('id',$st_data)->get();
                    }
                @endphp
                @if(isset($t_courses))
                <div class="row">
                @foreach($t_courses as $s_crs)
                        <div id="instructor-box-dec" class="col-lg-6 col-md-6 d-flex mt-4">
                        <a href="{{url('/teacher/course-details12',['st_id' => $avtar->id, 'id' => $s_crs->id])}}">
                        <div class="instructor-box flex-fill ins-box1">
                            <div id="inst-img" class="instructor-img ins-img">
                                <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}"> -->
                                    <img class="img-fluid" alt=""
                                        src="{{asset('uploads/course/'.$s_crs->image)}}">
                               <!--  </a> -->
                                <div class="overlay icon">
                                  <!-- <a href="{{url('/teacher/course-details12',$s_crs->id)}}" class="icon" title="User Profile"> -->
                                    <i class="fa fa-pencil"></i>
                                  <!-- </a> -->
                                  </div>
                            </div>
                            <div class="instructor-content">
                                <div class="text-v">
                                    <h3 style="font-size: 0.25rem;"><a
                                            href="{{url('/teacher/course-details12',['st_id' => $avtar->id, 'id' => $s_crs->id])}}"
                                            style="font-size: 16px">{{$s_crs->title ?? ''}}</a></h3>
                                            @if(isset($s_crs->short_description))
                                            <h6 style="font-size: 16px">{!! substr($s_crs->short_description,0,50)?? '' !!}...</h6>
                                            @endif
                                </div>
                                <div class="instruct-stip d-flex align-items-center">
                                @php
                                    $total = Helper::PercentageCourse($s_crs->id);
                                @endphp
                                    <div class="course-stip progress-stip">
                                        @if($total == 0)
                                        <span class="per-cross" style="color: #000!important">{{$total}}%</span>
                                        @else
                                        <div class="progress-bar" role="progressbar" style="width: {{round($total)}}%;" aria-valuenow="{{round($total)}}" aria-valuemin="0" aria-valuemax="100">{{round($total)}}%</div>
                                        @endif                                        <!-- <div class="progress-bar bg-success progress-bar-striped active-stip"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div></a>
                    </div>
                        @endforeach
                        @endif
                        @if(isset($avtar))
                        <div class="col-lg-12 col-md-12 d-flex justify-content-end">
                                
                                <div href="javascript:void(0)" class="position-relative" >
                                    <i class="fa fa-plus-circle" id="addbtnsforthis" ></i>
                                        <div class="addModaldetails bg-white position-absolute" style="display:none;" >
                                            <ul>
                                                <li><a href="javascript:void(0)" data-id="{{$avtar->id}}" id="import_course"> Import Course</a></li>
                                                <li><a href="{{url('teacher/add-lession',$avtar->id)}}" class="border-0"> Create Course</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                
                            </div>

                        <div id="iframe" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <!-- <button id="iframe-cancel-btn" type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    </div>
                                    <div class="modal-body">
                                            <div class="popup-add">
                                            <form action="{{route('teacher.course-assign')}}" method="POST" id="coursecreate" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="student_id1" id="student_id1" value="">
                                                    @php 
                                                        $a_c_id = DB::table('assign_courses')->where('student_id', $avtar->id)->pluck('course_id');
                                                        $data = DB::table('assign_teachers')->whereNotIn('course_id', $a_c_id)->get();
                                                    @endphp
                                                    <div>
                                                        <label>Select Courses</label>
                                                        <select class="form-control" name="course">
                                                            <option value="">Select Course</option>
                                                            @foreach ($data as $courses)
                                                                @php 
                                                                    $data1 = DB::table('courses')->where('id', $courses->course_id)->first();
                                                                @endphp
                                                                <option value="{{ $data1->id }}">{{ $data1->title }}</option>
                                                            @endforeach
                                                        </select>                                
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-course"></p>
                                                    </div>
                                                    <button type="submit" class="btn subbtn">Submit</button>
                                                </form>
                                            </div>


                                        </div>
                                    <!-- <div class="modal-footer">
                            </div> -->
                                </div>

                            </div>
                    </div>
                        @endif
</div>