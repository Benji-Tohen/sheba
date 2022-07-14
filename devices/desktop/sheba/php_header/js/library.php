<?php  
/*because ella is secondary homepage - it gets its dinamic field values from home page type id = 5*/ 
$homePageTypeID = 5;
$mainSliderInterval=0;
$dynamicSliderInterval  = $wm->getDynamicFieldsByPageType($wmPage["ID"],$homePageTypeID,1);
$mainSliderInterval = ($dynamicSliderInterval[0]["Value"]) ? $dynamicSliderInterval[0]["Value"] : $params->getValue('slider_interval_default');
$mainSliderEnabled = ($mainSliderInterval == 0) ? 'false' : 'true';
$mainSliderInterval = $mainSliderInterval*1000;
?>

function loadMoreUpdates(numOfItems) {
    var limit = numOfItems;
    var start = $('#updatesFeed').children().length;
    var pageid = $('#updatesFeed').attr('pageid');

    $.ajax({
        method: "POST",
        url: "ajax/library_updates",
        data: { 
            pageid: pageid,
            start: start,
            limit: limit
        }
    }).done(function( data ) {
        var jsonResponse = JSON.parse(data);
        createItemsFromResponse(jsonResponse);

        if(jsonResponse.total_items <= $('#updatesFeed').children().length){
            $('#loadMoreUpdatesBtn').hide();
        }
    });
}

function createItemsFromResponse(jsonResponse) {
    if(jsonResponse.items > 0){
        jsonResponse.data.forEach(appendNewUpdateItem);
    } else {
        $('#loadMoreUpdatesBtn').hide();
    }
}

function appendNewUpdateItem(itemData) {
    var itemElem = $('<div>', { 
        'class': 'updates-item'
    });
    var itemLinkElem = $('<a>', { 
        'class': 'updates-item-title',
        'href': itemData.url,
        'target': itemData.target
    });
    var itemDateElem = $('<div>', { 
        'class': 'updates-item-date'
    });
    /* Append title to link */
    itemLinkElem.append(itemData.title);
    /* Append date to date elem */
    itemDateElem.append(itemData.date);
    /* Append date to link */
    itemLinkElem.append(itemDateElem);
    /* Append link to item */
    itemElem.append(itemLinkElem);
    /* Append item to feed */
    $('#updatesFeed').append(itemElem);
}

$(document).ready(function() {
    loadMoreUpdates(10);

    window.setTimeout(switchGallery, 4000);

    /*slick slider*/

     $('.events-slider').slick({
        infinite: true,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        rtl: false,
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


$('.row_slick_gallery').slick({
        rtl:true,
        dots: false,
        infinite: true,
        responsive:true,
        speed: 500,
        fade: true,
        autoplay:<?php echo $mainSliderEnabled;?>,
        autoplaySpeed:<?php echo $mainSliderInterval;?>,
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