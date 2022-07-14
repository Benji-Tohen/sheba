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
});