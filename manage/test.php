<?php
//exit;
if($_SERVER["HTTP_X_REAL_IP"]!="199.203.104.89"){
	exit;
}
if($_SERVER["HTTP_REFERER"]!="manage.sheba.co.il"){
	$data="www.sheba.co.il/manage/test.php";
	header("location: https://manage.sheba.co.il?".$data);
	exit;
}

print_r($_SERVER);
print_r($_POST);
?>
