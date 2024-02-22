<!DOCTYPE html>
<html lang="en">
  <head>
    <!--- Basic Page Needs  -->
    <meta charset="utf-8">
    <title>Knowmerit Math</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Meta  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('landing/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/icofont.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/meanmenu.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/typography.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/nivo-slider.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('landing/css/jquery.fancybox.min.css')}}">
    <!-- Favicon -->

    <link rel="shortcut icon" type="image/png" href="{{asset('landing/img/favicon.png')}}">

  </head>
  <body>
    <div class="main-wrapper">
    @include('layouts.landing.header')

    @yield('content')

    @include('layouts.landing.footer')
    </div>
    <!-- footer-end -->
        <!-- Scripts -->
        <script src="{{asset('landing/js/jquery-3.2.0.min.js')}}"></script>
       <script src="{{asset('landing/js/jquery.meanmenu.js')}}"></script>
        <script src="{{asset('landing/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('landing/js/jquery-ui.js')}}"></script>
        <script src="{{asset('landing/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('landing/js/jquery.nivo.slider.pack.js')}}"></script>
        <script src="{{asset('landing/js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('landing/js/countdown.js')}}"></script>
        <script src="{{asset('landing/js/jquery.fancybox.min.js')}}"></script>
        <script src="{{asset('landing/js/jquery.scrollUp.js')}}"></script>
        <script src="{{asset('landing/js/jquery.mixitup.min.js')}}"></script>
        <script src="{{asset('landing/js/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('landing/js/theme.js')}}"></script>
        @stack('script')
    </body>

    </html>
