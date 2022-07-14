<?php
if($wmPage["wm_forms"]){
	require_once(dirname(__FILE__)."/../../../../../site/php_components/form.php");

?>
function checkForm(){
<?php echo $jsMandatory;?>

	return true;
}
<?php }?>

$(document).ready(function(){
	$('#mainOverlay').on('click',function(){
		$(this).fadeOut();
		$('.fullScreenIframeWrap').fadeOut();
	});

	if(document.referrer.includes('.sheba.co.il')){
		$('#backBtn').show();
	}
});

function showDocVideo(){
	$('#mainOverlay').fadeIn();
	$('.fullScreenIframeWrap').fadeIn();
}

function closeDocVideo(){
	$('#mainOverlay').fadeOut();
	$('.fullScreenIframeWrap').fadeOut();

}