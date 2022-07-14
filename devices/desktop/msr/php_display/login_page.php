<?php
$link=$wm->getLink($wmPage);
?>
<div class="container">
    <div class="pageTitle"><h1><?php echo $wmPage["Name"];?></h1></div>
    <div class="row breadCrumbs">
        <?php include_once($device.'/php_components/navigator.php');?>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="protectPageText"><?php echo $trans->getText("This page is password protected");?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-6 col-lg-4">
        	<?php if($_POST){?>
				<div class="protectPageError"><?php echo $trans->getText("Login error");?></div>
			<?php }?>

            <form class="loginForm" name="loginForm" method="post" action="<?php echo $link["Link"];?>" style="padding: 0px; margin: 0px;">
				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("Username");?></span>
					<input type="text" name="username" class="form-control registerFormInput" />
				</div>
				<div class="input-group input-group-lg formText">
					<span class="input-group-addon formTextText"><?php echo $trans->getText("Password");?></span>
					<input type="password" name="password" class="form-control registerFormInput" />
				</div>
				<div class="input-group input-group-lg formText PassLoginButton">
					<input type="submit" name="submit" class="btn btn-default btn-lg" value="<?php echo $trans->getText("Login");?>" />
				</div>
			</form>

        </div>
    </div>
</div>





















