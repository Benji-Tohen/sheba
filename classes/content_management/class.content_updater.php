<?php
class ContentUpdater{

	var $db;
	var $table;
	
	var $lang;
	var $row_template;
	var $table_template;
	var $edit_template;	
	var $images_folder;		
	var $display;
	
	function ContentUpdater($db, $table){
		$this->db=		$db;
		$this->table=	$table;
	}
		
	function addDisplay($display){
		$this->display=$display;
	}	

	function add(){
		return $this->db->updateData($this->table, array());
	}

	function update($id=NULL, $fieldsArray){
		if(!$id){
			$id=$this->add();
		}

		$this->setValues($id, $fieldsArray);
		return $id;
	}
        
        function duplicate($id=NULL, $fieldsArray){
		if(!$id){
                    return;
		}
                $orgObj = $this->getValues($id);
                array_shift($orgObj);
                $id=$this->add();
		$this->update($id, $orgObj);
		return $id;
	}

	function setValue($id, $field, $value){
		$fieldsArray=array(
			$field	=>	$value
		);
		$this->setValues($id, $fieldsArray);
	}
	
	function setValues($id=NULL, $fieldsArray){
		$id=$this->db->updateData($this->table, $fieldsArray, $id);	
		if($id){
			return $id;
		}
		return true;
	}
	
	function delete($id){
		return $this->deleteByField("id", $id);
	}	
	
	function deleteByField($fieldName, $value){
		$query="DELETE FROM ".$this->table." WHERE ".mysqli_real_escape_string($this->db->conn, $fieldName)."='".mysqli_real_escape_string($this->db->conn, $value)."'";
		return $this->db->runQuery($query);
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
	
	function getValues($id){
		$query="SELECT * FROM ".$this->table." WHERE id=".intval($id);
		return $this->db->getRow($query);
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
	
	function getArray($query=NULL){
		if(!$query){
			$query="SELECT * FROM ".$this->table;
		}
		return $this->db->getArray($query);
	}
	
	function showList($query=NULL){
		$arr=$this->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$str_row=$this->row_template;
			
			$str_row=str_replace("[#CLASS#]", $this->display->getBg(), $str_row);
			$str_row=$str_row;
			foreach($arr[$i] as $var => $val){
				$str_row=str_replace("[#". $var ."#]", $val, $str_row);
			}
			$str.=$str_row;
		}
		return $str;
	}
	
	function showAllList($query){
		$str_table=$this->table_template;
		$str_table=str_replace("[#LANG_DIR#]", $this->display->getDirStr(), $str_table);
		
		$str=str_replace("[#TRDATA#]", $this->showList($query), $str_table);

		$str=translateAll($str);

		return $str;
	}	
	
	
	function action($id, $do, $query){
		if(strcmp($do, "delete")==0 && $id){
			$this->delete($id);
		}elseif(strcmp($do, "add")==0){
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
		
		return $this->showAllList($query);
	}		
	
	
	function get($id, $fieldName){
		return $this->db->getField("SELECT ".mysqli_real_escape_string($this->db->conn, $fieldName)." FROM ".$this->table." WHERE id=".intval($id), $fieldName);
	}
	
	
	/*****************************************
	*	Ordering
	*	Use Only 	orderUp($id)
	*		Or		orderDown($id)		
	*/
		/***********************************
		*	Move item up
		***********************************/
		function orderUp($id, $cond=""){
			return $this->orderUpDown($id, 0, $cond="");	
		}
		
		/***********************************
		*	Move item down
		***********************************/
		function orderDown($id, $cond=""){
			return $this->orderUpDown($id, 1, $cond="");	
		}
		
		function orderUpDown($id, $dir, $cond=""){
			$maxOrd=$this->order($id);
			$query="SELECT Ordering FROM ".$this->table." WHERE id=".intval($id).$cond;
			$ord=$this->db->getField($query, "Ordering");
				// 	0 - up / 1 - down
			if(($dir==0 && $ord==0) || ($dir==1 && $ord==$maxOrd)){
					//	Do not move beyond edges
				return false;
			}
			
			if($dir==0){
				$nextOrd=($ord-1);
			}else{
				$nextOrd=($ord+1);		
			}
			
			$query="UPDATE ".$this->table." SET Ordering=".$ord." WHERE Ordering=". $nextOrd.$cond;
			$this->db->runQuery($query);
					
			$query="UPDATE ".$this->table." SET Ordering=".$nextOrd." WHERE ID=".intval($id).$cond;
			$this->db->runQuery($query);
					
			return true;		
		}
		
		function order($id, $cond=""){
			$query="SELECT * FROM ".$this->table." WHERE ID>0".$cond." ORDER BY Ordering";
			$arr=$this->db->getArray($query);
			for($i=0;$i<count($arr);$i++){
				$query="UPDATE ".$this->table." SET Ordering=". $i ." WHERE ID=".$arr[$i]["ID"].$cond;
				$this->db->runQuery($query);
			}
			return $i;
		}
		
	/*
	*****************************************/	
	
	
		
}
?>
