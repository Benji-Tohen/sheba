<?php $arrHeaderLinks = $wm->getLinks();
foreach ($arrHeaderLinks as $item) {?>
	<a href="<?php echo $item['URL'];?>" class="headerLink" target="_blank" style="background-image: url('<?php echo $cfg["WM"]["Server"]."/".$item['File_Name'];?>');" title="<?php echo $item['Name'];?>"><!----></a>
<?php }?>
<div class="clear"><!----></div>