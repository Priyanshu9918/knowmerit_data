@extends('layouts.teacher.master')
@section('content')
<style>
    .member-details {
    /* background-color: #fff; */
}
    </style>
  <div class="col-md-9 col-lg-9 col-12" style="background-color: #f6f6f6;">

    <section class="course-sec">
        <div>
            <div class="" style="padding:40px;">

                <div class="row">
                    <div>
                        <h5>Apply for Tutor Partnership</h5>
                        <p>A one-time Registration fee is payable to become a Tutor Partner on Know Merit.</p>
                    </div>

                    <input type="hidden" id="title" name="title" value="">
                    <div id="display-title"></div>

                    <input type="hidden" id="tutor_id" name="tutor_id" value="{{ Auth::user()->id }}">

                    @php
                        $plansWithBenefits = DB::table('member_ship_plans')
                            ->join('benifits', 'member_ship_plans.id', '=', 'benifits.m_id')
                            ->select('member_ship_plans.amount', 'benifits.title', 'benifits.benifits')
                            ->where('member_ship_plans.status', 1)
                            ->where('member_ship_plans.user_type', 1)
                            ->where('benifits.status', 1)
                            ->get();
                    @endphp


                    @if ($plansWithBenefits->count() > 0)
                        @foreach ($plansWithBenefits as $planWithBenefits)
                            <div class="col-lg-6 col-md-6 col-sm-12 ">
                                <div class="card-offer plan-card" data-amount="{{ $planWithBenefits->amount }}"
                                    data-target="orderamount" data-title="{{ $planWithBenefits->title }}">
                                    <div class="member-cost">
                                        <h4>₹ {{ $planWithBenefits->amount }}</h4>
                                    </div>
                                    <div class="member-details">
                                        <h6>{{ $planWithBenefits->title }}</h6>
                                        <p>{!! $planWithBenefits->benifits !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                </div>
                <div class="row mt-5 d-none" id="orderamount">
                    <h5>Order Summary</h5>
                    <div class="ordersummary-first amt">
                        <p>800 Know Merit Coins</p>
                        <h6 class="plan-card" data-amount="{{ $planWithBenefits->amount }}" data-target="orderamount"
                            id="price1"></h6>
                    </div>
                    <div class="ordersummary-first">
                        <p>Have a Promo Code?</p>
                        <h6>₹ 0</h6>
                    </div>
                    <div class="ordersummary-first">
                        <p>Sub-Total:</p>
                        <h6>₹ 500</h6>
                    </div>
                    <div class="ordersummary-first">
                        <p>GST @ 18%</p>
                        <h6>₹ 90</h6>
                    </div>
                    <div class="ordersummary-first">
                        <p>Total:</p>
                        <h6>₹ 590</h6>
                    </div>

                    <div class="order-button buy_now">
                        <button>Continue</button>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="no-up">
                    <div class="no-upcomimg"> <img src="{{asset('assets/img/my-img/clipboard1.png')}}">
                        <h3 class="mt-4">No Coin History Availabile </h3>
                    </div>
                </div>
            </div>
            @endif
            </div>

        </div>

    </section>
</div>
@endsection


@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var SITEURL = '{{ URL::to('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.buy_now', function(e) {
            var first_name = $('#tutor_name').val();
            var mobile = $('#tutor_mobile').val();
            var email = $('#tutor_email').val();
            var title = $('#title').val();
            var amount = $('#price1').val();
            var payment_status = $('#payment_status').val();
            var options = {
                "key": "{{ env('RAZAR_CLIENT_ID') }}",
                "amount": (amount * 100),
                "name": first_name,
                "description": "Payment",
                "image": "//www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
                "handler": function(response) {
                    window.location.href = SITEURL + '/' + 'teacher/paysuccessteacher?payment_id=' +
                        response
                        .razorpay_payment_id + '&amount=' + amount + '&first_name=' + first_name +
                        '&mobile=' + mobile + '&email=' + email + '&title=' + title + '&payment_status=' +
                        payment_status;
                },
                "prefill": {
                    "mobile": mobile,
                    "email": email,
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
        $(".plan-card").on('change', function() {
            // var id = $(this).attr("data-id");
            var price = $(this).attr("data-amount");
            // var title = $(this).data('data-title');
            // $("#title").val(title);
            $("#price1").val(price);
        });

        $(document).on('click', '.plan-card', function(event) {
            var tutorId = $('#tutor_id').val();
            //   alert(tutorId);
            var targetId = $(this).data('target');
            var amt = $(this).data('amount');
            $('#price1').val(amt);
            var title = $(this).data('title');
            $('#title').val(title);
            // $('#display-title').text(title);

            $('#' + targetId).removeClass('d-none');
            $('.plan-card').removeClass('selected-plan');
            $(this).closest('.plan-card').addClass('selected-plan');

            // Update the plan amount in the "Order Summary"
            $('#' + targetId).find('.amt h6').text('₹ ' + amt);
        });
    </script>
    <style>
        /* Add a CSS class for the selected plan */
        .selected-plan {
            background-color: #bee1f5;
            /* Change this to your desired background color */
        }
    </style>
@endpush
