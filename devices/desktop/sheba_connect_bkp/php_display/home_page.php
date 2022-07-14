<?php include(dirname(__FILE__).'/../php_components/homepage_banner.php');?>

<div class="clear"></div>

<div class="container">
	<?php if(!empty($ticker01)){ ?>
	<div class="row">
		<div class="col-xs-12">
			<h1><?php echo $wmPage["h1"];?></h1>
			<div class="home-subtitle">
				<?php echo $wmPage["Sub_Title"];?>
			</div>
			<?php
				$namespace = "firstCarousel";
				$homepageSliderArr = $ticker01;
				$stringLength = 27;
				$thumb_call_slide = $cfg["WM"]["Server"]."/webfiles/images/cache/100X100/zcX1/";
				$shebaDomain = "https://www.sheba.co.il";
				include(dirname(__FILE__).'/../php_components/homepage_slider.php');
				$shebaDomain = "";
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="sepLineSection greenLine"></div>
		</div>
	</div>
	<?php }?>

	<?php if(!empty($ticker02)){ ?>
	<div class="row">
		<div class="col-xs-12">
			<h2><?php echo $trans->getText('connect_translation_02');?></h2>
			<?php
				$namespace = "secondCarousel";
				$homepageSliderArr = $ticker02;
				$stringLength = 16;
				$thumb_call_slide = $cfg["WM"]["Server"]."/webfiles/images/cache/80X80/zcX1/";
				$shebaDomain = "https://www.sheba.co.il";
				include(dirname(__FILE__).'/../php_components/homepage_slider.php');
				$shebaDomain = "";
			?>
		</div>
	</div>
	<?php }?>
</div>

<div class="bannerSection">
	<?php include(dirname(__FILE__).'/../php_components/homepage_items.php'); ?>
</div>


<?php include(dirname(__FILE__).'/../php_components/articles.php'); ?>