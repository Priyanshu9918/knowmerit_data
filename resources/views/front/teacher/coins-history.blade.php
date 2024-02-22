@extends('layouts.teacher.master')
@section('content')
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
    <div class="row p-3" style="background-color: #4f94cf12; border-radius: 10px;">
        <!-- <div class="profile-title">
            <h3>Coins History</h3>
        </div> -->
        <div class="current-coin">
            <h5>Current Coins Balance: <span id="current-coins-balance">₹ 0</span></h5>
        </div>
     @php
        $tutor_id = Auth::user()->id;
        $tutor = DB::table('coins_histories')->where('tutor_id', $tutor_id)->get();
     @endphp
        <div>
            <table class="table coins-table table-striped">
                @php
                    $totalAmount = 0;
                @endphp
                @if (isset($tutor) && count($tutor) > 0)
                <thead>
                    <tr style="color: #019fff;">
                        <th scope="col">Title</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date and Time</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($tutor as $ts)
                            <tr>
                                <td>{{$ts->title}}</td>
                                <td class="plus-coins"><span>+</span>₹ {{$ts->amount}}</td>
                                <td> {{date('d-m-Y h:i A', strtotime($ts->created_at))}}</td>
                            </tr>
                            @php
                                $totalAmount += $ts->amount;
                            @endphp
                        @endforeach
                    @else
                        {{-- <h1>No Data Found</h1> --}}
                        <div class="row p-3">
                            <div class="no-up">
                                <div class="no-upcomimg"> <img src="{{asset('assets/img/my-img/clipboard1.png')}}">
                                    <h3 class="mt-4">No Coin History Availabile </h3>
                                </div>
                            </div>
                        </div>
                        @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    $('.tab-value').click(function() {
        var t = $(this).text();
        $('#addbtn').html('Add' + t);
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentCoinsBalance = document.getElementById("current-coins-balance");
        currentCoinsBalance.innerText = `₹ ${Number({{$totalAmount}}).toFixed(1)}`;
    });
</script>
<script>
    $(document).ready(function () {
        const currentCoinsBalance = Number({{ $totalAmount }}).toFixed(1);
        $("#header-coins-balance").text(`Current Coins Balance: ₹ ${currentCoinsBalance}`);
    });
</script>
