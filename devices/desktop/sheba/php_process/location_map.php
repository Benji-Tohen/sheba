<?php
$totalItems=$wm->getNumShowenItems($id);
$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));

function sort_by_order ($a, $b){
    return strcasecmp($a['Name'], $b['Name']);
}

if($wm->loadForGoogle()){
	$numItems=1000;
}

$locationsCounter=0;
$locationsArr=array();
$wm->getChildrenRecursiveByPageType($locationsArr,'30987',"'95','94','3'");
$arr=$locationsArr;

usort($arr, 'sort_by_order');

$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/zcX1/";

/* Home Page Banners */
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";
$homeBanner=$db->getRow("SELECT Top_Header, Image_Text FROM wm_pages WHERE Page_Type=5 And Lang='".$_SESSION["WM"]["Lang"]."'");

?>