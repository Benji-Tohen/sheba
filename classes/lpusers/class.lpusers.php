<?php
class lpusers{
	var $db;
	var $table;

	function __construct($db, $table="wm_landing_pages_customers"){
		$this->db=$db;
		$this->table=$table;		
	}

	function loginUser($username, $password){
		$query="
		SELECT * 
		FROM ".$this->table." 
		WHERE Email='".mysqli_real_escape_string($this->db->conn, $username)."' AND Password='".md5(mysqli_real_escape_string($this->db->conn, $password))."'";

		$userRow=$this->db->getRow($query);
		
		if($userRow){
			$_SESSION["LPMEDIA"]["USER_DATA"]=$userRow;
			return true;
		}

		return false;
	}

	function logoutUser(){
		$_SESSION["LPMEDIA"]=NULL;
		$_SESSION["LPMEDIA"]["USER_DATA"]=NULL;
		$_SESSION=NULL;
	}

	function canEdit(){
		return false;
	}

	function canAdd(){
		return false;
	}

	function isPageBelongs($pageData){
		if(!$pageData || !$_SESSION["LPMEDIA"]["USER_DATA"]){
			return false;
		}

		$sessionRow=$_SESSION["LPMEDIA"]["USER_DATA"];
		
		if($pageData["wm_landing_pages_customers"]==$sessionRow["ID"]){
			return true;
		}

		return false;
	}

	function allowedPageType($pageTypeId){
		$allowedPageTypes=array(56,57);
		if(in_array($pageTypeId, $allowedPageTypes)){
			return true;
		}
		return false;
	}


	function canAddElement(){
		return false;
	}

	function canDelete(){
		return false;
	}

	function canAddPage(){
		return false;
	}

	function canHideElement(){
		return true;
	}
}
?>
