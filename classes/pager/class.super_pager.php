<?php
class SuperPager{
	
	var $db;
	var $query;
	var $fields;
	var $where;
	var $group;
	var $order;
	var $itemsPerPage;
	var $numResults;
	var $numPages;
	var $startAt;
	var $numFoundInPage;
	var $startNumber;
	var $endNumber;

	function SuperPager($db, $query, $fields="*", $where, $group="", $order="", $itemsPerPage=5, $count="COUNT(*)"){
	
		$this->db=		$db;
		$this->query=		$query;
		$this->fields=		$fields;
		$this->where=		$where;
		$this->group=		$group;
		$this->order=		$order;
		$this->itemsPerPage=	$itemsPerPage;
		
		
		//echo "<br>".$count.'<br/>';
		$this->numResults=	$this->db->getField("SELECT ".$count." AS num ".$query." ".$where, "num");

		$this->numPages=	ceil($this->numResults/$itemsPerPage);
		//echo "<br>Res: ".$this->numResults." -- Pages:".$this->numPages;
		//echo "<br>"."SELECT ".$count." AS num ".$query." ".$where.'<br/>';
		
	}

	function getNumResults(){
		return $this->numResults;
	}

	function getNumPages(){
		return $this->numPages;
	}

	function getStartAt(){
		return $startAt;
	}

	function getNumFoundInPage(){
		return $this->numFoundInPage;
	}

	function getStartNumber(){
		return $this->startNumber;
	}

	function getEndNumber(){
		return $this->endNumber;
	}

	function getPage($page){
		
		$this->startAt=(intval($page-1)*$this->itemsPerPage);
		$query="SELECT ".$this->fields." ".$this->query." ".$this->where." ".$this->group." ".$this->order." LIMIT ".$this->startAt.",".$this->itemsPerPage;
		
		$itemsArr=$this->db->getArray($query);
		$this->numFoundInPage=count($itemsArr);
		
		$this->startNumber=	(intval($page-1)*$this->itemsPerPage)+1;
		$this->endNumber=	$this->startNumber+$this->numFoundInPage-1;
		

		return $itemsArr;
	}



}
?>
