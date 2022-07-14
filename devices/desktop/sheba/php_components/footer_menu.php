<?php
$arrFooter = $wm->getChildrenOnMenu($wm->getIdByPageType(33, $_SESSION["WM"]["Lang"]), 1, "Ordering");
foreach ($arrFooter as $item) {
	//$item = $wm->getValues($item);
	$link = $wm->getLink($item);
	?>
	<a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>" class="footerMenuItem"><?php echo $item['Name'];?></a>
<?php }?>
