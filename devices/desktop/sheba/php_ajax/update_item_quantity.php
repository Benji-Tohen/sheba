<?php 
if(!$su->getLoginUser()){
	//echo "error";
	//	Create a temp user
	$su->loginStoreUser();
	//exit;
}
$itemId=	intval($getParams[2]);
$quantity=	intval($getParams[3]);


if(!$itemId){
	echo "error";
	exit;
}

$itemRow=$wm->getValues($itemId);

$time=time();

$fieldsArray=array(
	"quantity"	=>	$quantity,
	"update_date"	=>	TIME	
);
$store->updateOrderItem($itemId, $fieldsArray);

echo $store->getNumItemsInCart();
?>
