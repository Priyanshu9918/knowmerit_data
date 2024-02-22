@include('mail.header')
<!-- Email Body -->



<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">

            @if (isset($data['name']))
            Hi, {{ $data['name'] }}</p>

        @endif
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">

            Thank you for choosing KnowMerit. Your registration is important to us, and we're currently reviewing your details. Please allow us some time, and we'll send a confirmation shortly.</p>
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
