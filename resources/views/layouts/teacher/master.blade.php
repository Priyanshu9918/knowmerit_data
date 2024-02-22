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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet"> -->

   <!--  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->

</head>
  <body class="home-three">
  <div class="pre-loader" style="display: block;"></div>
    <div class="main-wrapper">
    @include('layouts.teacher.header')
    <div class="page-content instructor-page-content createteacher">
        <div class="container pb-4">
            <div class="row">
                @include('layouts.teacher.sidebar')

                @yield('content')

                </div>
            </div>
        </div>
        @include('layouts.teacher.footer')
        </div>
        @php
        $country = DB::table('countries')->get();
    @endphp
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="height:365px;">
                <div class="modal-header">
                    <h4 class="fw-bold">Select Country And TimeZone</h4>
                </div>
                <div class="modal-body" style="width: 100%">
                    <form action="{{ route('teacher.timezone.create') }}" method="POST" id="teacherFrm">
                        @csrf
                        <div class="container">
                            <label class="fw-bold">Country</label>
                            <select class="form-select country2" aria-label="Default select example" name="country2"
                                id="country_id2">
                                <option value="">Select country</option>
                                @if (count($country) > 0)
                                    @foreach ($country as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div class="container d-none" id="tiz2">
                            <label class="fw-bold">TimeZone</label>
                            <select class="form-select" aria-label="Default select example" name="timezone2"
                                id="timezone_id2">

                            </select>
                        </div>
                </div>
                <div class="modal-footer text-center">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @php
        $id = Auth::user()->id;
        $timezone = DB::table('users')
            ->where('id', $id)
            ->first();
        $time = $timezone->timezone;
    @endphp
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
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
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

  $(document).ready(function() {
        $('.pre-loader').hide();
    });

});

 $("#account-list").click(function(){
   $("#account-child").toggle();
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

bd.addEventListener("wheel", (evt) => {
    evt.preventDefault();
    scrollContainer.scrollLeft += evt.deltaY;
    scrollContainerv.scrollLeft -= evt.deltaY;
    scrollContainervv.scrollLeft += evt.deltaY;
});
</script>
<script type="text/javascript">
  var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
       // downscroll code
       $('nav').addClass('add-header-bg');
   } else {
      // upscroll code
       $('nav').removeClass('add-header-bg');
   }
   // lastScrollTop = st;
});
</script>

<script>
    ////////////timezone//////
    var date = "{{ $time }}";
    if (!date) {
        $(document).ready(function() {
            $("#exampleModalCenter").modal({
                show: false,
                backdrop: 'static'
            });
            $("#exampleModalCenter").modal("show");
        })
    }


    //submit
    $(document).on('change', '.country2', function() {
        var id = $('#country_id2').val();
        $.ajax({
            type: "post",
            url: "{{ route('timezone-list') }}",
            data: {
                'country_id': id,
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                $("#timezone_id2").empty();
                $("#timezone_id2").html('<option value="">Select Timezone</option>');
                $.each(data, function(key, value) {
                    $("#timezone_id2").append('<option value="' + value.id + '">' + value
                        .timezone + '</option>');
                });
                $('#tiz2').removeClass('d-none');
            }
        });
    });

    $(document).on('submit', 'form#teacherFrm', function(event) {
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
                    $('.submit').html('Save');
                }, 2000);
                //console.log(response);
                if (response.success == true) {
                    //notify

                    toastr.success("Timezone updated Successfully");

                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: 'TimeZone Updated Successfully',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    //     })
                    window.setTimeout(function() {
                        // window.location = "{{ url('/') }}" + "/student/my-classes";
                        location.reload();
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
    ///////timezone///////

</script>

<script type="text/javascript">
   //  $(document).ready(function() {
   //     $('#summernote').summernote();
   // });
    
        // ClassicEditor
        //     .create( document.querySelector( '#summernote' ) )
        //     .catch( error => {
        //         console.error( error );
        //     } );
   
</script>
    
@stack('script')
  </body>
</html>
