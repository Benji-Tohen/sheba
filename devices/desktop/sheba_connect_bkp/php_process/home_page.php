<?php
	// HOMEPAGE BANNER
	$homepageBanners = $wm->getGalleryItems($wmPage["ID"]);
	$thumb_call_banner = $cfg["WM"]["Server"]."/webfiles/images/cache/1920X538/zcX1/";

	// HOMEPAGE ITEMS
	$homepageItemsID = $wm->getIdByPageType(149);
	$homepageItemsArr = $wm->getMenuLevel($homepageItemsID);

	// HOMEPAGE TICKERS
	$ticker01 = $wm->getLinkedPages(1, $wmPage['Lang']);
	$ticker02 = $wm->getLinkedPages(5, $wmPage['Lang']);

	$thumb_call_inner = $cfg["WM"]["Server"]."/webfiles/images/cache/555X260/zcX1/";
?>