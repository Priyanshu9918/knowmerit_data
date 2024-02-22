<!DOCTYPE html>
<html lang="en">
  <head>
    <!--- Basic Page Needs  -->
    <meta charset="utf-8">
    <title>Knowmerit Science</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="online science classes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Specific Meta  -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/icofont.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/nivo-slider.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/meanmenu.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/typography.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('landing/css/responsive.css')}}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('landing/img/favicon.png')}}">

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
                <img src="{{asset('landing/img/logo.png')}}" alt="">
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
          <form class="well form-horizontal" action="{{ route('landing.sciencetwo') }}" method="POST" id="createFrm1">
              @csrf

                <!-- Text input-->
                <div class="form-group">
                  <div class="col-md-12 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-user"></i>
                      </span>
                      <input name="first_name" placeholder="Full Name" class="form-control" type="text">
                     
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
                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                    id="error-email"></p>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12 inputGroupContainer">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-earphone"></i>
                      </span>
                      <input name="phone" placeholder="Phone Number" class="form-control" type="number">
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
                      <input name="subject" placeholder="Subject, Grade / Year that you offer " class="form-control" type="text">
                    </div>
                    <p style="margin-bottom: 2px;" class="text-danger error_container"
                    id="error-subject"></p>
                  </div>
                </div>
                <div class="form-group text-center mar-top-30">
                 <button type="submit" class="btn btn-info submit">Book Now <span class="glyphicon glyphicon-send"></span>
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
    <section class="banner2">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-md-7 col-sm-12">
            <div class="banner-text">
             <h1>Fuel Your Curiosity:<br>

                  <span> KnowMerit's Online Science Classes <h1>Await Your Exploration</h1></span>

               </h1>

            </div>
          </div>

          <div class="col-md-5 col-md-5 col-sm-12">
            {{-- <form  action=" " method="post" id="contact_form"> --}}
            <form class="well form-horizontal" action="{{ route('landing.science') }}" method="POST" id="createFrm">
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
                                <input name="email" placeholder="Email" class="form-control" type="email">
                                
                            </div>
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-email">
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
                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error1-phone">
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
                                <input name="subject" placeholder="Grade"
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
                        <button type="submit" class="btn btn-info submit">Book Now<span
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
                <h2>KnowMerit's Science Learning Process</h2>

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
                        <h6>Choose chapters</h6>
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
                        <img  src="{{ asset('landing/img/test_1.png')}}">
                        <h6>Practice tests</h6>
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
              <p class="about-us1-text">Science provides the basis for practically everything we know about how and why humans exist. Whether you're looking for a new job or want to learn more about a particular topic of science, Know Merit has online scientific courses for everyone.</p>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="about1-banner">
              <img src="{{ asset('landing/img/sc12.png')}}" alt="">


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
                    <p>At KnowMerit, we believe that learning science should be an exciting journey of discovery for K-12 students. Science is more than just a subject; it's a gateway to understanding the world around us. </p>
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
                    <p>We at Know Merit offer interactive courses and expert guidance for young minds to turn their scientific curiosity into a lifelong passion. Courses cover various branches, anatomy, physiology, and cooking principles, offering a rewarding career path.</p>
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
                            <h2>KnowMerit’s Science Classes: Igniting Minds for Future Across the USA And Canada</h2>

                            <span class="home1-section-title-border"></span>
                            <p>Why Choose Know Merit for Science Learning?</p>
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
                          <p>Our learner-centric one-on-one approach allows students to explore science at their own pace, ensuring a deeper understanding of the subject. The instructor comprehends the child's learning style and enhances classroom performance through one-on-one tutoring, ensuring quality learning under parental supervision and discipline.</p>
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
                          <p>Our experienced and engaging instructors bring science to life, making it accessible and captivating for young learners. Their dedication and zeal for science drive them to teach with passion, thus helping the future with talented and insightful brains who can contribute to society at large.</p>
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
                          <p>We understand that each student is unique. Our customized learning approach adapts to individual preferences, fostering a love for science. KnowMerit offers customized learning based on a child's individual learning preferences and interests, analyzing their learning processes and adjusting the curriculum accordingly.</p>
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
                          <p>KnowMerit makes use of the power of interactive audiovisual techniques, integrating video lectures that are augmented by captivating animations. These interactive materials spark students' imaginations by making complex academic concepts understandable through real-world experiences.</p>
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
              <h2>Ignite Your Passion for Science</h2>
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

            <h2>KnowMerit Science Courses </h2>

            <span class="home1-section-title-border"></span>

         </div>

         <div class="col-lg-2 col-md-6 col-sm-6 floatleft">

            <div class="space-is">
               <div>
                  <img src="{{ asset('landing/img/subjects.png')}}" class="w-100" style=" width: 50px; margin-bottom: 5px;">
                  <p>Online science classes</p>
               </div>
            </div>

         </div>
         <div class="col-lg-2 col-md-6 col-sm-6 floatright">

            <div class="space-is">
               <div>
                  <img src="{{ asset('landing/img/assignments.png')}}" class="w-100" style=" width: 50px; margin-bottom: 5px;">
                  <p>Test preparation and assignments</p>
               </div>
            </div>

         </div>
         <div class="col-lg-2 col-md-6 col-sm-6 floatleft">

            <div class="space-is">
               <div>
                  <img src="{{ asset('landing/img/test.png')}}" class="w-100" style=" width: 50px; margin-bottom: 5px;">
                  <p>The flexibility to pause</p>
               </div>
            </div>

         </div>
         <div class="col-lg-2 col-md-6 col-sm-6 floatright">

            <div class="space-is">
               <div>
                  <img src="{{ asset('landing/img/exam.png')}}" class="w-100" style=" width: 50px; margin-bottom: 5px;">
                  <p>Home works</p>
               </div>
            </div>

         </div>
         <div class="col-lg-2 col-md-6 col-sm-6 floatleft">

            <div class="space-is">
               <div>
                  <img src="{{ asset('landing/img/homework.png')}}" class="w-100" style=" width: 50px; margin-bottom: 5px;">
                  <p>Practice Quizzes</p>
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
                <h2>Benefits of Joining Know Merit Science Classes</h2>
                <span class="home1-section-title-border"></span>
                </div>

                <div class="col-md-5 col-sm-12">
                   <div class="">
                        <img class="large-img" src="{{ asset('landing/img/s-e.jpg')}}">
                   </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/teacher.png')}}">
                                </div>
                                <p>Learning hours can be changed as needed</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/Flexibility-teaching.png')}}">
                                </div>
                                <p>The option of 1-on-1 or group lessons</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/students.png')}}">
                                </div>
                                <p>A personalized dashboard for resource management</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/classes.png')}}">
                                </div>
                                <p>Using technology to enhance scientific education</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/price.png')}}">
                                </div>
                                <p>Offline tutor search remains difficult</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/on-off-classes.png')}}">
                                </div>
                                <p>Online tutoring saves both time and money</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="benefits-child">
                                <div class="benefits-icon">
                                    <img src="{{ asset('landing/img/assured.png')}}">
                                </div>
                                <p>With parental supervision, children are supervised and tutored</p>
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
  <img itemprop="logo" class="none cl-ps" src="{{ asset('landing/img/logo.png')}}">
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


       <!--  <li>
          <a href="https://in.linkedin.com/company/knowmerit" target="_blank" rel="noreferrer" aria-label="Facebook">
            <i class="fa fa-linkedin-square" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
          </a>
        </li> -->
        <!-- <li>
          <a href="https://www.youtube.com/channel/UCpFtWRari3irhNb1yzCjrLg#:~:text=Our%20channel%20is%20dedicated%20to,%2C%20social%20studies%2C%20and%20more." target="_blank" rel="noreferrer" aria-label="Twitter">
            <i class="fa fa-youtube-play" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
          </a>
        </li> -->
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
        <!-- <li>
          <a href="https://www.tumblr.com/knowmerit" target="_blank" rel="noreferrer" aria-label="Twitter">
            <i class="fa fa-tumblr" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
          </a>
        </li> -->
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
    <p class="footerUpTxt hideForListingBlock " style="color: #fff;">KnowMerit is your premier destination for online tutoring services, offering expert live 1-on-1 learning for K-12 students across all subjects. Our dedicated team of experienced tutors employs a personalized approach and cutting-edge technology to cultivate an optimal learning environment for students to excel academically.</p>
    <div class="footer-copyright" style="color: #fff;">© 2023 All Rights Reserved</div>
  </div>
