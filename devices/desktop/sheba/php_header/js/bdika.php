<?php /*require_once(dirname(__FILE__)."/../../php_components/more_items_js.php");*/?>
$(document).ready(function() {
    /* Using default configuration */
    /*$('#carousel').carouFredSel();*/
     $('#showMoreText').click(function(){
        $(this).hide(1);
        $('#moreTextWrap').fadeIn(1000);
    });
    /* Using custom configuration */
    $('#carousel').carouFredSel({
        infinite: true,
        width: '100%',
        height: 'auto',
        direction  : "left",
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
        scroll : 1,
        prev:{button:"#prevItem"}, 
        next:{button:"#nextItem"}    
    });
   
    
});
