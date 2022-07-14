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
    }
}

function searchDoctorsAlpha(value){
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
    }
}

function searchDoctorsAll(){
        $(".loader").fadeIn(300);
	if(true){ 
        $.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: {
                searchFor: 'all'
            },
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
    }
}

$(document).ready(function(){
	searchDoctorsAll();
});
	
