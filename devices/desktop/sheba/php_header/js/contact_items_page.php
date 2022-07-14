$(document).ready(function(){
    $('.itemExpand').bind( "click", function() {
        var ID = $(this).attr('id');
        $('#expandWrap'+ID).toggle(500);
        if($(this).children('button').hasClass('fa fa-plus')){
            $(this).children('button').removeClass();
            $(this).children('button').addClass('fa fa-minus');
        }else{
            $(this).children('button').removeClass();
            $(this).children('button').addClass('fa fa-plus');
        }
        
        
    });
});
<?php /*require_once(dirname(__FILE__)."/../../php_components/more_items_js.php");*/?>
