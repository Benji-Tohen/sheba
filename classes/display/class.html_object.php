<?php
require_once(dirname( __FILE__ )."/../array_ext/class.array_ext.php");

class HtmlObject{
	
	var $db;
	var $table;
	var $lang;
	
	function HtmlObject($db, $table, $lang="en"){
		$this->db=		$db;
		$this->table=	$table;
		$this->lang=	$lang;
	}
	
	function drawObject($fieldName, $defaultValue, $table=NULL){
		if(strcmp($fieldName, "ID")==0 || strcmp($fieldName, "Parent")==0 || strcmp($fieldName, "Ordering")==0){
			return $this->makeHiddenInput($fieldName, $defaultValue);
		}
		if(!$fieldType){
			$fieldType=$this->db->getFieldType($this->table, $fieldName);
		}
		if(strcmp($fieldType, "int")==0){
			if(!$table){
				$table=$fieldName;
			}
			$fieldListArr=$this->db->getAllTableFields($table);
			$ae=new ArrayExt();
			
			if($ae->in_multi_array("Parent", $fieldListArr)){
				$field=$this->makeTreeSelectWindow($fieldName, $defaultValue, $this->lang, $table);
			}else{
				$field=$this->makeSelect($fieldName, $defaultValue, $this->lang, $table);
			}
			if(!$field){
				$field=$this->makeTextInput($fieldName, $defaultValue);
			}
			return $field;
		}elseif(strcmp($fieldType, "string")==0){
			return $this->makeTextInput($fieldName, $defaultValue);
		}elseif(strcmp($fieldType, "date")==0){
			return $this->makeDateSelect("edit", $fieldName, $defaultValue);
		}elseif(strcmp($fieldType, "blob")==0){
			return $this->makeTextArea($fieldName, $defaultValue);
		}
		
		return $fieldType;
	}
	
	function makeTextInput($filedName, $defaultValue){
		$str="<input type=\"text\" name=\"".$filedName."\" id=\"".$filedName."\" value=\"".$defaultValue."\" class=\"obj_text\">";
		return $str;
	}
	
	function makeTextArea($filedName, $defaultValue){
		$str="<textarea name=\"".$filedName."\" id=\"".$filedName."\" class=\"obj_textarea\">".$defaultValue."</textarea>";
		return $str;
	}	

	function makeHiddenInput($filedName, $defaultValue){
		$str="<input type=\"hidden\" name=\"".$filedName."\" id=\"".$filedName."\" value=\"".$defaultValue."\" class=\"obj_select\">";
		return $str;
	}

