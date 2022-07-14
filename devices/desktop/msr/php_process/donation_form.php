<?php
$arr_pictures=$wm->getGalleryItems($id);
$link=$wm->getLink($wmPage);

require_once("classes/phpmailer/class.send_mail.php");
require_once('classes/phpmailer/sendmail.php');


if(isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]){		//	use $_POST or $_GET

	if(!$wmPage["Email"]){
		$wmPage["Email"]=$params->getValue("site_mail_default_email");
	}
	
	$toList=	$wmPage["Email"];//$cfg["WM"]["Email"]["To"];						//	The Email Address
	$subject=	$trans->getText("New form filled at: ")." ".$cfg["WM"]["Server"]." ".$wmPage["Name"];		//	The Subject
	$from=		$params->getValue("mailing_list_sender_email");//$cfg["WM"]["Email"]["To"];	//	From EMail address
									
	//$body="This is an email from Website<br /><br />";	//	Some Initial Text
	$body="";
    $_POST["New_Url"]="<a href='".urldecode($_POST["hidden_url"])."'>".$trans->getText("Link")."</a>";
    //die($_POST["New_Url"]);
	$postLang=array(
        "New_Url"    =>  "קישור לטופס",
		"First_Name"	=>	"שם מלא",
		"Company"		=>	"חברה",
		"Service"		=>	"שירות",
		"Email"			=>	"דואל",
		"Phone"			=>	"טלפון",		
		"Address"		=>	"כתובת",		
		"Comments"		=>	"תוכן הפניה",
		"submit"		=>	"כפתור שנלחץ"
	);
	
	$body.=getFormTable($_POST, $postLang);	//	use $_POST or $_GET	
	$toArray=explode(",", $toList);
	foreach($toArray as $to){
		$to=trim($to);
		sendSingleMail($subject, $body, $to, $from);
	}

	require_once('classes/content_management/class.content_updater.php');
	require_once('classes/site_users/class.site_users.php');
	$siteUsers=new SiteUsers($db, "wm_siteusers");
	
	$enable=1;
	if($_POST["SendMail"]){
		$enable=1;
	}
	
	$arrFields=array(
		"Name"			=>	$_POST["First_Name"],
		"First_Name"		=>	$_POST["First_Name"],
		"Company"		=>	$_POST["Company"],
		"Service"		=>	$_POST["Service"],
		"Email"			=>	$_POST["Email"],
		"Phone"			=>	$_POST["Phone"],		
		"Address"		=>	$_POST["Address"],		
		"Comments"		=>	$_POST["Comments"],
		"Enabled"		=>	$enable
	);
	
	$user_id=$siteUsers->addUser($arrFields);

	$exists=$db->getField("SELECT ID FROM wm_siteusers_forms WHERE wm_siteusers=".intval($user_id)." AND form_id=".intval($wmPage["ID"]), "ID");
	
	$fieldsArr=array(
		"wm_siteusers"	=>	$user_id,
		"form_id"	=>	$wmPage["ID"],
		"form_name"	=>	$wmPage["Name"],
		"content"	=>	$_POST["Comments"]	
	);
	$db->updateData("wm_siteusers_forms", $fieldsArr, $exists);
}
?>
