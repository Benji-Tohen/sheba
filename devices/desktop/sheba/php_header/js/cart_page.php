$(document).ready(function() {

	$('.cartItemDelete').click(function(){
		var divid=$(this).attr("id");
		divid=divid.split('_');
		var itemid=divid[1];

		var thisItem=$(this);

		$.ajax({
		    url: '<?php echo $cfg["WM"]["Server"];?>/ajax/remove_from_cart/'+itemid,
		    success: function (data) {
		        if(data=="error"){
				$('.loginButton').trigger('click');
			}else{
				var cartItemDiv=thisItem.parents('.cartItem');
				cartItemDiv.slideUp('fast', function(){
					cartItemDiv.html(data);
					cartItemDiv.slideDown();
				});
				updatePrice();
			}
		    }
		});	
	});

	$('.cartItemQuantity input').keyup(function(){
		$(this).parent().children('.updateItemQuantityButton').fadeIn();
	});

	$('.updateItemQuantityButton').click(function(){
		var divid=$(this).attr("id");
		divid=divid.split('_');
		var itemid=divid[1];
		var quantity=$(this).parent().children("input").val();

		var thisItem=$(this);

		$.ajax({
		    url: '<?php echo $cfg["WM"]["Server"];?>/ajax/update_item_quantity/'+itemid+'/'+quantity,
		    success: function (data) {
		        if(data=="error"){
				$('.loginButton').trigger('click');
			}else{
				updatePrice();
				thisItem.html("<div class=\"updateItemQuantityUpdated\"><?php echo $trans->getText("Updated");?></div>");
				thisItem.css("text-decoration", "none");
				thisItem.delay(3000).fadeOut("fast", function(){
					thisItem.css("text-decoration", "underline");
					thisItem.html("<?php echo $trans->getText("Update");?>");
				});

			}
		    }
		});	
	});


	$('.buyNowButton').click(function(){
		
	});


	$('.shipmentMethod').change(function(){
		$.ajax({
		    url: '<?php echo $cfg["WM"]["Server"];?>/ajax/change_shipment/'+$('.shipmentMethod option:selected').val(),
		    success: function (data) {
		        if(data=="error"){
				$('.loginButton').trigger('click');
			}else{
				updatePrice();
			}
		    }
		});
	});

	
});


function updatePrice(){
	$.ajax({
	    url: '<?php echo $cfg["WM"]["Server"];?>/ajax/get_subtotal',
	    success: function (data) {
	        if(data=="error"){
			$('.loginButton').trigger('click');
		}else{
			$('.subTotalNumberNumber').html(data);
		}
	    }
	});	
}
