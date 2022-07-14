<?php


class Auth{

	var $pm;
	var $users;
	var $objects;
	
	function Auth($pm){
		$this->pm=			$pm;
		$this->users=		$this->pm->userPerm->users;
		$this->objects=		$this->pm->userPerm->objects;
	}
	
	function getUser($UserName, $Password){
		return $this->users->getUser($UserName, $Password);
	}
	
	function isAllowed($Obj_Name){
		if(!$_SESSION["user_data"]["ID"]){
			return false;
		}
		$Obj_ID=$this->objects->getByName($Obj_Name);
		return $this->pm->userPerm->isAllowed($_SESSION["user_data"]["ID"], $Obj_ID);
	}
	
	function isAllowedId($Obj_ID){
		if(!$_SESSION["user_data"]["ID"]){
			return false;
		}
		return $this->pm->userPerm->isAllowed($_SESSION["user_data"]["ID"], $Obj_ID);
	}	
}
?>