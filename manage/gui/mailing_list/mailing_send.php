<?php require_once('../../classes/phpmailer/class.send_mail.php');?>
<?php require_once('../../classes/file/class.file.php');?>
<?php require_once('../../classes/parameters/class.parameters.php');?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Mailing List"];?></div>
<div style="padding-left: 30px;padding-right: 30px; padding-top: 10px; color: #ffffff; font-weight: bold;">
<?php echo $text["Sending to list"];?>...
<br /><br />
<?php 
$param=		new Parameters($db);
$tester=	$param->getValue("mailing_list_tester_email");
$from=		$param->getValue("mailing_list_sender_email");
$fromName=	$param->getValue("mailing_list_sender_name");

$mailBody=file_get_contents($cfg["WM"]["Server"]."/manage/gui/mailing_list/mailingList.php");

$formIds=	$_POST["formIds"];
$test=		($_REQUEST["test"]?1:0);

$postContent=	$_POST["Content"];
$postContent=	stripslashes($postContent);

//echo $cfg["WM"]["File_Uploades_Folder_fck"];

//echo $postContent;

$postContent=	str_replace($cfg["WM"]["File_Uploades_Folder_fck"], "http://".$_SERVER["HTTP_HOST"].$cfg["WM"]["File_Uploades_Folder_fck"], $postContent);

$mailBody=str_replace("[#DIR#]", 	$gui->getDir(), $mailBody);
$mailBody=str_replace("[#ALIGN#]", 	$gui->getLeft(), $mailBody);
$mailBody=str_replace("[#CONTENT#]", 	$postContent, $mailBody);


$mail=new SendMail();



$mail->setMail($from);
//$mail->setSMTP($host);

$mail->setFrom($from, $fromName, $from, $from);		//	($from, $fromName="", $replyTo="", $sender="")

$mail->setSubject($_POST["Subject"]);
$mail->setBody($mailBody);

/*
$newFileLoc=NULL;
if($_FILES["fileAttached"]["tmp_name"]){
	$newFileLoc="../../".$cfg["WM"]["File_Uploades_Folder"]."/tmp/".$_FILES["fileAttached"]["name"];
	
	$file=new File();
	$file->checkPath("../../".$cfg["WM"]["File_Uploades_Folder"]."/tmp/");		
	move_uploaded_file($_FILES["fileAttached"]["tmp_name"], $newFileLoc);
	$mail->addAttachment($newFileLoc);
}
*/


$sendMail=false;

if(is_array($formIds) && count($formIds)>0){
	$where=		"AND wm_siteusers_forms.form_id IN(".implode(",", $formIds).")";
	$innerJoin=	"INNER JOIN wm_siteusers_forms ON wm_siteusers_forms.wm_siteusers=wm_siteusers.ID";


	$query="SELECT DISTINCT wm_siteusers.ID, wm_siteusers.Email  
		FROM wm_siteusers 
		".$innerJoin."  
		WHERE wm_siteusers.Enabled=1 ".$where;
	$arrEmail=$db->getArrayForField($query, "Email");
	
	for($i=0;$i<count($arrEmail);$i++){
		$mail->Mail->AddBCC($arrEmail[$i], $arrEmail[$i]);
	}
	$sendmail=count($arrEmail);
}

if($test){
	$mail->Mail->AddBCC($tester, $tester);
	$sendmail=true;
}

if($sendmail){
	$success=$mail->send();
}

if($newFileLoc){
	unlink($newFileLoc);
}
if($success){
	echo str_replace("_1_", (count($arrEmail)+$test), $text["Mail sent successfuly"]);
}else{
	echo $text["Mail send failed"];
}
?>
</div>
<?php require_once('common/footer.php');?>
