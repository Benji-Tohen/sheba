<?php include_once($device.'/php_components/dynamic_form/form_js.php');?>
$(document).ready(function() {
  $('#field_of_activity').slick({
        infinite: true,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        rtl: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow:'<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        autoplay: false,
        slickPause: true,
        responsive: [
            {

              breakpoint: 1920,
              settings: {
                slidesToShow: 3,
                 infinite: true,
                slidesToScroll: 1,
              }
            },
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 2,
                 infinite: true,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                 infinite: true,
                slidesToScroll: 1
              }
            }
        ]
    });

    $('#doctors_slider').slick({
        infinite: true,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        rtl: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow:'<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        autoplay: false,
        slickPause: true,
        responsive: [
            {

              breakpoint: 1920,
              settings: {
                slidesToShow: 3,
                 infinite: true,
                slidesToScroll: 1,
              }
            },
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 2,
                 infinite: true,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 1,
                 infinite: true,
                slidesToScroll: 1
              }
            }
        ]
    });

    var sumImg = $('.row_slick_gallery').attr('sum-img');
    $('#inner_gallery').slick({
        infinite: true,
        arrows: true,
        dots: (sumImg > 1) ? true : false,
        slidesToShow: 1,
        slidesToScroll: 1,
        rtl: false,
        prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow:'<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        autoplay: false,
        slickPause: true,
        adaptiveHeight: true,
        responsive: [
            {
              breakpoint: 992,
              settings: {
                arrows: false,
              }
            }
        ]
    });
    /*countdown */
    // Set the date we're counting down to
    var countTo = document.getElementById("countdown").getAttribute("data-date");
    var countTo = document.getElementById("countdownm").getAttribute("data-date");

    if (countTo) {
    var countDownDate = new Date(countTo).getTime();
    // Update the count down every 1 second
      var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        days = days < 10 ? "0" + days: days;
        hours = hours < 10 ? "0" + hours: hours;
        minutes = minutes < 10 ? "0" + minutes: minutes;
        seconds = seconds < 10 ? "0" + seconds: seconds;

        // Display the result in the element with id="demo"
        document.getElementById("countdown").innerHTML = days + ":" + hours + ":"
        + minutes + ":" + seconds;
        document.getElementById("countdownm").innerHTML = days + ":" + hours + ":"
        + minutes + ":" + seconds;

        // If the count down is finished, write some text
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("countdown").innerHTML = "00:00:00";
          document.getElementById("countdownm").innerHTML = "00:00:00";

        }
    }, 1000);
    };
});
