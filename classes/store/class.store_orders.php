<?php
class StoreOrders extends ContentUpdater{

	var $ordersDetails;
	var $orderId;

	function StoreOrders($db, $tableName){
		parent::ContentUpdater($db, $tableName);
		$this->ordersDetails=new StoreOrdersDetails($this->db, "wm_store_orders_details");
	}
	
	function getOpenOrderByUser($userId){
		if(!$userId){
			return false;
		}
		$query="
			SELECT ID
			FROM ".$this->table." 
			WHERE wm_siteusers=".intval($userId)." 
			AND wm_store_orders_status='open' 
			ORDER BY create_date DESC 
			LIMIT 0,1
		";
		return $this->db->getField($query, "ID");
	}

	function getLastOrderByUser($userId){
		if(!$userId){
			return false;
		}
		$query="
			SELECT *
			FROM ".$this->table." 
			WHERE wm_siteusers=".intval($userId)." 
			AND wm_store_orders_status!='open' 
			ORDER BY create_date DESC 
			LIMIT 0,1
		";
		return $this->db->getRow($query, "ID");
	}

	function setPaid($orderId=NULL){
		$this->setValue($orderId, "wm_store_orders_status", "paid");
		$this->setValue($orderId, "paid_date", TIME);
	}

	function setComplete($orderId=NULL){
		$this->setValue($orderId, "wm_store_orders_status", "complete");
		$this->setValue($orderId, "complete_date", TIME);
	}

	function addOrder($userId){
		$this->orderId=$this->add();
		$fieldsArray=array(
			"wm_siteusers"	=>	$userId,
			"create_date"	=>	TIME,
			"update_date"	=>	TIME
		);
		$this->setValues($this->orderId, $fieldsArray);
		return $this->orderId;
	}
	
	function updateOrder($orderId){
		$query="
			UPDATE wm_store_orders 
			SET 	wm_store_orders.update_date=".TIME.", 
				total_sum=(
						SELECT sum(total_price*quantity) 
						FROM wm_store_orders_details 
						WHERE wm_store_orders=".intval($orderId)."
						) +
					   (
						SELECT price 
						FROM wm_store_shipping 
						WHERE wm_store_shipping.ID=wm_store_orders.wm_store_shipping
						)
			WHERE ID=".intval($orderId)."
		";
		$this->db->runQuery($query);
		return $this->get($orderId, "total_sum");
	}

	function getOrderSubtotal($orderId=NULL){
		return $this->get($orderId, "total_sum");
	}
}
?>
