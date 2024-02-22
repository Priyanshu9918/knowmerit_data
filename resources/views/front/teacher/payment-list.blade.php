@extends('layouts.teacher.master')
@section('content')
<style type="text/css">
    .user-nav a.dropdown-toggle {
        display: block;
    }

    .course-instruct-blk .badge {
        min-width: 133px;
        padding: 7px 10px;
        border-radius: 30px !important;
        color: #fff;
        font-size: 14px;
    }

    .for-margin {
        margin: 20px;
    }
    .group-img-tdbtn
    {
        position: absolute;
        top: 33%;
        right: 0%;
    }
</style>
<div class="col-xl-9 col-lg-8 col-md-12">

    <div class="row" style="background-color: #4f94cf12; border-radius: 10px; margin-bottom: 10px;">
            <div class="col-md-6 col-sm-12">
                <div class="course-group mb-0 d-flex mt-3 mb-3"
                    style="background-color: #fff; padding: 10px; border-radius: 5px;">
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
                <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 22px; border-radius: 5px;">
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
                <div class="course-group mb-0 d-flex mt-3 mb-3" style="background-color: #fff; padding: 22px; border-radius: 5px;">
                    <a href="{{url('chatify')}}"  class="iconpadding">
                        <i class="fa fa-comments icnfirst"></i>
                        <span> My Inbox</span> 
                        <span class="spancunt">{{ $total_msg ?? 0 }}</span>
                    </a>
                </div>
            </div>
    </div>
    <div class="row" style="background-color: #4f94cf12; border-radius: 10px; padding: 20px 20px 60px 20px;">
        <div class="position-relative">
                <!-- <div class="profile-title">
                    <h3>Payment List</h3>
                </div> -->
               
                <!--<div>
                        <h3>Payment List</h3>
                    </div> -->
                <div class="ticket-btn-grp group-img-tdbtn mt-4">
                    <a href="{{url('/teacher/payment')}}">Create Payment</a>
                </div>
        </div>
        <div class="profile-details mt-5">
                
            
            <!-- <div class="change-password">
                    <form action="{{ route('teacher.payment') }}" method="POST" id="createFrm" enctype="multipart/form-data">
                    @csrf
                        <div class="row" style="justify-content: center;">
                        @php
                            $tutors = DB::table('categories')->where('status',1)->get();
                        @endphp
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label>Categories</label><br>
                                    <select class="form-control" name="category" id="category">
                                        <option value="" disaled>Select Category</option>
                                        @foreach ($tutors as $t)
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-category"></p>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3 d-none" id="sb1">
                                    <label>Sub-categories</label><br>
                                    <select class="form-control" name="sub_category" id="sub_category">
                                    </select>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-sub-category"></p>
                                @php
                                    $id =  Auth::user()->id;
                                        $user1 = DB::table('tutors')
                                            ->where('user_id', $id)
                                            ->first();
                                        $latitude = $user1->lat;
                                        $longitude = $user1->lng;
                                        $student_enquiry = DB::table("book_a_classes")
                                                ->select("book_a_classes.id","book_a_classes.first_name","book_a_classes.user_id"
                                                    ,DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                                    * cos(radians(book_a_classes.lat))
                                                    * cos(radians(book_a_classes.lng) - radians(" . $longitude . "))
                                                    + sin(radians(" .$latitude. "))
                                                    * sin(radians(book_a_classes.lat))) AS distance"))
                                                    ->orderBy('created_at','Desc')
                                                    ->get();
                                @endphp
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label>Students</label><br>
                                    <select class="form-control" name="student" id="student">
                                        <option value="" disaled>Select student</option>
                                        @foreach ($student_enquiry as $st1)
                                            @if($st1->distance < $user1->tutor_travel)
                                                $user1 = DB::table('tutors')
                                                ->where('user_id', $id)
                                                ->first();
                                                <option value="{{ $st1->user_id }}">{{ $st1->first_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-student"></p>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label>Boards</label><br>
                                    <input name="board" type="text" class="text-field" id="board">
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-board"></p>
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                                    <label>Amonut</label><br>
                                    <input name="amount" type="number" class="text-field" id="amount">
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-amount"></p>
                                <button type="submit">Save Change</button>
                            </div>

                        </div>
                    </form>
                </div> -->
                @php
                    $p_history = DB::table('student_payments')->where('teacher_id',Auth::user()->id)->get();
                    @endphp
                    @if(count($p_history) > 0)
            <div class="settings-widget mt-4" data-select2-id="19">
                <div class="settings-inner-blk p-0" data-select2-id="18">
                    <div class="comman-space pb-0" data-select2-id="17">


                    </div>

                    <div class="comman-space pb-0">
                        <div class="settings-referral-blk course-instruct-blk  table-responsive">

                            <table class="table table-nowrap mb-0">
                                <thead>
                                    <tr>

                                        <th>Categories</th>
                                        <!-- <th>Sub Categories</th> -->
                                        <th>Students</th>
                                        <th>Boards</th>
                                        <th>Amount</th>
                                        <th>Status </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($p_history as $pay_history)
                                    <tr>
                                        @php
                                        $user = DB::table('users')->where('id', $pay_history->student_id)->first();
                                        $cate1 = DB::table('categories')->where('id', $pay_history->category)->first();
                                        @endphp
                                        <td>{{$cate1->name ?? ''}}</td>
                                        <td>{{$user->name ?? ''}}</td>
                                        <td>{{$pay_history->board ?? ''}} </td>
                                        <td>₹ {{$pay_history->amount ?? 0}}</td>
                                        @if($pay_history->payment_status == 1)
                                        <td><span class="badge info-low">Paid</span></td>
                                        @else
                                        <td><span class="badge info-medium">Pending</span></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    {{--<tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-low">Paid</span></td>
                                    </tr>
                                    <tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-medium">Pending</span></td>
                                    </tr>
                                    <tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-high">Cancel</span></td>

                                    </tr>
                                    <tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-low">Paid</span></td>
                                    </tr>
                                    <tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-low">Paid</span></td>
                                    </tr>
                                    <tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-low">Paid</span></td>
                                    </tr>
                                    <tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-low">Paid</span></td>
                                    </tr>
                                    <tr>

                                        <td>ABC</td>
                                        <td>XYZ</td>

                                        <td>priya</td>
                                        <td>BSEB </td>
                                        <td>₹ 120000</td>
                                        <td><span class="badge info-low">Paid</span></td>
                                    </tr>--}}

                                </tbody>
                            </table>

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
                                <span class="noupcom">There is no payment info !</span>
                            </div>
                        </div>
                    </div>
            @endif
        </div>

    </div>
</div>
@endsection
@push('script')
{{-- <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        //on change country

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
                        toastr.success("Email payment link send Successfully");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/')}}" + "/teacher/payment";
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
        $(document).on('change', '#category', function() {
            var id = $('#category').val();
            $.ajax({
                type: "get",
                url: "{{ route('teacher.st.sub-category') }}",
                data: {
                    'category': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    if (data.success == true) {
                        $("#sb1").removeClass('d-none');
                        $("#sub_category").empty();
                        $.each(data.value, function(key, value) {
                            $("#sub_category").append('<option value="' + value.id +
                                '">' +
                                value
                                .name + '</option>');
                        });
                    }
                    if (data.success == false) {
                        $("#sb1").addClass('d-none');
                    }
                }
            });
        });
    });
</script>

@endpush