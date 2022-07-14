<?php
/*********************************************************************

	Class TreeData
	 

	Simple table sttructure for working with this class:
		tree_id   		int(11)  	   		No   	auto_increment   	  Change   	  Drop   	  Primary   	  Index   	  Unique   	 Fulltext
		tree_parent  	int(11) 	  		No  	0  	  	Change 	Drop 	Primary 	Index 	Unique 	Fulltext
		tree_oredring  	int(11) 	  		No  	0  	  	Change 	Drop 	Primary 	Index 	Unique 	Fulltext
		tree_name  		varchar(255) 	  	No  	  	  	Change 	Drop 	Primary 	Index 	Unique 	Fulltext

*********************************************************************/
class NewTreeData{
	
	var $db;
	var $table;
	var $id;

	/*****************************************
	*	Constructor
	*****************************************/
	function NewTreeData($db, $table){
		$this->db=		$db;
		$this->table=	$table;

		$query="SELECT COUNT(*) AS num FROM ".$this->table;
		if($this->db->getField($query, "num")==0){			
			$this->add(0, "Root");
		}
	}
	
	function getDB(){
		return $this->db;
	}

	function getTable(){
		return $this->table;
	}
	
	/*****************************************
	*	Display the tree
	*****************************************/	
	function display($id=0, $level=0, $cond="", $order="tree_oredring"){
		$query="SELECT * FROM ".$this->table." WHERE tree_parent=".$id.$cond." ORDER BY ".$order;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			echo "<br>".str_repeat(">", $level)." ".$arr[$i]["tree_name"];
			$this->display($arr[$i]["tree_id"], ($level+1), $cond, $order);
		}
	}
	
	/*****************************************
	*	EvalTree the tree
	*****************************************/	
	function evalTree($function, $id=0, $level=0, $cond="", $order="tree_oredring"){
		$query="SELECT * FROM ".$this->table." WHERE tree_parent=".$id.$cond." ORDER BY ".$order;
		$arr=$this->db->getArray($query);
		if(is_array($arr)){
			for($i=0;$i<count($arr);$i++){
				eval('$this->'.$function.', $id, $level);');
				$this->evalTree($function, $arr[$i]["tree_id"], ($level+1), $cond, $order, $function);
			}
		}
	}
	
	/*****************************************
	*	EvalTree the tree
	*****************************************/	
	function evalTreeExt($function, $id=0, $level=0, $cond="", $order="tree_oredring"){
		$query="SELECT * FROM ".$this->table." WHERE tree_parent=".$id.$cond." ORDER BY ".$order;
		$arr=$this->db->getArray($query);
		if(is_array($arr)){
			for($i=0;$i<count($arr);$i++){
				eval('$function('.$arr[$i]["tree_id"].', $level);');
				$this->evalTreeExt($function, $arr[$i]["tree_id"], ($level+1), $cond, $order, $function);
			}
		}
	}	
	
	/*****************************************
	*	Get the top id of the tree
	*****************************************/
	function getTop($cond=""){
		$query="SELECT MIN(tree_id) AS id FROM ".$this->table." WHERE tree_id>0".$cond;
		$id=$this->db->getField($query, "id");
		return $id;
	}

	/*****************************************
	*	Return the parent id
	*****************************************/
	function getParent($id=1, $cond=""){
		$query="SELECT tree_parent FROM ".$this->table." WHERE tree_id=".$id.$cond;
		return $this->db->getField($query, "tree_parent");
	}
	
	function getParentRow($id, $cond=""){
		$parent_id=$this->getParent($id, $cond);
		return $this->getValues($parent_id);
	}
	
	function getGrandfather($id=1, $cond=""){
		return $this->getParent($this->getParent($id, $cond), $cond);
	}	

	/*****************************************
	*	Delete Leaf
	*****************************************/
	function delete_leaf($id, $cond=""){
		return $this->delete_both($id, "", true);
	}


	/*****************************************
	*	Delete Leaf & Children
	*****************************************/
	function delete($id, $cond=""){
		return $this->delete_both($id, "", false);
	}

	function delete_both($id, $cond="", $only_children=true){
		$query="SELECT * FROM ".$this->table." WHERE tree_parent=".$id.$cond;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$this->deleteRelatedRecords($arr[$i]["tree_id"]);
			$this->delete_both($arr[$i]["tree_id"], $cond, $only_children);
			$query="DELETE FROM ".$this->table." WHERE tree_id=".$arr[$i]["tree_id"].$cond;
			$this->db->runQuery($query);
		}
		if($only_children){
			return true;
		}
		$this->deleteRelatedRecords($id);
		$query="DELETE FROM ".$this->table." WHERE tree_id=".$id.$cond;
		$this->db->runQuery($query);
		return true;
	}
	
	function deleteRelatedRecords($id){
	
	}
	
	/*****************************************
	*	Adds an inheriting child (duplicate)
	*****************************************/
	function add($parent=1, $newName="Untitled", $inherit=false, $sameParent=false){
		if($inherit){
			$row_defaults=$this->getValues($parent);
			$arrFields=array();
			foreach($row_defaults as $field => $value){
				if(strcmp($field, "tree_id")==0){
					continue;
				}
				$arrFields[$field]=$value;
			}
		}
		if($sameParent){
			$parent=$sameParent;
		}
		$arrFields["tree_parent"]=$parent;
		$arrFields["tree_name"]=$newName;

		if(strcmp($newName, "Untitled")!=0){
			$itemID=$this->db->getExistQuery("SELECT tree_id FROM ".$this->table." WHERE tree_parent=".$parent." AND tree_name=".mysqli_real_escape_string($this->db->conn, $newName));
		}
		
		if(!$itemID){
			$itemID=$this->db->updateData($this->table, $arrFields, NULL, "tree_id");
		}
			
		return $itemID;
	}

	/*****************************************
	*	Duplicate a node in the same parent
	*****************************************/	
	function duplicate($id=1, $newName=""){
		if(!$newName){
			$row=$this->getValues($id);
			$newName="Copy of ".$row["tree_name"];
		}
		$this->add($id, $newName, true, $this->getParent($id));
	}

	function get($id, $fieldName){
		$query="SELECT ".$fieldName." FROM ".$this->table." WHERE tree_id=".$id;
		return $this->db->getField($query, $fieldName);
	}

	/*****************************************
	*	Returns values of a node
	*****************************************/
	function getValues($id){
		$query="SELECT * FROM ".$this->table." WHERE tree_id=".$id;
		return $this->db->getRow($query);
	}

	/*****************************************
	*	Set new values for an existing record
	*****************************************/
	function setValues($id, $arrFieldsValues){
		$this->db->updateData($this->table, $arrFieldsValues, $id, "tree_id");
		return true;
	}
	
	/*****************************************
	*	Set new value for an existing record
	*****************************************/	
	function setValue($id, $field, $value){
		$arrFields=array($field => $value);
		$this->setValues($id, $arrFields);
		return true;
	}
	
	/*****************************************
	*	Move To another parent
	*****************************************/
	function move($id, $newParent){
		if(!$this->db->getExist($this->table, "tree_id", $newParent)){
			return false;
		}
		$this->setValue($id, "tree_parent", $newParent);
		return true;
	}
	
	/*****************************************
	*	For binary data only set on/off
	*****************************************/
	function check($id, $field, $cond=""){
		$query="SELECT ".$field." FROM ".$this->table." WHERE tree_id=".$id.$cond;
		if($this->db->getField($query, $field)==0){
			$this->setValue($id, $field, 1);
		}else{
			$this->setValue($id, $field, 0);
		}
	}
	
	/*****************************************
	*	Chacks if id has any children
	*****************************************/	
	function hasChildren($id, $cond=""){
		$query="SELECT COUNT(*) AS num FROM ".$this->table." WHERE tree_parent=".$id;
		$num=$this->db->getField($query, "num");
		return ($num>0);
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
		$query="SELECT tree_oredring FROM ".$this->table." WHERE tree_id=".$id.$cond;
		$ord=$this->db->getField($query, "tree_oredring");
			// 	0 - up / 1 - down
		if(($dir==0 && $ord==0) || ($dir==1 && $ord==($maxOrd-1))){
				//	Do not move beyond edges
			return false;
		}
		
		if($dir==0){
			$nextOrd=($ord-1);
		}else{
			$nextOrd=($ord+1);		
		}
		
		$query="UPDATE ".$this->table." SET tree_oredring=".$ord." WHERE tree_oredring=". $nextOrd ." AND tree_parent=".$this->getParent($id).$cond;
		$this->db->runQuery($query);
				
		$query="UPDATE ".$this->table." SET tree_oredring=".$nextOrd." WHERE tree_id=". $id.$cond;
		$this->db->runQuery($query);
				
		return true;		
	}
	
	function order($id, $cond=""){
		$query="SELECT * FROM ".$this->table." WHERE tree_parent=".$this->getParent($id).$cond." ORDER BY tree_oredring";
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$query="UPDATE ".$this->table." SET tree_oredring=". $i ." WHERE tree_id=".$arr[$i]["tree_id"].$cond;
			$this->db->runQuery($query);
		}
		return $i;
	}
	
	function isOnTop($id){
		if($this->get($id, "tree_oredring")==0){
			return true;
		}
		return false;
	}
	
	function isOnBottom($id){
		$max_order=$this->order($id);
		if($this->get($id, "tree_oredring")==$max_order-1){
			return true;
		}
		return false;
	}
	
	
	/*
	function getByName($Name){
		list($parent, $id)=explode("/", $Name);
		$query="SELECT tree_id FROM ".$this->table." WHERE tree_name='".$parent."'".$cond;
		$parent_id=$this->db->getField($query, "tree_id");

		$query="SELECT tree_id FROM ".$this->table." WHERE tree_parent=".$parent_id." AND tree_name='".$id."'".$cond;
	
		return $this->db->getField($query, "tree_id");
	}
	*/
	
	function getByName($Name){	
		$arr=explode("/", $Name);

		$query="SELECT tree_id FROM ".$this->table." WHERE tree_name='".$arr[0]."'".$cond;
		$parent_id=$this->db->getField($query, "tree_id");
		
		for($i=1;$i<count($arr);$i++){
			$query="SELECT tree_id FROM ".$this->table." WHERE tree_parent=".$parent_id." AND tree_name=".mysqli_real_escape_string($this->db->conn, $arr[$i]);
			$parent_id=$this->db->getField($query, "tree_id");
			if(!$parent_id){
				return false;
			}		
		}
		
		return $parent_id;
	}	
	
	function getArray($id, $cond=""){
		$query="SELECT * FROM ".$this->table." WHERE tree_parent=".$id.$cond;
		return $this->db->getArray($query);	
	}
	
	function getLastInOrder($parent){
		$query="SELECT MAX(tree_oredring) AS last_in_order FROM ".$this->table." WHERE tree_parent=".$parent;
		$lio=$this->db->getField($query, "last_in_order");;
		if(!$lio){
			$lio=0;
		}
		return $lio;
	}
	
	function getParentsArray($id, $arr=NULL, $level=0){
		if(!$arr){
			$arr=array();
		}
		
		//if($this->getParent($id)==0){
		if($id==0){
			return array_reverse($arr);
		}
		$row=$this->getValues($id);
		$arr[$level]=$row;
			
		return $this->getParentsArray($this->getParent($id), $arr, ++$level);
	}


	function inParents($id, $id_not){
		$arr=$this->getParents($id, $arr);
		for($i=0;$i<count($arr);$i++){
			if($arr[$i]["tree_id"]==$id_not){
				return true;
			}
		}
		return false;
	}	

	/************************************************************************
	*	Returns array list of parents
	*/
		function getParents($id, $arr){
			$row=$this->getValues($id);

			$numRows=count($arr);
			$arr[$numRows]["tree_id"]=$row;
			
			if($row["tree_parent"]==0){	//	Break the chain
				return array_reverse($arr);
			}
			return $this->getParents($row["parent"], $arr);
		}
	/*
	************************************************************************/


	function inParentsIds($id, $id_not){
		$arr=$this->getParentsIds($id, $arr);
		for($i=0;$i<count($arr);$i++){
			if($arr[$i]==$id_not){
				return true;
			}
		}
		return false;
	}		
	
	function getParentsIds($id, $arr){
		
		if(!is_array($arr)){
			$arr=array();
		}
		
		$arr[count($arr)]=$id;
			
		if($id==0){	//	Break the chain
			return array_reverse($arr);
		}
		return $this->getParentsIds($this->getParent($id), $arr);
	}

	function inChildren($parent, $id){
		if($parent==1){
			return false;
		}
		
		if($parent==$id){
			return true;
		}
		
		return $this->inChildren($this->getParent($parent), $id);
	}
	
	function getTopParentAfterRoot($id){

		if($this->getParent($id)==0){
			return $id;
		}
		
		if($this->getGrandfather($id)==1){
			return $id;
		}
				
		return $this->getTopParentAfterRoot($this->getParent($id));
	}


	function getTopValue($id, $fieldName){
		$thisValue=$this->get($id, $fieldName);
		if($this->getParent($id)==1){
			return $thisValue;
		}
		
		if($thisValue){
			return $thisValue;
		}
		
		
		if(!$thisValue){
			return $this->getTopValue($this->getParent($id), $fieldName);
		}
	}
	
	function getTopTrueID($id, $fieldName){
		$thisValue=$this->get($id, $fieldName);
		if($this->getParent($id)==1){
			return false;
		}
		
		if($thisValue){
			return $id;
		}
		
		
		if(!$thisValue){
			return $this->getTopTrueID($this->getParent($id), $fieldName);
		}
	}	
	
/*
*****************************************/


}
?>
