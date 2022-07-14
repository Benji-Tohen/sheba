<?php if($wmPage["Top_Header2"]){ ?>
<div class="page-header-img" style="background-image: url(<?php echo $thumb_inner_img.$wmPage["Top_Header2"];?>)"></div>
<?php }?>

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
		<div class="col-xs-12 col-sm-12 <?php echo (empty($sideGallery)) ? 'col-md-12 col-lg-12' : 'col-md-8 col-lg-8' ?>">
			<div class="page-content">
				<?php echo $wmPage["Content"]; ?>
			</div>
		</div>

		<?php if(!empty($sideGallery)){ ?>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<div class="sideGallery">
				<?php foreach ($sideGallery as $key => $value) { 	$link= $wm->getLink($value); ?>
					<a href="<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>" title="<?php echo $value["Name"];?>">
						<img src="<?php echo $thumb_call_slick.$value["File_Name"];?>" alt="<?php echo $value["Name"];?>" class="img-responsive galleryImg" />
					</a>
				<?php }?>
			</div>
		</div>
		<?php }?>
	</div>
</div>