</div>
{{-- @push('script') --}}
<script src="{{ asset('landing/js/jquery-3.2.0.min.js')}}"></script>
<script src="{{ asset('landing/js/jquery-ui.js')}}"></script>
<script src="{{ asset('landing/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('landing/js/jquery.nivo.slider.pack.js')}}"></script>
<script src="{{ asset('landing/js/jquery.counterup.min.js')}}"></script>
<script src="{{ asset('landing/js/countdown.js')}}"></script>
<script src="{{ asset('landing/js/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('landing/js/jquery.meanmenu.js')}}"></script>
<script src="{{ asset('landing/js/jquery.scrollUp.js')}}"></script>
<script src="{{ asset('landing/js/jquery.mixitup.min.js')}}"></script>
<script src="{{ asset('landing/js/jquery.waypoints.min.js')}}"></script>
<script src="{{ asset('landing/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('landing/js/theme.js')}}"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                     toastr.success("Thank you for choosing KnowMerit. We will contact you shortly.y");
                     // redirect to google after 5 seconds
                     window.setTimeout(function() {
                         window.location = "{{ url('/') }}" + "/science";
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
                       toastr.success("Thank you for choosing KnowMerit. We will contact you shortly.y");
                       // redirect to google after 5 seconds
                       window.setTimeout(function() {
                           window.location = "{{ url('/') }}" +
                               "/science";
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






