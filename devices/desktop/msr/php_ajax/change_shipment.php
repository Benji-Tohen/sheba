<?php 
if(!$su->getLoginUser()){
	//echo "error";
	//	Create a temp user
	$su->loginStoreUser();
	//exit;
}
$shipment=intval($getParams[2]);

if(!$shipment){
	echo "error";
	exit;
}

echo $store->changeShipmentMethod($shipment);
?>
