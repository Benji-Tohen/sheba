<?php
$totalItems=$wm->getNumShowenItems($id);
?>
var newsLimit=<?php echo $params->getValue(str_replace('.php', '', $wmPage["Type"]["Page"])."_num_items");?>;
var newsStart=newsLimit;


$(document).ready(function(){
	$('.moreButtonDesk').click(function(){
		$.ajax({
		  url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo rtrim($wmPage["Type"]["Page"], ".php");?>/<?php echo $id;?>/"+newsStart,
		  success: function(data){
			if(data==""){
				$('.moreButtonDesk').fadeOut();
			}
		    	$('#moreNews').append(data);
		    	$('.moreNewsWrapper').hide();
			$('.moreNewsWrapper').slideDown('slow',function(){

				var numReturned=parseInt($('.numItems').text());
				if(numReturned<newsLimit){
					$('.moreButtonDesk').fadeOut();
				}
				$('.numItems').removeClass('numItems');

			});
		    	$('.moreNewsWrapper').removeClass('moreNewsWrapper');

			if(newsStart>=<?php echo $totalItems;?>){
				$('.moreButtonDesk').fadeOut();
			}else{
			}

			//$('html, body').animate({ scrollTop: $(document).height()}, 1400);
			//setTimeout(function(){$('html, body').animate({ scrollTop: document.body.scrollTop + 400}, 1400);},500);
			setTimeout(function(){$('html, body').animate({ scrollTop: $(document).scrollTop() + 200}, 1400);},500);

		  }
		});
		newsStart+=newsLimit;
	});
});
