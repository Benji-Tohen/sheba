<?php
/*
<form method=post action=https://api-3t.sandbox.paypal.com/nvp>
	<input type=hidden name=USER value='office_api1.tohen-media.com'>
	<input type=hidden name=PWD value='GHEW7SNTPWGVC3AW'>
	<input type=hidden name=SIGNATURE value='AtBBV0aBa9xC7tY8yr9WyPvOFRTZAyyWFSTOUa3JaVaqx2pESg-gqtqP'>
	<input type=hidden name=VERSION value=76.0>
	<input type=hidden name=PAYMENTREQUEST_0_CURRENCYCODE value=ILS>
	<input type=hidden name=PAYMENTREQUEST_0_PAYMENTACTION value=Sale>
	<input name=PAYMENTREQUEST_0_AMT value=19.95>
	<input type=hidden name=RETURNURL value='<?php echo $cfg["WM"]["Server"];?>/payment_done/success'>
	<input type=hidden name=CANCELURL value='<?php echo $cfg["WM"]["Server"];?>/payment_done/cancel'>
	<input type=submit name=METHOD value=SetExpressCheckout>
</form>
*/
?>


<form action='<?php echo $cfg["WM"]["Server"];?>/ajax/paypal_express_check_out' method='post'>
	<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal'/>
</form>
