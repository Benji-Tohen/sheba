<?php 
/*home page - shiba rashi - english has some differnet features - if this code changes - change also in php_process*/
$homePageEng = HOMEPAGEID;
if($homePageEng == '2374'){
    $isHomePageEng = true;
}else{
    $isHomePageEng = false;
}
?>
$(document).ready(function() {

 /*slick slider*/
     
     $('.doctors-slider').slick({
        infinite: false,
        arrows: true,
        initialSlide: $(".doctors-slider .item").length - 4,
        rtl: <?php if ($gui->getDir()=="rtl") { echo "false" ;} else {echo "true";} ?>,
        slidesToShow: 4,
        slidesToScroll: <?php echo ($gui->getDir()=="rtl") ? 1 : -1; ?>,
        prevArrow:'<button type="button" class="slick-prev galleryArrowLeft"><img src="site/images/arrowLeft.jpg" /></button>',
        nextArrow:'<button type="button" class="slick-next galleryArrowRight"><img src="site/images/arrowRight.jpg" /></button>',
        autoplay: true,
        autoplaySpeed: 10000,
        pauseOnHover: true,
        slickPause: true,
        responsive: [
            {
              breakpoint: 1920,
              settings: {
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: <?php echo ($gui->getDir()=="rtl") ? 1 : -1; ?>,
                initialSlide: $(".doctors-slider .item").length - 4,
                rtl: <?php if ($gui->getDir()=="rtl") { echo "false" ;} else {echo "true";} ?>,
              }
            },
            {
              breakpoint: 1200,
              settings: {
                infinite: false,
                slidesToShow: 2,
                slidesToScroll: <?php echo ($gui->getDir()=="rtl") ? 1 : -1; ?>,
                initialSlide: $(".doctors-slider .slick-slide").length - 2,
                rtl: <?php if ($gui->getDir()=="rtl") { echo "false" ;} else {echo "true";} ?>,
              }
            },
            {
              breakpoint: 768,
              settings: {
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: <?php echo ($gui->getDir()=="rtl") ? 1 : -1; ?>,
                initialSlide: $(".doctors-slider .slick-slide").length - 1,
                rtl: <?php if ($gui->getDir()=="rtl") { echo "false" ;} else {echo "true";} ?>,
              }
            }
          ]
      });
      
    <?php if ($gui->getDir()=="rtl") { ?>
    // this is due to a BUG in slick carousel that when its from right to left, it doesnt trigger
    // the correct prev/next buttons
    $(".doctors-slider").slickSetOption("speed",0);
    $(".doctors-slider").slickGoTo($(".doctors-slider .slick-slide").length - $(".slick-active").length);
    $(".doctors-slider").slickSetOption("speed",300);
    <?php } ?>














    window.setTimeout(switchGallery, 6000);

    /*slick slider*/

     $('.events-slider').slick({
        infinite: true,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        rtl: true,
        prevArrow:'<button type="button" class="slick-prev galleryArrowLeft"><img src="site/images/arrowLeft.jpg" /></button>',
        nextArrow:'<button type="button" class="slick-next galleryArrowRight"><img src="site/images/arrowRight.jpg" /></button>',
        autoplay: true,
        autoplaySpeed: 10000,
        pauseOnHover: true,
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




    /* Using default configuration */



    
    /* Using custom configuration */
    $('#carousel2').carouFredSel({
        infinite: true,
        width: '100%',
        height: 'auto',
        direction  : "<?php echo $gui->getLeft();?>",
        responsive: false,
        mousewheel: true,
        align: "center",
        items: {
            width: 250,
            visible: {
                min: 1,
                max: 3
            }
        },
        swipe       : {
            onTouch    : true,
            onMouse    : true,
        },
        scroll      : {
            duration        : 1000,
        },
        auto        : {
            duration        : 1000,
            timeoutDuration : 90000,     //  5 * auto.duration

        },
        prev:{button:"#prevItem2"}, 
        next:{button:"#nextItem2"}    
    });



$('.row_slick_gallery').slick({
        rtl:true,
        dots: false,
        infinite: true,
        responsive:true,
        speed: 500,
        fade: true,
        autoplay:true,
        autoplaySpeed:30000,
        nextText:'',
        prevText:'',
        cssEase: 'linear'
  });


});
function switchGallery(){
    if($("#smGalleryImg1").hasClass("imgActive")){
        $("#smGalleryImg1").removeClass("imgActive");
        $("#smGalleryImg2").addClass("imgActive");
        $("#smallGalleryInfo1").css("display","none");
        $("#smallGalleryInfo2").css("display","block");
    }else{
        if($("#smGalleryImg2").hasClass("imgActive")){
            $("#smGalleryImg2").removeClass("imgActive");
            $("#smGalleryImg3").addClass("imgActive");
            $("#smallGalleryInfo2").css("display","none");
            $("#smallGalleryInfo3").css("display","block");
        }else{
            if($("#smGalleryImg3").hasClass("imgActive")){
                $("#smGalleryImg3").removeClass("imgActive");
                $("#smGalleryImg4").addClass("imgActive");
                $("#smallGalleryInfo3").css("display","none");
                $("#smallGalleryInfo4").css("display","block");
            }else{
                if($("#smGalleryImg4").hasClass("imgActive")){
                    $("#smGalleryImg4").removeClass("imgActive");
                    $("#smGalleryImg1").addClass("imgActive");
                    $("#smallGalleryInfo4").css("display","none");
                    $("#smallGalleryInfo1").css("display","block");
                }
            }
        }
    }
setTimeout(function(){
switchGallery();},6000);
}
