$(document).ready(function() {
    $('.slickCarousel').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 1,
        pauseOnHover: false,
        dots: false,
        arrows: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>',
        nextArrow:'<button type="button" class="slick-next"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>',
        autoplay: false
    });

    // FIRST SLIDE
    $('.firstCarousel').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 4,
        pauseOnHover: false,
        dots: false,
        centerMode: true,
        arrows: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
	    nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        autoplay: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // SECOND SLIDE
    $('.secondCarousel').slick({
        <?php if($gui->getDir()=="rtl"){ echo "rtl: true,"; } else { echo "rtl: false,"; };?>
        infinite: true,
        slidesToShow: 6,
        pauseOnHover: false,
        dots: false,
        centerMode: true,
        arrows: true,
        prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        nextArrow:'<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        autoplay: false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});