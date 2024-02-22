<!DOCTYPE html>
<html lang="en">

<head>
    <!--- Basic Page Needs  -->
    <meta charset="utf-8">
    <title>Knowmerit Science</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="Online coding courses">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Meta  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/nivo-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/responsive.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('landing/img/favicon.png') }}">

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MLFL7W8K');</script>
        
  </head>
  <body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MLFL7W8K"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        
  <header>
        <div class="menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-9">
                        <div class="logo">
                            <a href="#">
                                <img src="{{ asset('landing/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 hidden-sm hidden-xs">
                        <div class="menu">
                            <ul>
                                <li data-toggle="modal" data-target="#bookfreedemo">
                                    <a href="javascript:">Book a Free Demo Class
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="#">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i> info@knowmerit.com </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="modal fade" id="bookfreedemo" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Book a Free Demo Class
                    </h4>
                </div>
                <div class="modal-body">
                    <form class="well form-horizontal" action="{{ route('landing.codingtwo') }}" method="POST"
                        id="createFrm1">
                        @csrf

                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span>
                                    <input name="first_name" placeholder="Full Name" class="form-control"
                                        type="text">
                                   
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                id="error-first_name"></p>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </span>
                                    <input name="email" placeholder="Email" class="form-control" type="email">
                                  
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email">
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-earphone"></i>
                                    </span>
                                    <input name="phone" placeholder="Phone Number" class="form-control"
                                        type="number">
                                    
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-phone"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-list"></i>
                                    </span>
                                    <select name="gender" class="form-control selectpicker">
                                        <option value="">Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                    
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-gender"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-book"></i>
                                    </span>
                                    <input name="subject" placeholder="Grade"
                                        class="form-control" type="text">
                                    
                                </div>
                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                        id="error-subject"></p>
                            </div>
                        </div>
                        <div class="form-group text-center mar-top-30">
                            <button type="submit" class="btn btn-info submit">Book Now <span
                                    class="glyphicon glyphicon-send"></span>
                            </button>
                        </div>
                        </fieldset>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!-- header-end -->

    <!-- mobile-menu-start -->
    <!--  <div class="mobile-menu-area visible-xs visible-sm"><div class="container"><div class="row"><div class="col-md-12"><div class="mobile_menu"><nav id="mobile_menu_active"><ul><li><a href="index-2.html">Home</a></li><li><a href="#">about us</a></li><li><a href="#">services</a></li><li><a href="#">process</a></li><li><a href="#">contact</a></li></ul></nav></div></div></div></div></div> -->
    <!-- mobile-menu-end -->
    <section class="banner3">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-7 col-sm-12">
                    <div class="banner-text">
                        <h1>Curiosity Meets Code:<br>

                            <span>KnowMerit's Young Coders<!-- <h1>leaving home!</h1> --></span>

                        </h1>
                        <p>Embracing a coding journey where young minds explore, innovate, and reach new coding heights
                        </p>

                    </div>
                </div>
                <div class="col-md-5 col-md-5 col-sm-12">
                    {{-- <form  action=" " method="post" id="contact_form"> --}}
                    <form class="well form-horizontal" action="{{ route('landing.coding') }}" method="POST"
                        id="createFrm">
                        @csrf
                        <fieldset>
                            <h2>
                                <b>Book a Free Demo Class</b>
                            </h2>
                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-12 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-user"></i>
                                        </span>
                                        <input name="first_name" placeholder="Full Name" class="form-control"
                                            type="text">
                                        
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error1-first_name"></p>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-12 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-envelope"></i>
                                        </span>
                                        <input name="email" placeholder="Email" class="form-control"
                                            type="email">
                                        
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error1-email">
                                        </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-earphone"></i>
                                        </span>
                                        <input name="phone" placeholder="Phone Number" class="form-control"
                                            type="number">
                                      
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                    id="error1-phone">
                                </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-list"></i>
                                        </span>
                                        <select name="gender" class="form-control selectpicker">
                                            <option value="">Gender</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                            <option>Other</option>
                                        </select>
                                        
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error1-gender"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-book"></i>
                                        </span>
                                        <input name="subject" placeholder="Subject, Grade / Year that you offer "
                                            class="form-control" type="text">
                                       
                                    </div>
                                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                                    id="error1-subject"></p>
                                </div>
                            </div>
                            <!-- Text input-->
                            <!-- Select Basic -->
                            <!-- Button -->
                            <div class="form-group text-center mar-top-30">
                                <button type="submit" class="btn btn-info submit">Book Now <span
                                        class="glyphicon glyphicon-send"></span>
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!-- /.container -->
            </div>
        </div>
        </div>
    </section>
    <section class="certificate-process">
        <div class="container">
            <div class="row">
                <div class="home1-section-title text-center mar-bot-50">
                <h2>KnowMerit's Coding Learning Process</h2>

                <span class="home1-section-title-border"></span>
                 <p>Simple and Student-Friendly</p>
                </div>
                <div class="s-res">
                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="certi-process-child afterline">
                        <img src="{{ asset('landing/img/registration.png')}}">
                        <h6>Student registration</h6>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="certi-process-child afterline">
                        <img src="{{ asset('landing/img/interview.png')}}">
                        <h6>Get demo classes</h6>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="certi-process-child afterline">
                        <img src="{{ asset('landing/img/instructor-payment.png')}}">
                        <h6>Instructor payments</h6>
                    </div>
                </div>

                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="certi-process-child afterline">
                        <img src="{{ asset('landing/img/verification.png')}}">
                        <h6>Choose Coding Topics</h6>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="certi-process-child afterline">
                        <img src="{{ asset('landing/img/schedule-classes.png')}}">
                        <h6>Schedule Classes</h6>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="certi-process-child afterline">
                        <img src="{{ asset('landing/img/test_1.png')}}">
                        <h6>Practice Coding Projects</h6>
                    </div>
                </div>
                 <div class="col-md-2 col-lg-2 col-sm-12">
                    <div class="certi-process-child">
                        <img src="{{ asset('landing/img/doubt.png')}}">
                        <h6>Doubt Session</h6>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </section>
    <!-- about-us1-area-start -->
    <div class="about-us1-area" id="about1">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="about-us1">
                        <h2 class="about-us1-title">About Us</h2>
                        <p class="about-us1-text">From app developers and software engineers to tech enthusiasts and
                            future innovators, individuals in diverse fields rely on coding to fuel their digital
                            creations. Coding forms the universal language of innovation, and at KnowMerit, we're your
                            premier destination for online coding education.</p>
                        <p class="about-us1-text">Our expert instructors provide tailored one-on-one guidance,
                            empowering K-12 students to master the art of coding and unlock a world of tech
                            possibilities.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="about1-banner">
                        <img src="{{ asset('landing/img/code1.png') }}" alt="">


                    </div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="service-1">

                        <div class="service-box">
                            <div class="clearfix">
                                <div class="sb-icon">
                                    <i class="fa fa-cogs"></i>
                                </div>
                                <div class="sb-content">
                                    <h4>Mission Statement</h4>
                                    <p>To empower individuals with critical coding skills for success in a tech-driven
                                        world. KnowMerit's thoughtfully designed online courses introduce universally
                                        applicable coding concepts, benefiting diverse industries and professions,
                                        whether you're an aspiring developer, software engineer, data scientist, or tech
                                        innovator.</p>
                                </div>
                            </div>
                        </div>
                        <div class="service-box">
                            <div class="clearfix">
                                <div class="sb-icon">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                                <div class="sb-content">
                                    <h4>Vision</h4>
                                    <p>To become a worldwide leader in coding education, instilling a passion for
                                        programming and cultivating problem-solving excellence across all sectors. We
                                        envisage a world where every learner, from K-12 students to professionals, can
                                        access the coding knowledge necessary for success and innovation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="our-team-area building-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="our-team-head">
                        <div class="home1-section-title">
                            <h2>KnowMerit's Coding Classes: Building Tomorrow's Innovators in the USA and Canada </h2>

                            <span class="home1-section-title-border"></span>
                            <p>Why Choose KnowMerit for Coding Classes?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="h1-team-caousel owl-carousel">
                    <div class="col-xs-12">
                        <div class="item">
                            <div class="service-2">
                                <div class="service-box">
                                    <div class="clearfix">
                                        <div class="sb-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <div class="sb-content">
                                            <h4>Engaging 1-on-1 Sessions</h4>
                                            <p>Personalized learning at your own pace, ensuring a deeper understanding
                                                of coding. Learning is under parental supervision, providing a
                                                disciplined environment.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="item">
                            <div class="service-2">
                                <div class="service-box">
                                    <div class="clearfix">
                                        <div class="sb-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <div class="sb-content">
                                            <h4>Top-Rated Instructors</h4>
                                            <p>Experienced instructors make coding accessible and captivating. Infusing
                                                curiosity into young minds, they drive innovation. Along with Doubt
                                                clearing options.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="item">
                            <div class="service-2">
                                <div class="service-box">
                                    <div class="clearfix">
                                        <div class="sb-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <div class="sb-content">
                                            <h4>Customized Learning</h4>
                                            <p>Tailored to individual preferences, fostering a love for coding.
                                                Analyzing the child's learning processes and adjusting the curriculum
                                                accordingly. Learning was never made so easy and fun activity. With
                                                KnowMerit it is possible now.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="item">
                            <div class="service-2">
                                <div class="service-box">
                                    <div class="clearfix">
                                        <div class="sb-icon">
                                            <i class="fa fa-shield"></i>
                                        </div>
                                        <div class="sb-content">
                                            <h4>AI-Enabled Learning</h4>
                                            <p>At KnowMerit, we harness the power of interactive audiovisual tools,
                                                employing video lectures enriched with animations. These immersive
                                                resources fuel students' imaginations, simplifying complex subject
                                                concepts with real-world examples.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="join-now-area bg-with-black">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="join-now">
                        <h2>Ignite Your Coding Passion: Book a Free Demo Class</h2>
                        <a href="#">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- join-now-area-end -->
    <section class="fifth-section">
        <div class="container">
            <div class="row">

                <div class="home1-section-title text-center mar-bot-50">

                    <h2>KnowMerit Coding Courses</h2>

                    <span class="home1-section-title-border"></span>

                </div>

                <div class="col-lg-2 col-md-6 col-sm-6 floatleft">

                    <div class="space-is">
                        <div>
                            <img src="{{ asset('landing/img/subjects.png') }}" class="w-100"
                                style=" width: 50px; margin-bottom: 5px;">
                            <p>Online coding courses for K-12 students</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 floatright">

                    <div class="space-is">
                        <div>
                            <img src="{{ asset('landing/img/assignments.png') }}" class="w-100"
                                style=" width: 50px; margin-bottom: 5px;">
                            <p>Test preparation and assignments</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 floatleft">

                    <div class="space-is">
                        <div>
                            <img src="{{ asset('landing/img/test.png') }}" class="w-100"
                                style=" width: 50px; margin-bottom: 5px;">
                            <p>Flexibility to pause</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 floatright">

                    <div class="space-is">
                        <div>
                            <img src="{{ asset('landing/img/exam.png') }}" class="w-100"
                                style=" width: 50px; margin-bottom: 5px;">
                            <p>Homework assignments</p>
                        </div>
                    </div>

                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 floatleft">

                    <div class="space-is">
                        <div>
                            <img src="{{ asset('landing/img/homework.png') }}" class="w-100"
                                style=" width: 50px; margin-bottom: 5px;">
                            <p>Practice Questions</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <section class="sixth-section">
        <div class="container">
            <div class="row">
                <div class="home1-section-title text-center mar-bot-50">
                    <h2>Benefits of Joining KnowMerit Coding Classes</h2>
                    <span class="home1-section-title-border"></span>
                </div>

                <div class="col-md-5 col-sm-12">
                    <div class="">
                        <img class="large-img" src="{{ asset('landing/img/c122.png') }}">
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/teacher.png') }}">
                                </div>
                                <p>Learning hours that are flexible</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/Flexibility-teaching.png') }}">
                                </div>
                                <p>You have the option of doing 1-on-1 or group lessons</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/students.png') }}">
                                </div>
                                <p>Personalized resource management dashboard</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/classes.png') }}">
                                </div>
                                <p>Technology is being used to improve coding teaching</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/price.png') }}">
                                </div>
                                <p>With parental supervision, children are supervised and tutored</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/on-off-classes.png') }}">
                                </div>
                                <p>Offline tutoring is still difficult to find</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/assured.png') }}">
                                </div>
                                <p>Online tutoring helps you save time and money</p>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="interested-form">
                                <a href="#">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!-- footer-start -->
    <div class="footernew">
        <img itemprop="logo" class="none cl-ps" src="{{ asset('landing/img/logo.png') }}">
        <div class="footerMarginWidth">
            <div class="footerNSocial clearfix">
                <ul class="footermenuhori floatLeft">
                    <li>
                      <a href="javascript:">About knowmerit.com </a>
                    </li>
                    <li>
                      <a href="javascript:">Who are we?</a>
                    </li>
                    <li>
                      <a href="javascript:">Our Commitment</a>
                    </li>
                    <li>
                      <a href="javascript:">Terms &amp; Conditions</a>
                    </li>
                     <li>
                      <a href="javascript:">Privacy Policy</a>
                    </li>
                    <li>
                      <a href="javascript:">Need Help?</a>
                    </li>
                     <li>
                      <a href="javascript:">Refund Policy</a>
                    </li>
                    <li>
                      <a href="javascript:">About Us</a>
                    </li>
                    <li>
                      <a href="javascript:">FAQ</a>
                    </li>
                    <li>
                      <a href="javascript:">Community</a>
                    </li>
                    <li>
                      <a href="javascript:">Contacts Us</a>
                    </li>
          
                  </ul>
          
                  <ul class="footer-social">
          
          
                    
                    <li>
                      <a href="https://www.instagram.com/knowmerit_education/" target="_blank" rel="noreferrer" aria-label="Twitter">
                        <i class="fa fa-instagram" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.facebook.com/knowmerity" target="_blank" rel="noreferrer" aria-label="Twitter">
                        <i class="fa fa-facebook" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://twitter.com/KnowMerit" target="_blank" rel="noreferrer" aria-label="Twitter">
                        <i class="fa fa-twitter" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
                      </a>
                    </li>
                   
                   <!--  <li>
                      <a href="https://knowmerit.livejournal.com/profile" target="_blank" rel="noreferrer" aria-label="Twitter">
                        <img src="assets/img/my-img/R.png" width="30px">
                      </a>
                    </li>
                    <li>
                      <a href="https://www.minds.com/knowmerit/about" target="_blank" rel="noreferrer" aria-label="Twitter">
                       <img src="assets/img/my-img/bulb.svg" width="20px">
                      </a>
                    </li> -->
                  </ul>
            </div>
            <ul class="footermenuhori hideForListingBlock">
                <li>
                    <a href="#">Bangalore</a>
                </li>
                <li>
                    <a href="#">Chennai</a>
                </li>
                <li>
                    <a href="#">Delhi</a>
                </li>
                <li>
                    <a href="#">Hyderabad</a>
                </li>
                <li>
                    <a href="#">Mumbai</a>
                </li>
                <li>
                    <a href="#">Pune</a>
                </li>
                <li>
                    <a href="#">Kolkata</a>
                </li>
                <li>
                    <a href="#">Gurgaon</a>
                </li>
                <li>
                    <a href="#">Ahmedabad</a>
                </li>
                <li>
                    <a href="#">Noida</a>
                </li>
            </ul>
            <ul class="footermenuhori hideForListingBlock">
                <li>
                    <a href="#">Canada</a>
                </li>
                <li>
                    <a href="#">USA</a>
                </li>
                <li>
                    <a href="#">UAE</a>
                </li>
                <li>
                    <a href="#">Australia</a>
                </li>
            </ul>
            <p class="footerUpTxt hideForListingBlock " style="color: #fff;">KnowMerit is your premier destination for
                online tutoring services, offering expert live 1-on-1 learning for K-12 students across all subjects.
                Our dedicated team of experienced tutors employs a personalized approach and cutting-edge technology to
                cultivate an optimal learning environment for students to excel academically.</p>
            <div class="footer-copyright" style="color: #fff;">© 2023 All Rights Reserved</div>
        </div>
    </div>
    {{-- @push('script') --}}
    <script src="{{ asset('landing/js/jquery-3.2.0.min.js') }}"></script>
    <script src="{{ asset('landing/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('landing/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing/js/jquery.nivo.slider.pack.js') }}"></script>
    <script src="{{ asset('landing/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('landing/js/countdown.js') }}"></script>
    <script src="{{ asset('landing/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('landing/js/jquery.meanmenu.js') }}"></script>
    <script src="{{ asset('landing/js/jquery.scrollUp.js') }}"></script>
    <script src="{{ asset('landing/js/jquery.mixitup.min.js') }}"></script>
    <script src="{{ asset('landing/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing/js/theme.js') }}"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).on('submit', 'form#createFrm1', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
            $('.form-control').addClass('disabled-link');
            $('.error-control').addClass('disabled-link');
            if ($('.submit').html() !== loadingText) {
                $('.submit').html(loadingText);
            }
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Book Now');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success(
                            "Thank you for choosing KnowMerit. We will contact you shortly.y");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" + "/coding";
                        }, 2000);

                    }
                    //show the form validates error
                    if (response.success == false) {
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                            // $('#error-'+error_text).html(response.errors[error_text][0]);
                            // console.log('#error-'+error_text);
                        }
                        // console.log(response.errors);
                    }
                },
                error: function(response) {
                    // alert("Error: " + errorThrown);
                    console.log(response);
                }
            });
            event.stopImmediatePropagation();
            return false;
        });
    </script>
    <script>
        $(document).on('submit', 'form#createFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
            $('.form-control').addClass('disabled-link');
            $('.error-control').addClass('disabled-link');
            if ($('.submit').html() !== loadingText) {
                $('.submit').html(loadingText);
            }
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Book Now');
                    }, 2000);
                    //console.log(response);
                    if (response.success == true) {

                        //notify
                        toastr.success(
                            "Thank you for choosing KnowMerit. We will contact you shortly.y");
                        // redirect to google after 5 seconds
                        window.setTimeout(function() {
                            window.location = "{{ url('/') }}" +
                                "/coding";
                        }, 2000);

                    }
                    //show the form validates error
                    if (response.success == false) {
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error1-' + error_text).html(response.errors[control]);
                            // $('#error-'+error_text).html(response.errors[error_text][0]);
                            // console.log('#error-'+error_text);
                        }
                        // console.log(response.errors);
                    }
                },
                error: function(response) {
                    // alert("Error: " + errorThrown);
                    console.log(response);
                }
            });
            event.stopImmediatePropagation();
            return false;
        });
    </script>

    <!-- footer-end -->
    <!-- Scripts -->

    {{-- @endpush --}}
</body>

</html>
