// -----------------------------

//   js index
/* =================== */
/*




*/
// -----------------------------


(function($) {
    "use strict";



    /*---------------------
    preloader
    --------------------- */

    $(window).on('load', function() {
        $('#preloader').fadeOut('slow', function() { $(this).remove(); });
    });


    /*----------------------------
     jQuery MeanMenu
    ------------------------------ */
    $('nav#dropdown').meanmenu();

    /*-----------------
    meanmenu
    -----------------*/
    $('nav#mobile_menu_active').meanmenu({
        meanScreenWidth: "991",
        meanMenuContainer: '.mobile-menu-area .container',
    });

    /*-----------------
    sticky-home-1
    -----------------*/
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 117) {
            $('.menu-area').addClass('navbar-fixed-top');
        } else {
            $('.menu-area').removeClass('navbar-fixed-top');
        }
    });

    /*-----------------
    sticky-home-2
    -----------------*/
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 120) {
            $('.h2-header').addClass('navbar-fixed-top');
        } else {
            $('.h2-header').removeClass('navbar-fixed-top');
        }
    });

    /*-----------------
    scroll-up
    -----------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-arrow-up" aria-hidden="true"></i>',
        easingType: 'linear',
        scrollSpeed: 1500,
        animation: 'fade'
    });

    /*------------------------------
         counter
    ------------------------------ */
    $('.counter-up').counterUp();


    /*---------------------
    smooth scroll
    --------------------- */
    $('.smoothscroll').on('click', function(e) {
        e.preventDefault();
        var target = this.hash;

        $('html, body').stop().animate({
            'scrollTop': $(target).offset().top - 80
        }, 1200);
    });


    /*---------------------
    countdown
    --------------------- */
    $('[data-countdown]').each(function() {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
        });
    });

    /*-----------------------
    home 1 slider
    -----------------------*/
    $('#home1_slider').nivoSlider({
        directionNav: true,
        animSpeed: 2000,
        slices: 18,
        pauseTime: 5000,
        pauseOnHover: false,
        controlNav: false,
        prevText: '<i class="fa fa-arrow-left nivo-prev-icon"></i>',
        nextText: '<i class="fa fa-arrow-right nivo-next-icon"></i>'
    });

    /*-----------------------
    home 3 slider
    -----------------------*/
    $('#home3_slider').nivoSlider({
        directionNav: true,
        animSpeed: 2000,
        slices: 18,
        pauseTime: 50000000,
        pauseOnHover: false,
        controlNav: false,
        prevText: '<span>PIXEL PERFECT DESIGN</span><i class="fa fa-angle-left nivo-prev-icon"></i>',
        nextText: '<span>A LEGACY OF QUALITY</span><i class="fa fa-angle-right nivo-next-icon"></i>'
    });

    /*--------------------------
    project-mix
    ------------------------- */
    $('#project_mix').mixItUp();

    /*---------------------
    fancybox
    --------------------- */
    $('[data-fancybox]').fancybox({
        image: {
            protect: true
        }
    });



    /*---------------------
    h1-team-caousel
    --------------------- */
    function h1_team_caousel() {
        var owl = $(".h1-team-caousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
            nav: true,
            items: 3,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 40000000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 3
                }
            }
        });
    }
    h1_team_caousel();

    /*---------------------
    h1-testimonial-caousel
    --------------------- */
    function h1_testimonial_caousel() {
        var owl = $(".h1-testimonial-caousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 2,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 2
                }
            }
        });
    }
    h1_testimonial_caousel();

    /*---------------------
    brand-carousel
    --------------------- */
    function brand_carousel() {
        var owl = $(".brand-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 5,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 3
                },
                760: {
                    items: 3
                },
                1024: {
                    items: 5
                }
            }
        });
    }
    brand_carousel();


    /*---------------------
    h3-team-carousel
    --------------------- */
    function h3_team_carousell() {
        var owl = $(".h3-team-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 3,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                760: {
                    items: 2
                },
                1024: {
                    items: 3
                }
            }
        });
    }
    h3_team_carousell();


    /*---------------------
    client-feedback-carousel
    --------------------- */
    function client_feedback_carousel() {
        var owl = $(".client-feedback-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: true,
            items: 1,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 4000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 1
                },
                1024: {
                    items: 1
                }
            }
        });
    }
    client_feedback_carousel();


    /*---------------------
    h3-brand-carousel
    --------------------- */
    function h3_brand_carousel() {
        var owl = $(".h3-brand-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 4,
            smartSpeed: 2000,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                760: {
                    items: 3
                },
                1024: {
                    items: 4
                }
            }
        });
    }
    h3_brand_carousel();


    /*---------------------
    h4-brand-carousel
    --------------------- */
    function h4_brand_carousel() {
        var owl = $(".h4-brand-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 6,
            smartSpeed: 2000,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                760: {
                    items: 4
                },
                1024: {
                    items: 6
                }
            }
        });
    }
    h4_brand_carousel();


    /*---------------------
    h5-hc-carousel
    --------------------- */
    function h5_hc_carousel() {
        var owl = $(".h5-hc-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 1,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 6000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 1
                },
                1024: {
                    items: 1
                }
            }
        });
    }
    h5_hc_carousel();


    /*---------------------
    h5-sc-carousel
    --------------------- */
    function h5_sc_carousel() {
        var owl = $(".h5-sc-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 6,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 6000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 3
                },
                1024: {
                    items: 6
                }
            }
        });
    }
    h5_sc_carousel();


    /*---------------------
    h5-blog-carousel
    --------------------- */
    function h5_blog_carousel() {
        var owl = $(".h5-blog-carousel");
        owl.owlCarousel({
            loop: true,
            margin: 20,
            responsiveClass: true,
            navigation: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            nav: false,
            items: 2,
            smartSpeed: 2000,
            dots: true,
            autoplay: true,
            autoplayTimeout: 6000,
            center: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                760: {
                    items: 1
                },
                1024: {
                    items: 2
                }
            }
        });
    }
    h5_blog_carousel();


    /*------------------------------
        datepicker
    ------------------------------ */
    $("#datepicker").datepicker();


    /*---------------------
    // Ajax Contact Form
    --------------------- */

    $('.cf-msg').hide();
    $('form#cf input#submit').on('click', function() {
        var fname = $('#fname').val();
        var subject = $('#subject').val();
        var email = $('#email').val();
        var msg = $('#msg').val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!regex.test(email)) {
            alert('Please enter valid email');
            return false;
        }

        fname = $.trim(fname);
        subject = $.trim(subject);
        email = $.trim(email);
        msg = $.trim(msg);

        if (fname != '' && email != '' && msg != '') {
            var values = "fname=" + fname + "&subject=" + subject + "&email=" + email + " &msg=" + msg;
            $.ajax({
                type: "POST",
                url: "mail.php",
                data: values,
                success: function() {
                    $('#fname').val('');
                    $('#subject').val('');
                    $('#email').val('');
                    $('#msg').val('');

                    $('.cf-msg').fadeIn().html('<div class="alert alert-success"><strong>Success!</strong> Email has been sent successfully.</div>');
                    setTimeout(function() {
                        $('.cf-msg').fadeOut('slow');
                    }, 4000);
                }
            });
        } else {
            $('.cf-msg').fadeIn().html('<div class="alert alert-danger"><strong>Warning!</strong> Please fillup the informations correctly.</div>')
        }
        return false;
    });



    /*-----------------------
    hide-show-h3-menu
    -----------------------*/
    document.getElementById("h3_menu").style.display = 'none';
    $("#h3_menu_show").on('click', function() {
        $("#h3_menu").fadeToggle("slow");
    });



}(jQuery));;
