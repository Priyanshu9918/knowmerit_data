@extends('layouts.teacher.master')
@section('content')
<style>
.for-margin {
    margin: 0%;
}

.desforcommunity {
    overflow: scroll;
    height: 88vh;
    overflow-x: hidden;
    margin-top: 30px;
}
</style>
@php
$community = DB::table('communities')->where('community_type',Auth::user()->id)->where('status',1)->get();
@endphp

<div class="col-xl-9 col-lg-8 col-md-12">

    <div class="row" style="background-color: #4f94cf12; border-radius: 10px; margin-bottom: 10px;">
            <div class="col-md-6 col-sm-12">
                <div class="course-group mb-0 d-flex mt-3 mb-3"
                    style="background-color: #fff; padding: 16px; border-radius: 5px;">
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
                    @php
                    $user_id = Auth::user()->id;
                    $user1 = DB::table('users')->where('id',$user_id)->first();
                    $timezone = DB::table('time_zones')->where('id',$user1->timezone ?? 195)->first();
                    $tz = $timezone->timezone;
                    $timestamp = time();
                    $dt = new DateTime("now", new DateTimeZone($tz));
                    $dt1 = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
                    $dt->setTimestamp($timestamp);
                    @endphp
                    <div class="profile-share d-flex align-items-center justify-content-center">
                        <p class="head-time-des">{{$dt->format('h:ia')}} (UTC {{$timezone->raw_offset}}.00)</p>
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
                                        <form action="{{ route('teacher.timezone2.create') }}" method="POST" id="teacher2Frm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="sel1">Country</label>
                                                <select class="form-select country" aria-label="Default select example"
                                                    name="country3" id="country_id3">
                                                    <option>Select country</option>
                                                    @if (count($country) > 0)
                                                    @foreach ($country as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group container d-none" id="tiz4">
                                                <label for="sel1">TimeZone</label>
                                                <select class="form-select" aria-label="Default select example" name="timezone3"
                                                    id="timezone_id3">
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
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                    <a href="{{url('/teacher/calendar',['id'=>base64_encode(Auth::user()->id)])}}" class="iconpadding">
                        <i class="fa fa-calendar icnfirst"></i>
                        <span> Availability</span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            @php
                     $total_msg = DB::table('ch_messages')->where('seen', 0)->where('to_id', Auth::user()->id)->count('seen');
                    @endphp
            <div class="col-md-3 col-sm-12">
                <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 27px; border-radius: 5px;">
                    <a href="{{url('chatify')}}"  class="iconpadding">
                        <i class="fa fa-comments icnfirst"></i>
                        <span> My Inbox</span> 
                        <span class="spancunt">{{ $total_msg ?? 0 }}</span>
                    </a>
                </div>
            </div>
    </div>
    <div class="row p-3 pb-4" style="background-color: #4f94cf12; border-radius: 10px;">
        <div class="add-community d-flex justify-content-end mt-4">
            <a href="{{url('/teacher/add-community')}}"><button>+ Add New</button></a>
        </div>
        <div class="desforcommunity">
            @if(count($community)>0)
            @foreach($community as $key => $c_point)
            <div>
                <div class="card-body">
                    <!--  <h5 class="subs-title">Tags : Project Management, Leadership</h5> -->
                    <div class="instructor-wrap">
                        <div class="about-instructor">
                            <div class="abt-instructor-img img12">

                                @php
                                $id = Auth::user()->id;
                                $avtar = DB::table('users')
                                ->where('id', $id)
                                ->where('status', 1)
                                ->first();
                                @endphp
                                <a href="#" class="img-fluid">
                                    @if (Auth::user()->avatar == null)
                                    <img src="{{ asset('assets/img/user/av.jpg') }}" alt>
                                    @else
                                    <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt>
                                    @endif
                                </a>
                            </div>
                            <div class="instructor-detail">
                                <h5>
                                    @if(isset($c_point->community_type))
                                    @php
                                    $name= DB::table('users')->where('id',$c_point->community_type)->first();
                                    @endphp
                                    <a href="#">{{$name->name ?? ''}}</a>
                                    @endif
                                </h5>
                                @if(isset($c_point->created_at))
                                <p>{{date('D - M d , Y', strtotime($c_point->created_at));}}</p>
                                @endif
                            </div>
                        </div>
                        <!-- @if($key == 0)
                      <div class="add-community">
                        <a href="{{url('/add-community')}}"><button>+ Add New</button></a>
                      </div>
                      @endif -->
                    </div>
                    <h5>
                        <b>{{$c_point->title ?? ''}}</b>
                    </h5>
                    @if(isset($c_point->description))
                    <p class="rev-info">{!!$c_point->description!!}</p>
                    @endif
                    <div class="col-md-12">
                        @if(isset($c_point->image))
                        <img class="blog-post-image" src="{{asset('uploads/communities/'.$c_point->image)}}" width="100%"
                            style="height: 300px;object-fit: fill;">
                        @endif
                    </div>
                    <div class="like-p mt-4 d-flex">
                        <div class="like-p d-flex" id="st_id{{$c_point->id}}">
                            @php
                            $comment =
                            DB::table('community_comments')->where('community_id',$c_point->id)->where('parent',0)->paginate(5);
                            $count_comm = count( $comment );
                            @endphp
                            @php
                            if(auth()->check() && Auth::user()->user_type != 0){
                            $like =
                            DB::table('community_likes')->where('community_id',$c_point->id)->where('user_id',Auth::user()->id)->first();
                            }
                            $like1 =
                            DB::table('community_likes')->where('community_id',$c_point->id)->where('status',1)->get();
                            $dislike =
                            DB::table('community_likes')->where('community_id',$c_point->id)->where('status',0)->get();
                            @endphp
                            @if(auth()->check() && Auth::user()->user_type != 0)
                            @if(isset($like))
                            @if($like->status == 1)
                            <div class="like">
                                <a href="javascript:" id="like" data-id="{{$c_point->id}}">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                </a>
                                <a>{{count($like1) ?? 0}}</a>
                            </div>
                            @else
                            <div class="like">
                                <a href="javascript:" id="like" data-id="{{$c_point->id}}">
                                    <img src="{{asset('assets/img/my-img/like-img-gr.png')}}"
                                        style="width: 23px;height: 23px;">
                                </a>
                                <a>{{count($like1) ?? 0}}</a>
                            </div>
                            @endif
                            @if($like->status == 0)
                            <div class="unlike">
                                <a href="javascript:" class="m-2 mt-lg-1" id="dislike" data-id="{{$c_point->id}}">
                                    <i class="fa-solid fa-thumbs-down"></i> </a>
                                <a>{{count($dislike) ?? 0}}</a>
                            </div>
                            @else
                            <div class="unlike">
                                <a href="javascript:" class="m-2 mt-lg-1" id="dislike" data-id="{{$c_point->id}}">
                                    <img src="{{asset('assets/img/my-img/unlike-img-gr.png')}}"
                                        style="width: 23px;height: 23px;">
                                </a>
                                <a>{{count($dislike) ?? 0}}</a>
                            </div>
                            @endif
                            @else
                            <div class="like">
                                <a href="javascript:" id="like" data-id="{{$c_point->id}}">
                                    <img src="{{asset('assets/img/my-img/like-img-gr.png')}}"
                                        style="width: 23px;height: 23px;">
                                </a>
                                <a>{{count($like1) ?? 0}}</a>
                            </div>
                            <div class="unlike">
                                <a href="javascript:" class="m-2 mt-lg-1" id="dislike" data-id="{{$c_point->id}}">
                                    <img src="{{asset('assets/img/my-img/unlike-img-gr.png')}}"
                                        style="width: 23px;height: 23px;">
                                </a>
                                <a>{{count($dislike) ?? 0}}</a>
                            </div>
                            @endif
                            @else
                            <div class="like">
                                <a href="{{route('front.login')}}" id="like" data-id="{{$c_point->id}}">
                                    <img src="{{asset('assets/img/my-img/like-img-gr.png')}}"
                                        style="width: 23px;height: 23px;">
                                </a>
                                <a>{{count($like1) ?? 0}}</a>
                            </div>
                            <div class="unlike">
                                <a href="{{route('front.login')}}" class="m-2 mt-lg-1" id="dislike"
                                    data-id="{{$c_point->id}}">
                                    <img src="{{asset('assets/img/my-img/unlike-img-gr.png')}}"
                                        style="width: 23px;height: 23px;">
                                </a>
                                <a>{{count($dislike) ?? 0}}</a>
                            </div>
                            @endif
                        </div>
                        @if(auth()->check() && Auth::user()->user_type != 0)
                        <div class="comment">
                            <a href="javascript:" class="m-2 mt-lg-1">
                                <i class="fa fa-commenting" aria-hidden="true" style="color: #ffe088;font-size: 21px;"></i>
                                <!-- <img src="assets/img/my-img/unlike-img-gr.png" style="width: 23px;height: 23px;"> -->
                            </a>
                            <a>{{$count_comm}}</a>
                        </div>
                        @else
                        <div>
                            <a href="{{route('front.login')}}" class="m-2 mt-lg-1">
                                <i class="fa fa-commenting" aria-hidden="true" style="color: #ffe088;font-size: 21px;"></i>
                                <!-- <img src="assets/img/my-img/unlike-img-gr.png" style="width: 23px;height: 23px;"> -->
                            </a>
                            <a>{{$count_comm}}</a>
                        </div>
                        @endif
                    </div>
                    <div class="addcomment mt-4">
                        <form action="{{url('community-comments')}}" method="post" id="addFrm">
                            @csrf
                            <input type="hidden" name="community_id" value="{{$c_point->id}}">
                            <div class="row">
                                <div class="col-md-11" style="padding-right: 0px">
                                    <textarea rows="2" class="form-control" placeholder="comments"
                                        name="comment"></textarea>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-comment">
                                    </p>
                                </div>
                                <div class="col-md-1" style="padding-left: 0px">
                                    <div class="send-icon">
                                        <button type="submit" style="background: transparent;border: none;"><img
                                                src="{{asset('assets/img/my-img/send-icon-new.png')}}"
                                                class="send-icon1"></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @foreach($comment as $comments)
                    <div class="notify-item mt-4">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="notify-content">

                                    <a href="#" class="avatar-img semirounded-circle" alt>
                                        @if (Auth::user()->avatar == null)
                                        <img src="{{ asset('assets/img/user/av.jpg') }}" alt>
                                        @else
                                        <img src="{{ asset('uploads/tutors/' . $avtar->avatar) }}" alt>
                                        @endif
                                    </a>

                                    @php
                                    $userq = DB::table('users')->where('id',$comments->user_id)->where('status',1)->first();
                                    @endphp
                                    <div class="notify-detail">
                                        <h6><a href="#">{{$userq->name}}</a></h6>
                                        <!-- <h6><a href="instructor-profile.html">{{$userq->name}}</a><span>Today at 9:42
                                                AM</span></h6> -->
                                        <p>{{$comments->comment}}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="rep12">
                                @if(auth()->check() && Auth::user()->user_type != 0)
                                @if($comments->user_id != Auth::user()->id)
                                <div class="reply reply-view">
                                    <a href="javascript:;" class="btn btn-reply rep-btn rep_view1"><i
                                            class="feather-corner-up-left"></i> Reply</a>
                                </div>
                                @endif
                                @endif
                                <div class="like like1">
                                    <!-- <a href="javascript:">
                                                <img src="assets/img/my-img/like-img-gr.png"
                                                    style="width: 23px;height: 23px;">
                                            </a> -->
                                    <!-- <a href="">10</a> -->
                                </div>
                            </div>
                            <div class="addcomment1 mt-4">
                                <form action="{{url('community-comments')}}" method="post" id="addFrm1">
                                    @csrf
                                    <input type="hidden" id="comment_id" name="comment_id" value="{{$comments->id}}">
                                    <input type="hidden" id="community_id" name="community_id" value="{{$c_point->id}}">
                                    <div class="row">
                                        <div class="col-md-11" style="padding-right: 0px">
                                            <textarea rows="2" class="form-control sec-reply" placeholder="Comments"
                                                name="comment"></textarea>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                id="error1-comment"></p>

                                        </div>
                                        <div class="col-md-1" style="padding-left: 0px">
                                            <div class="send-icon">
                                                <button type="submit" style="background: transparent;border: none;"><img
                                                        src="{{asset('assets/img/my-img/send-icon-new.png')}}"
                                                        class="send-icon1" style="border: unset;"></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @php
                    $childcomment = DB::table('community_comments')->where('parent',$comments->id)->get();
                    @endphp
                    @foreach($childcomment as $child)
                    <div class="notify-item message2">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="notify-content">
                                    @php
                                    $userq1 = DB::table('users')->where('id',$child->user_id)->where('status',1)->first();
                                    @endphp
                                    <a href="#" class="avatar-img semirounded-circle" alt>
                                        @if (Auth::user()->avatar == null)
                                        <img src="{{ asset('assets/img/user/av.jpg') }}" alt>
                                        @else
                                        <img src="{{ asset('uploads/tutors/' . $userq1->avatar) }}" alt>
                                        @endif
                                    </a>
                                    <div class="notify-detail">
                                        <h6><a href="#">{{ $userq1->name}} </a></h6>
                                        <p>{{$child->comment}}</p>
                                        <br>
                                        <div class="rep123" style="margin-left: 0">
                                            <div class="reply">
                                                <!-- <a href="javascript:;" class="btn btn-reply rep-btn rep_view"><i
                                                                class="feather-corner-up-left"></i> Reply</a> -->
                                            </div>

                                            <div class="like like1">
                                                <!-- <a href="javascript:">
                                                            <img src="assets/img/my-img/like-img-gr.png"
                                                                style="width: 23px;height: 23px;">
                                                        </a>
                                                        <a href="">10</a> -->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{--<div class="addcomment12 mt-4">
                                        <div class="row">
                                            <div class="col-md-11" style="padding-right: 0px">
                                                <textarea rows="2" class="form-control sec-reply"
                                                    placeholder="Comments"></textarea>
                                            </div>
                                            <div class="col-md-1" style="padding-left: 0px">
                                                <div class="send-icon">
                                                    <a href=""><img src="{{asset('assets/img/my-img/send-icon-new.png')}}"
                                            class="send-icon1" style="border: unset;"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                    @endforeach
                    @endforeach
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
                <span class="noupcom">There is no community post available</span>
            </div>
        </div>
            </div> @endif
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).ready(function() {
    //on change country
    $(document).on('submit', 'form#addFrm', function(event) {
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
                    toastr.success("comment created successfully!");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        // window.location = "{{ url('/')}}"+"/admin/user-feedback";
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
    $(document).on('submit', 'form#addFrm1', function(event) {
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
                    toastr.success("comment created successfully!");
                    // redirect to google after 5 seconds
                    window.setTimeout(function() {
                        // window.location = "{{ url('/')}}"+"/admin/user-feedback";
                        location.reload();
                    }, 2000);

                }
                //show the form validates error
                if (response.success == false) {
                    for (control in response.errors) {
                        var error_text = control.replace('.', "_");
                        $('#error1-' + error_text).html(response.errors[control]);
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
    $(document).on('click', '#like', function(event) {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('like.dislike') }}",
            type: "get",
            data: {
                'active': 1,
                'id': id,
            },
            success: function(response) {
                console.log(response);
                $('#st_id' + id).replaceWith(response);
            }
        });
    });
    $(document).on('click', '#dislike', function(event) {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('like.dislike') }}",
            type: "get",
            data: {
                'active': 0,
                'id': id,
            },
            success: function(response) {
                console.log(response);
                $('#st_id' + id).replaceWith(response);
            }
        });
    });
});
</script>
@endpush