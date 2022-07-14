<?php 
if(!empty($arr_pictures) || $wmPage["Top_Header2"] || $wmPage["Top_Header"]){?>
<div class="regularTextWithGallery">
<?php }else{?>
<div class="regularText">
<?php }?>
	<?php if($wmPage["AddThis"]){?>
		<?php echo $params->getValue("AddThis");?>
	<?php }?>

	<?php if($wmPage["Content"]){?>
		<div class="richtext"><?php echo $wmPage["Content"];?></div>
	<?php }?>

	<div class="price">
		<div class="priceText"><?php echo $trans->getText("Price");?></div>
		<div class="priceNumber"><?php echo $wmPage["price"];?></div>
		<div class="clear"></div>
	</div>

	<div class="addToCart"><?php echo $trans->getText("Add to cart");?></div>

	<?php if($wmPage["wm_forms"]){?>
		<?php if($_POST){?>
			<div class="answerText"><?php echo $wmPage["Answer_Text"];?></div>
		<?php }else{?>
			<form action="<?php $cfg["WM"]["Server"];?>/<?php echo $wm->getAlias($wmPage);?>" method="post">
			<?php echo $htmlFields;?>
			<input type="submit" name="submit" value="<?php echo $trans->getText("Send");?>" />
			</form>
		<?php }?>
	<?php }?>
	<?php include(dirname(__FILE__)."/../php_components/comments.php");?>
	<div class="clear"></div>
</div>


<?php

if(!$wmPage["Top_Header2"] && empty($arr_pictures) && $wmPage["Top_Header"]){
	$wmPage["Top_Header2"]=$wmPage["Top_Header"];
}

if($wmPage["Top_Header2"]){
	//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?w=370&amp;src=";
	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."370"."X".$thumbHeight."/";
?>
<div class="regularPageImage">
	<div class="yoxview">
		<a href="<?php echo $cfg["WM"]["Server"]."/".$wmPage["Top_Header2"];?>"><img src="<?php echo $thumb_call.$wmPage["Top_Header2"];?>" alt="<?php echo $wmPage["Name"]?>" title="<?php echo $wmPage["Name"]?>" class="storeImage" /></a>
	</div>
</div>
<?php 
}elseif(!empty($arr_pictures)){
	$thumbWidth=$params->getValue("gallery_thumb_width");
	$thumbHeight=$params->getValue("gallery_thumb_height");
	//$image_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?w=1000&amp;h=1000&amp;src=";
	$image_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."1000"."X"."1000"."/";
	//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=$thumbWidth&amp;h=$thumbHeight&amp;src=";//&aoe=1
	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/".$thumbWidth."X".$thumbHeight."/zcX1/";
	$first_image=$arr_pictures[0];
	?>


<div class="regularGallery">

	<div class="regularGalleryTop regularGalleryBg"></div>
	<div class="yoxview">
	<?php for($i=0;$i<count($arr_pictures);$i++){
			if(file_exists($arr_pictures[$i]["File_Name"])){
				if($arr_pictures[$i]["Code"]){
					$link=$arr_pictures[$i]["Code"];
				}else{
					$link=$cfg["WM"]["Server"]."/".$arr_pictures[$i]["File_Name"];					
				}
	?>
	    			<a href="<?php echo $link;?>"><img src="<?php echo $thumb_call.$arr_pictures[$i]["File_Name"];?>" alt="<?php echo $string->htmlentities($arr_pictures[$i]["Name"]);?>" title="<?php echo $string->htmlentities($arr_pictures[$i]["Name"]);?>" class="storeImage" /></a>
				<div class="galleryItemTitle"><?php echo $arr_pictures[$i]["Name"];?></div>
				<div class="galleryItemText"><?php echo nl2br($arr_pictures[$i]["Content"]);?></div>

	<?php }}?>
		<div class="clear"></div>
	</div>
	<div class="regularGalleryBottom regularGalleryBg"></div>
</div>
<?php }?>

