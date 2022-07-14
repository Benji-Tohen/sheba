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
});
