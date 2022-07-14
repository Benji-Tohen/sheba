<?php include(dirname(__FILE__).'/../php_components/homepage_banner.php');?>

<div class="clear"></div>

<div class="container marg1_b">
	<div class="row">
		<div class="col-xs-12">
			<div class="breadCrumbsStyle">
				<?php include(dirname(__FILE__).'/../php_components/breadCrumbs.php'); ?>
			</div>

			<h1><?php echo $wmPage["Name"]; ?></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="page-sub-title">
				<?php echo $wmPage["Sub_Title"]; ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="sepLineSection greenLine"></div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="contentItems">
			<?php foreach ($lobiPageItems as $key => $value) {
				$link= $wm->getLink($value);
				?>
				
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<a href="<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>" class="boxItem">
							<div class="boxImage">
								<img src="<?php echo $thumb_call_items.$value["Top_Header"];?>" alt="<?php echo $value["Name"];?>" title="<?php echo $value["Name"];?>" class="boxImageStyle img-responsive">
							</div>

							<div class="boxLabel">
								<?php echo $value["Name"];?>
							</div>
						</a>
					</div>
				
			<?php }?>
			</div>
		</div>
	</div>
    <!-- END PAGE CONTENT -->
</div>