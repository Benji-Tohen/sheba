<?php
class StoreUsers extends SiteUsers{

	var $userRow=NULL;
	var $orderId=NULL;
	var $oldUserId=NULL;

	function login($username, $password){

		$this->preserveCartSessionTop();

		if(strlen($username)<3 || strlen($password)<5){
			return false;
		}
		$query="
			SELECT * 
			FROM wm_siteusers 
			WHERE Email='".mysqli_real_escape_string($this->db->conn, $username)."' AND Password='".mysqli_real_escape_string($this->db->conn, md5($password))."'
		";
		$row=$this->db->getRow($query);

		if(!empty($row)){
			$_SESSION["STORE_USER"]["ID"]=$row["ID"];
			$userRow=$row;

			$this->preserveCartSessionBottom($row["ID"]);

			return $row;
		}
		return false;
	}
	
	function logout(){
		$_SESSION["linkedin_connected"]=false;
		$_SESSION['oauth']['linkedin']['authorized']=NULL;
		$_SESSION["access_token"]=NULL;
		$_SESSION["STORE_USER"]=NULL;
		unset($_SESSION['token']);
	}

	function getLoginUser(){
		//if($id==NULL){
			$id=$this->getCurrentUser();
		//}

		if(!$id){
			return false;
		}

		return $this->getValues($id);
	}

	function getLoginUserField($id=NULL, $fieldName){
		if($id==NULL){
			$id=$this->getCurrentUser();
		}

		if(!$id){
			return false;
		}

		$query="
			SELECT ".mysqli_real_escape_string($this->db->conn, $fieldName)." 
			FROM wm_siteusers 
			WHERE ID=".intval($id)."
		";

		return $this->db->getField($query, $fieldName);
	}

	function getCurrentUser(){
		if(!isset($_SESSION["STORE_USER"]["ID"])){
			return false;
		}
		return $_SESSION["STORE_USER"]["ID"];	
	}

	function requireUser(){
		if(!$this->getCurrentUser()){
			header("location: ".$cfg["WM"]["Server"]."/noPermission");
			exit;
		}
	}
	
	function userLogin(){
		return $this->getCurrentUser();
	}

	function loginFacebookUserAjax($fuid){
		
		$this->preserveCartSessionTop();

		if(!$fuid){
			return false;
		}

		$id=$this->db->getExistText("wm_siteusers", "fuid", $fuid);
		if($id){
			$row=$this->getValues($id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;
				return $row;
			}
		}else{
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, "graph.facebook.com/".$fuid); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$json = curl_exec($ch); 
			curl_close($ch);

			$std=json_decode($json);

			if($std->{'error'}){
				return false;
			}

			$first_name=$std->{'first_name'};
			$last_name=$std->{'last_name'};
			$username=$std->{'username'};
			
			$fieldsArray=array(
				"Name"		=>	$first_name." ".$last_name,
				"First_Name"	=>	$first_name,
				"Last_Name"	=>	$last_name,
				"Email"		=>	$username."@facebook.com",
				"fuid"		=>	$fuid,
				"JoiningDate"	=>	date("Y-m-d H:i:s", time()),
				"Enabled"	=>	1
			);

			$user_id=$this->addUser($fieldsArray);

			$fieldsArr=array(
				"wm_siteusers"	=>	$user_id,
				"form_id"	=>	0,
				"form_name"	=>	"facebook.com",
				"content"	=>	$std
			);
			$db->updateData("wm_siteusers_forms", $fieldsArr);

			$row=$this->getValues($user_id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;

				$this->preserveCartSessionBottom($row["ID"]);

				return $row;
			}
		}

