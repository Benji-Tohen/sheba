<?php
if(!$store->getOrder()){
	echo "0";
	exit;
}

require_once(dirname(__FILE__)."/../../../../site/php_components/paypal_order_confirmation.php");
$store->setPaid();
echo $trans->getText("Your order completed successfully");
exit;
?>
