<?php 
$home_arr_pictures=$wm->getGalleryItems($wmPage["ID"]);

$mobilePicArray = array();
foreach($home_arr_pictures as $key => $mobilePicArr){
	if(!$mobilePicArr['File_Name_Mobile']){
		continue;
	}
	$mobilePicArray[$key] = $mobilePicArr['File_Name_Mobile'];
}


$arrHomeNewsRelated = $wm->getConnectedPages($id,103,"wm_connected_pages_ids.Ordering ASC","0,6");
$arrHomeEventsRelated = $wm->getConnectedPages($id,98,"wm_connected_pages_ids.Ordering ASC","0,6");
/*$arrHomeEventsRelated1 = array_slice($arrHomeEventsRelated,0,3);
$arrHomeEventsRelated2 = array_slice($arrHomeEventsRelated,3,3);
$arrHomeEventsRelated = array_merge($arrHomeEventsRelated2,$arrHomeEventsRelated1);*/


$parent = $db->getRow("SELECT ID FROM wm_pages WHERE Parent = ".intval($homePageId)." AND Page_Type=63 AND Deleted=0");
$arrCenterBanners=$db->getArray("SELECT * FROM wm_pages WHERE Parent=".$parent['ID']." AND Deleted=0 ORDER BY Ordering");

		/*
		echo "<div style='display: none;'>";
		echo "shery: ";
		echo "<pre>";
		print_r($_SERVER);
		echo "</pre>";
		echo "</div>";
		*/
?>
 