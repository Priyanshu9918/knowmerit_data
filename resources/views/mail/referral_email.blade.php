@include('mail.header')
<!-- Email Body -->
{{-- @php
    $aa = Session::get('ist_id');
    $user = DB::table('users')
        ->where('id', $aa)
        ->first();
    // dd($aa);
@endphp --}}


<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Hi {{ $referralCode->first_name }}</p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">

        <p> Love using KnowMerit? Share the love with your friends and earn rewards! Here's how it works:</p>

        <p>1. Refer a friend to KnowMerit.</p>
        <p> 2. Your friend signs up and makes their first booking.</p>
        <p> 3. You both earn rewards!</p>
        </p>

        <p>Referral Link: <a>{{ route('front.student.create') }}?ref={{ $referralCode->referral_code }}</a></p>
        <p>
            It's that simple. Start referring today and enjoy the benefits. If you have any questions, please contact
            our support team.</p>
        </p>
        <h5>Best regards,</h5>
        <p>The KnowMerit Team
        </p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Date: {{ date('d-m-Y') }}</p>

    </td>
</tr>

@include('mail.footer')
