<?php
require_once(dirname(__FILE__).'/../encrypt/encrypt.class.php');

class Login extends TreeData{
	
	var $db;
	var $table;
        var $logged_users = "wm_logged_users";                                  // logged in users table
/*		
	function Login($db, $table){
		$this->db = $db;
		$this->table = $table;	
	}
*/

	function loginUser($Username, $Password){
		$row=$this->db->getRow("SELECT * FROM ".$this->table." WHERE Password=MD5('".mysqli_real_escape_string($this->db->conn, $Password)."') AND Username='".mysqli_real_escape_string($this->db->conn, $Username)."'");
		if($row){           // old password type
			$dateTime=new DateTime1();
			setcookie("user_name", $Username, strtotime("+7 day"),null,null,true);
                        $_SESSION["User_Data"]=$row;
                        $user_id = $row["ID"];
                        $logged_uid = uniqid($user_id, true);
                        $_SESSION["User_Data"]["logged_uid"] = $logged_uid;
                        $this->db->runQuery("REPLACE INTO {$this->logged_users} (wm_user_id,logged_uid) VALUES ($user_id,'$logged_uid')");
			return true;
		} else {            // new password type
                    $ec = new encrypt();
                    $row=$this->db->getRow("SELECT * FROM ".$this->table." WHERE Password=('".$ec->sha256($Password)."') AND Username='".mysqli_real_escape_string($this->db->conn, $Username)."'");
                    if($row){
                        $dateTime=new DateTime1();
                        setcookie("user_name", $Username, strtotime("+7 day"),null,null,true);
                        $_SESSION["User_Data"]=$row;
                        $user_id = $row["ID"];
                        $logged_uid = uniqid($user_id, true);
                        $_SESSION["User_Data"]["logged_uid"] = $logged_uid;
                        $this->db->runQuery("REPLACE INTO {$this->logged_users} (wm_user_id,logged_uid) VALUES ($user_id,'$logged_uid')");
                        return true;
                    }
                }
		
		return false;	
	}

	function replacePassword() {
		$_SESSION["User_Data"]["replace_password"] = 1;
	}


	function logoutUser(){
		$_SESSION["User_Data"]=NULL;
	}
	
	function userLoggedIn(){
		if($_SESSION["User_Data"]){
			return true;
		}
		
		return false;
	}
	
	function required($level){
		if(!$_SESSION["User_Data"]["Level"]){
			header("Location: index.php?show=enter");
			exit;
		}
		if($_SESSION["User_Data"]["Level"]<=$level){
			return true;
		}else{
			header("Location: index.php?show=not_authorized");
			exit;
		}
	}
	
	function isSuperManager(){
		if(!$_SESSION["User_Data"]["Level"]){
			return false;
		}	
		if($_SESSION["User_Data"]["Level"]==1){
			return true;
		}
		return false;
	}
	
	function isManager(){
		if(!isset($_SESSION["User_Data"]["Level"])){
			return false;
		}	

		if(!$_SESSION["User_Data"]["Level"]){
			return false;
		}	
		if($_SESSION["User_Data"]["Level"]<=2){
			return true;
		}
		return false;
	}
	
	function isUser(){
		if(!isset($_SESSION["User_Data"]["Level"]) || !$_SESSION["User_Data"]["Level"]){
			return false;
		}	
		if($_SESSION["User_Data"]["Level"]<=3){
                        $arr = $this->db->getRow("SELECT * FROM {$this->logged_users} WHERE wm_user_id={$_SESSION["User_Data"]["ID"]}");
                        if (!$arr) return false;
                        else {
                            if ($arr['logged_uid']!=@$_SESSION["User_Data"]["logged_uid"]) {
                                $this->logoutUser();
                                return false;
                            } else return true;
                        }
			return true;
		}
		return false;
	}

	function isReplacePassword() {
		if (!isset($_SESSION["User_Data"]["replace_password"])) return false;
                if ($_SESSION["User_Data"]["replace_password"]) return true;
                return false;
	}	
	
	function isGuest(){
		if(!$_SESSION["User_Data"] || $_SESSION["User_Data"]["Level"]>3){
			return true;
		}
		return false;
	}
	
	function addUser($arrFieldsValues){
		if($this->db->getExist($this->table, "Username", $arrFieldsValues["Username"])){
			return false;
		}
		$user_id=$this->add(1);
		$this->setValues($user_id, $arrFieldsValues);
		$this->db->runQuery("UPDATE ".$this->table." SET Password=".$arrFieldsValues["Password"]." WHERE ID=".intval($user_id));
		return true;
	}
	
	function editUser($user_id, $arrFieldsValues){
		$exists=$this->db->getExist($this->table, "Username", $arrFieldsValues["Username"]);
		if($exists && $exists!=$user_id){
			return false;
		}
		$this->setValues($user_id, $arrFieldsValues);
		$this->db->runQuery("UPDATE ".$this->table." SET Password=".$arrFieldsValues["Password"]." WHERE ID=".intval($user_id));
		return true;
	}

	function getLevel(){
		return $_SESSION["User_Data"]["Level"];
	}
	
}
?>
