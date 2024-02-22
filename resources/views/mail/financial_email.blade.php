@include('mail.header')
<!-- Email Body -->
<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Dear {{$sender_name}}</p>


        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            We appreciate your interest in our free demo financial literacy classes. Our dedicated team is working diligently, and we will reach out to you soon to embark on your journey into the realm of financial knowledge and empowerment. We are excited to be a part of your educational voyage
        </p>
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            If you have immediate questions or require assistance, please feel free to contact us. We are here to support your exploration of financial literacy in every way possible
        <h5>Thanks & Regards</h5>
        <p>The KnowMerit Team
        </p>
        <p>{{$sender_name}}
        </p>
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Date: {{ date('d-m-Y') }}</p>

    </td>
</tr>

@include('mail.footer')
