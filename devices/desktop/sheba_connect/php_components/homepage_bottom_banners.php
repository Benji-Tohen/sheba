<?php foreach ($homepageBottomBannersArr as $key => $banner) {
	$link = $wm->getLink($banner);
?>
<div class="col-12 col-sm-6 col-md-3 col-lg-3">
	<a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>" title="<?php echo $banner['Name'];?>" class="bottomBannerItem">
		<img src="<?php echo $thumb_call_banners.$banner['Top_Header'];?>" alt="<?php echo $banner['Name'];?>" />
	</a>
</div>
<?php }?>