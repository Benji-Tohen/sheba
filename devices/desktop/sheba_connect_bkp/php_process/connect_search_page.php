<?php

$wm->initGetParams();
$q=urldecode($_GET["q"]);
$q = str_replace(array(";","(",")",'"'),"",strip_tags($q)); // prevent cross-site scripting 

if($_GET["q"]){
    $wm->insertSearch($q);
}

$_SESSION['q'] = $q;



$thumbWidth=$params->getValue("news_page_image_width");
$thumbHeight=$params->getValue("news_page_image_height");
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";



?>
