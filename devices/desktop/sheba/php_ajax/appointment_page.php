<?php
$params=new Parameters($db);
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	intval($getParams[2]);
$start=	intval($getParams[3]);

$wmPage=$wm->getValues($id);
$wmPage["Type"]=$wm->getPageType($id);

$newsItemsLimit= intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);

$arr=$wm->getOrderingNews($id, "LIMIT $start, $newsItemsLimit");
foreach ($arr as $n=>$array) if (!$array['Top_Header']) $arr[$n]['Top_Header'] = 'webfiles/fck/image/headers/03f4d54d4a03183faca0cf25db290601_empety.jpg';
//$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."380"."X"."227"."/zcX1/";
if($wmPage["vertical_images"]){
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."270"."X"."346"."/zcX1/";
} else {
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."380"."X"."227"."/zcX1/";
}
//$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."270"."X"."346"."/zcX1/";
//foreach ($arr as $n=>$array) $arr[$n]["Name"] = str_replace('"',"\\\"",$arr[$n]["Name"]);
if(empty($arr)){
    exit;
}
header('Content-Type: text/html; charset=utf-8');
?>
<div>
    <?php for($i=0;$i<count($arr);$i=($i+3)){?>
    <?php $link=$wm->getLink($arr[$i]);?>
    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
    <?php }?>
</div>
<div class="clear"></div>
<div class="numItems" style="display: none;"><?php echo count($arr);?></div>
