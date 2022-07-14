<div class="footerLinks">
	<?php $arrFooterLinks = $wm->getLinks2();
	foreach ($arrFooterLinks as $item) {?>
		<a href="<?php echo $item['URL'];?>" class="footerLink" target="_blank" style="background-image: url('<?php echo $cfg["WM"]["Server"]."/".$item['File_Name'];?>');" title="<?php echo $item['Name'];?>"><!----></a>
	<?php }?>
</div>
<div class="footerFunds">
	<?php $arrFooterFunds = $wm->getLinks3();
	foreach ($arrFooterFunds as $item) {?>
		<a href="<?php echo $item['URL'];?>" class="footerFund" target="_blank" style="background-image: url('<?php echo $cfg["WM"]["Server"]."/".$item['File_Name'];?>');" title="<?php echo $item['Name'];?>"><!----></a>
	<?php }?>
</div>
<?php
$newsletter = $wm->getValues($wm->getIdByPageType(61, $_SESSION["WM"]["Lang"]));
$link = $wm->getLink($newsletter);
?>
<a href="<?php echo $link['Link'];?>" class="newsletter" target="<?php echo $link['Target'];?>"><?php echo $newsletter['Name'];?></a>