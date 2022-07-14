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

	<?php foreach ($lobiPageItems as $key => $value) {
		$link= $wm->getLink($value);
		?>
		<div class="row page-child-item">
			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<a href="<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>" class="boxItem">
					<div class="boxImage">
						<img src="<?php echo $thumb_call_items.$value["Top_Header"];?>" alt="<?php echo $value["Name"];?>" title="<?php echo $value["Name"];?>" class="boxImageStyle img-responsive">
					</div>
					<span class="article-item-line"></span>
				</a>
			</div>

			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<a href="<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>" class="boxItem">
					<div class="item-title"><?php echo $value["Name"];?></div>
					<?php /*
					<div class="item-date"><?php echo $value["Start_Date"];?></div>
					*/ ?>
					<div class="item-sub-title"><?php echo $value["Sub_Title"];?></div>
				</a>
			</div>
		</div>
	<?php }?>
    <!-- END PAGE CONTENT -->
</div>