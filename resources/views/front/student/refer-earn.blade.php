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
            padding: 1rem 8px !important;
        }

        .sell-tabel-info {
            max-width: 100%;
        }

        .ds_terms p {
            font-size: 14px;
            margin: 5px;
        }

        .ds_terms li {
            font-size: 12px;
            margin: 0;
        }
        .invite_img {
            max-width: 440px;
            display: block;
            margin: auto;
        }
        .referearnbody
        {
            height: 100vh;
            overflow: scroll;
            overflow-x: hidden;
        }
    </style>
    <div class="col-xl-9 col-lg-8 col-md-12 p-md-4" style="background-color: #4f94cf12; border-radius: 10px;">
       <!--  <div class="profile-title">
            <h3>Refer & Earn</h3>
        </div> -->
        <div class="referearnbody">
            <div class="row email-refer">
            <div class="col-xl-6 d-flex">
                <div class="card link-box flex-fill">
                    <div class="card-body referbylink">
                        <h5>Your Referral Link</h5>
                        <div class="form-group">
                            @php
                                $id = Auth::user()->id;
                                $data = DB::table('users')
                                    ->where('id', $id)
                                    ->first();
                            @endphp
                            <input type="text" class="form-control" name="referral_code" id="referral_code"
                                value="{{ route('front.student.create') }}?ref={{ $data->referral_code }}">

                        </div>
                        <button type="submit" class="nav-link login-three-head button m-2" onclick="copyToClipboard()">Copy
                            Link</button>
                        <textarea id="clipboard-textarea" style="position: absolute; left: -9999px; top: -9999px;"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body referbyemail">
                        <div class="widra-your-money">
                            <div>
                                <h5>Enter Your Friend Email To Send Referral Code</h5>
                                <form action="{{ route('student.send-referral-email') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="sendmail" id="sendmail" placeholder="Enter your Friend Email" required>
                                        <div id="error-sendmail"></div>
                                    </div>
                                    <button type="submit" class="nav-link login-three-head button m-2 sendmail">Send Email</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="massage-box">
                    <h5>Introducing Our Exciting Referral Rewards Program</h5>
                    <p>We're thrilled to announce our new referral program, designed to reward you for sharing the benefits
                        of our edtech platform with your network. Get ready to earn fantastic rewards for your referrals!
                    </p>
                    <h6>Here's how it works:</h6>
                    @php
                        $referral = DB::table('referrals')
                            ->where('status', 1)
                            ->get();
                    @endphp
                    <div class="row all-massage">
                        @if (isset($referral) && count($referral) > 0)
                        @foreach ($referral as $key => $row)
                            @if (is_object($row) && isset($row->title) && isset($row->description))
                                <div class="col-md-6 col-lg-6 col-12">
                                    @if (is_numeric($key) && $key % 2 == 0)
                                        <div class="massage-des" style="background-color: #fff1d4;">
                                            <p>{{ $row->title }}</p>
                                            <p>{!! $row->description !!}</p>
                                        </div>
                                    @else
                                        <div class="massage-des" style="background-color: #ddf2ff;">
                                            <h6>{{ $row->title }}</h6>
                                            <p>{!! $row->description !!}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="row p-3">
                                    <div class="no-up">
                                        <div class="no-upcomimg">
                                            <img src="{{ asset('assets/img/my-img/clipboard1.png') }}">
                                            <h3 class="mt-4">No Referral Available</h3>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="row p-3">
                            <div class="no-up">
                                <div class="no-upcomimg">
                                    <img src="{{ asset('assets/img/my-img/clipboard1.png') }}">
                                    <h3 class="mt-4">No Referral Available</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                   </div>
                </div>

            </div>
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


    function copyToClipboard() {
        var referralCodeInput = document.getElementById("referral_code");
        var clipboardTextarea = document.getElementById("clipboard-textarea");
        clipboardTextarea.value = referralCodeInput.value;
        clipboardTextarea.select();
        document.execCommand("copy");
        showMessage("Link copied to clipboard successfully!");
    }
    // function showMessage(message) {
    //     // You can customize how you want to display the message here
    //     alert(message);
    // }

</script>



