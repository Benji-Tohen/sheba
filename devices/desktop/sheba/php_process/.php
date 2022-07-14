<?php 
//$arrHome=$wm->getHomePageContent($_SESSION["WM"]["Lang"], Null, NULL, "Start_Date DESC");
$arrHome=		$wm->getHomepageBanners($wmPage["Lang"]);
$arrHomeSmallNews=	$wm->getHomePageContent($_SESSION["WM"]["Lang"], Null, NULL, "Start_Date DESC");
$arr_pictures=$wm->getGalleryItems($wmPage["ID"]);
$arrHomeNewsRelated = $wm->getConnectedPages($id,103,"wm_connected_pages_ids.Ordering DESC");
$arrHomeEventsRelated = $wm->getConnectedPages($id,98,"wm_connected_pages_ids.Ordering DESC","0,6","Start_Date > NOW()");
$arr_connected_doctors = $wm->getConnectedPages($id,96);

$thumbWidth=300;//$params->getValue("news_page_image_width");
$thumbHeight=210;//$params->getValue("news_page_image_height");
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";
$thumb_call_small=$cfg["WM"]["Server"]."/webfiles/images/cache/214X159/zcX1/";
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";

?>
