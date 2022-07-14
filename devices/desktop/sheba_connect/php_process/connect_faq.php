<?php 
	// GALLERY
	$homepageBanners = $wm->getGalleryItems($wmPage["ID"]);
	$thumb_call_banner = $cfg["WM"]["Server"]."/webfiles/images/cache/1920X430/zcX1/";

	// CHILDREN
	$pageChildren = $wm->getNewsList($wmPage["ID"]," Ordering ASC ");

	// THUMBS
	$thumb_call_items = $cfg["WM"]["Server"]."/webfiles/images/cache/512X512/zcX1/";
?> 