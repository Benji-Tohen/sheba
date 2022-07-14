<?php /*require_once(dirname(__FILE__)."/../../php_components/more_items_js.php");*/?>
function searchDoctors(){
        $(".loader").fadeIn(300);
        /*first get selected search values - if no option was selected in dropdowns send - '' */
	var searchedName = $("#searchByName").val();
        var searchByMedDomain = ($("#searchByMedDomain option:selected" ).val() == 0 ? '': $("#searchByMedDomain option:selected" ).val());
        var searchByUnit = ($("#searchByUnit option:selected" ).val() == 0 ? '' : $("#searchByUnit option:selected" ).val());
        
	if(true){ 
        $.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "searchedName="+searchedName+"&searchByMedDomain="+searchByMedDomain+"&searchByUnit="+searchByUnit,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                $(".loader").fadeOut(300);
                $("#childrenWrap").html(data);
            }
        });
        $("h2[class=searchCategodyTitle]").html("");
    }
}

var selected_letter=null;
function searchDoctorsAlpha(value,obj){
        $(".loader").fadeIn(300);
	if(true){ 
        $.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "searchedAlpha="+value,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                $(".loader").fadeOut(300);
                $("#childrenWrap").html(data);
            }
        });
        if (selected_letter) $(selected_letter).css({backgroundColor:"",color:""});
        $(obj).css({backgroundColor:"#1abc9c",color:"#ffffff"});
        selected_letter = obj;
        $("h2[class=searchCategodyTitle]").html(obj.innerHTML);

    }
}

function searchDoctorsAll(){
        $(".loader").fadeIn(300);
	if(true){ 
        $.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                $("#searchByMedDomain").val(0);
                $("#searchByUnit").val(0);
                $(".loader").fadeOut(300);
                $("#childrenWrap").html(data);
            }
        });
        $("h2[class=searchCategodyTitle]").empty();
    }
}
	
