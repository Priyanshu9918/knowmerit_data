<div class="whiteSlantBg"></div>
<div class="footernew">
	<img itemprop="logo" class="none cl-ps" src="{{asset('assets/img/logo/logo.png')}}" >
  <div class="footerMarginWidth">
    <div class="footerNSocial clearfix">
        @php
        $footerdash = DB::table('footers')->where('status', 1)->where('id',1)->first();
        $whereareyou = DB::table('footers')->where('status', 1)->where('id',2)->first();
        $ourcommitment = DB::table('footers')->where('status', 1)->where('id',3)->first();
        $termsconditions = DB::table('footers')->where('status', 1)->where('id',4)->first();
        $privacy = DB::table('footers')->where('status', 1)->where('id',5)->first();
        $needhelp = DB::table('footers')->where('status', 1)->where('id',6)->first();
        $refundpolicy = DB::table('footers')->where('status', 1)->where('id',7)->first();
        $aboutus = DB::table('footers')->where('status', 1)->where('id',8)->first();
        $faq = DB::table('footers')->where('status', 1)->where('id',9)->first();
        $community = DB::table('footers')->where('status', 1)->where('id',10)->first();
        $contact = DB::table('footers')->where('status', 1)->where('id',11)->first();

        $Bangalore = DB::table('footers')->where('status', 1)->where('id',12)->first();
        $Chennai = DB::table('footers')->where('status', 1)->where('id',13)->first();
        $Delhi = DB::table('footers')->where('status', 1)->where('id',14)->first();
        $Hyderabad = DB::table('footers')->where('status', 1)->where('id',15)->first();
        $Mumbai = DB::table('footers')->where('status', 1)->where('id',16)->first();
        $Pune = DB::table('footers')->where('status', 1)->where('id',17)->first();
        $Kolkata = DB::table('footers')->where('status', 1)->where('id',18)->first();
        $Gurgaon = DB::table('footers')->where('status', 1)->where('id',19)->first();
        $Ahmedabad = DB::table('footers')->where('status', 1)->where('id',20)->first();
        $Noida = DB::table('footers')->where('status', 1)->where('id',21)->first();

        $Canada = DB::table('footers')->where('status', 1)->where('id',22)->first();
        $USA = DB::table('footers')->where('status', 1)->where('id',23)->first();
        $UAE = DB::table('footers')->where('status', 1)->where('id',24)->first();
        $Australia = DB::table('footers')->where('status', 1)->where('id',25)->first();

        $texttitle = DB::table('footers')->where('status', 1)->where('id',26)->first();
        $copy = DB::table('footers')->where('status', 1)->where('id',27)->first();
    @endphp
      <ul class="footermenuhori floatLeft">
        <li>
          <a href="{{url('/')}}">{{ $footerdash->title ?? '' }} </a>
        </li>
        <li>
          <a href="{{url('who-are-we')}}">{{ $whereareyou->title ?? ''}}</a>
        </li>
        <li>
          <a href="{{url('our-commitment')}}">{{ $ourcommitment->title ?? ''}}</a>
        </li>
        <li>
          <a href="{{url('terms-and-conditions')}}">{{ $termsconditions->title ?? ''}}</a>
        </li>
         <li>
          <a href="{{url('privacy-policy')}}">{{ $privacy->title ?? ''}}</a>
        </li>
        <li>
          <a href="{{url('need-help')}}">{{ $needhelp->title ?? ''}}</a>
        </li>
         <li>
          <a href="{{url('refund-policy')}}">{{ $refundpolicy->title ?? ''}}</a>
        </li>
        <li>
          <a href="{{url('about-us')}}">{{ $aboutus->title ?? '' }}</a>
        </li>
        <li>
          <a href="{{url('faq')}}">{{ $faq->title ?? ''}}</a>
        </li>
        <li>
          <a href="{{url('community')}}">{{ $community->title ?? ''}}</a>
        </li>
        <li>
          <a href="{{url('contact-us')}}">{{ $contact->title ?? ''}}</a>
        </li>

      </ul>

      <ul class="footer-social">


        <li>
          <a href="https://in.linkedin.com/company/knowmerit" target="_blank" rel="noreferrer" aria-label="Facebook">
            <i class="fa fa-linkedin-square" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
          </a>
        </li>
        <li>
          <a href="https://www.youtube.com/channel/UCpFtWRari3irhNb1yzCjrLg#:~:text=Our%20channel%20is%20dedicated%20to,%2C%20social%20studies%2C%20and%20more." target="_blank" rel="noreferrer" aria-label="Twitter">
            <i class="fa fa-youtube-play" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
          </a>
        </li>
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
        <li>
          <a href="https://www.tumblr.com/knowmerit" target="_blank" rel="noreferrer" aria-label="Twitter">
            <i class="fa fa-tumblr" aria-hidden="true" style="font-size: 28px;color: #fff;"></i>
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
        <a href="#">{{$Bangalore->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Chennai->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Delhi->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Hyderabad->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Mumbai->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Pune->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Kolkata->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Gurgaon->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Ahmedabad->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Noida->title ?? ''}}</a>
      </li>
    </ul>
    <ul class="footermenuhori hideForListingBlock">
      <li>
        <a href="#">{{$Canada->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$USA->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$UAE->title ?? ''}}</a>
      </li>
      <li>
        <a href="#">{{$Australia->title ?? ''}}</a>
      </li>
    </ul>
    <p class="footerUpTxt hideForListingBlock " style="color: #fff;">{{$texttitle->title ?? ''}}</p>
    <div class="footer-copyright" style="color: #fff;">{{$copy->title ?? ''}}</div>
  </div>
