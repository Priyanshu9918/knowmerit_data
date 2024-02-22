@extends('layouts.student.master')
@section('content')
<style type="text/css">
.user-nav a.dropdown-toggle {
display: block;
}
.modal-body {
height: 257px;
width: 500px;
background-color: #f1faff;
}
.profile-share .btn-success {
padding: 1px 13px;
font-size: 13px;
}
</style>
<div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
    
    <div class="course-group mb-0 d-flex mt-2 mb-2" style="background-color:#fff;padding:20px">
        <div class="course-group-img d-flex align-items-center">
            <div class="course-name">
                @php
                $id = Auth::user()->id;
                $data = DB::table('users')->where('id' ,$id)->first();
                $datacon = DB::table('countries')->where('id',$data->country)->first();
                $datatime = DB::table('time_zones')->where('id',$data->timezone)->first();
                @endphp
                <h4><a href="">{{ $datacon->name ?? '' }}</a></h4>
                <p>{{ $datatime->timezone ?? '' }}</p>
            </div>
        </div>
        <div class="profile-share d-flex align-items-center justify-content-center">
            <a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#timezone">Edit</a>
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
                            <form action="{{ route('student.timezone1.create') }}" method="POST" id="createFrm">
                                @csrf
                                <div class="form-group">
                                    <label for="sel1">Country</label>
                                    <select class="form-select country" aria-label="Default select example"
                                        name="country" id="country_id">
                                        <option>Select country</option>
                                        @if (count($country) > 0)
                                        @foreach ($country as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group d-none" id="tiz">
                                    <label for="sel1">TimeZone</label>
                                    <select class="form-select" aria-label="Default select example" name="timezone"
                                        id="timezone_id">
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
    <div class="card instructor-card w-100">
        <div class="card-body" style="padding:7px">
            <div class="instructor-inner">
                @php
                $id = Auth::user()->id;
                $credit = DB::table('credits')->where('student_id',$id)->sum('credit');
                @endphp
                <h4 class="instructor-text-success mb-0">{{$credit ?? ''}}</h4>
                <p>Remaining credits</p>
            </div>
        </div>
    </div>
    <div class="category-tab tickets-tab-blk enqui-task enqui12">
        <ul class="nav nav-justified ">
            <li class="nav-item"><a href="#upcoming" class="nav-link active" data-bs-toggle="tab"> <img class="img-fluid v-icon" alt="" src="{{asset('assets/img/my-img/upcoming-one-img.png')}}">Upcoming Task</a>
        </li>
        <li class="nav-item"><a href="#past" class="nav-link enquiri" data-bs-toggle="tab"> Past </a></li>
    </ul>
    
</div>
<div class="tab-content">
    <div class="tab-pane fade" id="past">
        <div class="noenquery">
            <span class="noupcom">There is no upcoming session </span>
        </div>
    </div>
    <div class="tab-pane fade active show" id="upcoming">
        @php
        $student_enquiry1 = App\Models\BookSession::where('student_id',auth()->user()->id)
        ->orderBy('id','DESC')
        ->get();
        @endphp
        @if(count($student_enquiry1) <= 0) <div class="settings-top-widget">
            <!-- No Upcoming Task Start -->
            <div class="row">
                <div class="no-up">
                    <div class="no-upcomimg"> <img src="{{asset('assets/img/my-img/clipboard1.png')}}">
                        <h3 class="mt-4">No Upcoming Class </h3>
                    </div>
                </div>
            </div>
            <!-- No Upcoming Task End -->
            <!--44 Classrooms listing start -->
            <div>
                @else
                <div class="row">
                    <div class="top-headingg">
                        <h3>Your Classrooms</h3>
                        <!-- <div class="top-class">
                            <div class="top-view-c">
                                <h4>1:1</h4>
                            </div>
                            <div class="top-view-c1">
                                <h4>1:M</h4>
                            </div>
                        </div> -->
                        <!-- <div class="right-icon"> <a href=""> <i class="feather-search icon-right"></i>
                        </a> <a href=""> <i class="fa fa-calendar icon-right" aria-hidden="true"></i>
                        </a> <a href=""> <i class="fa fa-plus icon-right" aria-hidden="true"></i> </a>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="settings-widget">
                        <div class="settings-inner-blk p-0">
                            <div class="comman-space pb-0">
                                <div class="settings-tickets-blk course-instruct-blk table-responsive">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr style="border-bottom: 1px solid #e5dede;">
                                                <div class="tab12">
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/10.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Coding Class </a> <a class="top-view-c1">
                                                <h4>1:1</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><span class="badge info-low" style="color: #fff;border-radius: 7px!important;background-color: #009fff;">Join</span></td>
                                              </div>
                                            </tr>
                                             <tr>
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/11.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Math Class </a> <a class="top-view-c1">
                                                <h4>1:4</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><i class="fa fa-times-circle close-v" style="font-size:24px;color: #ff0909;"></i><span class="badge info-low" style="color: #fff;background-color: #f96d41;border-radius: 7px!important;">Starts in 12:00:00</span></td>

                                            </tr>
                                             <tr style="border-bottom: 1px solid #e5dede;">
                                                <div class="tab12">
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/10.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Coding Class </a> <a class="top-view-c1">
                                                <h4>1:1</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><span class="badge info-low" style="color: #fff;border-radius: 7px!important;">Completed</span></td>
                                              </div>
                                            </tr>
                                             <tr style="border-bottom: 1px solid #e5dede;">
                                                <div class="tab12">
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/11.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Coding Class </a> <a class="top-view-c1">
                                                <h4>1:4</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><span class="badge badge-danger
                                                    .." style="color: #fff;border-radius: 7px!important;background-color: #009fff;">Cancelled</span></td>
                                              </div>
                                            </tr>
                                              <tr style="border-bottom: 1px solid #e5dede;">
                                                <div class="tab12">
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/11.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Coding Class </a> <a class="top-view-c1">
                                                <h4>1:M</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><span class="badge badge-secondary" style="color: #fff;border-radius: 7px!important;background-color: #999a9a;">S_No Show</span></td>
                                              </div>
                                            </tr>
                                          </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="faq-card">
                        <h3 class="faq-title title-fq"> <a class="" data-bs-toggle="collapse"
                            href="#faqone" aria-expanded="true"> <span style="font-size: 24px;">Sarah</span>
                            <img src="{{asset('assets/img/my-img/india-flag.png')}}"
                            style="width: 33px;margin-left: 9px;">
                        </a> </h3>
                        <div class="name-f">
                            <h6>Grade 7 - USCC Mathematics</h6>
                        </div>
                        <div id="faqone" class="collapse" style="">
                            <div class="faq-detail">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                    richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                <p>If several languages coalesce, the grammar of the resulting language is more
                                    simple and regular than that of the individual languages. The new common
                                    language will be more simple and regular than the existing European
                                languages.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="settings-widget">
                        <div class="settings-inner-blk p-0">
                            <div class="comman-space" style="background-color: #009fff;">
                                <div class="settings-tickets-blk course-instruct-blk table-responsive">
                                    <table class="table table-nowrap mb-0 dash-table">
                                        <tbody>
                                            @foreach ($student_enquiry1 as $st2)
                                            @php
                                            $today = date("M d, Y H:i:s");
                                            $time = $st2->start_time;
                                            $time1 = date_format($time,"M d, Y H:i:s");
                                            $e_time = $st2->end_time;
                                            $e_time1 = date_format($e_time,"M d, Y H:i:s");
                                            $st3 =
                                            DB::table("tutors")->where('user_id',$st2->teacher_id)->first();
                                            $avtar = DB::table('users')
                                            ->where('id', $st3->user_id)
                                            ->where('status', 1)
                                            ->first();
                                            @endphp
                                            @if($today <= $e_time1)
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0)" id="student1"
                                                        data-id="{{$st3->user_id}}">
                                                        <div class="sell-table-group d-flex align-items-center">
                                                            <div class="sell-tabel-info">
                                                                <h3> <span
                                                                style="font-size:24px;">{{$st3->name}}</span>
                                                                <!-- <img src="{{asset('assets/img/my-img/india-flag.png')}}"
                                                                style="width:33px;margin-left: 9px;"> -->
                                                                </h3>
                                                                <div class="">
                                                                    <h6>{{date('M d, Y h:i:sa', strtotime($st2->start_time))}}
                                                                    </h6>
                                                                    <!-- @if(isset($subcat->name))
                                                                    <h6> {{ $category->name ?? '' }} - {{ $subcat->name ?? '' }}</h6>
                                                                    @else
                                                                    <h6> {{ $category->name ?? '' }}</h6>
                                                                    @endif -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                @if($time1 <= $today) <td style="float: right;"> <a href="{{$st2->student_url}}"><span
                                                class="badge info-low">Join Class</span> </a> </td>
                                                <td>
                                                    @endif
                                                    @if($time1 >= $today)
                                                    <td style="float: right;">
                                                        <!-- <span class="badge info-high">Cancel</span> -->
                                                        <span class="badge info-inter">Starts in <span>
                                                            <p id="demo{{$st2->id}}"></p>
                                                        </span>
                                                    </td>
                                                    @endif
                                                    <!-- @if($e_time1 <= $today)
                                                    <td style="float: right;"> <span class="badge info-low">Expired</span> </td>
                                                    <td>
                                                        @endif -->
                                                        <script>
                                                        // Set the date we're counting down to
                                                        var countDownDate{{$st2->id}} = new Date("{{$time1}}").getTime();
                                                        // Update the count down every 1 second
                                                        var x = setInterval(function() {
                                                        // Get today's date and time
                                                        var now = new Date().getTime();
                                                        // Find the distance between now and the count down date
                                                        var distance = countDownDate{{$st2->id}} - now;
                                                        // Time calculations for days, hours, minutes and seconds
                                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                        // Output the result in an element with id="demo"
                                                        document.getElementById('demo{{$st2->id}}').innerHTML = days + "d " + hours + "h "
                                                        + minutes + "m " + seconds + "s ";
                                                        // If the count down is over, write some text
                                                        if (distance < 0) {
                                                        clearInterval(x);
                                                        document.getElementById('demo{{$st2->id}}').innerHTML = "EXPIRED";
                                                        }
                                                        }, 1000);
                                                        </script>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    <!-- <tr>
                                                        <td>
                                                            <div class="sell-table-group d-flex align-items-center">
                                                                <div class="sell-tabel-info">
                                                                    <h3> <a class="" data-bs-toggle="collapse"
                                                                        href="#faqone" aria-expanded="true"> <span
                                                                        style="font-size:24px;">Sarah</span>
                                                                        <img src="{{asset('assets/img/my-img/india-flag.png')}}"
                                                                        style="width:33px;margin-left: 9px;">
                                                                        <span class="top-view-c3">1:M</span> </a>
                                                                        </h3>
                                                                        <div class="">
                                                                            <h6>Grade 7 - USCC Mathematics</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="float: right;"> <span
                                                            class="badge info-inter">Starts in 02:05:36</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="sell-table-group d-flex align-items-center">
                                                                <div class="sell-tabel-info">
                                                                    <h3> <a class="" data-bs-toggle="collapse"
                                                                        href="#faqone" aria-expanded="true"> <span
                                                                        style="font-size: 24px;">Sarah</span>
                                                                        <img src="{{asset('assets/img/my-img/india-flag.png')}}"
                                                                        style="width: 33px;margin-left: 9px;">
                                                                        <span class="top-view-c2">1:1</span> </a>
                                                                        </h3>
                                                                        <div class="">
                                                                            <h6>Grade 7 - USCC Mathematics</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="float: right;">
                                                                <span class="badge info-high">Cancel / Reschedule</span>
                                                                <span class="badge info-inter">Starts in 02:05:36</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="sell-table-group d-flex align-items-center">
                                                                    <div class="sell-tabel-info">
                                                                        <h3> <a class="" data-bs-toggle="collapse"
                                                                            href="#faqone" aria-expanded="true"> <span
                                                                            style="font-size:24px;">Sarah</span>
                                                                            <img src="{{asset('assets/img/my-img/india-flag.png')}}"
                                                                            style="width:33px;margin-left: 9px;">
                                                                            <span class="top-view-c3">1:M</span> </a>
                                                                            </h3>
                                                                            <div class="">
                                                                                <h6>Grade 7 - USCC Mathematics</h6>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td style="float: right;"> <span
                                                                class="badge info-high">Cancel / Reschedule</span>
                                                                <span class="badge info-inter">Starts in 02:05:36</span>
                                                            </td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div id="data1"></div>
                    </div>
                    <!-- Your Classrooms listing End -->
                    <!-- Your Classrooms Details start -->
                    <div>
                        <!-- <div class="row">
                            <div class="top-headingg">
                                <h3>Your Classrooms</h3>
                                <div class="top-class">
                                    <div class="top-view-c">
                                        <h4>1:1</h4>
                                    </div>
                                    <div class="top-view-c1">
                                        <h4>1:M</h4>
                                    </div>
                                </div>
                                <div class="right-icon"> <a href=""> <i class="feather-search icon-right"></i>
                                </a> <a href=""> <i class="fa fa-calendar icon-right" aria-hidden="true"></i>
                                </a> <a href=""> <i class="fa fa-plus icon-right" aria-hidden="true"></i> </a>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="faq-card">
                                <h3 class="faq-title title-fq"> <a class="" data-bs-toggle="collapse"
                                    href="#faqone" aria-expanded="true"> <span
                                    style="font-size: 24px;">Sarah</span> <img
                                    src="{{asset('assets/img/my-img/india-flag.png')}}"
                                style="width:33px;margin-left: 9px;"> </a> </h3>
                                <div class="name-f">
                                    <h6>Grade 7 - USCC Mathematics</h6>
                                </div>
                                <div id="faqone" class="collapse" style="">
                                    <div class="faq-detail">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                            richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard
                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod.</p>
                                        <p>If several languages coalesce, the grammar of the resulting language is more
                                            simple and regular than that of the individual languages. The new common
                                            language will be more simple and regular than the existing European
                                        languages.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
