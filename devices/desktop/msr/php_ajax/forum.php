<?php
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
}else{/*add new message or comment*/
    /*check if is human?*/
    if(!isset($_SESSION['isHuman']) && $_SESSION['isHuman'] != 1){/*check captcha with google*/
        $secret = "6Lc5hgYTAAAAAOwUBtHY9LOweMmkEN-UXrpxS8Ms";
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
    }
    
    if($output->success == 1 || $_SESSION['isHuman']==1){/*is human! add message - and save isHuman in session*/
        $_SESSION['isHuman'] = 1;
        $Parent = $_POST['Parent'];
        $Full_Name = $_POST['Full_Name'];
        $Subject = $_POST['Subject'];
        $Value = $_POST['Value'];
        $Email = $_POST['Email'];
        $newMesId = $forumObj->addMessage($Forum_Id,$Parent,$Subject,$Value,$Full_Name,$Email);
        $messageArr = $db->getArray("SELECT * FROM wm_forum_messages WHERE ID =$newMesId");
        echo "<style>.g-recaptcha{opacity: 0;height:1px;overflow: hidden;}</style>";
    }else{/*is robot!*/
        echo 'אתה רובוט..לך מפה';
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

