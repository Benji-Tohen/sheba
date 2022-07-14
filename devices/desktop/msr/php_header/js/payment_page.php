$(document).ready(function() {

	$('.confirmButton').click(function(){
		var thisdiv=$(this);

		thisdiv.html("<?php echo $trans->getText("Sending request");?>");

		thisdiv.css("cursor", "arrow");
		thisdiv.unbind("click");

		$.ajax({
		    url: '<?php echo $cfg["WM"]["Server"];?>/ajax/paypal_confirm',
		    success: function (data) {
		        if(data=="0"){
				$('.loginButton').trigger('click');
			}else{
				thisdiv.slideUp();
				$('.paymentConfirmText').html(data).slideDown();
				$('.basketNumItems').html("0");
			}
		    }
		});

	});

});
