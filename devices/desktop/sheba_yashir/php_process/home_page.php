<?php
	// HOMEPAGE BANNER
	$homepageBanners = $wm->getGalleryItems($wmPage["ID"]);
	$thumb_call_banner = $cfg["WM"]["Server"]."/webfiles/images/cache/945X425/zcX1/";

	// HOMEPAGE ITEMS
	$homepageItemsID = $wm->getIdByPageType(126);
	$homepageItemsArr = $wm->getMenuLevel($homepageItemsID);

	// HOMEPAGE SLIDERS
	$thumb_call_slide = $cfg["WM"]["Server"]."/webfiles/images/cache/222X155/zcX1/";
	$arrHomeEventsRelated = $wm->getConnectedPages($id,98,"wm_connected_pages_ids.Ordering ASC","0,6");
	//$ticker01 = $wm->getLinkedPages(1, $wmPage['Lang']);
	$ticker02 = $wm->getLinkedPages(2, $wmPage['Lang']);
	$ticker03 = $wm->getLinkedPages(3, $wmPage['Lang']);
	$ticker04 = $wm->getLinkedPages(4, $wmPage['Lang']);

	// HOMEPAGE BOTTOM BANNERS
	$homepageBottomBannersID = $wm->getIdByPageType(128);
	$homepageBottomBannersArr = $wm->getMenuLevel($homepageBottomBannersID);
	$thumb_call_banners = $cfg["WM"]["Server"]."/webfiles/images/cache/222X180/zcX1/";

	// YASHIR EVENTS PAGE
	$eventsPageLink = $wm->getLinkByPageType(133, $wmPage["Lang"]);
?>