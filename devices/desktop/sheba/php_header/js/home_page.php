<?php 
/*home page - shiba rashi - english has some differnet features - if this code changes - change also in php_process*/
$homePageEng = HOMEPAGEID;
if($homePageEng == '2374'){
    $isHomePageEng = true;
}else{
    $isHomePageEng = false;
}

$dynamicSliderInterval  = $wm->getDynamicFieldsByPageType($wmPage["ID"],$wmPage['Type']['ID'],1);
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
            speed: 500,
            arrows: false,
            fade: true,
            autoplay:<?php echo $mainSliderEnabled;?>,
            autoplaySpeed:<?php echo $mainSliderInterval;?>,
            adaptiveHeight: true,
            nextText:'',
            prevText:'',
            cssEase: 'linear'
    });
});