// $('.tab-value').click(function() {
//     var t = $(this).text();
//     $('#addbtn').html('Add' + t);
// });
////////////timezone//////
//submit
$(document).on('change', '.country', function() {
var id = $('#country_id').val();
$.ajax({
type: "post",
url: "{{ route('timezone-list') }}",
data: {
'country_id': id,
"_token": "{{ csrf_token() }}"
},
success: function(data) {
$("#timezone_id").empty();
$("#timezone_id").html('<option value="">Select Timezone</option>');
$.each(data, function(key, value) {
$("#timezone_id").append('<option value="' + value.id + '">' + value
.timezone + '</option>');
});
$('#tiz').removeClass('d-none');
}
});
});
$(document).on('submit', 'form#createFrm', function(event) {
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
toastr.success("Timezone updated Successfully");
// Swal.fire({
//     position: 'top-end',
//     icon: 'success',
//     title: 'TimeZone Updated Successfully',
//     showConfirmButton: false,
//     timer: 1500
//     })
window.setTimeout(function() {
// window.location = "{{ url('/') }}" + "/student/my-classes";
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
///////timezone///////
$(document).ready(function() {
$(document).on('click', '#student1', function(event) {
var id = $(this).attr('data-id');
$.ajax({
url: "{{ route('student.dash') }}",
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
$('#learnMore123').modal('show');
$('#category12').val('test');
$('#head12').text('Add Tests');
});
$(document).on('click', '#adddoc', function(event) {
$('#learnMore12').modal('show');
$('#category1').val('document');
$('#head1').text('Add Documents');
});
});
//      $(document).on('submit', 'form#createFrm', function(event) {
//          event.preventDefault();
//          //clearing the error msg
//          $('p.error_container').html("");
//          var title = $('div.iti__selected-flag').attr('title');
//          var form = $(this);
//          var data = new FormData($(this)[0]);
//          data.append("c_code", title);
//          var url = form.attr("action");
//          var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
//          $('.submit').attr('disabled', true);
//          $('.form-control').attr('readonly', true);
//          $('.form-control').addClass('disabled-link');
//          $('.error-control').addClass('disabled-link');
//          if ($('.submit').html() !== loadingText) {
//              $('.submit').html(loadingText);
//          }
//          $.ajax({
//              type: form.attr('method'),
//              url: url,
//              data: data,
//              cache: false,
//              contentType: false,
//              processData: false,
//              success: function(response) {
//                  window.setTimeout(function() {
//                      $('.submit').attr('disabled', false);
//                      $('.form-control').attr('readonly', false);
//                      $('.form-control').removeClass('disabled-link');
//                      $('.error-control').removeClass('disabled-link');
//                      $('.submit').html('Save');
//                  }, 2000);
//                  //console.log(response);
//                  if (response.success == true) {
//                      //notify
//                      toastr.success("Document Created successfully!");
//                      // Swal.fire({
//                      //     position: 'top-end',
//                      //     icon: 'success',
//                      //     title: 'user Created Successfully',
//                      //     showConfirmButton: false,
//                      //     timer: 1500
//                      //     })
//                      window.setTimeout(function() {
//                          location.reload();
//                      }, 2000);
//                  }
//                  //show the form validates error
//                  if (response.success == false) {
//                      for (control in response.errors) {
//                          var error_text = control.replace('.', "_");
//                          $('#error-' + error_text).html(response.errors[control]);
//                          // $('#error-'+error_text).html(response.errors[error_text][0]);
//                          // console.log('#error-'+error_text);
//                      }
//                      // console.log(response.errors);
//                  }
//              },
//              error: function(response) {
//                  // alert("Error: " + errorThrown);
//                  console.log(response);
//              }
//          });
//          event.stopImmediatePropagation();
//          return false;
//      });
//      $(document).on('submit', 'form#createFrm1', function(event) {
//          event.preventDefault();
//          //clearing the error msg
//          $('p.error_container').html("");
//          var title = $('div.iti__selected-flag').attr('title');
//          var form = $(this);
//          var data = new FormData($(this)[0]);
//          data.append("c_code", title);
//          var url = form.attr("action");
//          var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
//          $('.submit').attr('disabled', true);
//          $('.form-control').attr('readonly', true);
//          $('.form-control').addClass('disabled-link');
//          $('.error-control').addClass('disabled-link');
//          if ($('.submit').html() !== loadingText) {
//              $('.submit').html(loadingText);
//          }
//          $.ajax({
//              type: form.attr('method'),
//              url: url,
//              data: data,
//              cache: false,
//              contentType: false,
//              processData: false,
//              success: function(response) {
//                  window.setTimeout(function() {
//                      $('.submit').attr('disabled', false);
//                      $('.form-control').attr('readonly', false);
//                      $('.form-control').removeClass('disabled-link');
//                      $('.error-control').removeClass('disabled-link');
//                      $('.submit').html('Save');
//                  }, 2000);
//                  //console.log(response);
//                  if (response.success == true) {
//                      //notify
//                      toastr.success("Video Created successfully!");
//                      // Swal.fire({
//                      //     position: 'top-end',
//                      //     icon: 'success',
//                      //     title: 'user Created Successfully',
//                      //     showConfirmButton: false,
//                      //     timer: 1500
//                      //     })
//                      window.setTimeout(function() {
//                          location.reload();
//                      }, 2000);
//                  }
//                  //show the form validates error
//                  if (response.success == false) {
//                      for (control in response.errors) {
//                          var error_text = control.replace('.', "_");
//                          $('#error-' + error_text).html(response.errors[control]);
//                          // $('#error-'+error_text).html(response.errors[error_text][0]);
//                          // console.log('#error-'+error_text);
//                      }
//                      // console.log(response.errors);
//                  }
//              },
//              error: function(response) {
//                  // alert("Error: " + errorThrown);
//                  console.log(response);
//              }
//          });
//          event.stopImmediatePropagation();
//          return false;
//      });
//  });
//  $(document).on('submit', 'form#createFrm12', function(event) {
//      event.preventDefault();
//      //clearing the error msg
//      $('p.error_container').html("");
//      var title = $('div.iti__selected-flag').attr('title');
//      var form = $(this);
//      var data = new FormData($(this)[0]);
//      data.append("c_code", title);
//      var url = form.attr("action");
//      var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
//      $('.submit').attr('disabled', true);
//      $('.form-control').attr('readonly', true);
//      $('.form-control').addClass('disabled-link');
//      $('.error-control').addClass('disabled-link');
//      if ($('.submit').html() !== loadingText) {
//          $('.submit').html(loadingText);
//      }
//      $.ajax({
//          type: form.attr('method'),
//          url: url,
//          data: data,
//          cache: false,
//          contentType: false,
//          processData: false,
//          success: function(response) {
//              window.setTimeout(function() {
//                  $('.submit').attr('disabled', false);
//                  $('.form-control').attr('readonly', false);
//                  $('.form-control').removeClass('disabled-link');
//                  $('.error-control').removeClass('disabled-link');
//                  $('.submit').html('Save');
//              }, 2000);
//              //console.log(response);
//              if (response.success == true) {
//                  //notify
//                  toastr.success("MCQs Created successfully!");
//                  // Swal.fire({
//                  //     position: 'top-end',
//                  //     icon: 'success',
//                  //     title: 'user Created Successfully',
//                  //     showConfirmButton: false,
//                  //     timer: 1500
//                  //     })
//                  window.setTimeout(function() {
//                      location.reload();
//                  }, 2000);
//              }
//              //show the form validates error
//              if (response.success == false) {
//                  for (control in response.errors) {
//                      var error_text = control.replace('.', "_");
//                      $('#error-' + error_text).html(response.errors[control]);
//                      // $('#error-'+error_text).html(response.errors[error_text][0]);
//                      // console.log('#error-'+error_text);
//                  }
//                  // console.log(response.errors);
//              }
//          },
//          error: function(response) {
//              // alert("Error: " + errorThrown);
//              console.log(response);
//          }
//      });
//      event.stopImmediatePropagation();
//      return false;
//  });
</script>
@endpush
<tr>
                                                    <td>
                                                        <div class="sell-table-group d-flex align-items-center">
                                                            <div class="sell-tabel-info">
                                                                <h3><a class="#" data-bs-toggle="collapse" href="#faqone" aria-expanded="true"><span style="font-size:24px;" style="color:green;">{{$teacher->name}}</span><span style="font-size: 14px;display: block;color: #999;" class=""></span> </a></h3>
                                                                <h3><a class="#" data-bs-toggle="collapse" href="#faqone" aria-expanded="true"><span style="font-size:24px;">{{$cat->name}}</span><span style="font-size: 14px;display: block;color: #999;" class=""></span> </a></h3>
                                                                <span class="top-view-c2 mb-2 d-inline-block">{{$teacher->classes_mode ?? ''}}</span>
                                                                <!-- <span class="top-view-c2 mb-2 d-inline-block">Mathematics</span> -->
                                                                <div class="">
                                                                <!-- <h6 class="mt-2"> <i class="fa-solid fa-calendar-days"></i> Book a demo</h6> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                  <td style="float: right;"><a class="find_slot" href="javascript:void(0)" data-id="{{$data1->teacher_id}}" data-class="{{$data1->class_id}}" data-sub="{{$data1->sub_id}}"><span class="badge info-low">Book Class</span></a></td> 
                                                    </tr>




                                                    ///teacsvdsd

                                                    <tr>
                                                            <td>
                                                                <a href="javascript:void(0)" id="student1" data-id="{{$st3->user_id}}"><div class="sell-table-group d-flex align-items-center">
                                                                    <div class="sell-tabel-info">
                                                                        <h3> <span
                                                                                    style="font-size:24px;">{{$st3->first_name}}</span>
                                                                                <!-- <img src="{{asset('assets/img/my-img/india-flag.png')}}"
                                                                                    style="width:33px;margin-left: 9px;"> -->

                                                                        </h3>
                                                                        <div class="">
                                                                            @if(isset($subcat->name))
                                                                            <h6> {{ $category->name ?? '' }} - {{ $subcat->name ?? '' }}</h6>
                                                                            @else
                                                                            <h6> {{ $category->name ?? '' }}</h6>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div></a>
                                                            </td>
                                                                @if($time1 <= $today)
                                                                    <td style="float: right;"> <a href="{{$st2->teacher_url}}"><span class="badge info-low">Join
                                                                            Class</span></a></td>
                                                                    <td>
                                                                @else
                                                                    <td style="float: right;">
                                                                        <!-- <span class="badge info-high">Cancel</span> -->
                                                                        <span class="badge info-inter">Starts in <span><p id="demo{{$st2->id}}"></p></span></span>
                                                                    </td>
                                                                @endif
                                                                    <script>
                                                                        // Set the date we're counting down to
                                                                        var countDownDate{{$st2->id}} = new Date("{{$time1}}").getTime();

                                                                        // Update the count down every 1 second
                                                                        var x = setInterval(function() {

                                                                        // Get today's date and time
                                                                        var now = new Date().getTime();

                                                                        // Find the distance between now and the count down date
                                                                        var distance = countDownDate{{$st2->id}} - now;

                                                                        // Time calculations for days, hours, minutes and seconds
                                                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                                        // Output the result in an element with id="demo"
                                                                        document.getElementById('demo{{$st2->id}}').innerHTML = days + "d " + hours + "h "
                                                                        + minutes + "m " + seconds + "s ";

                                                                        // If the count down is over, write some text
                                                                        if (distance < 0) {
                                                                            clearInterval(x);
                                                                            document.getElementById('demo{{$st2->id}}').innerHTML = "EXPIRED";
                                                                        }
                                                                        }, 1000);
                                                                    </script>
                                                        </tr>

                                                        {{--<tr>
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/11.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Math Class </a> <a class="top-view-c1">
                                                <h4>1:4</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><i class="fa fa-times-circle close-v" style="font-size:24px;color: #ff0909;"></i><span class="badge info-low" style="color: #fff;background-color: #f96d41;border-radius: 7px!important;">Starts in 12:00:00</span></td>

                                            </tr>
                                             <tr style="border-bottom: 1px solid #e5dede;">
                                                <div class="tab12">
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/10.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Coding Class </a> <a class="top-view-c1">
                                                <h4>1:1</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><span class="badge info-low" style="color: #fff;border-radius: 7px!important;">Completed</span></td>
                                              </div>
                                            </tr>
                                             <tr style="border-bottom: 1px solid #e5dede;">
                                                <div class="tab12">
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/11.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Coding Class </a> <a class="top-view-c1">
                                                <h4>1:4</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><span class="badge badge-danger
                                                    .." style="color: #fff;border-radius: 7px!important;background-color: #009fff;">Cancelled</span></td>
                                              </div>
                                            </tr>
                                              <tr style="border-bottom: 1px solid #e5dede;">
                                                <div class="tab12">
                                                <td>
                                                    <div class="sell-table-group d-flex align-items-center">
                                                        <div class="sell-group-img student-news">
                                                            <a href="#">
                                                                <img src="{{asset('assets//img/my-img/web_img/11.png')}}" class="img-fluid s-list" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="sell-tabel-info">
                                                            <div style="font-size: 20px;display: flex;" ><a href="">Coding Class </a> <a class="top-view-c1">
                                                <h4>1:M</h4>
                                            </a></div>
                                                            <span>Thu, Jun 22, 2023 05:00 AM</span>
                                                           
                                                        </div>
                                                    </div>
                                                </td>

                                                <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                Teacher Name</td>

                                                <td style="text-align: center;"><span class="badge badge-secondary" style="color: #fff;border-radius: 7px!important;background-color: #999a9a;">S_No Show</span></td>
                                              </div>
                                            </tr>--}}