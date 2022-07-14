<?php
$arrSlider=	$wm->getTickerContent(NULL, NULL, "Ordering", $wmPage["Lang"]);
$thumbWidth=	$params->getValue("slider_image_width");
$thumbHeight=	$params->getValue("slider_image_height");
$thumb_call=	$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=$thumbWidth&amp;h=$thumbHeight&amp;src=";
?>
<div class="sliderWrapperRelative">
		<div id="slider">
			<div title="&lt;div class='sliderItemDot'&gt;1&lt;/div&gt;" class="slider4Items" onmouseover="this.title='';">
			<?php 

for($itemIndex=0, $j=2, $i=0;$i<(count($arrSlider)+count($arrSlider)%4);$i++){?>
			<?php
				


				$item=$arrSlider[$itemIndex];
				$link=$wm->getLink($item);
					if($i>0 && ($i%4==0)){
						echo "</div>";
			?>
						<div title="&lt;div class='sliderItemDot'&gt;<?php echo $j++;?>&lt;/div&gt;" class="slider4Items" onmouseover="this.title='';">
			<?php
					}
			?>
					<div class="sliderItem" onclick="<?php

if($link["Target"]=="_self"){?>
	document.location='<?php echo $link["Link"];?>';
<?php }else{?>
	window.open('<?php echo $link["Link"];?>');
<?php }?>">
						<?php if($item["Top_Header"]){?>
							<div class="homeSliderItemImage"><?php echo $itemIndex;?>
								<img src="<?php echo $thumb_call.$item["Top_Header"];?>" alt="<?php echo $string->htmlentities($item["Name"]);?>" title="<?php echo $string->htmlentities($item["Name"]);?>" />
							</div>
						<?php }?>
						<div class="sliderTextInner">
							<div class="sliderItemTextInner">
								<div class="sliderItemTextTitle"><a href="<?php echo $link["Link"];?>" title="<?php echo $item["Name"];?>"><?php echo $item["Name"];?></a></div>
								<div class="sliderItemTextSubTitle"><?php echo nl2br($string->shorten($item["Sub_Title"], 90));?></div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
<?php
				if($i==count($arrSlider)-1){
					$itemIndex=0;
				}else{
					$itemIndex++;			
				}
?>

			<?php }?>



			</div>
		</div>
</div>
