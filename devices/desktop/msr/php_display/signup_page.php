<div class="container">
    <div class="pageTitle"><h1><?php echo $wmPage["Name"];?></h1></div>
    <div class="row breadCrumbs">
        <?php include_once($device.'/php_components/navigator.php');?>
    </div>
    <?php if($wmPage["Top_Header2"]){?>
    <div class="row">
        <div class="col-xs-12 bigImgCont">
            <img src="<?php echo $cfg["WM"]["Server"].'/'.$wmPage["Top_Header2"];?>" class="img-responsive" alt="<?php echo $wmPage["Name"];?>"/>
        </div>
    </div>
    <?php }?>
	
	<?php if($wmPage["Content"]){?>
    <div class="row">
        <div class="col-xs-12 col-md-5 col-lg-5 formContentDiv">
             <?php echo $wmPage["Content"];?>
        </div>
    </div>
	<?php }?>

	<div class="row">
		<div class="col-xs-12 col-md-6 col-lg-4">
			<?php if((isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]) || (isset($getParams[1]) && $getParams[1]=="POST")){?>
				<div class="richtext answerText"><?php echo $errorText?$errorText:$wmPage["Answer_Text"];?></div>
				<?php echo $wmPage["Conversion"];?>
			<?php }else{

				$loginUser=	$siteUsers->getCurrentUser();
				$user=		$siteUsers->getValues($loginUser);
				if(strpos($user["First_Name"], "Ano")===false && strpos($user["Email"], "tohen-media")===false && strpos($user["Email"], "twitter")===false && strpos($user["Email"], "linkedin")===false){
					
				}else{
					$user=NULL;
				}
			?>
			<form action="<?php echo $cfg["WM"]["Server"];?>/<?php echo $wmPage["Alias"]?$wmPage["Alias"]:$id;?>/POST" method="post" name="contactForm" style="padding: 0px; margin: 0px;" onsubmit="return checkFormContact();">
				<div class="formTitle"><?php echo $trans->getText("Personal Info");?></div>
				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("First Name");?></span>
					<input name="First_Name" type="text" id="First_Name" size="50" class="form-control registerFormInput" value="<?php echo $user["First_Name"];?>" />
					<div style="clear: both;"></div>
				</div>

				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("Last Name");?></span>
					<input name="Last_Name" type="text" id="Last_Name" size="50" class="form-control registerFormInput" value="<?php echo $user["Last_Name"];?>" />
					<div style="clear: both;"></div>
				</div>

				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("Phone");?></span>
					<input name="Phone" type="text" id="Phone" size="50" class="form-control registerFormInput" dir="ltr" value="<?php echo $user["Phone"];?>" />
					<div style="clear: both;"></div>
				</div>

				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("Email");?></span>
					<input name="Email" type="text" id="Email" size="50" class="form-control registerFormInput" dir="ltr" value="<?php echo $user["Email"];?>" />
					<div style="clear: both;"></div>
				</div>

				<div class="formTitle"><?php echo $trans->getText("Login Info");?></div>
				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("Password");?></span>
					<input name="Password" type="password" id="Password" size="50" class="form-control registerFormInput" dir="ltr" />
					<div style="clear: both;"></div>
				</div>

				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("PasswordValidate");?></span>
					<input name="PasswordValidate" type="password" id="PasswordValidate" size="50" class="form-control registerFormInput" dir="ltr" />
					<div style="clear: both;"></div>
				</div>

				<div class="formCheckbox">
					<input type="checkbox" name="SendMail" value="1" checked /> <?php echo $trans->getText("Enable Mail");?>
				</div>

				<input type="submit" name="submit" class="inputButton" value="<?php echo $trans->getText("Send");?>" />
				<input type="hidden" name="hidden_Submit" value="1" />

				<div style="clear: both;"></div>
			</form>

			<?php }?>
		</div>

		<?php if($wmPage["Content_Center"]){?>
        <div class="col-xs-12 col-md-6 col-lg-7 col-lg-offset-1 registerPageContentCenter">
             <?php echo $wmPage["Content_Center"];?>
        </div>
		<?php }?>
	</div>
</div>

<div class="clear"></div>
