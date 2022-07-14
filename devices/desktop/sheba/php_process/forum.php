<?php
$getExplode = explode("/", $_GET["a"]);

if($getParams[1]=="respond"){
	if(!isset($_SESSION['doctor_id'])){
        $link=$wm->getLink($wmPage);
		$_SESSION["RETURN_URL"]=$link["Link"];
		header("location: https://forum.sheba.co.il/authok");
		exit;
	}
}
/*
if($getExplode[1] == "doctor_tomer"){
    $_SESSION['doctor_id'] = "123456";
}
*/

/*

$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));

if($wm->loadForGoogle()){
	$numItems=1000;
}

$arr=$wm->getItems($id, "LIMIT 0,".$numItems);

$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/zcX1/";
/* Home Page Banners */
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";
$homeBanner=$db->getRow("SELECT Top_Header, Image_Text FROM wm_pages WHERE Page_Type=5 And Lang='".$_SESSION["WM"]["Lang"]."'");


/*from here start relevent code*/
require_once("classes/forum/class.forum.php");
$forumObj = new Forum($db, "wm_forum_messages");
$forumId = $forumObj->getForumIdByWmPage($wmPage['ID']);/*get this forum id and set it*/
//echo $forumId.'pp';exit;
$forumObj->forumId=$forumId;
//$parentID = $forumObj->searchInitialParent(12);
//$search = $forumObj->getMessagesSearch('תקין');
$limitMessages = "0,10";
$messages=array();
$forumObj->getForumMessages($messages, $forumId,0,$limitMessages);/*get messages for this forum id*/

//print_r($messages);

/*$newMessageId = $forumObj->addMessage($forumId, 0, 'נושא מעניין', 'תוכן מביך','סמי', 'david@tohen-media.com');
$forumObj->deleteMessage($newMessageId);
*/
?>
