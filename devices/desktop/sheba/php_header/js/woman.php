<?php  
/*because woman is secondary homepage - it gets its dinamic field values from home page type id = 5*/ 
$homePageTypeID = 5;
$mainSliderInterval=0;
$dynamicSliderInterval  = $wm->getDynamicFieldsByPageType($wmPage["ID"],$homePageTypeID,1);
$mainSliderInterval = ($dynamicSliderInterval[0]["Value"]) ? $dynamicSliderInterval[0]["Value"] : $params->getValue('slider_interval_default');
$mainSliderEnabled = ($mainSliderInterval == 0) ? 'false' : 'true';
$mainSliderInterval = $mainSliderInterval*1000;
?>

$(document).ready(function() {
    var sumImg = $('.row_slick_gallery').attr('sum-img');
    $('.row_slick_gallery').slick({
        rtl:false,
        dots: (sumImg > 1) ? true : false,
        infinite: true,
        responsive:true,
        arrows: false,
        speed: 500,
        fade: true,
        autoplay:<?php echo $mainSliderEnabled;?>,
        autoplaySpeed:<?php echo $mainSliderInterval;?>,
        nextText:'',
        prevText:'',
        cssEase: 'linear'
    });
});