<?php
/*
	Code By Tomer Efrati
	webmaster@quan.co.il
	
	Where all think alike, no one thinks very much. 
													Walter Lippmann (1889 - 1974)
*/

function sendSingleMail($subject, $body, $to, $from=NULL){
	
	global $cnf;
	

	$subject='=?UTF-8?B?'.base64_encode($subject).'?=';

	//	Prepering mail object
	$mail=new SendMail();
	$mail->setSubject($subject);	
	//$mail->setMail($from);
	$mail->setSMTP("192.168.151.66");


	if(!$from){
		$from=			$to;
		$sender=		$from;
		$senderName=	$from;
		$replyTo=		$from;
	}

	$sender=		$from;
	$senderName=	$from;
	$replyTo=		$from;	
	
	//echo "$from, $senderName, $sender, $replyTo";
	$mail->setFrom($from, $senderName, $sender, $replyTo);

	$htmlBody=@file_get_contents("mail_template.htm");

	if(!$htmlBody){
		$htmlBody="
			<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
			<html xmlns=\"http://www.w3.org/1999/xhtml\">
			<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
			<title>Mail From Website</title>
			<style type=\"text/css\">
				html, body, table{
					font-family: Arial;
					font-size: 12px;
				}
			</style>
			</head>
			<body dir=\"rtl\">
				[#MAIN_DATA#]
			</body>
			</html>	
		";	
	}
		
	$htmlBody=str_replace("[#MAIN_DATA#]", $body, $htmlBody);

	$mail->setBody($htmlBody);

	//$to=array($to);
	
	//$mail->bulkSend($to, 10);
	
	//mail($to, $subject, $htmlBody);
	$success=$mail->send($to);
	return $success;
}

function getFormTable($formData, $postLang=NULL){	//	use $_POST or $_GET	

	$dataTemplate="
		<tr>
			<td valign=\"top\" nowrap>[#VAR#]</td>
			<td valign=\"top\">[#VAL#]</td>		
		</tr>
	";
	
	$postMailTemplate="
		<table>
			[#POSTDATA#]
		</table>
	";
	
	$data="";
	
	foreach($formData as $var => $val){
		if(strcmp(substr($var, 0, 6), "hidden")==0 || strcmp($var, "p")==0 || $var=="submit" || $var=="Password" || $var=="PasswordValidate"){
			continue;
		}
		if(is_array($val)){
			$val=implode(",", $val);
		}
		$tmpData=$dataTemplate;
		
		if($postLang){
			$tmpData=str_replace("[#VAR#]", "<b>".$postLang[$var].":</b>", $tmpData);		
		}else{
			$tmpData=str_replace("[#VAR#]", "<b>".str_replace("_", " ", $var).":</b>", $tmpData);
		}
		$tmpData=str_replace("[#VAL#]", str_replace("\r\n", "<br />", $val), $tmpData);
		$data.=$tmpData;
	}
	
	$body=str_replace("[#POSTDATA#]", $data, $postMailTemplate);

	return $body;
}
?>
