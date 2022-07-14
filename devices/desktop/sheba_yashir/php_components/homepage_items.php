<div class="homepageItems">
	<?php foreach ($homepageItemsArr as $key => $homeItem) {
		$link = $wm->getLink($homeItem);
	?>
		<a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>" title="<?php echo $homeItem['Name'];?>" class="homepageItem">
			<?php if($homeItem['Top_Header']){?>
				<img src="<?php echo $homeItem['Top_Header'];?>" alt="<?php echo $homeItem['Name'];?>" />
			<?php }?>

			<div class="homepageItemTitle"><?php echo $homeItem['Name'];?></div>
		</a>
	<?php }?>
</div>