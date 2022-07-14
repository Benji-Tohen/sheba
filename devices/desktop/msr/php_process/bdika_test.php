<?php

$arr_modul=$wm->getNewsList($wmPage["ID"], "Ordering");

$thumb_call_item=$cfg["WM"]["Server"]."/webfiles/images/cache/"."220"."X"."133"."/iarX1/";
$thumb_call_open_item=$cfg["WM"]["Server"]."/webfiles/images/cache/"."470"."X"."285"."/zcX1/";
$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));

if($wm->loadForGoogle()){
	$numItems=1000;
}

$arr_connected_doctors = $wm->getConnectedPages($wmPage['ID'],96);
$arr_connected_institute = $wm->getConnectedPages($wmPage['ID'],95);
$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/";

?>
