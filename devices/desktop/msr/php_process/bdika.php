<?php

$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));

if($wm->loadForGoogle()){
	$numItems=1000;
}

/*$page=$getParams[1];

if(!$page){
    $page=1;
}*/

//$sp=	$wm->getOrderingNewsPager($wmPage["ID"], $numItems);
/*$sp=	$wm->getNewsListPager($wmPage["ID"],"Start_Date DESC, Start_Time DESC, Name", $numItems);
$arr=	$sp->getPage($page);*/
/*$arr=$wm->getItems($id, "LIMIT 0,".$numItems);*/
/*$arr=$wm->getNewsList($id);*/
/*get menu letters according to language*/
/*switch ($_SESSION["WM"]["Lang"]) {
    case 'fr':
    case 'en':
        $arrLetters = mb_range('a', 'z');
        break;
    case 'he':
        $arrLetters = mb_range('א', 'ת');
        break;
    case 'ru':
        $arrLetters = mb_range('б', 'я');
        array_unshift($arrLetters,'a');
        break;
    default:
        break;
}*/
$arr_connected_doctors = $wm->getConnectedPages($wmPage['ID'],96);
$arr_connected_institute = $wm->getConnectedPages($wmPage['ID'],95);
$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/";

?>
