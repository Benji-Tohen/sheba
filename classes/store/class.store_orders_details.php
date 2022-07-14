<?php
class StoreOrdersDetails extends ContentUpdater{
	
	function StoreOrdersDetails($db, $tableName){
		parent::ContentUpdater($db, $tableName);
	}

	function addItem($fieldsArray){
		$itemId=$this->add();
		$this->setValues($itemId, $fieldsArray);
		return $itemId;
	}

	function updateOrderItem($orderItemId, $fieldsArray){
		if(!$orderItemId){
			$orderItemId=$this->addItem($fieldsArray);
		}

		$this->setValues($orderItemId, $fieldsArray);
		return $itemId;
	}

	function getOrderItems($orderId){
		$query="
			SELECT * 
			FROM wm_store_orders_details 
			WHERE wm_store_orders=".intval($orderId)." 
			ORDER BY create_date
		";
		return $this->db->getArray($query);
	}

	function getOrderItemId($orderId, $pageItemId){
		$query="
			SELECT ID
			FROM wm_store_orders_details 
			WHERE wm_pages=".intval($pageItemId)." AND wm_store_orders=".intval($orderId)." 
		";

		return $this->db->getField($query, "ID");
	}

	function getNumItemsInCart($orderId){
		$query="
			SELECT SUM(quantity) AS num 
			FROM ".$this->table." 
			WHERE wm_store_orders=".intval($orderId)."
		";
		return $this->db->getField($query, "num");
	}
}
?>
