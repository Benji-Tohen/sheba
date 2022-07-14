<?php if(!empty($arr_pictures) || $wmPage["Top_Header2"]){?>
<div class="regularTextWithGallery">
<?php }else{?>
<div class="regularText">
<?php }?>


	<div class="formArea">
	<?php if((isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]) || (isset($getParams[1]) && $getParams[1]=="POST")){?>
		<div class="richtext"><?php echo $errorText?$errorText:$wmPage["Answer_Text"];?></div>
		<?php echo $wmPage["Conversion"];?>
	<?php }else{
?>
	<?php if($wmPage["Content"]){?>
		<div class="richtext"><?php echo $wmPage["Content"];?></div>
	<?php }?>

	<div class="subtotalInfo"><?php echo $trans->getText("Subtotal");?> <div class="subTotalNumberInfo"><div class="subTotalNumberNumber"><?php echo number_format($orderSum, 2);?></div> <?php echo $trans->getText("currencySign");?></div></div>
<?php
		$loginUser=	$siteUsers->getCurrentUser();
		$user=		$siteUsers->getValues($loginUser);

		if(strpos($user["First_Name"], "Ano")===false && strpos($user["Email"], "twitter")===false && strpos($user["Email"], "linkedin")===false){
			
		}else{
			$user=NULL;	
		}


		if($loginUser && !$siteUsers->isAnonymousUser()){
			$address=$store->getLastOrderData($loginUser);
		}else{
			$address=array();
		}


		
	?>
			<form action="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$id;?>/POST" method="post" name="contactForm" style="padding: 0px; margin: 0px;" onsubmit="return checkFormContact();">

			<div class="formTitle"><?php echo $trans->getText("Personal Info");?></div>
			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("First Name");?>:</div>
				<input name="First_Name" type="text" id="First_Name" size="50" class="inputText" value="<?php echo $user["First_Name"];?>" />
				<div style="clear: both;"></div>
			</div>

			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("Last Name");?>:</div>
				<input name="Last_Name" type="text" id="Last_Name" size="50" class="inputText" value="<?php echo $user["Last_Name"];?>" />
				<div style="clear: both;"></div>
			</div>

			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("Phone");?>:</div>
				<input name="Phone" type="text" id="Phone" size="50" class="inputText" dir="ltr" value="<?php echo $user["Phone"];?>" />
				<div style="clear: both;"></div>
			</div>
	
			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("Email");?>:</div>
				<input name="Email" type="text" id="Email" size="50" class="inputText" dir="ltr" value="<?php echo $user["Email"];?>" />
				<div style="clear: both;"></div>
			</div>


			<div class="formTitle"><?php echo $trans->getText("Shipping Details");?></div>
			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("Shipping Name");?>:</div>
				<input name="shipping_address_name" type="text" id="shipping_address_name" size="50" class="inputText" value="<?php echo $address["shipping_address_name"];?>" />
				<div style="clear: both;"></div>
			</div>
			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("Address");?>:</div>
				<input name="shipping_address_line1" type="text" id="shipping_address_line1" size="50" class="inputText" value="<?php echo $address["shipping_address_line1"];?>" />
				<div style="clear: both;"></div>
			</div>
			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("City");?>:</div>
				<input name="shipping_address_city" type="text" id="shipping_address_city" size="50" class="inputText" value="<?php echo $address["shipping_address_city"];?>" />
				<div style="clear: both;"></div>
			</div>
			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("Zip Code");?>:</div>
				<input name="shipping_address_zip" type="text" id="shipping_address_zip" size="50" class="inputText" value="<?php echo $address["shipping_address_zip"];?>" />
				<div style="clear: both;"></div>
			</div>

<?php if($siteUsers->isAnonymousUser()){?>
			<div class="formTitle"><?php echo $trans->getText("Login Info");?></div>
			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("Password");?>:</div>
				<input name="Password" type="password" id="Password" size="50" class="inputText" dir="ltr" />
				<div style="clear: both;"></div>
			</div>

			<div class="formText">
				<div class="formTextText"><?php echo $trans->getText("PasswordValidate");?>:</div>
				<input name="PasswordValidate" type="password" id="PasswordValidate" size="50" class="inputText" dir="ltr" />
				<div style="clear: both;"></div>
			</div>
<?php }?>
			<div class="formCheckbox">
				<input type="checkbox" name="SendMail" value="1" checked /> <?php echo $trans->getText("Enable Mail");?>
			</div>

			<input type="submit" name="submit" class="inputButton" value="<?php echo $trans->getText("Send");?>" />
			<input type="hidden" name="hidden_Submit" value="1" />
<!--
			<div class="formText" style="width: 360px; margin-top: 5px;">
				<input type="submit" name="submit" value="<?php echo $trans->getText("Send");?>" />
			</div>
-->
			<div style="clear: both;"></div>
			</form>

	<?php }?>
	</div>
	<?php include('site/php_components/comments.php');?>
	<div class="clear"></div>
</div>


<?php
if($wmPage["Top_Header2"]){
	//$thumb_call=$cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?w=370&amp;src=";
	$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."370"."X".$thumbHeight."/";
?>
<div class="regularPageImage">
	<div class="yoxview">
		<a href="<?php echo $cfg["WM"]["Server"]."/".$wmPage["Top_Header2"];?>"><img src="<?php echo $thumb_call.$wmPage["Top_Header2"];?>" alt="<?php echo $wmPage["Name"]?>" title="<?php echo $wmPage["Name"]?>" /></a>
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
	    			<a href="<?php echo $link;?>"><img src="<?php echo $image_call.$arr_pictures[$i]["File_Name"];?>" alt="<?php echo $string->htmlentities($arr_pictures[$i]["Name"]);?>" title="<?php echo $string->htmlentities($arr_pictures[$i]["Name"]);?>" /></a>
				<div class="galleryItemTitle"><?php echo $arr_pictures[$i]["Name"];?></div>
				<div class="galleryItemText"><?php echo nl2br($arr_pictures[$i]["Content"]);?></div>

	<?php }}?>
		<div class="clear"></div>
	</div>
	<div class="regularGalleryBottom regularGalleryBg"></div>
</div>
<?php }?>
































