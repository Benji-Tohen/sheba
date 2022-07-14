<?php

$login->logoutUser();
$lpusers->logoutUser();
$ipb = new ipblock($db, $cfg);				// loaded at config
if (!$ipb->is_ip_allowed()) $ipb->show_block_page();	// if IP is blocked - deny access to site
if($_POST){

	$userEmail=$_POST["Username"];

	if($lpusers->loginUser($_POST["Username"], $_POST["Password"])){
		$_POST["Username"]="client";
		$_POST["Password"]="client123";
	}


	if($login->loginUser($_POST["Username"], $_POST["Password"])){
                if ($_SESSION["User_Data"]["password_time"]) {                  // if password time exists ..
                    $now_time = time();
                    $password_time = $_SESSION["User_Data"]["password_time"];
                    if ($now_time - $password_time > 86400*90) {                // if 90 days have passed since last password
                        $login->replacePassword();
			header('location: '.$cfg["WM"]["Server"].'/manage/gui/index.php?show=change_pass');
			exit;
                    }
                }
		$ipb->remove_ip_block();		// if user logs in, cancel the block or any suspicious log
		$log->write("User '".$_POST["Username"]."' ".$userEmail." logged in", "login");
		if($_REQUEST["se"]){
			header('location: '.$cfg["WM"]["Server"]);
			exit;
		}else{
			header('location: '.$cfg["WM"]["Server"].'/index.php?show=main');
			exit;
		}
	}else{
                $log->write("User '".$_POST["Username"]."' login attempt failed from address {$_SERVER['REMOTE_ADDR']}", "login_failed");
		$ipb->trigger_suspicious_action();	// trigger suspicious activity for block

	}
}
?>
<?php require_once('common/header.php');?>
<script type="text/javascript">
if(top===self){
}else{
	top.location=window.location.href;
}
</script>
<style type="text/css">
input{
	width: 150px;
	height: 24px;
	font-size: 20px;
}
.login_box{
	margin: 0px;
	font-size: 24px;
	font-weight: bold;
	border: 1px solid #c0c0c0;
	padding: 20px;
	width: 250px;
}
</style>
</head>
<body dir="<?php echo $gui->getDir();?>" onLoad="if(top.menu){top.menu.location=top.menu.location;}">
<center>
<br /><br /><br />
<img src="images/tmlogo.png" border="0" />
<div class="login_box">
<div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;"><?php echo $text["Login page title"];?></div>
<div style="font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #ff0000; height: 15px;">
<?php if($_POST){?>
	<?php echo $text["Incorrect name or password"];?>
<?php }?>
</div>
<form action="index.php" name="edit" method="post" enctype="multipart/form-data" style="padding: 0px; margin: 0px;">
<input type="hidden" name="se" value="<?php echo $_REQUEST["se"];?>" />
<table cellpadding="0" cellspacing="0">
	<tr>
		<td><?php echo $text["Username"];?>:&nbsp;</td>
		<td><input type="text" name="Username" dir="ltr" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Password"];?>:&nbsp;</td>
		<td><input type="password" name="Password" dir="ltr" /></td>		
	</tr>
	<tr>
		<td></td>
		<td align="<?php echo $gui->getRight();?>"><input style="width: 80px; height: 30px; border: 1px solid #000000; background-color: #ffffff; cursor: pointer; font-weight: bold; font-size: 18px;" type="Submit" name="Submit" value="<?php echo $text["Login"];?>" /></td>		
	</tr>
</table>
</form>
</div>
<br />
<div style="font-size: 10px; color: #ffffff;"><?php echo $_SERVER["SERVER_ADDR"];?></div>

</center>
<script language="javascript" type="text/javascript">
document.edit.Username.focus();
</script>
