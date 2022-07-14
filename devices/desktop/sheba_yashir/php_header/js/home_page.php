$(document).ready(function() {
    $('.slickCarousel').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 1,
        pauseOnHover: false,
        dots: false,
        arrows: false,
        autoplay: false
    });

    // TOP RIGHT SLIDE
    $('.topRightSlide').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 2,
        pauseOnHover: false,
        dots: false,
        arrows: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	    nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        autoplay: false,
        responsive: [
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // TOP LEFT SLIDE
    $('.topLeftSlide').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 2,
        pauseOnHover: false,
        dots: false,
        arrows: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	    nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        autoplay: false,
        responsive: [
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // BOTTOM RIGHT SLIDE
    $('.bottomRightSlide').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 2,
        pauseOnHover: false,
        dots: false,
        arrows: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	    nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        autoplay: false,
        responsive: [
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // BOTTOM LEFT SLIDE
    $('.bottomLeftSlide').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 2,
        pauseOnHover: false,
        dots: false,
        arrows: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	    nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        autoplay: false,
        responsive: [
            {
                breakpoint: 1920,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});