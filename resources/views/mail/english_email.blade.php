@include('mail.header')
<!-- Email Body -->
<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Dear {{$sender_name}}</p>


        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            We appreciate that you are interested in our free demo English Classes. Our committed team is already hard at work, and we will contact you shortly to begin your adventure into the world of English language and literature. We are excited to be a part of your educational journey.
        </p>
        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            If you have any immediate questions or need assistance, please don't hesitate to contact us. We're here to support your linguistic exploration in every way we can.        </p>

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
