<?php
$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
if($wm->loadForGoogle()){
	$numItems=1000;
}
$arr=$wm->getOrderingNews($id, "LIMIT 0,".$numItems);
// shuffle($arr);
$thumbWidth=$params->getValue("lobiTwo_page_image_width");
$thumbHeight=$params->getValue("lobiTwo_page_image_height");
/*$thumbWidth=424;
$thumbHeight=285;*/
//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=$thumbWidth&amp;h=$thumbHeight&amp;src=";
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/iarX1/";
?>
