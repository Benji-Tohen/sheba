<?php
switch($getParams[0]){
	case 'forgotPassword':

		if($getParams[1]=="passwordReset"){
		
		}else{
			$error=true;

			$_POST["returnTo"]=str_replace("?fperror=1", "", $_POST["returnTo"]);
			$_POST["returnTo"]=str_replace("?ps=1", "", $_POST["returnTo"]);
			$returnTo=$cfg["WM"]["Server"];

			$user_id=$su->isExistsText("Email", $_POST["email"]);
			$userRow=$su->getValues($user_id);
			
			if($_POST["email"] && $userRow["user_activated"]){
				$error=false;
				require_once("classes/phpmailer/class.send_mail.php");
				require_once("classes/phpmailer/sendmail.php");

				$passwordResetCode=md5(time());

				$userSubject=$trans->getText("Password recovery mail subject");
				$userBody=$trans->getText("Password recovery mail body");
				$userBody=nl2br($userBody);

				$su->setValue($userRow["ID"], "password_reset_code", md5($passwordResetCode));

				$userBody.=	"<a href=\"".$cfg["WM"]["Server"]."/changePassword/passwordReset/".$passwordResetCode."\">".$cfg["WM"]["Server"]."/changePassword/passwordReset/".$passwordResetCode."</a>";
				$from=$params->getValue("mailing_list_sender_email");
				$to=$_POST["email"];
				sendSingleMail($userSubject, $userBody, $to, $from);
				
				if($_POST["returnTo"]){
					$returnTo.=$_POST["returnTo"];
					$returnTo.="?ps=1";
					header("location: ".$returnTo);
					exit;
				}
			}

			if($error){
				if($_POST["returnTo"]){
					$returnTo.=$_POST["returnTo"];
					$returnTo.="?fperror=1";
					header("location: ".$returnTo);
				}
			}
		}
		exit;
	break;
	case 'activate':
		$user_id=$su->activate($getParams[1]);
		if($user_id){
			$wm->gotoPageType(85);
		}else{
			$wm->gotoPageType(86);
		}
		exit;
	break;
	case 'logout':
		$su->logout();
		header("location: ".$_SERVER["HTTP_REFERER"]);
		exit;
	break;
	case 'loginpost':
		$loginId=$su->login($_POST["username"], $_POST["password"]);
		if($_POST["returnTo"]){
			$_POST["returnTo"]=str_replace("?error=1", "", $_POST["returnTo"]);
			$returnTo=$cfg["WM"]["Server"];
			if($_POST["returnTo"]){
				$returnTo.=$_POST["returnTo"];
			}
			if(!$loginId){
				$returnTo.="?error=1";
			}

			header("location: ".$returnTo);
		}
		exit;
	break;
	default:
		echo $wmPage["Conversion"];
	break;
}
?>
