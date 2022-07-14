$(document).ready(function() {
    window.setTimeout(switchGallery, 4000);

    /*slick slider*/
    var sumItems =  $(".events-slider .item").length;
     $('.events-slider').slick({
        infinite: true,
        arrows: (sumItems > 1) ? true : false,
        slidesToShow: 3,
        slidesToScroll: 1,
        rtl: false,
        prevArrow:'<button type="button" class="slick-prev galleryArrowLeft"><i class="fas fa-chevron-left"></button>',
        nextArrow:'<button type="button" class="slick-next galleryArrowRight"><i class="fas fa-chevron-right"></i></button>',
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
    var sumItems =  $(".row_slick_gallery .item").length;
$('.row_slick_gallery').slick({
        rtl:true,
        arrows: (sumItems > 1) ? true : false,
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