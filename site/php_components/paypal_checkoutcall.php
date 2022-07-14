<?php
$wm->initGetParams();

$error=NULL;
$success=NULL;

/*==================================================================
 PayPal Express Checkout Call
 ===================================================================
*/
// Check to see if the GET object contains a variable named 'token'	
$token = "";
if (isset($_GET['token']))
{
	$token = $_GET['token'];
	
}

if(!$token){
	header("location: ".$cfg["WM"]["Server"]."/noPermission");
	exit;
}

// If the GET object contains the variable 'token' then it means that the user is coming from PayPal site.	
if ( $token != "" )
{

	require_once("paypal_paypalfunctions.php");

	/*
	'------------------------------------
	' Calls the GetExpressCheckoutDetails API call
	'
	' The GetShippingDetails function is defined in PayPalFunctions.jsp
	' included at the top of this file.
	'-------------------------------------------------
	*/
	
	$resArray = GetShippingDetails( $token );
	$ack = strtoupper($resArray["ACK"]);


	//print_r($resArray);

	if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") 
	{

		$success=true;

		$arrFields=array(
			"shipping_address_name"		=>	$resArray["SHIPTONAME"],
			"shipping_address_line1"	=>	$resArray["SHIPTOSTREET"],
			"shipping_address_city"		=>	$resArray["SHIPTOCITY"],
			"shipping_address_zip"		=>	$resArray["SHIPTOZIP"]
		);

		$store->setDetails($arrFields);

	} 
	else  
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
		$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
		$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
		$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
/*		
		echo "GetExpressCheckoutDetails API call failed. ";
		echo "Detailed Error Message: " . $ErrorLongMsg;
		echo "Short Error Message: " . $ErrorShortMsg;
		echo "Error Code: " . $ErrorCode;
		echo "Error Severity Code: " . $ErrorSeverityCode;
*/
		$error="orderError";

	}
}
		
?>
