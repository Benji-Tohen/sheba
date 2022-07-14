<?php
require_once("classes/phpmailer/class.send_mail.php");
require_once('classes/phpmailer/sendmail.php');


require_once('classes/content_management/class.content_updater.php');
require_once('classes/site_users/class.site_users.php');
require_once('classes/store/class.store_users.php');
$siteUsers=new StoreUsers($db, "wm_siteusers");





$user_id=NULL;

$userAllowed=false;

if($siteUsers->getCurrentUser()){
	$userAllowed=true;
}

if(!$siteUsers->getCurrentUser()){
	$userAllowed=true;

	if($_POST["hidden_tmp"]){
		$userTmpCode=$_POST["hidden_tmp"];
	}elseif($getParams[2]){
		$userTmpCode=$getParams[2];
	}
	
	$user_id=$su->isExistsText("password_reset_code", md5($userTmpCode));
	if(!$user_id){
		header("location: ".$cfg["WM"]["Server"]."/noPermission");
		exit;	
	}
}

if(!$userAllowed){
	header("location: ".$cfg["WM"]["Server"]."/noPermission");
	exit;
}


if(!$user_id){
	$user_id=$siteUsers->getCurrentUser();
}


if($_POST["hidden_Submit"] && $userAllowed){		//	use $_POST or $_GET

	if(!$siteUsers->getCurrentUser() && $user_id){
		$user_id=$su->isExistsText("password_reset_code", md5($userTmpCode));
		$siteUsers->setValue($user_id, "password_reset_code", "");
	}

	$siteUsers->setValue($user_id, "Password", md5($_POST["Password"]));

}
?>
