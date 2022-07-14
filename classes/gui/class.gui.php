<?php
class Gui{
	
	var $lang;
	var $direction;
	
	function Gui($lang=NULL, $direction=NULL){
		if($direction){
			$this->direction=$direction;
		}else{
			$this->lang=$lang;
			$this->direction=(strcmp($this->lang, "he")==0 || strcmp($this->lang, "ar")==0);
		}
	}
	
	function getDir(){
		if($this->isRTL()){
			return "rtl";
		}
		return "ltr";
	}
	
	function getRight(){
		if($this->isRTL()){
			return "left";
		}
		return "right";
	}

	function getLeft(){
		if($this->isRTL()){
			return "right";
		}
		return "left";
	}
	
	function isRTL(){
		return ($this->direction=="rtl"?true:false);
	}
	
	function setDir($dir){
		$this->direction=($dir=="rtl"?true:false);
	}
}
?>
