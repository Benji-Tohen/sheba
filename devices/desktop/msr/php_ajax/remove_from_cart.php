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

$itemRow=$store->orders->ordersDetails->getValues($itemId);

$success=$store->deleteOrderItem($itemId);

if($success){
	$removedText="<div class=\"cartItemRemovedText\"><div class=\"cartItemRemovedItemName\">".$itemRow["Name"]."</div> ".$trans->getText("Has been removed from your cart")."</div>";
	echo $removedText;
}else{
	echo "error";
}
?>
