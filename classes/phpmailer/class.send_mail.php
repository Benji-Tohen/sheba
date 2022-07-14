<?php
require_once('class.phpmailer.php');
require_once('class.smtp.php');

/*
$mail=new SendMail();

$to="tomer@comediagroup.com";
$from="tomer@comediagroup.com";

$mail->setMail($sender);
//$mail->setSMTP($host);

$mail->setFrom($from);	//	($from, fromName="", $replyTo="", $sender="")

$mail->setSubject("Subject test");
$mail->setBody("Body test");

$mail->send($to);
//$mail->sendMulti($toArr, $cfg["APP"]["Num_Mail_For_Bulk"]);
*/

class SendMail{

	var $Mail;
	var $originalMessage;

	function SendMail(){

        $this->Mail = new PHPMailer();	

		$this->Mail->IsHTML(true);

        $this->Mail->Priority = 3;
        $this->Mail->Encoding = "8bit";
        $this->Mail->CharSet = "utf-8";

        $this->Mail->AltBody = "";
        $this->Mail->WordWrap = 0;
        $this->Mail->Port = 25;
        $this->Mail->Helo = "localhost.localdomain";
        $this->Mail->SMTPAuth = false;
        $this->Mail->Username = "";
        $this->Mail->Password = "";
        //$this->Mail->PluginDir = $INCLUDE_DIR;
	}
	
	function setAuth($username, $password){
		$this->Mail->SMTPAuth 	= 	true;
		$this->Mail->Username	=	$username;
		$this->Mail->Password	=	$password;
	}
	
	function addAttachment($filename){
		$this->Mail->addAttachment($filename);
	}

	function setHost($host){
		$this->Mail->Host=	$host;
	}
	
	function setSMTP($host){
		$this->Mail->Host=	$host;
		$this->Mail->Mailer = "smtp";	
	}
	
	function setMail($sender){
		$this->Mail->Mailer = "mail"; 
		$this->Sender= $sender;
	}

	function send($to="", $toName=""){
		if($to){
			if(!$toName){
				$toName=$to;
			}

			$this->Mail->AddAddress($to, $toName);
		}
		$success=$this->Mail->Send();
		$this->Mail->ClearAllRecipients();
		return $success;
	}
	
	function sendMulti($toArr){
	
		for($i=0;$i<count($toArr);$i++){
			if(is_array($toArr[$i])){
				$this->Mail->Body=	str_replace("[#First_Name#]", $toArr[$i]["First_Name"], $this->originalMessage);
				$this->Mail->AddAddress($toArr[$i]["Email"], $toArr[$i]["First_Name"]);
				$success=$this->Mail->Send();
				$this->Mail->ClearAllRecipients();				
			}else{
				$this->Mail->AddBCC($toArr[$i], $toArr[$i]);			
			}
			//		$this->Mail->AddAddress($toArr[$i], $toArr[$i]);				
		}
		if(!is_array($toArr[0])){
			$success=$this->Mail->Send();
			$this->Mail->ClearAllRecipients();
		}
		
		return $success;
	}
	
	function bulkSend($arrTo, $Num_Mail_For_Bulk){
	
		$num_bulks=count($arrTo)/$Num_Mail_For_Bulk;
		
		$numSends=0;
		
		for($i=0;$i<$num_bulks;$i++){
			if($this->sendMulti(array_slice($arrTo, $i*$Num_Mail_For_Bulk, $Num_Mail_For_Bulk))){
				//echo "<br><br>tov";
				$numSends++;
			}else{
				//echo "<br><br>lo tov";
			}
		}
		
		if($numSends<=0){
			return false;
		}
		return $numSends;
	}

	function setFrom($from, $fromName="", $replyTo="", $sender=""){
		if(!$fromName){
			$fromName=$from;
		}
		if(!$reply){
			$reply=$from;
		}
		if(!$reply){
			$reply=$from;
		}
		if(!$sender){
			$sender=$reply;
		}
	
		$this->Mail->From = 	$from;
		$this->Mail->FromName = $fromName;
		$this->Mail->AddReplyTo($reply, $reply);		//($reply, "Reply Guy")
		$this->Mail->Sender = 	$sender;
	}

	function setBody($body){
		$this->Mail->Body=	$body;
		$this->originalMessage=	$body;
	}
	
	function setSubject($subject){
		$this->Mail->Subject=	$subject;	
	}
}
?>