<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <h1>Dear</h1>
    <p> Make your payment</p>

    <p>We received a request make payment for your credit to book a class.</p>

    <p>To make your payment, click on the button below:</p>
    <a href="{{ route('paymentlink', $id) }}">payment Link</a>

    <!-- <p>Or copy and paste the URL into your browser:</p>
    <p>url : flame.com</p> -->
    <br>

    <!-- <h5>Thanks & Regards</h5> -->
    <p>Date: {{date('d-m-Y')}}</p>
</html>
