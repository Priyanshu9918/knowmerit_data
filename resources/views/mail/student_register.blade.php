@include('mail.header')
<!-- Email Body -->
@php
    $aa = Session::get('ist_id');
    $user = DB::table('users')
        ->where('id', $aa)
        ->first();
@endphp
<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Hi {{ $user->first_name }}</p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Congratulations! You've successfully registered on KnowMerit. We're thrilled to have you as part of our
            learning community. You can now access all the amazing features and resources we offer.
            Thank you for choosing KnowMerit for your educational journey. If you have any questions or need assistance,
            please don't hesitate to contact our support team.</p>
        </p>
        <h5>Thanks & Regards</h5>
        <p>The KnowMerit Team
        </p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Date: {{ date('d-m-Y') }}</p>

    </td>
</tr>

@include('mail.footer')
