<?php
$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
if($wm->loadForGoogle()){
	$numItems=1000;
}
$arr=$wm->getOrderingNews($id, "LIMIT 0,".$numItems);

$thumbWidth=$params->getValue("services_page_image_width");
$thumbHeight=$params->getValue("services_page_image_height");
//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?far=1&amp;w=$thumbWidth&amp;h=$thumbHeight&amp;src=";
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/farX1/";
?>
