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
			<div class="faq">
			<?php foreach ($pageChildren as $key => $value) {
				$link = $wm->getLink($value);
			?>
				<div class="faq-item">
					<button title="<?php echo $value["h1"];?>" class="faq-question" onclick="toggleItem(this);">
						<span class="faq-q-icon"><i class="fa fa-question" aria-hidden="true"></i></span>
						<span class="faq-q-text"><?php echo $value["h1"];?></span>
					</button>
					<div class="faq-answer">
						<div class="faq-a-title-container">
							<span class="faq-a-icon"><i class="fa fa-info" aria-hidden="true"></i></span>
							<div class="faq-a-title"><?php echo $value["Sub_Title"];?></div>
						</div>
						<div class="faq-a-text"><?php echo $value["Content"];?></div>
					</div>
				</div>
			<?php }?>
			</div>
		</div>
	</div>
    <!-- END PAGE CONTENT -->

    <div class="row">
    	<div class="sepLineSection greenLine"></div>
    </div>
</div>


<?php include(dirname(__FILE__).'/../php_components/articles.php'); ?>