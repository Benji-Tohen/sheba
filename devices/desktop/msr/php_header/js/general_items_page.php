<?php /*require_once(dirname(__FILE__)."/../../php_components/more_items_js.php");*/?>

function updateChildrenList(){
	var searchedText = jQuery("#searchChildren").val();
        jQuery(".loader").fadeIn(300);
	if(true){ 
		jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo rtrim($wmPage["Type"]["Page"], ".php");?>",
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
	
