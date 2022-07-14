<?php 
	$shebaConnectLinks = $wm->getLinksConnect();
?>
<div class="container">
	<div class="row">
	    <div class="col-xs-12">
			<div class="sepLineSection"></div>
		</div>
	</div>

	<div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			<a href="<?php echo $cfg["WM"]["Server"] . $homeAlias; ?>" title="<?php echo $trans->getText("logoName"); ?>"  class="mobileFooterLogo">
			    <img src="<?php echo $cfg["WM"]["Server"].'/'.$logoImg ?>" alt="<?php echo $trans->getText("logoName"); ?>" title="<?php echo $trans->getText("logoName"); ?>" class="img-responsive" />
			</a>

			<div class="footer-social-links">
				<?php if(!empty($shebaConnectLinks)){
					foreach ($shebaConnectLinks as $key => $value) { ?>
						<a href="<?php echo $value['URL'];?>" title="<?php echo $value['Name'];?>" class="footer-social-link">
							<img src="<?php echo $value['File_Name'];?>">
						</a>
				<?php }}?>
			</div>
		</div>

	    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	        <?php include('bottom_menu.php');?>
	    </div>

		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			<img src="<?php echo $homePage["Menu_File"];?>" title="<?php echo $trans->getText('logoName');?>" class="footer-logo" />
		</div>
	</div>
</div>