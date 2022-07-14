<?php
class Shopping{

	var $db;
	var $customer_table;
	var $order_table;
	
	function Shopping($db, $customer_table, $order_table){
		$this->db=				$db;
		$this->customer_table=	$customer_table;		
		$this->order_table=		$order_table;
	}
	
	function addCustomer($fieldList){
		return $this->db->updateData($this->customer_table, $fieldList);
	}
	
	function addReservation($fieldList){
		return $this->db->updateData($this->order_table, $fieldList);
	}
	

}
?>