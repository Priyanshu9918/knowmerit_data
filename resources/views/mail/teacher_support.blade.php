@include('mail.header')
<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Dear Support Team,</p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">

            A new teacher has registered on our platform and is currently queued for review. Please find the teacher's details below:</p>

            <p>Teacher's Details:</p>
            @if (isset($data['university_name']) && isset($data['name']) && isset($data['email']) && isset($data['created_at']))
            <p>Name: {{ $data['name'] }}</p>
            <p>Email: {{ $data['email'] }}</p>
            <p>Registration Date: {{ date('d-m-Y', strtotime($data['created_at'])) }}</p>
            <p>Username: {{ $data['email'] }}</p>
            <p>School/Institution: {{ $data['university_name'] }}</p>
        @endif
           <p> The teacher has completed the registration process, and their account is currently under review to ensure compliance with our platform's guidelines and policies. We kindly request your prompt attention to expedite the review process.</p>

        </p>

        <p>Thank you for your attention to this notification.</p>


        <h5>Thanks & Regards</h5>
        <p>The KnowMerit Team
        </p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Date: {{ date('d-m-Y') }}</p>

    </td>
</tr>

@include('mail.footer')
