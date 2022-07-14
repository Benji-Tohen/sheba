<?php
require_once("classes/phpmailer/sendmail.php");
require_once("classes/phpmailer/class.smtp.php");
require_once("classes/phpmailer/class.send_mail.php");
require_once("classes/phpmailer/class.phpmailer.php");

/*
$arrDrs = $db->getArray("SELECT wm_pages.Name, wm_pages.ID ,wm_pages.Email FROM wm_pages 
                                  INNER JOIN wm_connected_pages_ids ON wm_connected_pages_ids.wm_connected_wm_pages_ids = wm_pages.ID 
                                 WHERE Page_Type =".$pageType['ID']." AND (wm_connected_pages_ids.wm_pages = "..")");
*/

$Forum_Id = intval($_POST['Forum_Id']);
require_once("classes/forum/class.forum.php");
$forumObj = new Forum($db, "wm_forum_messages");
$forumObj->forumId=$Forum_Id;
global $db;
/*check if we come from add or search*/
if(isset($_POST['searchText'])){/*just search*/
    $searchText = $_POST['searchText'];
    $messageArr = $forumObj->getMessagesSearch($searchText);
    
}elseif(isset($_POST['limit'])) {/*get more messages*/
    $limit = intval($_POST['limit'] +10 );
    $limit = $limit.",10";
    $messageArr = array();
    $forumObj->getForumMessages($messageArr,$Forum_Id,0,$limit);
    if(count($messageArr)<10){/*remove more button if needed*/
        $display='no';
    }
    echo "<div style='display: none;' display='".$display."' id='limitDiv".intval($_POST['limit'])."'>".$limit."</div>";
}elseif(isset($_POST['messageIdUpdate'])) {/*update message*/
        $query = "UPDATE wm_forum_messages SET Subject='".mysqli_real_escape_string($db->conn,$_POST['messageSubject'])."', Value='".mysqli_real_escape_string( $db->conn, $_POST['messageText'])."'
                  WHERE ID =".intval($_POST['messageIdUpdate']);
        $db->runQuery($query);
}elseif(isset($_POST['messageIdDelete'])) {/*update message*/
        $query = "DELETE FROM wm_forum_messages WHERE ID =".intval($_POST['messageIdDelete']);
        $db->runQuery($query);
}else{
	
	/*add new message or comment*/
    /*check if is human?*/
    if(false && !isset($_SESSION['isHuman']) && $_SESSION['isHuman'] != 1){/*check captcha with google*/
        $secret = "6Lc_3AsTAAAAAAcPHhGqtl91y9ihuJ2fSz42BAlm";
        $response = $_POST['g-recaptcha-response'];
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $data = array('secret' => $secret, 'response' => $response, 'remoteip' => $remoteip);
        $url="https://www.google.com/recaptcha/api/siteverify";
        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($handle);
        $output = json_decode($output);
		//print_r($output);exit;
    }



    
    if(true|| $output->success == 1 || $_SESSION['isHuman']==1){/*is human! add message - and save isHuman in session*/
        $_SESSION['isHuman'] = 1;
        $Parent = $_POST['Parent'];
        $Full_Name = $_POST['Full_Name'];
        $Subject = $_POST['Subject'];
        $Value = $_POST['Value'];
        $Email = $_POST['Email'];
        $newMesId = $forumObj->addMessage($Forum_Id,$Parent,$Subject,$Value,$Full_Name,$Email);
        $messageArr = $db->getArray("SELECT * FROM wm_forum_messages WHERE ID =$newMesId");


        $pageId=intval($_POST["pageid"]);
        $pageName = ($_POST['pagename']);


        $arrDrs = $db->getArray("SELECT wm_pages.Name, wm_pages.ID ,wm_pages.Email_Address  
                                FROM wm_pages 
                                          INNER JOIN wm_connected_pages_ids ON wm_connected_pages_ids.wm_connected_wm_pages_ids = wm_pages.ID 
                                         WHERE wm_connected_pages_ids.wm_pages = ".$pageId." AND wm_pages.Page_Type=96");


        $wmPage=$wm->getValues($pageId);
        $link=$wm->getLink($wmPage);
        $pageLink="<a href=\"".$link["Link"]."/respond"."\">".$link["Link"]."/respond"."</a>";


        foreach ($arrDrs  as $value) {
          
            $emailText = $trans->getText("forum_dr_email_text");
            $emailTextName = str_replace(' [#DR_NAME#]' , " ".$value['Name']." " ,$emailText );
            $emailTextForum = str_replace(' [#FORUM_NAME#]' ," ".$pageName." " ,$emailTextName );            
            $body = str_replace(' [#FORUM_LINK#]' ," ".$pageLink ,$emailTextForum );
            $subject = $trans->getText("forum_dr_email_subject");
            $from= "info@sheba.co.il";  
		
			//sendSingleMail($subject, $body, $value['Email_Address'], $from);
            sendSingleMail($subject, $body, "david@tohen-media.com", $from);

        }






        echo "<style>.g-recaptcha{opacity: 0;height:1px;overflow: hidden;}</style>";
    }else{/*is robot!*/
        echo $trans->getText("Robots are not allowed to post :-)");
    }
}

foreach ($messageArr as $key => $message) {
    include(dirname(__FILE__)."/../php_html/forum.php");
}
    

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

