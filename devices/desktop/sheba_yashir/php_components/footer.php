<?php
	$footerItemsID = $wm->getIdByPageType(129);
	$footerItemsArr = $wm->getMenuLevel($footerItemsID);
?>
<div class="container">
	<div class="row firstFooterRow">
	    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	        <?php include('bottom_menu.php');?>
	    </div>

	    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	        <?php foreach ($footerItemsArr as $key => $footerItem) {
	        	$link = $wm->getLink($footerItem);
	        	?>
	        	<a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>" title="<?php echo $footerItem['Name'];?>" class="footerItem"><?php echo $footerItem['Name'];?></a>
	        <?php }?>
	    </div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="rightReserved">
				<?php echo $trans->getText('yashir_credits');?>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="credits">
				<a href="<?php if($gui->getDir()=="rtl") { ?>http://www.tohen-media.com<?php } else { ?>http://www.tohen-media.com/en<?php }?>" target="_blank"><?php echo $trans->getText("Site by: Media Processor");?></a>
			</div>
		</div>
	</div>
</div>