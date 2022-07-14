<div class="<?php echo $namespace;?> homepageSlider">
	<?php foreach ($homepageSliderArr as $key => $slide) {
		if(false){
			$link = array();
			$pageIdOrAlias = ($slide["Alias"]) ? $slide["Alias"] : $slide["ID"];
			$link["Link"] = $shebaDomain."/".$pageIdOrAlias;
			$link["Target"] = "_blank";
		} else {
			$link = $wm->getLink($slide);
		}
	?>
	<a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>" title="<?php echo $slide['Name'];?>" class="slideItem">
		<?php if(false && isset($slide["Start_Date"])){?>
			<div class="slideDate"><?php echo $slide["Start_Date"];?></div>
		<?php }?>
		<img src="<?php echo $thumb_call_slide.$slide['Top_Header'];?>" alt="<?php echo $slide['Name'];?>" class="img-responsive" />
		<div class="slideName"><?php echo $string->shorten($slide['Name'], $stringLength, false);?></div>
	</a>
	<?php }?>
</div>
