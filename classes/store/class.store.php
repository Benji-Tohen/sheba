<?php
class Store extends WebMaster{

	var $orderId;
	var $orders;
	var $ordersDetails;
	var $su;

	function Store($db, $table, $orderId=NULL){
		parent::WebMaster($db, $table);

		$this->su=		new StoreUsers($this->db, "wm_siteusers");
		$this->orders=		new StoreOrders($this->db, "wm_store_orders");

		if($orderId){
			$this->orderId=$orderId;
		}else{
			$this->orderId=		$this->getOpenOrderId();
		}
	}

	function addOrder(){
		$this->orderId=$this->orders->addOrder($this->su->getCurrentUser());
		return $this->orderId;
	}

	function getOrder(){
		if(!$this->orderId){
			$this->getOpenOrder();
		}
		return $this->orderId;
	}

	function getOpenOrder($userId=NULL){
		$this->getOpenOrderId($userId);
		return $this->orders->getValues($this->orderId);
	}

	function getOpenOrderId($userId=NULL){
		if(!$userId){
			$userId=$this->su->getCurrentUser();
			if(!$userId){
				return false;
			}
		}

		$this->orderId=$this->orders->getOpenOrderByUser($userId);
		$this->orderId=($this->orderId?$this->orderId:NULL);
		return $this->orderId;
	}

	function transferOrderId($newUser, $orderId){
		$this->setDetails(array("wm_siteusers" => $newUser), $orderId);
	}

	function updateOrderItem($orderItemId=NULL, $fieldsArray, $addIfExists=false){
		$orderId=$this->getOpenOrderId();
		if($orderId){
			if(!$orderItemId){
				$orderItemId=$this->orders->ordersDetails->getOrderItemId($orderId, $fieldsArray["wm_pages"]);
			}
		}else{
			$this->orderId=$this->addOrder();
		}

		$fieldsArray["wm_store_orders"]=$this->orderId;

		if($orderItemId){
			if($addIfExists){
				$numItems=$this->orders->ordersDetails->get($orderItemId, "quantity");
				$fieldsArray["quantity"]=($numItems+1);
			}
		}else{
			$orderItemId=$this->orders->ordersDetails->add();			
		}

		$this->orders->ordersDetails->updateOrderItem($orderItemId, $fieldsArray);

		return $orderItemId;
	}

	function addOrderItem($fieldsArray){
		return $this->updateOrderItem(NULL, $fieldsArray, true);
	}

	function itemExistsInOrder($itemId){
		$query="
			SELECT quantity  
			FROM ".$this->table." 
			WHERE wm_store_orders=".intval($this->orderId)." AND wm_pages=".intval($itemId)."
		";
		return $this->db->getField($query);
	}

	function getOrderItems($orderId=NULL){
		if(!$orderId){
			$orderId=$this->getOpenOrderId();
			if(!$orderId){
				return false;
			}
		}
		
		return $this->orders->ordersDetails->getOrderItems($orderId);
	}

	function thisOrderBelongsToThisUser($orderId, $userId){
		$orderUser=$this->orders->get($orderId, "wm_siteusers");
		if($userId!=$orderUser){
			return false;
		}
		return true;
	}

	function getNumItemsInCart(){
		$numItems=$this->orders->ordersDetails->getNumItemsInCart($this->orderId);
		$this->orders->updateOrder($this->orderId);
		return $numItems;
	}

	function deleteOrderItem($orderItemId){
		$itemOrder=$this->orders->ordersDetails->get($orderItemId, "wm_store_orders");

		if(!$this->thisOrderItemBelonsToThisUser($orderItemId)){
			return false;
		}
		$result=$this->orders->ordersDetails->delete($orderItemId);

		$this->orders->updateOrder($itemOrder);
		return $result;
	}

	function thisOrderItemBelonsToThisUser($orderItemId){
		$userId=$this->su->getCurrentUser();

		if($this->thisOrderBelongsToThisUser($this->orders->ordersDetails->get($orderItemId, "wm_store_orders"), $userId)){
			return true;
		}
		return false;
	}

	function getOrderSubtotal($orderId=NULL){
		if(!$orderId){
			$orderId=$this->orderId;
		}
		return $this->orders->getOrderSubtotal($orderId);
	}

	function getShipmentMethods(){
		$query="
			SELECT * 
			FROM wm_store_shipping 
			ORDER BY Ordering
		";
		return $this->db->getArray($query);
	}

	function changeShipmentMethod($shipmentId){
		$orderId=$this->getOpenOrderId();
		$this->orders->setValue($orderId, "wm_store_shipping", $shipmentId);
		return $this->orders->updateOrder($orderId);
	}

	function getShipmentMethod(){
		$shipmentMethod=	$this->orders->get($this->orderId, "wm_store_shipping");
		return $shipmentMethod;
	}

	function getShipmentPrice(){
		$shipmentMethod=$this->getShipmentMethod();
		$query="
			SELECT price
			FROM wm_store_shipping 
			WHERE ID=".$shipmentMethod."
		";
		$shipmentPrice=		$this->db->getField($query, "price");

		return $shipmentPrice;
	}

	function setPaid(){
		$orderId=$this->getOpenOrderId();
		$this->orders->setPaid($orderId);
	}

	function setComplete(){
		$orderId=$this->getOpenOrderId();
		$this->orders->setPaid($orderId);
	}

	function setDetails($arrFields, $orderId=NULL){
		if(!$orderId){
			$orderId=$this->getOpenOrderId();
		}
		if($orderId){
			$this->orders->setValues($orderId, $arrFields);
		}
	}

	function getLastOrderData($userId){
		return $this->orders->getLastOrderByUser($userId);
	}
}
?>
