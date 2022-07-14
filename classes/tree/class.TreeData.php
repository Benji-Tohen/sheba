<?php
/*********************************************************************

	Class TreeData
	 

	Simple table sttructure for working with this class:
		ID   		int(11)  	   		No   	auto_increment   	  Change   	  Drop   	  Primary   	  Index   	  Unique   	 Fulltext
		Parent  	int(11) 	  		No  	0  	  	Change 	Drop 	Primary 	Index 	Unique 	Fulltext
		Ordering  	int(11) 	  		No  	0  	  	Change 	Drop 	Primary 	Index 	Unique 	Fulltext
		Name  		varchar(255) 	  	No  	  	  	Change 	Drop 	Primary 	Index 	Unique 	Fulltext
		Value  		text 	  			No  	  	  	Change 	Drop 	Primary 	Index 	Unique 	Fulltext

*********************************************************************/
class TreeData{
	
	var $db;
	var $table;
	var $id;

	/*****************************************
	*	Constructor
	*****************************************/
	function TreeData($db, $table){
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
	function display($id=0, $level=0, $cond="", $order="Ordering"){
		$query="SELECT * FROM ".$this->table." WHERE Parent=".intval($id).$cond." ORDER BY ".$order;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			//echo "<br>".str_repeat(">", $level)." ".$arr[$i]["Name"];
			$this->display($arr[$i]["ID"], ($level+1), $cond, $order);
		}
	}
	
	/*****************************************
	*	EvalTree the tree
	*****************************************/	
	function evalTree($function, $id=0, $level=0, $cond="", $order="Ordering"){
		$query="SELECT * FROM ".$this->table." WHERE Parent=".$id.$cond." ORDER BY ".$order;
		$arr=$this->db->getArray($query);
		if(is_array($arr)){
			for($i=0;$i<count($arr);$i++){
				eval('$this->'.$function.', $id, $level);');
				$this->evalTree($function, $arr[$i]["ID"], ($level+1), $cond, $order, $function);
			}
		}
	}
	
	/*****************************************
	*	EvalTree the tree
	*****************************************/	
	function evalTreeExt($function, $id=0, $level=0, $cond="", $order="Ordering", $stopLevel=NULL, $fields="*"){
		if($stopLevel!=NULL && $level>0 && $level==$stopLevel){
			return;
		}
		$query="SELECT ".$fields." FROM ".$this->table." WHERE Parent=".$id.$cond." ORDER BY ".$order;
		$arr=$this->db->getArray($query);
		if(is_array($arr)){
			for($i=0;$i<count($arr);$i++){
				eval('$function('.$arr[$i]["ID"].', $level);');
				$this->evalTreeExt($function, $arr[$i]["ID"], ($level+1), $cond, $order, $stopLevel, $fields);
			}
		}
	}	
	
	/*****************************************
	*	Get the top id of the tree
	*****************************************/
	function getTop($cond=""){
		$query="SELECT MIN(ID) AS id FROM ".$this->table." WHERE ID>0".$cond;
		$id=$this->db->getField($query, "id");
		return $id;
	}

	/*****************************************
	*	Return the parent id
	*****************************************/
	function getParent($id=1, $cond=""){
		$query="SELECT Parent FROM ".$this->table." WHERE ID=".$id.$cond;
		return $this->db->getField($query, "Parent");
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
		$query="SELECT * FROM ".$this->table." WHERE Parent=".intval($id).$cond;
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$this->deleteRelatedRecords($arr[$i]["ID"]);
			$this->delete_both($arr[$i]["ID"], $cond, $only_children);
			$query="DELETE FROM ".$this->table." WHERE ID=".$arr[$i]["ID"].$cond;
			$this->db->runQuery($query);
		}
		if($only_children){
			return true;
		}
		$this->deleteRelatedRecords($id);
		$query="DELETE FROM ".$this->table." WHERE ID=".$id.$cond;
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
				if(strcmp($field, "ID")==0){
					continue;
				}
				$arrFields[$field]=$value;
			}
		}
		if($sameParent){
			$parent=$sameParent;
		}
		$arrFields["Parent"]=$parent;
		$arrFields["Name"]=$newName;