		return false;
	}

	function loginFacebookUser($user){

		if(empty($user) || !$user["id"]){
			return false;
		}

		$this->preserveCartSessionTop();

		$_SESSION["STORE_USER"]["fuid"]=$user["id"];

		$id=$this->db->getExistText("wm_siteusers", "fuid", $user["id"]);

		if(!$id){
			$id=$this->db->getExistText("wm_siteusers", "Email", $user["email"]);

			if($id){
				$this->setValue($id, "fuid", $user["id"]);
				$row=$this->getValues($id);
				if(!empty($row)){
					$_SESSION["STORE_USER"]["ID"]=$row["ID"];
					$userRow=$row;
					return $row;
				}
			}
		}

		if($id){
			$row=$this->getValues($id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;
				return $row;
			}
		}else{

			$fieldsArray=array(
				"Name"		=>	$user["name"],
				"First_Name"	=>	$user["first_name"],
				"Last_Name"	=>	$user["last_name"],
				"Email"		=>	$user["email"],
				"fuid"		=>	$user["id"],
				"JoiningDate"	=>	date("Y-m-d H:i:s", time()),
				"Enabled"	=>	1
			);

			$user_id=$this->addUser($fieldsArray);

			$fieldsArr=array(
				"wm_siteusers"	=>	$user_id,
				"form_id"	=>	0,
				"form_name"	=>	"facebook.com",
				"content"	=>	str_replace("\"", "'", json_encode($user))
			);


			$this->db->updateData("wm_siteusers_forms", $fieldsArr);



			$row=$this->getValues($user_id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;

				$this->preserveCartSessionBottom($row["ID"]);

				return $row;
			}
		}

		return false;
	}

	function loginGoogleUser($user){

			if(empty($user) || !$user["id"]){
				return false;
			}

			$this->preserveCartSessionTop();

			$_SESSION["STORE_USER"]["googleid"]=$user["id"];
			
			$id=$this->db->getExistText("wm_siteusers", "googleid", $user["id"]);

			if(!$id){
				$id=$this->db->getExistText("wm_siteusers", "Email", $user["email"]);

				if($id){
					$this->setValue($id, "googleid", $user["id"]);
					$row=$this->getValues($id);
					if(!empty($row)){
						$_SESSION["STORE_USER"]["ID"]=$row["ID"];
						$userRow=$row;
						return $row;
					}
				}
			}

			if($id){
				$row=$this->getValues($id);
				if(!empty($row)){
					$_SESSION["STORE_USER"]["ID"]=$row["ID"];
					$userRow=$row;
					return $row;
				}
			}

			$fieldsArray=array(
				"Name"		=>	$user["name"],
				"First_Name"	=>	$user["given_name"],
				"Last_Name"	=>	$user["family_name"],
				"Email"		=>	$user["email"],
				"googleid"	=>	$user["id"],
				"JoiningDate"	=>	date("Y-m-d H:i:s", time()),
				"Enabled"	=>	1
			);
			$user_id=$this->addUser($fieldsArray);

			$fieldsArr=array(
				"wm_siteusers"	=>	$user_id,
				"form_id"	=>	0,
				"form_name"	=>	"google.com",
				"content"	=>	str_replace("\"", "'", json_encode($user))
			);

			$this->db->updateData("wm_siteusers_forms", $fieldsArr);

			$row=$this->getValues($user_id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;

				$this->preserveCartSessionBottom($row["ID"]);

				return $row;
			}
	}

	function loginTwitterUser($user){
			if(empty($user) || !$user->{"name"}){
				return false;
			}

			$this->preserveCartSessionTop();

			$_SESSION["STORE_USER"]["twitterid"]=$user->{"id"};

			$id=$this->db->getExistText("wm_siteusers", "twitterid", $user->{"id"});

			if($id){
				$row=$this->getValues($id);
				if(!empty($row)){
					$_SESSION["STORE_USER"]["ID"]=$row["ID"];
					$userRow=$row;
					return $row;
				}
			}

			$names=explode(" ", $user->{"name"});

			$fieldsArray=array(
				"Name"		=>	$user->{"name"},
				"First_Name"	=>	$names[0],
				"Last_Name"	=>	$names[1],
				"Email"		=>	$user->{"id"}."@twitter.com",
				"twitterid"	=>	$user->{"id"},
				"JoiningDate"	=>	date("Y-m-d H:i:s", time()),
				"Enabled"	=>	1
			);
			$user_id=$this->addUser($fieldsArray);


			$fieldsArr=array(
				"wm_siteusers"	=>	$user_id,
				"form_id"	=>	0,
				"form_name"	=>	"twitter.com",
				"content"	=>	str_replace("\"", "'", json_encode($user))
			);

			$this->db->updateData("wm_siteusers_forms", $fieldsArr);

			$row=$this->getValues($user_id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;

				$this->preserveCartSessionBottom($row["ID"]);

				return $row;
			}
	}

	function loginLinkedinUser($user){
			if(empty($user) || !$user["id"]){
				return false;
			}

			$this->preserveCartSessionTop();

			$_SESSION["STORE_USER"]["linkedinid"]=$user["id"];
			
			$id=$this->db->getExistText("wm_siteusers", "linkedinid", $user["id"]);

			if($id){
				$row=$this->getValues($id);
				if(!empty($row)){
					$_SESSION["STORE_USER"]["ID"]=$row["ID"];
					$userRow=$row;
					return $row;
				}
			}

			$fieldsArray=array(
				"Name"		=>	$user["first-name"]." ".$user["last-name"],
				"First_Name"	=>	$user["first-name"],
				"Last_Name"	=>	$user["last-name"],
				"Email"		=>	$user["id"]."@linkedin.com",
				"linkedinid"	=>	$user["id"],
				"JoiningDate"	=>	date("Y-m-d H:i:s", time()),
				"Enabled"	=>	1
			);
			$user_id=$this->addUser($fieldsArray);

			$fieldsArr=array(
				"wm_siteusers"	=>	$user_id,
				"form_id"	=>	0,
				"form_name"	=>	"linkedin.com",
				"content"	=>	str_replace("\"", "'", json_encode($user))
			);

			$this->db->updateData("wm_siteusers_forms", $fieldsArr);

			$row=$this->getValues($user_id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;

				$this->preserveCartSessionBottom($row["ID"]);

				return $row;
			}
	}

	function loginStoreUser(){
			$user["id"]=TIME;
			if(empty($user) || !$user["id"]){
				return false;
			}

			$_SESSION["STORE_USER"]["storeid"]=$user["id"];
			
			$id=$this->db->getExistText("wm_siteusers", "storeid", $user["id"]);

			if($id){
				$row=$this->getValues($id);
				if(!empty($row)){
					$_SESSION["STORE_USER"]["ID"]=$row["ID"];
					$userRow=$row;
					return $row;
				}
			}

			$fieldsArray=array(
				"Name"		=>	"Anonymous",
				"First_Name"	=>	"Ano",
				"Last_Name"	=>	"nymous",
				"Email"		=>	$user["id"]."@".$_SERVER["HTTP_HOST"],
				"storeid"	=>	md5(TIME),
				"JoiningDate"	=>	date("Y-m-d H:i:s", TIME),
				"Enabled"	=>	1,
				"isanonymous"	=>	1
			);
			$user_id=$this->addUser($fieldsArray);

			$fieldsArr=array(
				"wm_siteusers"	=>	$user_id,
				"form_id"	=>	0,
				"form_name"	=>	$_SERVER["HTTP_HOST"],
				"content"	=>	str_replace("\"", "'", json_encode($user))
			);

			$this->db->updateData("wm_siteusers_forms", $fieldsArr);

			$row=$this->getValues($user_id);
			if(!empty($row)){
				$_SESSION["STORE_USER"]["ID"]=$row["ID"];
				$userRow=$row;
		
				$this->preserveCartSessionBottom($row["ID"]);

				return $row;
			}
	}

	function isFacebookUserLoggedIn(){
		if(!isset($_SESSION["STORE_USER"]["fuid"])){
			return false;
		}
		return $_SESSION["STORE_USER"]["fuid"];
	}

	function isGoogleUserLoggedIn(){
		if(!isset($_SESSION["STORE_USER"]["googleid"])){
			return false;
		}
		return $_SESSION["STORE_USER"]["googleid"];
	}

	function isTwitterUserLoggedIn(){
		if(!isset($_SESSION["STORE_USER"]["twitterid"])){
			return false;
		}
		return $_SESSION["STORE_USER"]["twitterid"];
	}

	function isLinkedInUserLoggedIn(){
		if(!isset($_SESSION["STORE_USER"]["linkedinid"])){
			return false;
		}
		return $_SESSION["STORE_USER"]["linkedinid"];
	}

	function isAnonymousUser($userId=NULL){
		return $this->getLoginUserField($userId, "isanonymous");

/*
		$email=$this->getLoginUserField(NULL, "Email");
		if(strpos($email, $_SERVER["HTTP_HOST"])===FALSE){
			return false;
		}
		return true;
*/
	}

	function preserveCartSessionTop(){
		global $store;
		$this->orderId=$store->getOpenOrderId();
		$this->oldUserId=$_SESSION["STORE_USER"]["ID"];
	}

	function preserveCartSessionBottom($userId){
		global $store;
		

		if($this->isAnonymousUser($this->oldUserId)){
			if($this->orderId){
				$store->transferOrderId($userId, $this->orderId);
			}			
		}
	}

}
?>
