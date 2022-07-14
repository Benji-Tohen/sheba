<?php
$params=new Parameters($db);
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	intval($getParams[2]);
$start=	intval($getParams[3]);

$wmPage=$wm->getValues($id);
$wmPage["Type"]=$wm->getPageType($id);

$newsItemsLimit= $params->getValue("news_page_num_items");
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);

$arr = $wm->getNewsList($id, "Ordering", "LIMIT $start, $newsItemsLimit");

$thumbWidth=$params->getValue("news_page_image_width");
$thumbHeight=$params->getValue("news_page_image_height");
//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=$thumbWidth&amp;h=$thumbHeight&amp;src=";
$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";

$menu_file = $wm->getProperty($id, "Menu_File");

if(empty($arr)){
	exit;
}
header('Content-Type: text/html; charset=utf-8');
?>
<div class="moreNewsWrapper">
	<?php for($i=0;$i<count($arr);$i++){?>
		<?php $link=$wm->getLink($arr[$i]);?>
		<?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
	<?php }?>
</div>
<div class="clear"></div>
<div class="numItems" style="display: none;"><?php echo count($arr);?></div>
