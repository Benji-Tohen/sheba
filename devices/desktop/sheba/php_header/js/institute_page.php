$(document).ready(function() {
    updateChildrenList();

     $('#showMoreText').click(function(){
        $(this).hide(1);
        $('#moreTextWrap').fadeIn(1000);
    });
});

<?php if($wmPage["wm_forms"]){
	require_once(dirname(__FILE__)."/../../../../../site/php_components/form.php");?>

  function checkForm(){
    <?php echo $jsMandatory;?>
    return true;
  }
<?php } ?>

function updateChildrenList(){/*copied from Institutions page type*/
	var searchedText = $("#searchChildren").val();
        $(".loader").fadeIn(300);
	if(true){ 
		$.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/Institutions",
            data: "searchedText="+searchedText+"&parentId="+parseInt(<?php echo $wmPage['ID']?>)+"&lang=<?php echo $wmPage['Lang']?>",
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
