<?php
require_once("../../classes/content_management/class.content_updater.php");
require_once("../../classes/forms/class.forms.php");
require_once('../../classes/site_users/class.site_users.php');

$user_table="wm_landing_pages_site_users_customer_0";
$siteUsers=new SiteUsers($db, $user_table);
$enable=1;
$landPageId=$_POST['landPageId'];
$arrFields=array("ID" => $_POST['userID']);
if($_POST["Email"]){
	$arrFields["Email"]=$_POST["Email"];
}
if($_POST["Name"]){
	$arrFields["Name"]=$_POST[$_POST["Name"]];
}
if($_POST["Phone"]){
	$arrFields["Phone"]=$_POST[$_POST["Phone"]];
}
if($_POST["First_Name"]){
	$arrFields["First_Name"]=$_POST[$_POST["First_Name"]];
}
if($_POST["Last_Name"]){
	$arrFields["Last_Name"]=$_POST[$_POST["Last_Name"]];
}
if($_POST["Address"]){
	$arrFields["Address"]=$_POST[$_POST["Address"]];
}
$user_id=$siteUsers->addUser($arrFields);
/*
$formFields=$forms->getPageFormFields($landPageId);
foreach($formFields as $field){
	print_r($field);
	echo "<hr>";
}
*/
foreach($_POST as $var => $val){
	if(substr($var, 0, 6)=="field_"){
		list($nothing, $id)=explode("field_", $var);

		if(is_array($val)){
			$val=implode(",", $val);
		}
		$content_update=new ContentUpdater($db, "wm_landing_pages_site_users_values_customer_".intval(0));
		$arrFields=array(
			"Value"													=>	$val,
			"JoiningDate"											=>	date("Y-m-d H:i:s", time())
		);
		$content_update->update($id, $arrFields);
	}else{
		//echo "<br />".$var;
	}
}

?>