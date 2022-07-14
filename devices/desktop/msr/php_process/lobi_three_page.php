<?php
$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
if($wm->loadForGoogle()){
	$numItems=1000;
}
$arr=$wm->getOrderingNews($id, "LIMIT 0,".$numItems);
// shuffle($arr);

if($wmPage["vertical_images"]==1){
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."270"."X"."346"."/iarX1/";
} else {
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."380"."X"."227"."/iarX1/";
}

?>
