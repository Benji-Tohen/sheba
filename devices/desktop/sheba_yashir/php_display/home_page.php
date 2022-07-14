<?php include(dirname(__FILE__).'/../php_components/homepage_banner.php');?>

<div class="clear"></div>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php include(dirname(__FILE__).'/../php_components/homepage_items.php');?>
			<div class="clear"></div>
			<div class="sepLine"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 top-right">
			<h2><?php echo $trans->getText('yashir_translation_01');?></h2>
			<?php
				$namespace = "topRightSlide";
				$homepageSliderArr = $arrHomeEventsRelated;
				$shebaDomain = "https://www.sheba.co.il";
				include(dirname(__FILE__).'/../php_components/homepage_slider.php');
				$shebaDomain = "";
			?>
			
			<?php /*
			<a href="<?php echo $eventsPageLink['Link'];?>" title="<?php echo $trans->getText('Go to all events');?>" class="moreButton">
				<?php echo $trans->getText('Go to all events');?>&nbsp;&nbsp;
				<i class="fa fa-chevron-left color2"></i>
			</a>
			*/?>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2><?php echo $trans->getText('yashir_translation_02');?></h2>
			<?php
				$namespace = "topLeftSlide";
				$homepageSliderArr = $ticker02;
				include(dirname(__FILE__).'/../php_components/homepage_slider.php');
			?>
		</div>
		<div class="clear"></div>
		<div class="sepLine"></div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2><?php echo $trans->getText('yashir_translation_03');?></h2>
			<?php
				$namespace = "bottomRightSlide";
				$homepageSliderArr = $ticker03;
				include(dirname(__FILE__).'/../php_components/homepage_slider.php');
			?>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<h2><?php echo $trans->getText('yashir_translation_04');?></h2>
			<?php
				$namespace = "bottomLeftSlide";
				$homepageSliderArr = $ticker04;
				include(dirname(__FILE__).'/../php_components/homepage_slider.php');
			?>
		</div>
		<div class="clear"></div>
		<div class="sepLine"></div>
	</div>

	<div class="row homepageBottomBanners">
		<?php include(dirname(__FILE__).'/../php_components/homepage_bottom_banners.php');?>
	</div>
</div>