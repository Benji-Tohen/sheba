<?php
$paymentAmount=$store->getOrderSubtotal();
$_SESSION["Payment_Amount"]=$paymentAmount;
echo number_format($paymentAmount, 2);
?>
