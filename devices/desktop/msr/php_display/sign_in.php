<?php require_once(dirname(__FILE__)."/../php_components/news_text.php");?>
<?php
$link=$wm->getLink($wmPage);
?>
<?php if($_POST){?>
	<div class="protectPageError"><?php echo $trans->getText("Login error");?></div>
<?php }?>


<form class="loginForm" name="loginForm" method="post" action="<?php echo $link["Link"];?>">
	<div class="loginField">
		<div class="loginFieldText"><?php echo $trans->getText("Username");?></div>
		<input type="text" name="username" class="login_form_menu_input" dir="ltr" />
	</div>
	<div class="loginField">
		<div class="loginFieldText"><?php echo $trans->getText("Password");?></div>
		<input type="password" name="password" class="login_form_menu_input" dir="ltr" />
	</div>
	<div class="loginField">
		<input type="submit" name="submit" class="inputButtonLogin" value="<?php echo $trans->getText("Login");?>" />
	</div>
</form>
