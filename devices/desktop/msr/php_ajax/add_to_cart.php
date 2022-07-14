<?php 
if(!$su->getLoginUser()){
	//echo "error";
	//	Create a temp user
	$su->loginStoreUser();
	//exit;
}
$itemId=intval($getParams[2]);

if(!$itemId){
	echo "error";
	exit;
}

$itemRow=$wm->getValues($itemId);

$time=time();

$fieldsArray=array(
	"Name"		=>	$wm->get($itemId, "Name"),
	"wm_pages"	=>	$itemId,
	"quantity"	=>	1,
	"price"		=>	$itemRow["price"],
	"total_price"	=>	($itemRow["price"]-$itemRow["discount"]),
	"create_date"	=>	TIME,
	"update_date"	=>	TIME	
);
$store->addOrderItem($fieldsArray);

echo $store->getNumItemsInCart();
?>
