<?php if($arrSlider){?>

<div class="regularGallery">
	<?php
		if(is_array($arrSlider) && count($arrSlider)){
			//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&w=70&h=70&src=";
			$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."70"."X"."70"."/zcX1/";
			//$image_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&w=540&h=330&src=../../";
			$image_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."540"."X"."330"."/zcX1/";
			$first_image=$arrSlider[0];
			?>
			<div class="yoxview">
				<div id="previewGallery">
					<div id="previewImage"><!--Replace on click-->
						<a href="<?php echo (strlen($arrSlider[0]["Code"])) ? $arrSlider[0]["Code"]."&width=540&height=330" : $cfg["WM"]["Server"]."/".$arrSlider[0]["File_Name"];?>" <?php if(strlen($arrSlider[0]["Code"])) echo "target='yoxview'";?>>
							<img src="<?php echo $image_call.$arrSlider[0]["File_Name"];?>" class="galleryPreviewImage" />
						</a>
					</div>
						<?php foreach ($arrSlider as $key => $item){ if ($key!=0){?>
							<a href="<?php echo (strlen($item["Code"])) ? $item["Code"]."&width=540&height=330" : $cfg["WM"]["Server"]."/".$item["File_Name"];?>" <?php if(strlen($item["Code"])) echo "target='yoxview'";?> class="galleryHiddenImage">
								<img src="<?php echo $image_call.$item["File_Name"];?>" />
							</a>
						<?php }}?>
				</div>
			</div>
<?php if (count($arrSlider) > 1){?>
<div class="sliderWrapperRelative">
    <div id="regularSlider">
        <div title="&lt;div class='sliderItemDot'&gt;1&lt;/div&gt;" class="slider3Items" onmouseover="this.title='';">
			<?php 
			$numOfThumbs = 6;
			for($itemIndex=0, $j=2, $i=0;$i<(count($arrSlider)+($numOfThumbs-count($arrSlider)%$numOfThumbs));$i++){
				$item=$arrSlider[$itemIndex];
			    $link=$item["Code"];
			    if($i>0 && ($i%$numOfThumbs==0)) { 
					?>
		        </div>
			<div title="&lt;div class='sliderItemDot'&gt;<?php echo $j++;?>&lt;/div&gt;" class="slider3Items" onmouseover="this.title='';">
		    <?php 
			} ?>
            <div class="sliderItem">
    <?php if($item["File_Name"]){

	if(!in_array($item["File_Name"], $arrAdded)){
		array_push($arrAdded, $item["File_Name"]);
	}
	?>
            <div class="homeSliderItemImage">
                <img src="<?php echo $thumb_call.$item["File_Name"];?>" alt="<?php echo $item["ID"];?>" title="<?php echo $string->htmlentities($item["Name"]);?>" class="sliderImage" />
            </div>
    <?php }?>
            <div class="clear"></div>
        </div>
    <?php
    if($i==count($arrSlider)-1){
            $itemIndex=0;
    }else{
            $itemIndex++;			
    }        
}
?>




        </div>
    </div>
</div>
	<?php }?>
	<?php }?>
</div>
<?php }?>
