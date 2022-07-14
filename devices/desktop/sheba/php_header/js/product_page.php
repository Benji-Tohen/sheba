<?php
if($wmPage["wm_forms"]){
	require_once(dirname(__FILE__)."/../../../../../site/php_components/form.php");

?>
function checkForm(){
<?php echo $jsMandatory;?>

	return true;
}
<?php }?>


$(document).ready(function() {

	$('.addToCart').click(function(){
		$.ajax({
		    url: '<?php echo $cfg["WM"]["Server"];?>/ajax/add_to_cart/<?php echo $id;?>',
		    success: function (data) {
		        if(data=="error"){
				$('.loginButton').trigger('click');
			}else{
				var targetPos=$('.basket').position();
				var itemPos=$('.storeImage').position();
				var storeImage;

				storeImage=$('.storeImage').clone(true).appendTo('.yoxview');
				storeImage.css("position", "absolute");
				storeImage.css("top", itemPos.top);
				storeImage.css("left", itemPos.left);
				storeImage.animate({
				    opacity: 0,
				    left: targetPos.left,
				    top: targetPos.top,
				    height: $('.basket').height(),
				    width: $('.basket').width()
				  }, 1000, function() {
/*
					//storeImage.fadeOut('fast');
					//alert(data);
*/
					$('.basketNumItems').html(data);
				  });
				
			}
		    }
		});	
	});

});
