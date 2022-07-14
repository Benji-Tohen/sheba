
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="bannerImg">
				<img src="<?php echo $thumb_call_banner.$wmPage["Top_Header3"]; ?>" alt="<?php echo $wmPage["Top_Header3_Alt"]; ?>" title="<?php echo $wmPage["Top_Header3_Alt"]; ?>" class="img-responsive yashirBanner">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="headLineH1"><h1> <?php echo $wmPage["Name"]; ?> </h1></div>
			<div class="breadCrumbsStyle">
				<!-- BREADCRUMBS -->
				<?php
				   include(dirname(__FILE__).'/../php_components/breadCrumbs.php');
				?>
				<!-- END BREADCRUMBS -->
			</div>
			<div class="greyLine"></div>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="row">
		<div class="col-xs-12">
			<div class="headLineH2">
				<h2><?php echo $wmPage["Sub_Title"]; ?></h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="textSection"><?php echo $wmPage["Content"]; ?> </div>
		</div>
 
		<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
			<div class="sideGallery">
				<?php foreach ($yashirSideGallery as $key => $value) { 	$link= $wm->getLink($value); ?>
					<a href=""<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>" title="<?php echo $value["Name"];?>">
						<img src="<?php echo $thumb_call_slick.$value["File_Name"];?>" alt="<?php echo $value["Name"];?>" class="img-responsive galleryImg" />
					</a>
				<?php }?>
			</div>
		</div>
	</div>
</div>