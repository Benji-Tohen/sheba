<?php if($wmPage["Video_Embed"]){?>
	<?php include 'site/php_components/video_embed.php';?>
	<div class="greenText" style="margin-top: 5px; padding-right: 5px;"><?php echo $wmPage["Video_Text"];?></div>
	<div class="leftContentSpace"></div>
<?php }?>
<?php if($wmPage["Top_Header"]){
	$left_thumb_call="classes/thumb/phpThumb.php?w=336&src=../../";
?>
	<img class="innerPageLeftImage" src="<?php echo $left_thumb_call.$wmPage["Top_Header"];?>" border="0" alt="" />
	<div class="greenText" style="margin-top: 5px; padding-right: 5px;"><?php echo $wmPage["Image_Text"];?></div>	
<?php }?>