</div>
<!-- <footer class="footer footer-three"><div class="footer-three-top aos-init aos-animate" data-aos="fade-up"><div class="container"><div class="footer-three-top-content"><div class="row align-items-center"><div class="col-lg-6 col-md-6 col-12"><div class="footer-widget-three footer-about"><div class="footer-three-logo"><img class="img-fluid" src="assets/img/logo/logo.png" alt="logo"></div><div class="footer-three-about"><p>KnowMerit is your premier destination for online tutoring services, offering expert live 1-on-1 learning  for K-12 students across all subjects. Our dedicated team of experienced tutors employs a personalized approach and cutting-edge technology to cultivate an optimal learning environment for students to excel academically.</p></div><div class="newsletter-title"><h6>Get Updates</h6></div><div class="box-form-newsletter"><form class="form-newsletter"><input class="input-newsletter" type="text" placeholder="Enter your email here"><button class="btn btn-default font-heading icon-send-letter">Subscribe Now</button></form></div></div></div><div class="col-lg-3 col-md-3 col-12"><div class="footer-widget-three footer-menu-three footer-three-right"><h6 class="footer-three-title">Useful Link</h6><ul><li><a href="{{url('who-are-we')}}">Who are we?</a></li><li><a href="{{url('our-commitment')}}">Our commitment</a></li><li><a href="{{url('terms-and-conditions')}}">Terms & Conditions</a></li><li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li><li><a href="{{url('need-help')}}">Need help?</a></li></ul></div></div><div class="col-lg-3 col-md-3 col-12"><div class="footer-widget-three footer-menu-three"><h6 class="footer-three-title">Company</h6><ul><li><a href="{{url('refund-policy')}}">Refund Policy</a></li><li><a href="{{url('about-us')}}">About Us</a></li><li><a href="{{url('faq')}}">FAQ</a></li><li><a href="{{url('community')}}">Community</a></li><li><a href="{{url('contact-us')}}">Contact Us</a></li></ul></div></div></div></div></div></div><div class="footer-three-bottom aos-init aos-animate" data-aos="fade-up"><div class="container"><div class="copyright-three"><div class="row"><div class="col-md-12"><div class="social-icon-three"><h6>Connect Socially</h6><ul><li><a href="https://in.linkedin.com/company/knowmerit" target="_blank" class="feather-linkedin-icon"><i class="feather-linkedin"></i></a></li><li><a href="https://www.youtube.com/channel/UCpFtWRari3irhNb1yzCjrLg#:~:text=Our%20channel%20is%20dedicated%20to,%2C%20social%20studies%2C%20and%20more." target="_blank" class="feather-youtube-icon"><i class="feather-youtube"></i></a></li></ul></div><div class="privacy-policy-three"><ul><li><a href="term-condition.html">Terms &amp; Condition</a></li><li><a href="privacy-policy.html">Privacy Policy</a></li><li><a href="support.html">Contact Us</a></li></ul></div><div class="copyright-text-three"><p class="mb-0">© 2023 KnowMerit. All rights reserved.</p></div></div></div></div></div></div></footer> -->
<!--   <footer class="footer footer-five"><div class="footer-top-five"><div class="container"><div class="footer-five-left"><img src="{{asset('assets/img/bg/footer-left.svg')}}" alt=""></div><div class="row"><div class="col-xl-4 col-lg-6 col-md-6 col-sm-12"><div class="footer-contact footer-menu-five"><h2 class="footer-title footer-title-five">About</h2><div class="footer-contact-info"><div class="footer-address"><p>KnowMerit is your premier destination for online tutoring services, offering expert live 1-on-1 learning  for K-12 students across all subjects. Our dedicated team of experienced tutors employs a personalized approach and cutting-edge technology to cultivate an optimal learning environment for students to excel academically.</p></div></div></div></div><div class="col-lg-2 col-md-3 col-sm-12"><div class="footer-menu footer-menu-five"><h2 class="footer-title footer-title-five"><i class="fa-sharp fa-solid fa-dash"></i>Useful Link</h2><ul><li><a href="{{url('who-are-we')}}">Who are we?</a></li><li><a href="{{url('our-commitment')}}">Our commitment</a></li><li><a href="{{url('terms-and-conditions')}}">Terms & Conditions</a></li><li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li><li><a href="{{url('need-help')}}">Need help?</a></li></ul></div></div><div class="col-lg-2 col-md-3 col-sm-12"><div class="footer-menu footer-menu-five"><h2 class="footer-title footer-title-five">Company</h2><ul><li><a href="{{url('refund-policy')}}">Refund Policy</a></li><li><a href="{{url('about-us')}}">About Us</a></li><li><a href="{{url('faq')}}">FAQ</a></li><li><a href="{{url('community')}}">Community</a></li><li><a href="{{url('contact-us')}}">Contact Us</a></li></ul></div></div><div class="col-lg-4 col-md-6 col-sm-6 col-12"><h2 class="footer-title footer-title-five">Stay in the Loop with "KnowMerit Newstrack"! </h2><div class="footer-about-five"><p>Don't miss out on the latest updates, exciting events, and key dates that can supercharge your calendar! The "KnowMerit Newstrack" newsletter is your ticket to staying informed and ahead of the curve.</p><p style="margin-bottom: 10px">Ready to be in the know? Drop your email address below, and we'll ensure you never miss a beat. Join our vibrant community of learners today!</p></div><div class="footer-widget-five"><div class="footer-news-five"><form><div class="form-group mb-0"><input type="email" class="form-control" placeholder="Enter Your Email Address"><button type="submit" class="btn btn-one">Subscribe</button></div></form></div><div class="footer-about-five" style="margin-top: -17px;"><p>Let's embark on a journey of knowledge, together!</p></div></div></div></div><div class="footer-five-right"><img src="{{asset('assets/img/bg/footer-right.svg')}}" alt=""></div></div></div></footer><div class="footer-bottom footer-bottom-five"><div class="container"><div class="copyright-five"><div class="row align-items-center"><div class="col-md-4"><div class="footer-logo-five"><a href="#"><img src="{{asset('assets/img/logo/logo.png')}}" class="img-fluid" alt="Footer Logo"></a></div></div><div class="col-md-4"><div class="copyright-text"><p>© 2023 KnowMerit. All rights reserved.</p></div></div><div class="col-md-4"><div class="social-icon-five"><ul class="nav"><li><a href="https://in.linkedin.com/company/knowmerit" target="_blank" class="linked-icon"><i class="fab fa-linkedin-in"></i></a></li><li><a href="https://www.youtube.com/channel/UCpFtWRari3irhNb1yzCjrLg#:~:text=Our%20channel%20is%20dedicated%20to,%2C%20social%20studies%2C%20and%20more." target="_blank" class="youtube-icon"><i class="fab fa-youtube"></i></a></li></ul></div></div></div></div></div></div> -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date();
  (function() {
    var s1 = document.createElement("script"),
      s0 = document.getElementsByTagName("script")[0];
    s1.async = true;
    s1.src = 'https://embed.tawk.to/650ee7800f2b18434fda2760/1hb13gjve';
    s1.charset = 'UTF-8';
    s1.setAttribute('crossorigin', '*');
    s0.parentNode.insertBefore(s1, s0);
  })();
</script>
<!--End of Tawk.to Script-->
