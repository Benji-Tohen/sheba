<?php
$params=new Parameters($db);
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	intval($getParams[2]);
$start=	intval($getParams[3]);

$wmPage=$wm->getValues($id);
$wmPage["Type"]=$wm->getPageType($id);

$newsItemsLimit= intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);

$arr = $wm->getConnectedPages($id, 98, "Start_Date ASC, Start_Time DESC, Name", "$start,9", "Start_Date >= '".date("Y-m-d")."' AND Hide_On_Menu=0");
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."380"."X"."227"."/zcX1/";

if(empty($arr)){
    exit;
}
header('Content-Type: text/html; charset=utf-8');
?>
<div class="moreNewsWrapper">
    <?php for($i=0;$i<count($arr);$i=($i+3)){?>
    <?php $link=$wm->getLink($arr[$i]);?>
    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
    <?php }?>
</div>
<div class="clear"></div>
<div class="numItems" style="display: none;"><?php echo count($arr);?></div>