/*
		if(strcmp($newName, "Untitled")!=0){
			$itemID=$this->db->getExistQuery("SELECT ID FROM ".$this->table." WHERE Parent=".$parent." AND Name='".$newName."'");
		}
*/		
		if(!$itemID){
			$itemID=$this->db->updateData($this->table, $arrFields);
		}
			
		return $itemID;
	}

	/*****************************************
	*	Duplicate a node in the same parent
	*****************************************/	
	function duplicate($id=1, $newName=""){
		if(!$newName){
			$row=$this->getValues($id);
			$newName="Copy of ".$row["Name"];
		}
		$this->add($id, $newName, true, $this->getParent($id));
	}

	function get($id, $fieldName, $cond="1"){
		$query="SELECT ".$fieldName." FROM ".$this->table." WHERE ID=".intval($id);
		$query.=" AND ".$cond;
		return $this->db->getField($query, $fieldName);
	}

	/*****************************************
	*	Returns values of a node
	*****************************************/
	function getValues($id){
		$query="SELECT * FROM ".$this->table." WHERE ID=".intval($id);
		return $this->db->getRow($query);
	}

	/*****************************************
	*	Set new values for an existing record
	*****************************************/
	function setValues($id, $arrFieldsValues){
		$this->db->updateData($this->table, $arrFieldsValues, $id);
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
		if(!$this->db->getExist($this->table, "ID", $newParent)){
			return false;
		}
		$this->setValue($id, "Parent", $newParent);
		return true;
	}
	
	/*****************************************
	*	For binary data only set on/off
	*****************************************/
	function check($id, $field, $cond=""){
		$query="SELECT ".$field." FROM ".$this->table." WHERE ID=".$id.$cond;
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
		$query="SELECT COUNT(*) AS num FROM ".$this->table." WHERE Parent=".$id;
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
	function orderUp($id, $cond="1"){
		return $this->orderUpDown($id, 0, $cond);	
	}
	
	/***********************************
	*	Move item down
	***********************************/
	function orderDown($id, $cond="1"){
		return $this->orderUpDown($id, 1, $cond);	
	}
	
	function orderUpDown($id, $dir, $cond="1"){
		$maxOrd=$this->order($id, $cond);
		$query="SELECT Ordering FROM ".$this->table." WHERE ".$cond." AND ID=".intval($id);
		$ord=$this->db->getField($query, "Ordering");
			// 	0 - up / 1 - down
		if(($dir==0 && $ord==0) || ($dir==1 && $ord==($maxOrd))){
				//	Do not move beyond edges
			return false;
		}
		
		if($dir==0){
			$nextOrd=($ord-1);
		}else{
			$nextOrd=($ord+1);		
		}
		
		$query="UPDATE ".$this->table." SET Ordering=".$ord." WHERE ".$cond." AND Ordering=". $nextOrd ." AND Parent=".$this->getParent($id);
		$this->db->runQuery($query);
				
		$query="UPDATE ".$this->table." SET Ordering=".$nextOrd." WHERE ".$cond." AND ID=".intval($id);
		$this->db->runQuery($query);
				
		return true;		
	}
	
	function order($id, $cond="1"){
		$query="SELECT * FROM ".$this->table." WHERE ".$cond." AND Parent=".$this->getParent($id)." ORDER BY Ordering";
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$query="UPDATE ".$this->table." SET Ordering=". ($i+1) ." WHERE ".$cond." AND ID=".$arr[$i]["ID"];
			$this->db->runQuery($query);
		}
		return $i;
	}

	function orderParent($id, $cond="1"){
		$query="SELECT * FROM ".$this->table." WHERE ".$cond." AND Parent=".intval($id)." ORDER BY Ordering";
		$arr=$this->db->getArray($query);
		for($i=0;$i<count($arr);$i++){
			$query="UPDATE ".$this->table." SET Ordering=". ($i+1) ." WHERE ".$cond." AND ID=".$arr[$i]["ID"];
			$this->db->runQuery($query);
		}
		return $i;
	}
	
	function isOnTop($id, $cond="1"){
		if($this->get($id, "Ordering", $cond)==1){
			return true;
		}
		return false;
	}
	
	function isOnBottom($id, $cond="1"){
		$max_order=$this->order($id, $cond);
		
		if($this->get($id, "Ordering", $cond)==$max_order){
			return true;
		}
		return false;
	}
	
	
	/*
	function getByName($Name){
		list($parent, $id)=explode("/", $Name);
		$query="SELECT ID FROM ".$this->table." WHERE Name='".$parent."'".$cond;
		$parent_id=$this->db->getField($query, "ID");

		$query="SELECT ID FROM ".$this->table." WHERE Parent=".$parent_id." AND Name='".$id."'".$cond;
	
		return $this->db->getField($query, "ID");
	}
	*/
	
	function getByName($Name){	
		$arr=explode("/", $Name);

		$query="SELECT ID FROM ".$this->table." WHERE Name='".$arr[0]."'".$cond;
		$parent_id=$this->db->getField($query, "ID");
		
		for($i=1;$i<count($arr);$i++){
			$query="SELECT ID FROM ".$this->table." WHERE Parent=".$parent_id." AND Name='".$arr[$i]."'".$cond;
			$parent_id=$this->db->getField($query, "ID");
			if(!$parent_id){
				return false;
			}		
		}
		
		return $parent_id;
	}	
	
	function getArray($id, $cond="", $onlyFields="*", $orderBy="Ordering"){
		$query="SELECT ".$onlyFields." FROM ".$this->table." WHERE Parent=".$id.$cond;
		return $this->db->getArray($query);	
	}
	
	function getLastInOrder($parent){
		$query="SELECT MAX(Ordering) AS last_in_order FROM ".$this->table." WHERE Parent=".$parent;
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
			if($arr[$i]["ID"]==$id_not){
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
			$arr[$numRows]["ID"]=$row;
			
			if($row["Parent"]==0){	//	Break the chain
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

		if(!$id){
			return false;
		}

		if($this->getParent($id)==0){
			return $id;
		}
		
		if($this->getGrandfather($id)==1){
			return $id;
		}
				
		return $this->getTopParentAfterRoot($this->getParent($id));
	}


	function getTopValue($id, $fieldName){

		if(!$id){
			return false;
		}

		$thisValue=$this->get($id, $fieldName);

		if($this->getParent($id)==1){
			return $thisValue;
		}
		
		if($thisValue && $thisValue!="<br />"){
			return $thisValue;
		}		

		
		return $this->getTopValue($this->getParent($id), $fieldName);
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
