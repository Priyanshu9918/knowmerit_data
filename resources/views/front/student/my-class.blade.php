@extends('layouts.student.master')
@section('content')
<style type="text/css">
    .user-nav a.dropdown-toggle {
        display: block;
    }

    span.top-view-c2 {
        padding: 3px 6px;
    }

    .settings-inner-blk table tbody tr:last-child {
        border: 5px solid #009fff !important;
    }

    .dash-table td {
        padding: 1rem 35px !important;
    }
    .for-margin{
        margin: 20px;
    }
</style>
<div class="col-xl-9 col-lg-8 col-md-12" style="background-color: #f6f6f6;">
    <!-- <h3> My Courses </h3> -->
    <div class="profile-title">
        <h3>Profile</h3>
    </div>
    <div class="row">
        @php
        $st_data = DB::table('assign_courses')->where('student_id',Auth::user()->id)->pluck('course_id');
        if(isset($st_data)){
            $t_courses = DB::table('courses')->whereIn('id',$st_data)->get();
        }
        @endphp
        @if(count($t_courses)>0)
        @foreach($t_courses as $s_crs)
        <div id="instructor-box-dec" class="col-lg-4 col-md-4 d-flex mt-4">
            <div class="instructor-box flex-fill ins-box1">
                <div id="inst-img" class="instructor-img ins-img">
                    <a href="{{url('/student/course-details1',$s_crs->id)}}">
                        <img class="img-fluid" alt="" src="{{asset('uploads/course/'.$s_crs->image)}}">
                    </a>

                </div>
                <a href="{{url('/student/course-details1',$s_crs->id)}}">
                <div class="instructor-content courselistdet">
                    <div class="text-v">
                        <h3>{{$s_crs->title ?? ''}}</h3>
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
                            <div class="progress-bar" role="progressbar" style="width: {{$total}}%;" aria-valuenow="{{$total}}" aria-valuemin="0" aria-valuemax="100">{{$total}}%</div>
                            @endif
                            <!-- <div class="progress-bar bg-success progress-bar-striped active-stip"></div> -->
                        </div>
                    </div>



                </div></a>
            </div>
        </div>
        @endforeach
        @else
        <div class="row">
            <div class="no-up">
                <div class="noenquery for-margin">
                    <img src="{{asset('no-data.gif')}}" alt="Girl in a jacket">
                </div>
                <div style="text-align:center;padding-top: 25px;">
                    <span class="noupcom">You do not have courses.</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
<script type="text/javascript">
    $('.tab-value').click(function() {
        var t = $(this).text();
        $('#addbtn').html('Add' + t);
    });
</script>