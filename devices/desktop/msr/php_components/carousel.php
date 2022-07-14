<?php if($arrCarousel){?>

<div class="carousel">
	<div class="sliderWrapperRelative">
	    <div id="carouselSlider">
	        <div class="slider5Items">
				<?php 
				$numOfThumbs = 5;
				for($itemIndex=0, $i=0;$i<(count($arrCarousel)+($numOfThumbs-count($arrCarousel)%$numOfThumbs));$i++){
					$item=$arrCarousel[$itemIndex];
				    $link=$wm->getLink($item);
				    if($i>0 && ($i%$numOfThumbs==0)) { 
						?>
			        </div>
				<div  class="slider5Items">
			    <?php 
				} ?>
	            <?php if ($i%$numOfThumbs){?>
	            <div class="carouselMargin"><!----></div>
	            <?php }?>
	            <div class="sliderItem">
	    <?php if($item["Top_Header"]){

		if(!in_array($item["Top_Header"], $arrAdded)){
			array_push($arrAdded, $item["Top_Header"]);
		}
		?>
	            <div class="sliderItemImage">
	            	<a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>">
	                	<img src="<?php echo $carousel_call.$item["Top_Header"];?>" alt="<?php echo $item["ID"];?>" title="<?php echo $string->htmlentities($item["Name"]);?>" class="sliderImage" />
	                </a>
	            </div>
	    <?php }?>
	            <div class="clear"></div>
	        </div>
	    <?php
	    if($i==count($arrCarousel)-2){
	            $itemIndex=0;
	    }else{
	            $itemIndex++;			
	    }        
	}
	?>
	<div class="clear"><!----></div>
</div>
        </div>
        <div class="clear"><!----></div>
    </div>
    <div class="clear"><!----></div>
</div>
<div class="clear"><!----></div>
	<?php }?>
