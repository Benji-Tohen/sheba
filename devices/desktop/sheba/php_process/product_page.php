<?php
$arr_pictures=$wm->getGalleryItems($id);

if($wmPage["wm_forms"]){
	if($_POST){
		require_once(dirname(__FILE__)."/../../../../site/php_components/form_process.php");
	}else{
		require_once(dirname(__FILE__)."/../../../../site/php_components/form.php");
	}
}
?>
