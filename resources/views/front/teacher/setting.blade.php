@extends('layouts.teacher.master')

@section('content')
<style type="text/css">
    .user-nav a.dropdown-toggle {
        display: block;
    }

    .setting-text {
        padding: 17px;
        background: #FFFFFF;
        box-shadow: 0px 0px 6px rgba(227, 227, 227, 0.85);
        border-radius: 10px;
        margin-bottom: 5px;
    }
</style>
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
    <div class="row p-3 pb-5" style="background-color: #4f94cf12; border-radius: 10px;">

        <!-- <div class="profile-title">
            <h3>Setting</h3>
        </div> -->

        <div class="setting-text mt-4">
            <a href="{{ url('/teacher/change-password')}}">
                <p><i class="fa fa-unlock-alt"></i><span> Change Password</span></p>
            </a>
            <a href="#"><i class="fa fa-angle-right angle-des"></i></a>
        </div>
        <div class="setting-text">
            <a href="#" id="delete-account-link">
                <p>
                    <i class="fa {{ Auth::user()->status == 1 ? 'fa-user-times' : 'fa-user-check' }}"
                       aria-hidden="true" id="status"
                       data-status="{{ Auth::user()->status }}"></i>
                     <span style="margin-left: 10px">    Delete Your Account </span>
                </p>
            </a>
            <i class="fa fa-angle-right angle-des"></i>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#delete-account-link').click(function(e) {
            e.preventDefault(); // Prevent the default link behavior

            // Show the SweetAlert confirmation dialog when the link is clicked
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete your account.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    // User confirmed, make your AJAX request here to delete the account
                    var ajaxUrl = "{{ route('teacher.deactive') }}";
                    var requestData = {
                        "_token": "{{ csrf_token() }}",
                        "status": $('#status').attr('data-status')
                    };
                    $.ajax({
                        type: 'POST',
                        url: ajaxUrl,
                        data: requestData,
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire({
                                    title: 'Account Deleted!',
                                    text: 'Your account has been deleted successfully.',
                                    icon: 'success',
                                }).then(() => {
                                    window.location = "{{ url('/') }}" + "/student/logout";
                                });
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while deleting your account.',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
