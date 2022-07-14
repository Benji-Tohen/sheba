<?php
require_once('../tree/class.TreeData.php');
require_once('../display/class.display.php');
require_once('../display/class.html_object.php');
require_once('../DB/class.database.php');

class TreeContentUpdater extends TreeData{

	var $lang;
	var $row_template;
	var $table_template;
	var $edit_template;	
	var $images_folder;		
	var $display;
	
	function addDisplay($display){
		$this->display=$display;
	}
	
	function showTree($id=0, $level=0, $cond="", $order="Ordering"){
		$query="SELECT * FROM ".$this->table." WHERE Parent=".$id.$cond." ORDER BY ".$order;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$str_row=$this->row_template;

			$str_row=str_replace("[#CLASS#]", $this->display->getBg(), $str_row);
			$str_row=str_replace("[#SPACE#]", str_repeat("&nbsp;&nbsp;&nbsp;", $level), $str_row);
			foreach($arr[$i] as $var => $val){
				$str_row=str_replace("[#". $var ."#]", $val, $str_row);
			}
			$str.=$str_row;
			$str.=$this->showTree($arr[$i]["ID"], ($level+1), $cond, $order);
		}
		
		return $str;
	}
	
	function showAllTree($id){
		$str_table=$this->table_template;
		$str_table=str_replace("[#LANG_DIR#]", $this->display->getDirStr(), $str_table);
		
		$str=str_replace("[#TRDATA#]", $this->showTree($id), $str_table);

		$str=translateAll($str);

		return $str;
	}

	function edit($id){
		$htmlObj=new HtmlObject($this->db, $this->table);
		$str_edit=$this->edit_template;
		$row=$this->getValues($id);
		
		$str_edit=str_replace("[#PHP_SELF#]", $_SERVER['PHP_SELF'], $str_edit);
		foreach($row as $var => $val){
			$str_edit=str_replace("[#". $var ."#]", trans($var), $str_edit);
			$str_edit=str_replace("[#Field_". $var ."#]", $htmlObj->drawObject($var, $val), $str_edit);			
		}
		
		return $str_edit;
	}

		
	function updatePost($id){
		$fieldsArr=array();
		foreach($_POST as $var => $val){
			if(strcmp(substr($var, 0, 6), "hidden")!=0){
				$fieldsArr[$var]="'".$val."'";
			}
		}
		$this->setValues($id, $fieldsArr);
	}

	function action($id, $do, $disp_id=0){
		if(strcmp($do, "delete")==0 && $id){
			$this->delete($id);
		}elseif(strcmp($do, "add")==0 && $id){
			return $this->edit($this->add($id));
		}elseif(strcmp($do, "duplicate")==0 && $id){
			return $this->duplicate($id);
		}elseif(strcmp($do, "edit")==0 && $id){
			return $this->edit($id);
		}elseif(strcmp($do, "update")==0 && $id){
			$this->updatePost($id);
		}elseif(strcmp($do, "moveUp")==0 && $id){
			$this->orderUp($id);
		}elseif(strcmp($do, "moveDown")==0 && $id){
			$this->orderDown($id);	
		}
		return $this->showAllTree($disp_id);
	}	
	
}
?>