<div class="homepageBanners slickCarousel">
	<?php foreach ($homepageBanners as $key => $banner) {?>
	<div class="bannerItem">
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

		<div class="bannerImg" style="background-image: url(<?php echo $thumb_call_banner.$banner['File_Name'];?>);">
			
		</div>
	</div>
	<?php }?>
</div>