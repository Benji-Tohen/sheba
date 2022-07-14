<?php
class Translate{

	var $db;
	var $translations;

	function Translate($db, $lang){
		$this->db=		$db;
		$this->translations=	$this->getTranslations($lang);
		$_SESSION["Translate"]["lastLang"]=	$lang;
	}

	function getTranslations($lang){
	
		if($_SESSION["Translate"]["lastLang"]==$lang && !$_SESSION["Translate"]["refresh"]){
			return $_SESSION["Translate"]["translations"];
		}

		$transArray=array();
		$query="SELECT * FROM wm_translate WHERE Lang='".mysqli_real_escape_string($this->db->conn, $lang)."'";
		$arrTrans=$this->db->getArray($query);
		for($i=0;$i<count($arrTrans);$i++){
			$transArray[$arrTrans[$i]["Name"]]=$arrTrans[$i]["Value"];	
		}

		$_SESSION["Translate"]["translations"]=$transArray;

		$_SESSION["Translate"]["refresh"]=false;

		return $transArray;
	}

	function getValue($key){
		if(!isset($this->translations[$key])){
			return false;
		}

		return $this->translations[$key];
	}

	function getText($key){
		$text=	$this->getValue($key);
		if($text){
			return $text;
		}

		return $key;
	}
}
?>
