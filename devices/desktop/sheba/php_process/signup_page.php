<?php
require_once("classes/phpmailer/class.send_mail.php");
require_once('classes/phpmailer/sendmail.php');
require_once('classes/content_management/class.content_updater.php');
require_once('classes/site_users/class.site_users.php');
require_once('classes/store/class.store_users.php');



$file = file_get_contents("english_db.sql");
$file=json_decode($file, true);

foreach ($file as $key => $value) {
	$old_row = $wm->getValues($value["ID"]);
	if(strcmp($old_row["Name"],$value["Name"])==0){
		$wm->setValues($value["ID"], $file[$key]);
	}else{
		$versionId=$wm->add();
		unset($file[$key]["ID"]);
		if($_SERVER['REMOTE_ADDR'] == '31.168.120.186'){
				echo "shery: ";
				echo "<pre>";
				print_r($versionId);
				print_r($file[$key]);
				echo "</pre>";
		
		}
		$wm->setValues($versionId, $file[$key]);
	}
}







$siteUsers=new StoreUsers($db, "wm_siteusers");

if(isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]){		//	use $_POST or $_GET

	if(!$_POST["Email"]){
		echo "Error";
		exit;
	}

	/*	
	This is a bit complex, please have a little patience...
	if the user exists, don't allow signup,
	however, if the user doesn't have password, he made login from social plugins only, in that case allow signup
	*/
	$allowSignup=false;	

	$mailExists=	$siteUsers->isExistsText("Email", $_POST["Email"]);
	if($mailExists){
		if($_SESSION["STORE_USER"]["ID"]){
			$session_row["storeUser"]=$siteUsers->getValues($_SESSION["STORE_USER"]["ID"]);
		}
		$form_row=	$siteUsers->getValues($mailExists);
		$allowSignup=	(!$form_row["Password"] && $session_row["storeUser"]["Email"]==$form_row["Email"]);
	}else{
		$allowSignup=true;	
	}

	if(!$allowSignup){
		$errorText=$trans->getText("This email already exists");
	}else{

		if(!$wmPage["Email"]){
			$wmPage["Email"]=$params->getValue("site_mail_default_email");
		}
	
		$toList=	$wmPage["Email"];//$cfg["WM"]["Email"]["To"];						//	The Email Address
		$subject=	$trans->getText("New registration at: ")." ".$cfg["WM"]["Server"]." ".$wmPage["Name"];		//	The Subject
		$from=		$wmPage["Email"];//$cfg["WM"]["Email"]["To"];	//	From EMail address
									
		//$body="This is an email from Website<br /><br />";	//	Some Initial Text
		$body="";

		$postLang=array(
			"First_Name"	=>	"שם פרטי",
			"Last_Name"		=>	"שם משפחה",
			"Company"		=>	"חברה",
			"Service"		=>	"שירות",
			"Email"			=>	"דואל",
			"Phone"			=>	"טלפון",		
			"Address"		=>	"כתובת",
			"Comments"		=>	"תוכן הפנייה",
            "SendMail"      =>  "נרשם לניוזלטר"
		);


		$enable=0;
		if($_POST["SendMail"]){
            $_POST["SendMail"]=$trans->getText("yes");
            $enable=1;
        }else{
            $_POST["SendMail"]=$trans->getText("no");;
        }

        $body.=getFormTable($_POST, $postLang);	//	use $_POST or $_GET
        $toArray=explode(",", $toList);
        foreach($toArray as $to){
            sendSingleMail($subject, $body, $to, $from);
        }


		$activationCode=md5(time());

		$arrFields=array(
			"Name"			=>	$_POST["First_Name"]." ".$_POST["Last_Name"],
			"First_Name"		=>	$_POST["First_Name"],
			"Last_Name"		=>	$_POST["Last_Name"],
			"Company"		=>	$_POST["Company"],
			"Service"		=>	$_POST["Service"],
			"Email"			=>	$_POST["Email"],
			"Phone"			=>	$_POST["Phone"],		
			"Address"		=>	$_POST["Address"],		
			"Comments"		=>	$_POST["Comments"],
			"Enabled"		=>	$enable,
			"Password"		=>	md5($_POST["Password"]),
			"mail_activation_code"	=>	md5($activationCode)
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


		$to=$_POST["Email"];
		$userSubject=	$trans->getText("email activation subject");
		$userBody=	$trans->getText("email activation body");
		$userBody=	str_replace("[#Name#]", $_POST["First_Name"]." ".$_POST["Last_Name"], $userBody);
		$userBody=	nl2br($userBody);

		$userBody.=	"<a href=\"".$cfg["WM"]["Server"]."/activate/".$activationCode."\">".$cfg["WM"]["Server"]."/activate/".$activationCode."</a>";
		sendSingleMail($userSubject, $userBody, $to, $from);

		header("location: ".$cfg["WM"]["Server"]."/".$wm->getAlias($wmPage)."/POST");
		exit;

	}
}
?>
