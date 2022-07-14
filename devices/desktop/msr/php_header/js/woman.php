$(document).ready(function() {
    window.setTimeout(switchGallery, 6000);

    /*slick slider*/

     $('.events-slider').slick({
        //infinite: true,
        //arrows: true,
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
});


$(document).ready(function() {
    window.setTimeout(switchGallery, 6000);

    /* Using default configuration */
    /*$('#carousel').carouFredSel();*/

    /* Using custom configuration */
    /*$('#carousel').carouFredSel({
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
        scroll : 1,
        prev:{button:"#prevItem"}, 
        next:{button:"#nextItem"}    
    });*/
    
    /* Using custom configuration */
   /* $('#carousel2').carouFredSel({
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
        scroll : 1,
        prev:{button:"#prevItem2"}, 
        next:{button:"#nextItem2"}    
    });
*/

/*
$('.row_slick_gallery').slick({
        rtl:true,
        
        dots: false,
        infinite: true,
        responsive:true,
        speed: 500,
        fade: true,
        autoplay:true,
        autoplaySpeed:6000,
        nextText:'',
        prevText:'',
        cssEase: 'linear'
  });

*/
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