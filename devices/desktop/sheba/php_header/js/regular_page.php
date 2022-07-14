$(document).ready(function() {
    $('#regularGallery').owlCarousel({
        navigation:false,
        navigationText:false,
        singleItem:true
    });

});

<?php

if($wmPage["wm_forms"]){
	require_once(dirname(__FILE__)."/../../../../../site/php_components/form.php");

?>
function checkForm(){
<?php echo $jsMandatory;?>

	return true;
}
<?php }?>
