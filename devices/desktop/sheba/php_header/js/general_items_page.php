function updateChildrenList(){
	var searchedText = $("#searchChildren").val();
        $(".loader").fadeIn(300);
	if(true){ 
		$.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo rtrim($wmPage["Type"]["Page"], ".php");?>",
            data: "searchedText="+searchedText+"&parentId="+parseInt(<?php echo $wmPage['ID']?>),
            async:"true",
            error: function () {
                $(".loader").fadeOut(300);
            },
            success: function(data){
                $("#childrenWrap").html(data);
                $(".loader").fadeOut(300);
            }
        });
    }
}
	
