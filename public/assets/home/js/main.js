$(document).ready(function ($) {
    'use strict';


    /* ---------------------------------------------
         page  Prealoader
     --------------------------------------------- */
  $(window).on('load', function () {
        $("#loading-center-page").fadeOut();
        $("#loading-page").delay(300).fadeOut("fast");
    });

 
    /* ---------------------------------------------
        Sticky header
    --------------------------------------------- */
    $(window).on('scroll', function () {
        var scroll_top = $(window).scrollTop();

        if (scroll_top > 40) {
            $('.navbar').addClass('sticky');

        } else {
            $('.navbar').removeClass('sticky');
        }

    });

     /* ---------------------------------------------
        Slider Slick
    --------------------------------------------- */
 
 $('.slide-home').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  rtl:true,
  adaptiveHeight: true,
  cssEase: 'linear',
   prevArrow: "<button type='button' class='slick-prev color-blue pull-left'><i class='arrow_carrot-left ' aria-hidden='true'></i></button>",
   nextArrow: "<button type='button' class='slick-next color-blue pull-right'><i class='arrow_carrot-right' aria-hidden='true'></i></button>"
   
});


 $('.testimonial-slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  rtl:true,
  adaptiveHeight: true,
  cssEase: 'linear',
   prevArrow: "<button type='button' class='slick-prev color-blue pull-left'><i class='arrow_carrot-left ' aria-hidden='true'></i></button>",
   nextArrow: "<button type='button' class='slick-next color-blue pull-right'><i class='arrow_carrot-right' aria-hidden='true'></i></button>"
   
});


$('.client-slider').slick({
 dots: false,
 arrows: false,
 infinite: true,
 autoplay: true, 
 slidesToShow: 5,
 rtl:true,
 autoplaySpeed:3000,
 slidesToScroll: 5,
 centerMode: true,
 responsive: [
 {
  breakpoint: 1024,
  settings: {
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    
  }
},
{
  breakpoint: 600,
  settings: {
    slidesToShow: 2,
    slidesToScroll: 2
  }
},
{
  breakpoint: 480,
  settings: {
    slidesToShow: 2,
    slidesToScroll: 2
  }
}
]
});
    /* ---------------------------------------------
     Back top page scroll up
     --------------------------------------------- */


    $.scrollUp({
        scrollText: '<i class="arrow_carrot-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });


    /* ---------------------------------------------
     WoW plugin
     --------------------------------------------- */

    new WOW().init({
        mobile: true,
    });

    /* ---------------------------------------------
     Smooth scroll
     --------------------------------------------- */

    $('a.section-scroll[href*="#"]:not([href="#"])').on('click', function (event) {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') ||
            location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 750);
                return false;
            }
        }
    });



    /*----------------------------------------
     Newsletter Subscribe
     --------------------------------------*/

    $(".subscribe-mail").ajaxChimp({
        callback: mailchimpCallRep,
        url: "mailchimp-post-url" //Replace this with your own mailchimp post URL. Just paste the url inside "".
    });

    function mailchimpCallRep(resp) {
        if (resp.result === "success") {
            $(".sucess-message").html(resp.msg).fadeIn(1000);
            $(".error-message").fadeOut(500);
        } else if (resp.result === "error") {
            $(".error-message").html(resp.msg).fadeIn(1000);
        }
    }


      /*----------------------------------------------------*/
    /*  VIDEO POP PUP
    /*----------------------------------------------------*/



    $('.video-modal').magnificPopup({
      type: 'iframe',

      iframe: {
        patterns: {
          youtube: {

            index: 'youtube.com',
            src: 'https://www.youtube.com/embed/7e90gBu4pas'

          }
        }
      }
    });
 

  
 });