<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Know Merit</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/swiper/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/aos/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet"/>
    <link href=" https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css " rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">




</head>
  <body class="home-three">
    <div class="main-wrapper">
    @include('layouts.front.header')

    @yield('content')

    @include('layouts.front.footer')
    </div>
  <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/plugins/aos/aos.js')}}"></script>
    <script src="{{asset('assets/js/jquery.waypoints.js')}}"></script>
    <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/slick/slick.js')}}"></script>
    <script src="{{asset('assets/plugins/swiper/js/swiper.min.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/gsap-latest-beta.min.js?r=5426'></script>
    <script src='https://assets.codepen.io/16327/ScrollTrigger.min.js?v=3.8.0c'></script>
    <script>
      gsap.registerPlugin(ScrollTrigger);

      let sections1 = gsap.utils.toArray(".panel1");
      let sections2 = gsap.utils.toArray(".panel2");
      let sections3 = gsap.utils.toArray(".panel3");
      let sections4 = gsap.utils.toArray(".panel4");

      let scrollTween = gsap.to(sections1, {
          xPercent: -100 * (sections1.length - 6),
          ease: "none", // <-- IMPORTANT!
          scrollTrigger: {
            trigger: ".contain_ds1",

            pin: true,
            scrub: 1,
            //snap: directionalSnap(1 / (sections.length - 1)),
            end: "+=100000"
          }
        });
      let scrollTween2 = gsap.to(sections2, {
          xPercent: 100 * (sections2.length - 6),
          ease: "none", // <-- IMPORTANT!
          scrollTrigger: {
            trigger: ".contain_ds1",
            pin: true,
            scrub: 1,
            //snap: directionalSnap(1 / (sections.length - 1)),
            end: "+=100000"
          }
        });
      let scrollTween3 = gsap.to(sections3, {
          xPercent: -100 * (sections3.length - 6),
          ease: "none", // <-- IMPORTANT!
          scrollTrigger: {
            trigger: ".contain_ds1",
            pin: true,
            scrub: 1,
            //snap: directionalSnap(1 / (sections.length - 1)),
            end: "+=100000"
          }
        });
      let scrollTween4 = gsap.to(sections4, {
          xPercent: 100 * (sections2.length - 6),
          ease: "none", // <-- IMPORTANT!
          scrollTrigger: {
            trigger: ".contain_ds1",
            pin: true,
            scrub: 1,
            //snap: directionalSnap(1 / (sections.length - 1)),
            end: "+=100000"
          }
        });

      // making the code pretty/formatted.
      PR.prettyPrint();
    </script>
    <script>


    function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
    }
    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    }
    </script>
    <!-- <script type="text/javascript">
    // The End Of Year Date To Countdown To
    let countDownDate = new Date("Dec 31, 2023 23:59:59").getTime();
    let counter = setInterval(() => {
    // Get Date Now
    let dateNow = new Date().getTime();
    // Find The Difference Between The Time Now And The Countdown Date
    let dateDiff = countDownDate - dateNow;
    let days = Math.floor(dateDiff / (1000 * 60 * 60 * 24));
    let hours = Math.floor((dateDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((dateDiff % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((dateDiff % (1000 * 60)) / 1000);
    document.querySelector(".days").innerHTML =
    days < 100 && days > 10 ? `0${days}` : days < 10 ? `00${days}` : days;
    document.querySelector(".hours").innerHTML = hours < 10 ? `0${hours}` : hours;
    document.querySelector(".minutes").innerHTML =
    minutes < 10 ? `0${minutes}` : minutes;
    document.querySelector(".seconds").innerHTML =
    seconds < 10 ? `0${seconds}` : seconds;
    if (dateDiff <= 0) {
    clearInterval(counter);
    }
    }, 1000);
    </script> -->
    <script>
$(document).ready(function(){
  $(".avai").click(function(){
    $(".table-v").toggle();
  });
});
</script>
    <script>
      (function() {

  var parent = document.querySelector(".range-slider");
  if(!parent) return;

  var
    rangeS = parent.querySelectorAll("input[type=range]"),
    numberS = parent.querySelectorAll("input[type=number]");

  rangeS.forEach(function(el) {
    el.oninput = function() {
      var slide1 = parseFloat(rangeS[0].value),
          slide2 = parseFloat(rangeS[1].value);

      if (slide1 > slide2) {
        [slide1, slide2] = [slide2, slide1];
        // var tmp = slide2;
        // slide2 = slide1;
        // slide1 = tmp;
      }

      numberS[0].value = slide1;
      numberS[1].value = slide2;
    }
  });

  numberS.forEach(function(el) {
    el.oninput = function() {
      var number1 = parseFloat(numberS[0].value),
          number2 = parseFloat(numberS[1].value);

      if (number1 > number2) {
        var tmp = number1;
        numberS[0].value = number2;
        numberS[1].value = tmp;
      }

      rangeS[0].value = number1;
      rangeS[1].value = number2;

    }
  });

})();
    </script>
    <script>
$(document).ready(function(){
  $(".comment").click(function(){
    $(".addcomment").toggle();
  });
  $(".rep_view1").click(function(){
    $(".addcomment1").toggle();
  });
  $(".rep_view").click(function(){
    $(".addcomment12").toggle();
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
      function show1(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='block';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display = 'none';
}
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    </script>

<script type="text/javascript">
  const bd = document.querySelector("body");
  const scrollContainer = document.querySelector("main");
  const scrollContainerv = document.querySelector(".main2");
  const scrollContainervv = document.querySelector(".main3");

// bd.addEventListener("wheel", (evt) => {
//     evt.preventDefault();
//     scrollContainer.scrollLeft += evt.deltaY;
//     scrollContainerv.scrollLeft -= evt.deltaY;
//     scrollContainervv.scrollLeft += evt.deltaY;
// });
</script>
<!-- <script type="text/javascript">
  var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
       // downscroll code
       $('nav').addClass('add-header-bg');
   } else {
      // upscroll code
       // $('nav').removeClass('add-header-bg');
   }
   lastScrollTop = st;
});
</script> -->
@stack('script')
  </body>
</html>
