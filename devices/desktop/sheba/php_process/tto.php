<?php 
	$arr_pictures=$wm->getGalleryItems($wmPage["ID"]);
	$arrChildrenFolder = $wm->getChildren($id,153);
	$arrChildren = $wm->getAllChildren($arrChildrenFolder[0]['ID'], 'Ordering');

	$thumbWidth=100;
	$thumbHeight=100;
	$items_thumb=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";
?>