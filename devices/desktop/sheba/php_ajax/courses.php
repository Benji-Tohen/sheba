<?php
$params=new Parameters($db);
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	intval($getParams[2]);
$start=	intval($getParams[3]);

$wmPage=$wm->getValues($id);
$wmPage["Type"]=$wm->getPageType($id);

$newsItemsLimit= intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);

$arr=$wm->getItems($id, "LIMIT $start, $newsItemsLimit");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."390"."X"."235"."/zcX1/";

/* Home Page Banners */
$thumb_call_middle=$cfg["WM"]["Server"]."/webfiles/images/cache/338X260/zcX1/";
$homeBanner=$db->getRow("SELECT Top_Header, Image_Text FROM wm_pages WHERE Page_Type=5 And Lang='".$_SESSION["WM"]["Lang"]."'");

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
