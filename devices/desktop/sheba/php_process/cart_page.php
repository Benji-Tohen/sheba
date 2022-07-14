<?php
$orderItems=		$store->getOrderItems();
$orderSum=		$store->getOrderSubtotal();
$shipmentMethods=	$store->getShipmentMethods();
$shipmentMethod=	$store->getShipmentMethod();
$_SESSION["Payment_Amount"]=$orderSum;
?>
