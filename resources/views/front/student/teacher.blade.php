@extends('layouts.student.master')
@section('content')
<style type="text/css">
    .user-nav a.dropdown-toggle {
        display: block;
    }

    span.top-view-c2 {
        padding: 3px 6px;
    }

    .dash-table td {
        padding: 1rem 35px !important;
    }

    .time-frame {
        width: 100% !important;
    }
    .for-margin{
        margin: 20px;
    }
    .dance-music-scroll
    {
        height: 90vh;
        overflow: scroll;
        overflow-x: hidden;
        border-radius: 0px;
        border: none;
        margin-top: 20px;
    }
</style>
<div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #4f94cf12; border-radius: 10px;">
	<!-- <div class="profile-title">
        <h3>Your Book Class Session</h3>
    </div> -->
    <div class="tab-content">
        <div class="tab-pane fade" id="enquiries">

        </div>
        <div class="tab-pane fade active show" id="upcoming">
            <div class="settings-top-widget">
                <!-- No Upcoming Task Start -->
                <div class="row d-none">
                    <div class="no-up">
                        <div class="no-upcomimg">
                            <img src="assets/img/my-img/clipboard1.png">
                            <h3 class="mt-4">No Upcoming Task </h3>
                        </div>
                    </div>
                </div>
                <!-- No Upcoming Task End -->
                <!--Your Classrooms listing start -->
                <div>
                    @if(count($data) > 0)
                    <div class="row">
                        <div class="top-headingg">
                            <!-- <h3>Your Book Class Session</h3> -->
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
                            <div class="settings-widget dance-music-scroll">
                                <div class="settings-inner-blk p-0">
                                    <div class="comman-space pb-0">
                                        <div class="settings-tickets-blk course-instruct-blk table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>

                                                    @foreach($data as $data1)
                                                    @php
                                                    $user = DB::table('users')->where('id',$data1->teacher_id)->first();
                                                    if(isset($user)){
                                                    $teacher = DB::table('tutors')->where('user_id',$user->id)->first();
                                                    $cat = DB::table('categories')->where('id',$data1->class_id)->first();
                                                    }
                                                    @endphp
                                                    @if(isset($teacher))
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
                                                                        <div style="font-size: 20px;display: flex;"><a href="">{{$cat->name ?? ''}}</a> </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td style="text-align: center;"><img src="{{asset('assets/img/course/teacher-avg.png')}}" class="img-fluid" alt=""><br>
                                                                {{$teacher->name ?? ''}}
                                                            </td>
                                                            <!-- <td style="float:right; top:20px; position:relative;"><a class="find_slot" href="javascript:void(0)" data-id="{{$data1->teacher_id}}" data-class="{{$data1->class_id}}" data-sub="{{$data1->sub_id}}"><span class="badge info-low">Book Class</span></a></td>  -->
                                                            <!-- <td><a class="find_slot" href="javascript:void(0)" data-id="{{$data1->teacher_id}}" data-class="{{$data1->class_id}}" data-sub="{{$data1->sub_id}}">Join</span></a></td> -->

                                                            <td style="text-align: center;"><a class="find_slot" href="javascript:void(0)" data-id="{{$data1->teacher_id}}" data-class="{{$data1->class_id}}" data-sub="{{$data1->sub_id}}"><span class="badge info-low" style="color: #fff;border-radius: 7px!important;background-color: #009fff;">Book Class</span></a></td>
                                                        </div>

                                                    </tr>
                                                    @endif
                                                    @endforeach

                                                    {{--<tr>
                                                   <td>
                                                      <div class="sell-table-group d-flex align-items-center">
                                                         <div class="sell-tabel-info">
                                                            <h3><a class="#" data-bs-toggle="collapse" href="#faqone" aria-expanded="true"><span style="font-size:24px;">Class I-V Tuition</span><span style="font-size: 14px;display: block;color: #999;" class="">No Demo Booked yet - 0  Connected </span> </a></h3>
															<span class="top-view-c2 mb-2 d-inline-block">Online Class</span>
															<span class="top-view-c2 mb-2 d-inline-block">Mathematics</span>
                                                            <div class="">
                                                               <h6 class="mt-2"> <i class="fa-solid fa-calendar-days"></i> Book a demo</h6>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   </td>
                                                   <td style="float: right;"> <span class="badge info-low">Open</span> </td>
                                                </tr>--}}
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
                                <img src="{{asset('no-data.gif')}}" alt="Girl in a jacket">
                            </div>
                            <div style="text-align:center;padding-top: 25px;">
                                <span class="noupcom">There is no session </span>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                <!-- Your Classrooms listing End -->
                <!-- Your Classrooms Details start -->

                <!-- Your Classrooms Details End -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="schedule-calendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {{-- style="max-width:70%;" --}}
        <div class="modal-content selectplan">
            <div class="modal-header">
                <span><a href="{{ URL::previous() }}"><i class="fa-solid fa-chevron-left"></i></a></span>
                <h1 class="modal-title fs-5">Schedule your lessons</h1>
                <button type="button" class="btn-close m-0 p-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body time-frame">
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
<form action="" method="" class="d-none" id="boking_form">
    <input type="hidden" id="class_id" name="class_id" value="">
    <input type="hidden" id="sub_id" name="sub_id" value="">
    <input type="hidden" id="teacher_id" name="teacher_id" value="">
    <input type="hidden" id="student_id" name="student_id" value="{{ auth()->user()->id }}">
    <input type="hidden" id="date_time" name="date_time" value="">
</form>
@endsection
@push('script')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
</script>
<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.ie11.min.js"></script>
<script type="text/javascript">
    $('.tab-value').click(function() {
        var t = $(this).text();
        $('#addbtn').html('Add' + t);
    });

    $(document).on("click", ".find_slot", function() {
        var c_id = $(this).attr('data-class');
        var s_id = $(this).attr('data-sub');
        var t_id = $(this).attr('data-id');
        $('#teacher_id').val(t_id);
        if (c_id == '') {
            alert('Please select at least 1 lession rule');
        } else {
            $.ajax({
                url: "{{ route('cal') }}",
                type: 'GET',
                data: {
                    c_id: c_id,
                    s_id: s_id,
                    t_id: t_id
                },
                dataType: 'json',
                success: function(data) {
                    $('#class_id').val(data.class_id);
                    $('#sub_id').val(data.sub_id);
                    $('.time-frame').html(data.html);
                    $('#schedule-calendar').modal('show');

                    setTimeout(() => {
                        cal_init();
                    }, 200);
                }
            });
        }
    });
</script>
@endpush
