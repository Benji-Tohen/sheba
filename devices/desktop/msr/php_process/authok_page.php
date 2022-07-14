<?php
//echo "test";
//exit;

if(isset($_SERVER["HTTP_SHEBAIDNUMBER"])){

	$_SESSION["doctor_id"]=$_SERVER["HTTP_SHEBAIDNUMBER"];
	$_SESSION["doctor_name"]=$_SERVER["HTTP_DISPLAYNAME"];

//	print_r($_SESSION);


	header("location: ".$_SESSION["RETURN_URL"]);
	exit;
}

//echo "No header?!";

//exit;
/*
	echo "the right place";

	echo "<pre>------SERVER----------";
	print_r($_SERVER);
	echo "------GET----------";
	print_r($_GET);
	echo "------POST----------";
	print_r($_POST);
	echo "----------------</pre>";
*/
?>
