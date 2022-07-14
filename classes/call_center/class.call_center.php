<?php
class CallCenter{

	var $db;
	var $customers_table;
	var $call_reason_table;
	var $applines_table;
	var $customer_relation_table;

	function CallCenter($db, $customers_table, $call_reason_table, $applines_table, $customer_relation_table){
		$this->db=								$db;
		$this->customers_table=					$customers_table;
		$this->call_reason_table=				$call_reason_table;
		$this->applines_table=					$applines_table;
		$this->customer_relation_table=			$customer_relation_table;
	}

	function getCallLines($start_date=NULL, $end_date=NULL, $customer_id=NULL){
		if(!$start_date){
			$start_date=date("Y-m-d", time());
		}
		if(!$end_date){
			$end_date=date("Y-m-d", time());
		}
		$query="SELECT * FROM ".$this->applines_table." WHERE return_date>='".$start_date."' AND return_date<='".$end_date."'";
		if($customer_id){
			$query.=" AND customer_id=".$customer_id;
		}
		$arr=$this->db->getArray($query);
		return $arr;
	}
	
	function getCustomerCallLines($customer_id=NULL){
		$query="SELECT * FROM ".$this->applines_table." WHERE 1";
		if($customer_id){
			$query.=" AND customer_id=".$customer_id;
		}
		$query.=" ORDER BY call_date, call_time, return_date, return_time";
		$arr=$this->db->getArray($query);
		return $arr;
	}	
	
	function delete($id){
		$this->db->runQuery("DELETE FROM ".$this->applines_table." WHERE id=".$id);
	}
	
	function getCallReasons(){
		return $this->db->getArray("SELECT * FROM ".$this->call_reason_table);
	}
	
	function getCustomer($customer_id){
		return $this->db->getRow("SELECT * FROM ".$this->customers_table." WHERE id=".$customer_id);
	}

}
?>