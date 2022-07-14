<?php if(!empty($homepageBanners)){?>
<div class="homepageBanners slickCarousel hidden-xs">
	<?php foreach ($homepageBanners as $key => $banner) { ?>
		<?php if($banner['Code']){ ?>
		<a href="<?php echo $banner['Code'];?>" title="<?php echo $banner['Name'];?>" class="bannerItem" style="background-image: url(<?php echo $thumb_call_banner.$banner['File_Name'];?>);">
			<div class="banner-item-content">
				<span class="banner-item-content-first"><?php echo $banner['Content'];?></span><span class="banner-item-content-second"><?php echo " ".$banner['Contant2'];?></span>
			</div>
		</a>
		<?php } else {?>
		<div class="bannerItem" style="background-image: url(<?php echo $thumb_call_banner.$banner['File_Name'];?>);">
			<div class="banner-item-content">
				<span class="banner-item-content-first"><?php echo $banner['Content'];?></span><span class="banner-item-content-second"><?php echo " ".$banner['Contant2'];?></span>
			</div>
		</div>
		<?php }?>

		<?php /*
		<div class="bannerText">
			<div class="absoluteCenter">
				<div class="container">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<div class="bannerTextBox">
							<h1><?php echo $banner['Name'];?></h1>
							<div class="bannerSubtitle"><?php echo $banner['Content'];?></div>

							<a href="<?php echo $banner['Code'];?>" class="defaultBtn ts bannerBtn" title="<?php echo $trans->getText('yashir_home_banner_click_here');?>"><?php echo $trans->getText('yashir_home_banner_click_here');?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		*/ ?>

	<?php }?>
</div>
<?php }?>

<?php if($wmPage["Top_Header3"]){ ?>
<div class="hidden-sm hidden-md hidden-lg">
	<div class="homepageImage">
		<img src="<?php echo $wmPage["Top_Header3"];?>" class="img-responsive page-header-img">
	</div>
</div>
<?php } ?>