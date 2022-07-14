<?php /*require_once(dirname(__FILE__)."/../../php_components/more_items_js.php");*/?>
$(document).ajaxStop(function() {
  jQuery(".loader").fadeOut(300);
});
function updateChildrenList(){
        if(jQuery(event.target).attr('id')=='searchChildren'){/*clicked on input*/
            var elem = "onlyName";
        }else{/*clicked on button*/
            var elem = "all";
         }
       console.log(elem);
    var searchedText = jQuery("#searchChildren").val();
        if(searchedText.length >2 && jQuery(event.target).attr('id')=='searchChildren' || jQuery(event.target).attr('id')!='searchChildren' && searchedText.length >1){
            jQuery(".loader").fadeIn(300);
            if(true){ 
                    jQuery.ajax({
                type: "POST",
                url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace(".php",'',$wmPage["Type"]["Page"]);?>",
                data: "searchedText="+searchedText+"&parentId="+parseInt(<?php echo $wmPage['ID']?>)+"&searchType="+elem,
                async:"true",
                error: function () {
                    jQuery(".loader").fadeOut(300);
                    /*alert('קרתה תקלה, אנא נסה/י שנית');*/
                },
                success: function(data){
                    jQuery("#childrenWrap").html(data);

                }
            });
        }
    }
}
    
