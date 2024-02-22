@include('mail.header')
<!-- Email Body -->
<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <p
            style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Dear {{$sender_name}}({{$sender_email}})</p>

        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Greetings of the Day!  We want to inform you, that it's time to make your tuition fee payment for the upcoming session. To streamline this process and make it more convenient for you, we have partnered with [ Paypal/Razor pay], a trusted payment service provider, to offer you a secure and hassle-free payment experience.</p>
        </p>
        <p>You can now easily make your payment by following the link below:  </p>
        <p><span>Amount</span> : {{$currency}}{{$amount}}</p>
        <p><a href="{{ route('paymentlink', $id) }}">payment Link</a></p>

        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Please ensure that you make your payment before the due date as the link will expire in 48 hrs. If you have any questions or encounter any issues while making your payment, please don't hesitate to reach out to us.  KnowMerit ensures the security of your payment information, and you can use various payment methods, including credit/debit cards and electronic bank transfers, to complete your transaction.  Thank you for choosing KnowMerit for your education. We appreciate your prompt attention to this matter, and we look forward to assisting you with any further inquiries you may have.</p>
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
