<?php
class Display{

	var $lang;
	var $bgFlag;
	
	function Display($lang){
		$this->lang=$lang;
		$this->bgFlag=0;
	}
	
	function getLang(){
		return $this->lang;
	}

	function isRtl($lang=NULL){
		if($lang==NULL){
			$lang=$this->lang;
		}
		if(strcmp($lang, "he")==0 || strcmp($lang, "ar")==0){
			return true;
		}
		return false;
	}	
	
	function getDirStr($lang=NULL){
		if($lang==NULL){
			$lang=$this->lang;
		}
		if($this->isRtl($lang)){
			return "rtl";
		}
		return "ltr";	
	}
	
	function getBg(){
		$this->bgFlag++;
		if(($this->bgFlag%2)==0){
			return "class=\"list_line_1\"";
		}else{
			return "class=\"list_line_2\"";
		}
	}
}
?>