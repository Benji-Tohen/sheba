<?php
$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));

if($wm->loadForGoogle()){
	$numItems=1000;
}

/*$page=$getParams[1];

if(!$page){
    $page=1;
}*/

//$sp=	$wm->getOrderingNewsPager($wmPage["ID"], $numItems);
/*$sp=	$wm->getNewsListPager($wmPage["ID"],"Start_Date DESC, Start_Time DESC, Name", $numItems);
$arr=	$sp->getPage($page);*/
/*$arr=$wm->getItems($id, "LIMIT 0,".$numItems);*/
$bannerPageId = $wm->getHasValueId($wmPage["ID"],"hasConnectedBanners");
$arr_connected_banners_middle = $db->getArray("SELECT * FROM wm_connected_banners
                                 INNER JOIN wm_banners
                                 ON wm_banners.ID = wm_connected_banners.banner_id
                                 WHERE wm_pages=".intval($bannerPageId)." AND Banner_Type = 1");
$firstBanner = $arr_connected_banners_middle[0];

$arr = $wm->getFolderPage($id);

$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/zcX1/";
/* Home Page Banners */
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";
$homeBanner=$db->getRow("SELECT Top_Header, Image_Text FROM wm_pages WHERE Page_Type=5 And Lang='".$_SESSION["WM"]["Lang"]."'");
$thumb_call_banner=$cfg["WM"]["Server"]."/webfiles/images/cache/"."730"."X"."90"."/zcX1/";
?>