	function makeSelect($fieldName, $defaultValue=0, $lang="en", $table=NULL){
		$lang_def="";
		if(!$table){
			$table=$fieldName;
		}
		if(strcmp($lang, "en")!=0){
			$lang_def="_lang";
		}
		$str="<select name=\"".$fieldName."\" class=\"obj_select\">";
		$query = "SELECT ID, Name".$lang_def." FROM ".$table." ORDER BY Ordering";

		$arr=$this->db->getArray($query);	
		if(!$arr){
			return false;
		}
		for($i=0;$i<count($arr);$i++){
			$str.="\r\n<option value=\"".$arr[$i]["ID"]."\"";
			if($arr[$i]["ID"]==$defaultValue){
				$str.=" SELECTED";
			}
			$str.=">".$arr[$i]["Name".$lang_def]."</option>";
		}
		
		$str.="</select>";
		return $str;
	}
	
		
	/************************************************************************************************************
	*	Creats a Date field selection																			*
	/***********************************************************************************************************/
	function makeDateSelect($formName, $fieldName, $current, $start=1969, $end=2024, $do_empty=false, $lang="en"){
		$str="";
		if(!$current || strcmp($current, "0000-00-00")==0){
			$current=date("Y-m-d", time());
		}
		list ($year, $month, $day) = split ('[/.-]', $current);
		$str.= "<table cellspacing=0 cellpadding=0 border=0><tr><td><SELECT class=\"obj_date_select\" NAME='hidden_". $fieldName. "_d' onChange=\"document.".$formName.".". $fieldName .".value=document.". $formName .".hidden_". $fieldName ."_y.value+'-'+document.".$formName.".hidden_". $fieldName ."_m.value+'-'+document.".$formName.".hidden_". $fieldName ."_d.value;\">";
						if($do_empty){
							$str.= "<OPTION VALUE=\"\" ".($current?"":"SELECTED").">--</OPTION>";
						}
						for($i=1;$i<=31;$i++){
							$str.= "<OPTION VALUE=";
							$str.= $i;
							if($i==$day)
								$str.= " SELECTED";
							$str.= ">" .$i. "</OPTION>";
						}
		$str.= "</SELECT></td><td><SELECT class=\"obj_date_select\" NAME='hidden_". $fieldName ."_m'  onChange=\"document.".$formName.".". $fieldName .".value=document.". $formName .".hidden_". $fieldName ."_y.value+'-'+document.".$formName.".hidden_". $fieldName ."_m.value+'-'+document.".$formName.".hidden_". $fieldName ."_d.value;\">";
						if($do_empty){
							$str.= "<OPTION VALUE=\"\" ".($current?"":"SELECTED").">--</OPTION>";
						}
						for($i=1;$i<=12;$i++){
							$str.= "<OPTION VALUE=";
							if($i<10)
								$str.= "0";
							$str.= $i;
							if($i==$month)
								$str.= " SELECTED";
							
							$str.= ">" .date("M", mktime (0,0,0,$i+1,0,0)). "</OPTION>";
							
						}
		$str.= "</SELECT></td><td><SELECT class=\"obj_date_select\" NAME='hidden_". $fieldName ."_y' onChange=\"document.".$formName.".". $fieldName .".value=document.". $formName .".hidden_". $fieldName ."_y.value+'-'+document.".$formName.".hidden_". $fieldName ."_m.value+'-'+document.".$formName.".hidden_". $fieldName ."_d.value;\">";
						if($do_empty){
							$str.= "<OPTION VALUE=\"\" ".($current?"":"SELECTED").">--</OPTION>";
						}
						for($i=$start;$i<=$end;$i++){
							$str.= "<OPTION VALUE=". $i;
							if($i==$year)
								$str.= " SELECTED";
							$str.= ">" .$i. "</OPTION>";
						}
		$str.= "</SELECT></td><td>";
		$str.= "<input type=\"hidden\" name=\"". $fieldName ."\" value=\"\">";
		$str.="</td></tr></table>";
		$str.="\r\n";
		$str.="<script language=\"JavaScript\">\r\n";
		$str.="\r\nfunction ". $fieldName ."_makeDate(){
		\r\ndocument.".$formName.".". $fieldName .".value=document.". $formName .".hidden_". $fieldName ."_y.value+\"-\"+document.".$formName.".hidden_". $fieldName ."_m.value+\"-\"+document.".$formName.".hidden_". $fieldName ."_d.value;\r\n
		\r\nif(!document.". $formName .".hidden_". $fieldName ."_y.value || !document.". $formName .".hidden_". $fieldName ."_m.value || !document.". $formName .".hidden_". $fieldName ."_d.value){
		\r\ndocument.".$formName.".". $fieldName .".value='';
		\r\n}
		}\r\n". $fieldName ."_makeDate();\r\n";
		$str.="\r\n</script>\r\n";
			
		return $str;
	}
	
	function makeTreeSelectWindow($fieldName, $defaultValue=0, $lang="en", $table=NULL){
		$defaultName=$this->db->getField("SELECT Name FROM $table WHERE ID=".$defaultValue, "Name");
		
		$str="<span id=\"span_$fieldName\">$defaultName</span><input type=\"hidden\" name=\"$fieldName\" value=\"$defaultValue\" />
		&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-weight: bold;cursor: pointer;\" onClick=\"objectsWindow=openWin('../windows/select_$fieldName.php', 300, 300);\">Choose</span>";
		
		$str.="
		<script language=\"javascript\">
			function set$fieldName(val, name){
				document.getElementById(\"span_$fieldName\").innerHTML=name;
				document.edit.$fieldName.value=val;
			}
		</script>";
		
		return $str;
	}	
}
?>