<?php 
	// GALLERY
	$homepageBanners = $wm->getGalleryItems($wmPage["ID"]);
	$thumb_call_banner = $cfg["WM"]["Server"]."/webfiles/images/cache/1920X430/zcX1/";

	// CHILDREN
	$lobiPageItems=$wm->getNewsList($wmPage["ID"], "Ordering");

	// THUMBS
	$thumb_call_items = $cfg["WM"]["Server"]."/webfiles/images/cache/270X180/zcX1/";
?> 