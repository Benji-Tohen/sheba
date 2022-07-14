<div class="leftMenu">
	<?php if ($wmPage['AddThis']){?>
	<div class="addThis"><?php echo $params->getValue("AddThis");?></div>
	<div class="clear"><!----></div>
	<?php }?>
	<div class="lastUpdates">
<?php 
$updatesPageId=NULL;
if($wmPage["Page_Type"]==62){
	$updatesPageId=$db->getField("SELECT ID FROM wm_pages WHERE Deleted=0 AND Parent=".intval($wmPage["ID"])." AND Page_Type=63", "ID");
}
?>
		<h3><?php echo $trans->getText("Last Updates");?></h3>
		<?php $arrLastUpdates=$wm->getHomepageContent($wmPage["Lang"], $updatesPageId, "0,3", "Start_Date DESC, UpdatedTime DESC");?>
		<?php $i=0;foreach($arrLastUpdates as $item){
			$link=$wm->getLink($item);
		?>
			<div class="lastUpdateItem">
				<a href="<?php echo $link["Link"];?>"><?php echo $item["Name"];?></a>
			</div>
			<?php if($i<2){?>
			<div class="lastUpdateItemSaperator"></div>
			<?php }?>
		<?php $i++;}?>
		<?php
			$updatesPageId=$item["Parent"];
			$parentRow=$wm->getValues($updatesPageId);
			$link=$wm->getLink($parentRow);
		?>
		<a href="<?php echo $link["Link"];?>"><img src="<?php echo $cfg["WM"]["Server"];?>/site/images/arrow_green_tafi.png" alt="<?php echo $trans->getText("More updates");?>" title="<?php echo $trans->getText("More updates");?>" class="moreButtonDeskDesk" /></a>
	</div>
	<div class="tafiTV">
		<?php 
			$tafiTVParentPageId=$db->getField("SELECT ID FROM wm_pages WHERE Deleted=0 AND Page_Type=64", "ID");
			$tafiParentRow=$wm->getValues($tafiTVParentPageId);
			$tafiParentLink=$wm->getLink($tafiParentRow);
			$tafitvPageId=$wm->getFirstChild($tafiTVParentPageId);
			$tafitvRow=$wm->getValues($tafitvPageId);
		?>
		<a href="<?php echo $tafiParentLink["Link"];?>"><img src="<?php echo $cfg["WM"]["Server"];?>/site/images/arrow_green_tafi.png" alt="tafiTV" title="tafiTV" class="moreButtonDeskDesk" /></a>
		<a href="<?php echo $tafiParentLink["Link"];?>"><img src="<?php echo $cfg["WM"]["Server"];?>/site/images/tafiTV.jpg" alt="<?php echo $trans->getText("TAFI TV");?>" title="<?php echo $trans->getText("TAFI TV");?>" class="tafiTVHeader" /></a>
		<div class="tafiTVVideo">
			<iframe width="228" height="173" src="http://www.youtube.com/embed/<?php echo $string->getYoutubeCodeFromLink($tafitvRow["Video_Embed"]);?>" frameborder="0" allowfullscreen></iframe>
			<div class="tafiTvContent">
				<div class="richtext"><?php echo $tafitvRow["Content"];?></div>
			</div>
		</div>
	</div>
	<div class="facebookLike">
		<div class="fb-like-box" data-href="https://www.facebook.com/pages/%D7%99%D7%95%D7%96%D7%9E%D7%95%D7%AA-%D7%A7%D7%A8%D7%9F-%D7%90%D7%91%D7%A8%D7%94%D7%9D/154698021323966" data-width="245" data-show-faces="true" data-border-color="#ffffff" data-stream="true" data-header="true"></div>
	</div>
</div>
