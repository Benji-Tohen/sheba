<?php
/*small update script to make all children of this page connected to this page*/
/*$newsArchives = $db->getArray("SELECT ID FROM wm_pages WHERE Page_Type = 104");
foreach ($newsArchives as $key => $archive) {/*get children and update them as connected pages
	$children = $db->getArray("SELECT ID FROM wm_pages WHERE Parent = ".$archive['ID']);
	foreach ($children as $key => $child) {
		$db->runQuery("INSERT INTO `wm_connected_pages_ids`( `wm_pages`, `wm_connected_page_type`, `wm_connected_wm_pages_ids`, `Ordering`) VALUES (".$wmPage["ID"].",103,".$child['ID'].",99)");
	}
	exit;
}
/*small update script to make all children of this page connected to this page -END*/
$totalItems=$wm->getNumShowenItems($id);

/*$numItems=intval($params->getValue(str_replace('.php', '', $wmPage["Type"]["Page"])."_num_items"));*/
$numItems=10;
if($wm->loadForGoogle()){
	$numItems=1000;
}

$page=$getParams[1];

if(!$page){
    $page=1;
}

//$sp=	$wm->getOrderingNewsPager($wmPage["ID"], $numItems);
//$sp=	$wm->getNewsListPager($wmPage["ID"],"Start_Date DESC, Start_Time DESC, Name", $numItems);

//$arr=	$sp->getPage($page);
$arr = $wm->getConnectedPages($wmPage["ID"],103,"wm_connected_pages_ids.Ordering ASC","0,10");
/*$arr=$db->getArray("SELECT * FROM wm_pages WHERE Page_Type = 103 ORDER BY Start_Date DESC");*/

$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/zcX1/";
/* Home Page Banners */
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";
$homeBanner=$db->getRow("SELECT Top_Header, Image_Text FROM wm_pages WHERE Page_Type=5 And Lang='".$_SESSION["WM"]["Lang"]."'");

?>
