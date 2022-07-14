<?php 
//$arrHome=$wm->getHomePageContent($_SESSION["WM"]["Lang"], Null, NULL, "Start_Date DESC");
//$arrHome=		$wm->getHomepageBanners($wmPage["Lang"]);
//$arrHomeSmallNews=	$wm->getHomePageContent($_SESSION["WM"]["Lang"], Null, NULL, "Start_Date DESC");
//$arr_pictures=$wm->getGalleryItems($wmPage["ID"]);
$arrChildrenFolder = $wm->getChildren($id,102);/*get general items page under this page that is parent of all children*/
$arrChildren = $wm->getAllChildren($arrChildrenFolder[0]['ID']);
$arrHomeNewsRelated = $wm->getConnectedPages($id,"103","wm_connected_pages_ids.Ordering DESC","0,6");
//$arrHomeEventsRelated = $wm->getConnectedPages($id,98,"wm_connected_pages_ids.Ordering DESC","0,6","Start_Date >= NOW()");
$arrHomeEventsRelated = $wm->getConnectedPages($id,98,"wm_connected_pages_ids.Ordering DESC","0,6","Start_Date >= '".date("Y-m-d")."'");
//$arr_connected_doctors = $wm->getConnectedPages($id,96);
/*first check if this page has its own banners - else get parent banners - recursive*/
$bannerPageId = $wm->getHasValueId($wmPage["ID"],"hasConnectedBanners");
$arr_connected_banners_middle = $db->getArray("SELECT * FROM wm_connected_banners
                                 INNER JOIN wm_banners
                                 ON wm_banners.ID = wm_connected_banners.banner_id
                                 WHERE wm_pages=".intval($bannerPageId)." AND Banner_Type = 2");
$firstBanner = $arr_connected_banners_middle[0];
$secondBanner = $arr_connected_banners_middle[1];
$thumbWidth=300;//$params->getValue("news_page_image_width");
$thumbHeight=210;//$params->getValue("news_page_image_height");
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";
$thumb_call_small=$cfg["WM"]["Server"]."/webfiles/images/cache/214X159/zcX1/";
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";
$thumb_call_banner=$cfg["WM"]["Server"]."/webfiles/images/cache/"."780"."X"."90"."/zcX1/";

		


?>
