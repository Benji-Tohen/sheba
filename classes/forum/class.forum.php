<?php
class Forum extends TreeData{

	var $db;
        var $table;
        var $forumId=0;
        
        /*wm_forum functions*/
        function getForumIdByWmPage($id) {
            $query = "SELECT ID FROM wm_forum"
                    . " WHERE wm_pages=".intval($id);
            $arr=$this->db->getRow($query);
            return $arr['ID'];
        }
        
        function getMessageAndComments($messId,&$searchedMessages) {
            $query = "SELECT ID,wm_forum,Parent,First_Parent,Ordering,Subject,Full_Name,Email,REPLACE(Value,'<a','<a rel=\"nofollow\"') as Value,URL,Start_Date,Deleted,File_Name,doctor_id  FROM wm_forum_messages 
                     WHERE ID=".intval($messId);
            $arr = $this->db->getArray($query);
            $this->getForumMessages($arr,  $this->forumId,intval($messId));
            $searchedMessages[]=$arr;
        }
        function getForumMessages(&$arr, $forumId, $parent=0, $limit = "0,10", $order = "Start_Date DESC", $level=0) {/*this needs fixing...!!*/
            $query = "SELECT ID,wm_forum,Parent,First_Parent,Ordering,Subject,Full_Name,Email,REPLACE(Value,'<a','<a rel=\"nofollow\"') as Value,URL,Start_Date,Deleted,File_Name,doctor_id  FROM wm_forum_messages 
                      WHERE wm_forum = ".intval($forumId).
                      " AND Deleted = 0 AND Parent=".intval($parent).
                      " ORDER BY ".mysqli_real_escape_string($this->db->conn, $order).
                      " LIMIT ".mysqli_real_escape_string($this->db->conn, $limit);
            $temp_arr=$this->db->getArray($query);
            
            if(empty($temp_arr)){
                return;                
            }            
            
            $num=count($temp_arr);
            for($i=0;$i<$num;$i++){
                $temp_arr[$i]["level"]=$level;
                $arr[]=$temp_arr[$i];
                if($this->hasChildren($temp_arr[$i]["ID"])){
                    $tmp=$this->getForumMessages($arr, $forumId, $temp_arr[$i]["ID"], "0,10", $order, ($level+1));
                    if($tmp){/*if we get empty values - uncomment this!*/
                        //$arr[]=$tmp;
                    }
                }
            }
        }
        /*wm_forum functions - END*/
        
       
        /*wm_forum_messages functions*/
        
        /*add new message to wm_forum_messages*/
        function addMessage($forumId, $parent=0, $messageSubject='', $messageText='', $fullName='', $email='') {
            $encryptObj = new encrypt();
            
            $arrFields["wm_forum"] = $forumId;
            $arrFields["Parent"] = $parent;
            $arrFields["Subject"] = $messageSubject;
            $arrFields["Value"] = $messageText;
            $arrFields["Full_Name"] = $fullName;
            $arrFields["Email"] = $encryptObj->encrypt($email);/*email is encrypted in DB*/
            $arrFields["Start_Date"] = date("Y-m-d h:i:sa", time());
			if(isset($_SESSION['doctor_id'])){
				$arrFields["doctor_id"] = $_SESSION['doctor_id'];
                /*write answer to log*/
                 file_put_contents($_SERVER['DOCUMENT_ROOT'].'/site/logs/doctorForumAnswersLog.txt', json_encode($arrFields) , FILE_APPEND);
			}
            $id = $this->db->updateData("wm_forum_messages", $arrFields);
            return $id;
        }
        
        /*delete existing message from wm_forum_messages - not requiered because exists in Tree Data
        function deleteMessage($messageId) {
            $arrFields["Deleted"] = 1;
            $this->db->updateData("wm_forum_messages", $arrFields,  intval($messageId), "ID");
        }*/
        
        /*update existing message from wm_forum_messages*/
        function updateMessage($messageId, $messageSubject, $messageText) {
            $arrFields["Subject"] = $messageSubject;
            $arrFields["Value"] = $messageText;
            $this->db->updateData("wm_forum_messages", $arrFields,  intval($messageId), "ID");
        }
        
        function searchMessages($searchStr) {/*search all messages contaning some string value*/
            $query = "SELECT * FROM wm_forum_messages WHERE Subject LIKE '%".mysqli_real_escape_string($this->db->conn, $searchStr)."%' OR Value LIKE '%".mysqli_real_escape_string($this->db->conn, $searchStr)."%'";
            $arr=$this->db->getArray($query);
            return $arr;
        }
        
        function searchInitialParent($messageId) {/*get the oldest parent of message - recursive*/
            $query = "SELECT Parent, ID FROM wm_forum_messages WHERE ID =".intval($messageId);
            $parentId = $this->db->getField($query, 'Parent');
            if($parentId != 0){/*has parent - need to continue search upwards*/
                $trueParent = $this->searchInitialParent($parentId);
            }else{
                $trueParent =  $messageId;
            }
            return($trueParent);
        }
        
        function getMessagesSearch($searchStr) {/*bring back all messages and their heirarchy after search*/
            $allMessages = $this->searchMessages($searchStr);
            $parents = array();
            foreach ($allMessages as $message) {
                $parents[] = $this->searchInitialParent($message['ID']);
            }
            $parents = array_unique($parents);
            /*now that we have all parents get their messages heirarchy*/
            $searchedMessages = array();
            foreach ($parents as $key => $parent) {
                $this->getMessageAndComments($parent,$searchedMessages);
            }
            
            /*multidimensional array of parent and childeren - normalize*/
            foreach ($searchedMessages as $key => $message) {
                foreach ($message as $key => $mes) {
                    $temp[] = $mes;
                }
            }
            return($temp);
        }
        /*wm_forum_messages functions - END*/
	

}
?>
