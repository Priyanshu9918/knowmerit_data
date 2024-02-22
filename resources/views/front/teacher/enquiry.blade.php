@extends('layouts.teacher.master')
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

    @php
    $id =  Auth::user()->id;
        $user1 = DB::table('tutors')
            ->where('user_id', $id)
            ->first();
        $latitude = $user1->lat;
        $longitude = $user1->lng;
        $student_enquiry = DB::table("book_a_classes")
                ->select("book_a_classes.id"
                    ,DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                    * cos(radians(book_a_classes.lat))
                    * cos(radians(book_a_classes.lng) - radians(" . $longitude . "))
                    + sin(radians(" .$latitude. "))
                    * sin(radians(book_a_classes.lat))) AS distance"))
                    ->orderBy('created_at','Desc')
                    ->get();
                 @endphp

    <div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
    <div class="course-group mb-0 d-flex mt-4 mb-4" style="background-color:#fff;padding:20px">
<div class="course-group-img d-flex align-items-center">
<div class="course-name">
<h4><a href="">India</a></h4>
<p>Asia/Kolkata </p>
</div>
</div>
<div class="profile-share d-flex align-items-center justify-content-center">
<a href="javascript:;" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#timezone">Edit</a>
<!-- The Modal -->
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
      <form>
      <div class="form-group">
  <label for="sel1">Country</label>
  <select class="form-control" id="sel1">
    <option>Select Country</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
</div>
<div class="form-group">
  <label for="sel1">TimeZone</label>
  <select class="form-control" id="sel1">
    <option>Select TimeZone</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
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
        <div class="category-tab tickets-tab-blk enqui-task enqui12">
            <ul class="nav nav-justified ">
                <li class="nav-item"><a href="#upcoming" class="nav-link active" data-bs-toggle="tab"> Upcoming Task</a></li>
                <li class="nav-item"><a href="#enquiries" class="nav-link enquiri" data-bs-toggle="tab"> Enquiries <span>10</span></a></li></ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="enquiries">
                <!-- No Enquiry Task Start -->
                @if (count($student_enquiry) < 0)
                    <div class="row">
                        <div class="no-up">
                            <div class="no-enquiries">
                                <img src="{{asset('assets/img/my-img/enquiry123.1.png')}}" class="noenque">
                                <h3 class="mt-4">No Enquiry Task </h3>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="notify-sec">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mt-2">Enquiries</h5>
                                @foreach ($student_enquiry as $st1)
                                @if($st1->distance < $user1->tutor_travel)
                                @php $st = DB::table("book_a_classes")->where('id',$st1->id)->first();
                                @endphp
                                   @php
                                    $avtar = DB::table('users')
                                            ->where('id', $st->user_id)
                                            ->where('status', 1)
                                            ->first();
                                            // dd($avtar);
                                        $category = DB::table('categories')
                                            ->where('id', $st->category)
                                            ->where('status', 1)
                                            ->first();
                                        if (isset($st->sub_category)) {
                                            $subcat = DB::table('categories')
                                                ->where('id', $st->sub_category)
                                                ->where('status', 1)
                                                ->first();
                                        }
                                    @endphp
                                    <div class="notify-item notify-msg">
                                        <div class="row align-items-center">
                                            <div class="col-md-9">
                                                <div class="notify-content">
                                                    @if(isset($avtar->avatar))
                                                    <a href="#">
                                                        <img class="avatar-img semirounded-circle"

                                                            src="{{ asset('uploads/tutors/'. $avtar->avatar) }}" alt="User Image">
                                                    </a>
                                                    @else
                                                    <a href="#">
                                                        <img class="avatar-img semirounded-circle"
                                                            src="{{asset('assets/img/user/av.jpg')}}" alt="User Image">
                                                    </a>
                                                    @endif
                                                    <div class="notify-detail">
                                                        <h6><a href="#">{{ $st->first_name ?? '' }}
                                                            </a><span>{{ $st->created_at }}</span></h6>
                                                            @if(isset($subcat->name))
                                                        <p class="cat-en">
                                                            {{ $category->name ?? '' }} , {{ $subcat->name ?? '' }}
                                                        </p>
                                                        @else
                                                        <p class="cat-en">
                                                        {{ $category->name ?? '' }}
                                                    </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="text-md-end">
                                                    <a href="{{ url('/chatify/' . $st->user_id) }}" class="btn">Chat</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif
                <!-- All Enquiries End -->
            </div>
            <div class="tab-pane fade active show" id="upcoming">
                @php
                    $student_enquiry1 = App\Models\BookSession::where('teacher_id',auth()->user()->id)
                            ->orderBy('id','DESC')
                            ->get();
                    @endphp
                @if(count($student_enquiry1) <= 0)
                    <div class="settings-top-widget">
                        <!-- No Upcoming Task Start -->
                        <div class="row">
                            <div class="no-up">
                                <div class="no-upcomimg"> <img src="{{asset('assets/img/my-img/clipboard1.png')}}">
                                    <h3 class="mt-4">No Upcoming Task </h3>
                                </div>
                            </div>
                        </div>
                        <!-- No Upcoming Task End -->
                        <!--Your Classrooms listing start -->
                        <div>
                        @else
                        <div class="row">
                            <div class="mt-5 top-headingg">
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
                                                            $st3 = DB::table("book_a_classes")->where('user_id',$st2->student_id)->first();
                                                            $avtar = DB::table('users')
                                                                ->where('id', $st3->user_id)
                                                                ->where('status', 1)
                                                                ->first();
                                                            // dd($avtar);
                                                            $category = DB::table('categories')
                                                                ->where('id', $st3->category)
                                                                ->where('status', 1)
                                                                ->first();
                                                            if (isset($st->sub_category)) {
                                                                $subcat = DB::table('categories')
                                                                    ->where('id', $st3->sub_category)
                                                                    ->where('status', 1)
                                                                    ->first();
                                                            }
                                                        @endphp
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
                                                                    <td style="float: right;"> <span class="badge info-low">Join
                                                                            Class</span> </td>
                                                                    <td>
                                                                @else
                                                                    <td style="float: right;">
                                                                        <span class="badge info-high">Cancel</span>
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
                        <div id="data1">

                        </div>
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
    $(document).on('change', '.sub_category', function() {
        var id = $('#sub_category').val();
        $.ajax({
            type: "get",
            url: "{{ route('teacher.mcq-list') }}",
            data: {
                'category': id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                if (data.success == true) {
                    $("#test_title").empty();
                    $.each(data.value, function(key, value) {
                        $("#test_title").append('<option value="' + value.id + '">' +
                            value.mcq_title + '</option>');
                    });
                }
                if (data.success == false) {
                    $("#test_title").empty();
                }
            }
        });
    });

    $(document).ready(function() {
        $(document).on('click', '#student1', function(event) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('teacher.dash') }}",
                type: "get",
                data: {
                    'active': id,
                },
                success: function(response) {
                    console.log(response);
                    $('#data1').html(response);
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
                        toastr.success("Document Created successfully!");

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
                        toastr.success("Video Created successfully!");

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
    $(document).on('submit', 'form#createFrm12', function(event) {
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
                    toastr.success("MCQs Created successfully!");

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
</script>
@endpush
