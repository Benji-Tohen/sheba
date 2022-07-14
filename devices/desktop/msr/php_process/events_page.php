<?php


$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
if($wm->loadForGoogle()){
	$numItems=1000;
}

/*$arr=$wm->getOrderingNews($id, "LIMIT 0,".$numItems);*/
//$arr=$wm->getNewsList($id,"Start_Date DESC, Start_Time DESC, Name", "LIMIT 0,".$numItems);
//$arr=$wm->getConnectedPages($id,$pagetypeIds,$orderBy=NULL,$limit='0,10000',$where=NULL)
//$totalItems=$wm->getNumShowenItems($id);
//function getConnectedPages($pageId,$pagetypeIds,$orderBy=NULL,$limit='0,10000',$where=NULL)
$arr = $wm->getConnectedPages($id, 98, "Start_Date ASC, Start_Time DESC, Name", "0,1000", "Start_Date >= '".date("Y-m-d")."' AND Hide_On_Menu=0");
$totalItems=count($arr);
// shuffle($arr);
$thumbWidth=$params->getValue("lobiThree_page_image_width");
$thumbHeight=$params->getValue("lobiThree_page_image_height");
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."380"."X"."227"."/zcX1/";

?>
