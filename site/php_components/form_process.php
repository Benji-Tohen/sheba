<?php
/*this code is also in forum messages - consider to create function instead*/
$secret = "6Lc5hgYTAAAAAOwUBtHY9LOweMmkEN-UXrpxS8Ms";
$response = $_POST['g-recaptcha-response'];
$remoteip = $_SERVER['REMOTE_ADDR'];

$data = array('secret' => $secret, 'response' => $response, 'remoteip' => $remoteip);
$url="https://www.google.com/recaptcha/api/siteverify";
$handle = curl_init($url);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($handle);
$output = json_decode($output);
if($output->success == 1 || $_SESSION['isHuman']==1){
    echo "captcha succes-submit form to elad";
}else{
     echo "robot!!!";
}
/*
require_once(dirname(__FILE__)."/../../classes/content_management/class.content_updater.php");
require_once(dirname(__FILE__)."/../../classes/forms/class.forms.php");



	
$forms=new Forms($db);

$content_update=new ContentUpdater($db, "wm_landing_pages_site_users_values_customer_".intval($row["wm_landing_pages_customers"]));
$content_update1=new ContentUpdater($db, "wm_landing_pages_site_users_values_customer_post_".intval($row["wm_landing_pages_customers"]));


$formFields=$forms->getPageFormFields($id);

$dataTemplate="
	<tr>
		<td valign=\"top\" nowrap>[#VAR#]</td>
		<td valign=\"top\">[#VAL#]</td>		
	</tr>
";

$postMailTemplate="
	<table>
		[#POSTDATA#]
	</table>
";

	if (intval($row["wm_landing_pages_customers"])){
		$time=time();

		$postFields=array(
			"wm_landing_pages"	=>	$id,
			"wm_landing_pages_site_users_customer_".intval($row["wm_landing_pages_customers"])	=>	$user_id,
			"joiningDate"		=>	date("Y-m-d H:i:s", $time)
		);
		$newPostId=$content_update1->update(NULL, $postFields);
	}

foreach($formFields as $field){
	$tmpData=$dataTemplate;

	if($field["db_name"]){
		$fieldValue=$_POST[$field["db_name"]];
	}else{
		$fieldValue=$_POST["field_".$field["ID"]];
	}


//	$postLang["field_".$field["ID"]]=	$field["Name"];
	if(is_array($fieldValue)){
		$fieldValue=implode(",", $fieldValue);
	}

	$time=time();

	$arrFields=array(
		"wm_landing_pages"	=>	$id,
		"wm_forms_fields"	=>	$field["ID"],
		"Value"			=>	$fieldValue,
		"Name"			=>	$field["Name"],
		"wm_landing_pages_site_users_customer_".intval($row["wm_landing_pages_customers"])	=>	$user_id,
		"joiningDate"		=>	date("Y-m-d H:i:s", $time)
	);

	$content_update->update(NULL, $arrFields);

	$tmpData=str_replace("[#VAR#]", "<b>".$field["Name"].":</b>", $tmpData);		
	$tmpData=str_replace("[#VAL#]", str_replace("\r\n", "<br />", $fieldValue), $tmpData);	

	$data.=$tmpData;
}

$form_fields_data=str_replace("[#POSTDATA#]", $data, $postMailTemplate);
*/?>
