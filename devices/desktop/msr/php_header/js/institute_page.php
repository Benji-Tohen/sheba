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



    /* Using default configuration 
    /*$('#carousel').carouFredSel();*/
     $('#showMoreText').click(function(){
        $(this).hide(1);
        $('#moreTextWrap').fadeIn(1000);
    });
    /* Using custom configuration 
    $('#carousel').carouFredSel({
        infinite: true,
        width: '100%',
        height: 'auto',
        direction  : "right",
        responsive: true,
        mousewheel: true,
        items: {
            width: 160,
            visible: {
                min: 2,
                max: 5
            }
        },
        swipe       : {
            onTouch    : true,
            onMouse    : true,
        },
        scroll : { items:1,duration: 1000},
        prev:{button:"#prevItem"}, 
        next:{button:"#nextItem"}    
    });
    
    if ($('#carousel')[0].children.length<=5) {
        $('#carousel')[0].style.width = "";         // fix for carousel in hebrew
    } else {
        $('#carousel')[0].style.right = "";         // fix for carousel in hebrew
    }
    */
});

<?php
if($wmPage["wm_forms"]){
	require_once(dirname(__FILE__)."/../../../../../site/php_components/form.php");

?>
function checkForm(){
<?php echo $jsMandatory;?>

	return true;
}
<?php }?>

function updateChildrenList(){/*copied from Institutions page type*/
	var searchedText = jQuery("#searchChildren").val();
        jQuery(".loader").fadeIn(300);
	if(true){ 
		jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/Institutions",
            data: "searchedText="+searchedText+"&parentId="+parseInt(<?php echo $wmPage['ID']?>),
            async:"true",
            error: function () {
                jQuery(".loader").fadeOut(300);
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery("#childrenWrap").html(data);
                jQuery(".loader").fadeOut(300);
            }
        });
    }
}
