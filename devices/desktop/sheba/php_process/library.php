<?php 

// Big gallery pictures
$arr_pictures=$wm->getGalleryItems($wmPage["ID"]);

// Dynamic fields
$arrDynamicFieldsFirstBlock = $wm->getDynamicFieldsByPageType($id,$wmPage['Type']['ID'],1);

/*first check if this page has its own banners - else get parent banners - recursive*/
$bannerPageId = $wm->getHasValueId($wmPage["ID"],"hasConnectedBanners");
$arr_connected_banners_middle = $db->getArray("SELECT * FROM wm_connected_banners
                                 INNER JOIN wm_banners
                                 ON wm_banners.ID = wm_connected_banners.banner_id
                                 WHERE wm_pages=".intval($bannerPageId)." AND Banner_Type = 2");


$firstBanner = $arr_connected_banners_middle[0];
$secondBanner = $arr_connected_banners_middle[1];

$thumbWidth=300;
$thumbHeight=210;
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";
$thumb_call_small=$cfg["WM"]["Server"]."/webfiles/images/cache/214X159/zcX1/";
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";
$thumb_call_banner=$cfg["WM"]["Server"]."/webfiles/images/cache/"."780"."X"."90"."/zcX1/";

?>
