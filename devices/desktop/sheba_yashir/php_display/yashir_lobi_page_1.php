<div class="container marg1_b">
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

	<div class="row">
		<div class="col-xs-12">
			<div class="headLineH2">
				<h2><?php echo $wmPage["Sub_Title"]; ?></h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
			<div class="textSection"><?php echo $wmPage["Content"];?></div>
		</div>
	</div>
	
	<div class="clear"></div>

	<?php foreach ($lobiPageItems as $key => $value) {
		$link= $wm->getLink($value);
		?>
		<div class="row itemWrap">
			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
				<a href="<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>">
					<img src="<?php echo $value["Top_Header"];?>" alt="<?php echo $value["Name"];?>" title="<?php echo $value["Name"];?>" class="img-responsive itemImg">
				</a>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<a href="<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>">
					<div class="itemTitle">
						<?php echo $value["Name"];?>
					</div>

					<div class="itemSubtitle">
						<?php echo $value["Sub_Title"];?>
					</div>
				</a>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
				<a href="<?php echo $link['Link']; ?>" target="<?php echo $link['Target']; ?>" class="itemDate">
					<?php echo $value["Start_Date"];?>
				</a>
			</div>
		</div>
	<?php }?>
</div> 