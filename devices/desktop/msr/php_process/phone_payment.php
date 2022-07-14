<?php
require_once("classes/phpmailer/class.send_mail.php");
require_once('classes/phpmailer/sendmail.php');
require_once('classes/content_management/class.content_updater.php');
require_once('classes/site_users/class.site_users.php');
require_once('classes/store/class.store_users.php');



$orderItems=		$store->getOrderItems();
$orderSum=		$store->getOrderSubtotal();
$shipmentMethods=	$store->getShipmentMethods();
$shipmentMethod=	$store->getShipmentMethod();
$_SESSION["Payment_Amount"]=$orderSum;

$siteUsers=new StoreUsers($db, "wm_siteusers");


$toList=	$wmPage["Email"];					//	The Email Address
$toArray=	explode(",", $toList);
$from=		$toArray[0];					//	From EMail address

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
		//$errorText=$trans->getText("This email already exists");
	}else{

		if(!$wmPage["Email"]){
			$wmPage["Email"]=$params->getValue("site_mail_default_email");
		}
	

		$subject=	$trans->getText("New registration at: ")." ".$cfg["WM"]["Server"]." ".$wmPage["Name"];		//	The Subject

									
		//$body="This is an email from Website<br /><br />";	//	Some Initial Text
		$body="";

		$postLang=array(
			"Name"			=>	"שם מלא",
			"Company"		=>	"חברה",
			"Service"		=>	"שירות",
			"Email"			=>	"דואל",
			"Phone"			=>	"טלפון",		
			"Address"		=>	"כתובת",		
			"Comments"		=>	"תוכן הפנייה"
		);
	
		$body.=getFormTable($_POST, $postLang);	//	use $_POST or $_GET	
		foreach($toArray as $to){
			sendSingleMail($subject, $body, $to, $from);
		}

		$enable=0;
		if($_POST["SendMail"]){
			$enable=1;
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



	}


	$orderFields=array(
		"shipping_address_name"		=>	$_POST["shipping_address_name"],	
		"shipping_address_line1"	=>	$_POST["shipping_address_line1"],
		"shipping_address_city"		=>	$_POST["shipping_address_city"],	
		"shipping_address_zip"		=>	$_POST["shipping_address_zip"]
	);
	$store->setDetails($orderFields);



	$to=$_POST["Email"];
	$userSubject=	$trans->getText("email phone payment subject");
	$userBody=	$trans->getText("email phone payment body");
	$userBody=	str_replace("[#Name#]", $_POST["First_Name"]." ".$_POST["Last_Name"], $userBody);
	$userBody=	nl2br($userBody);



	$adminSubject=$trans->getText("email phone payment admin subject");
	$adminBody=$trans->getText("email phone payment admin body");
	$adminBody=	str_replace("[#Name#]", $_POST["First_Name"]." ".$_POST["Last_Name"], $adminBody);
	$adminBody=	nl2br($adminBody);

	$orderDetails="";

	$orderDetails.=	"
		<table cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td>".$trans->getText("Items to buy")."</td>
				<td>".$trans->getText("Quantity")."</td>
				<td>".$trans->getText("PriceTitle")."</td>
			</tr>
";


	foreach($orderItems as $orderItem){
		$itemDetails=$wm->getValues($orderItem["wm_pages"]);
		if(!$itemDetails["Top_Header2"]){
			$itemDetails["Top_Header2"]=$itemDetails["Top_Header"];
		}
	

		$orderDetails.=	"
			<tr>
				<td><img src=\"".$thumb_call."/".$itemDetails["Top_Header2"]."\" alt=\"".$orderItem["Name"]."\" title=\"".$orderItem["Name"]."\" /></td>
				<td>".$orderItem["Name"]."</td>
				<td>".number_format($orderItem["price"], 2).$trans->getText("currencySign")."</td>
			</tr>
		";
	}

	$orderDetails.=	"
		</table>
	";

	$userBody.=$orderDetails;
	$adminBody.=$orderDetails;

	sendSingleMail($userSubject, $userBody, $to, $from);


	foreach($toArray as $to){
		sendSingleMail($adminSubject, $adminBody, $to, $from);
	}

	$store->setComplete();


	header("location: ".$cfg["WM"]["Server"]."/".$wm->getAlias($wmPage)."/POST");
	exit;
}
?>
