@extends('layouts.student.master')
@section('content')
    <style type="text/css">
        .user-nav a.dropdown-toggle {
            display: block;
        }

        .profile_picture_sec img {
            max-width: 100px;
            border-radius: 100px;
        }
    </style>
    <div class="col-xl-9 col-lg-8 col-md-12 p-md-4" style="background-color: #4f94cf12; border-radius: 10px;;">
        <div class="profile-details">
            <!-- <div class="profile-image">
                                <img src="assets/img/my-img/enquiry-user.png">
                            </div> -->
            <!-- <div class="profile-title">
                <h3>Profile</h3>
            </div> -->
            <div class="profile-form">
                {{-- <div class="profile_picture_sec position-relative">
                    <img src="assets/img/user/user15.jpg" alt="" />
                    <a style="bottom: 0;left: 70px;" class="about-count btn-action-primary d-inline-block top-view-c2 position-absolute"><i class="fas fa-edit"></i></a>
                </div> --}}
                <form action="{{ route('student.student_profile_update') }}" method="POST" id="createFrm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label>Name</label><br>
                            <input type="text" class="text-field" name="first_name" value="{{ $data->first_name }}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label>Email Address</label><br>
                            <input type="email" class="text-field" name="email" value="{{ $data->email }}" readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            <label>Mobile</label><br>
                            <input type="number" class="text-field" name="phone" value="{{ $data->phone }}">
                        </div>
                        {{-- <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                            @php
                                $member_ship = DB::table('member_ship_plans')
                                    ->where('status', 1)
                                    ->get();
                            @endphp
                            <div class="form-group ">
                                <label><b>Payment</b></label>

                                <input type="text" class="form-control" id="payment_status" name="payment_status"
                                value="{{ $data2->payment_status }}" readonly/>

                              {{-- <select class="form-control" id="payment_status" name="payment_status">
                                                @foreach ($member_ship as $mb)
                                                    <option value="{{ $mb->benifits }}"
                                                        @if ($mb->benifits == $data2->payment_status) selected @endif>
                                                        {{ $mb->benifits }}</option>
                                                @endforeach
                                                <option value="Continue without prime benifits">Continue without prime
                                                    benifits</option>

                                                </option>
                                            </select>
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container"
                                id="error-classes_choice"></p>
                        </div> --}}
                    </div>
                    <button class="mt-2" type="submit">Save Change</button>
                </form>
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
