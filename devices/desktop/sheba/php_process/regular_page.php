<?php
$arr_pictures=$wm->getGalleryItems($pageContentId);

$thumb_call_galleryimage=$cfg["WM"]["Server"]."/webfiles/images/cache/"."750"."X"."400"."/zcX1/";

if($wmPage["wm_forms"]){
	if($_POST){
		require_once(dirname(__FILE__)."/../../../../site/php_components/form_process.php");
	}else{
		require_once(dirname(__FILE__)."/../../../../site/php_components/form.php");
	}
}



?>
