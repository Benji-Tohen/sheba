<?php /*require_once(dirname(__FILE__)."/../../php_components/more_items_js.php");*/?>
function searchDoctors(){
        jQuery(".loader").fadeIn(300);
        /*first get selected search values - if no option was selected in dropdowns send - '' */
	var searchedName = jQuery("#searchByName").val();
        var searchByMedDomain = (jQuery("#searchByMedDomain option:selected" ).val() == 0 ? '': jQuery("#searchByMedDomain option:selected" ).val());
        var searchByUnit = (jQuery("#searchByUnit option:selected" ).val() == 0 ? '' : jQuery("#searchByUnit option:selected" ).val());
        
	if(true){ 
        jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "searchedName="+searchedName+"&searchByMedDomain="+searchByMedDomain+"&searchByUnit="+searchByUnit,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery(".loader").fadeOut(300);
                jQuery("#childrenWrap").html(data);
            }
        });
        jQuery("h2[class=searchCategodyTitle]").html("");
    }
}

var selected_letter=null;
function searchDoctorsAlpha(value,obj){
        jQuery(".loader").fadeIn(300);
	if(true){ 
        jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "searchedAlpha="+value,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery(".loader").fadeOut(300);
                jQuery("#childrenWrap").html(data);
            }
        });
        if (selected_letter) jQuery(selected_letter).css({backgroundColor:"",color:""});
        jQuery(obj).css({backgroundColor:"#1abc9c",color:"#ffffff"});
        selected_letter = obj;
        jQuery("h2[class=searchCategodyTitle]").html(obj.innerHTML);

    }
}

function searchDoctorsAll(){
        jQuery(".loader").fadeIn(300);
	if(true){ 
        jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery("#searchByMedDomain").val(0);
                jQuery("#searchByUnit").val(0);
                jQuery(".loader").fadeOut(300);
                jQuery("#childrenWrap").html(data);
            }
        });
        jQuery("h2[class=searchCategodyTitle]").empty();
    }
}
	
