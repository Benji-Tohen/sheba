<?php
require_once('../../classes/site_users/class.site_users.php');
require_once("../../classes/forms/class.forms.php");

$userId=intval($_SESSION["LPMEDIA"]["USER_DATA"]["ID"]);

$user_table="wm_landing_pages_site_users_customer_".$userId;

$forms=new Forms($db);

$siteUsers=new SiteUsers($db, $user_table);

$id=intval($_REQUEST["user_id"]);




if($_POST){
/*
	$arrFields=array(
		"Name"			=>	$_POST["Name"],
		"First_Name"		=>	$_POST["First_Name"],
		"Last_Name"		=>	$_POST["Last_Name"],
		"Email"			=>	$_POST["Email"],
		"Enabled"		=>	$_POST["Enabled"]
	);

	if(!$_POST["ID"]){	//	Add new user
		
		$exists=!$siteUsers->addUser($arrFields);
	}else{				//	Update existing user
		$exists=!$siteUsers->update($_POST["ID"], $arrFields);
	}
	
	if(!$exists){
		header("location: index.php?show=site_users/users");
		exit;
	}
*/
}

if($id){
	//$user_data=$siteUsers->getValues($_REQUEST["user_id"]);
	$user_data=$db->getRow("SELECT * FROM $user_table WHERE ID=".intval($id));
}

if(!$user_data && $_POST){
	$user_data=$_POST;
}



$formFields=$forms->getPageFormFieldsValues($userId, $id);

$dataTemplate="
	<tr>
		<td valign=\"top\" nowrap>[#VAR#]</td>
		<td valign=\"top\">[#VAL#]</td>		
	</tr>
";

$data="";

$currentForm=0;
$joiningDate=0;



foreach($formFields as $field){



	$tmpData=$dataTemplate;

	if($currentForm!=$field["wm_landing_pages_site_users_values_customer_post_$userId"]){
		$currentForm=$field["wm_landing_pages_site_users_values_customer_post_$userId"];

		$tmpData=str_replace("[#VAR#]", "</td></tr><tr><td colspan=\"2\"><hr></td></tr><tr><td><b>".$field["joiningDate"].":</b><input type=\"button\" value=\"ערוך\" onclick=\"document.location='index.php?show=landing_pages_site_users/edit_form&wmPage=".$field['landPageId']."&userID=$id&postID=".$field["wm_landing_pages_site_users_values_customer_post_$userId"]."'\" />", $tmpData);		
		$tmpData=str_replace("[#VAR#]", "<b style=\"font-size: 14px;\">".$db->getField("SELECT Name FROM wm_landing_pages WHERE ID=".$field["landPageId"], "Name").":</b>", $tmpData);		
		$tmpData=str_replace("[#VAL#]", "", $tmpData);
		$tmpData=str_replace(" nowrap", " style=\"padding-top: 20px;\"", $tmpData);		

		$data.=$tmpData;
	}

	$tmpData=$dataTemplate;

	if($joiningDate!=$field["joiningDate"]){
		$joiningDate=$field["joiningDate"];
		$tmpData=str_replace("[#VAR#]", "", $tmpData);		

		$tmpData=str_replace("[#VAL#]", "", $tmpData);
		$tmpData=str_replace(" nowrap", " style=\"padding-top: 10px;\"", $tmpData);		

		$data.=$tmpData;
	}

	$tmpData=$dataTemplate;

//	$postLang["field_".$field["ID"]]=	$field["Name"];
	if(is_array($fieldValue)){
		$fieldValue=implode(",", $fieldValue);
	}
	$tmpData=str_replace("[#VAR#]", "<b>".$field["Name"].":</b>", $tmpData);		
	$tmpData=str_replace("[#VAL#]", str_replace("\r\n", "<br />", $field["Value"]), $tmpData);	
	$data.=$tmpData;
}
?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Site Users"];?> -> <?php echo $id?$text["Edit"].":".$user_data["First_Name"]." ".$user_data["Last_Name"]:$text["Add New"];?></div>
<div class="listPagePaddingItems">
<br /><br />
<?php if($exists){?>
This username already exists,<br />
Please choos another one
<?php }?>
<form action="index.php" name="edit" method="post" enctype="multipart/form-data" style="height: 600px; overflow: auto; padding-right: 10px;">
<input type="hidden" name="show" value="site_users/edit_user" />
<input type="hidden" name="ID" value="<?php echo $user_data["ID"];?>" />
<table>
<?php echo $data;?>
<!--
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><?php echo $user_data["Name"];?></td>		
	</tr>
	<tr>
		<td><?php echo $text["Phone"];?>:</td>
		<td><?php echo $user_data["Phone"];?></td>		
	</tr>
	<tr>
		<td><?php echo $text["Email"];?>:</td>
		<td><?php echo $user_data["Email"];?></td>		
	</tr>
	<tr>
		<td><?php echo $text["First Name"];?>:</td>
		<td><?php echo $user_data["First_Name"];?></td>		
	</tr>
	<tr>
		<td><?php echo $text["Last Name"];?>:</td>
		<td><?php echo $user_data["Last_Name"];?></td>		
	</tr>

	
	<tr>
		<td>טקסט:</td>
		<td><?php echo $user_data["Last_Name"];?></td>		
	</tr>
-->


<!--
	<tr>
		<td><?php echo $text["Send Email"];?></td>
		<td>
			<select name="Enabled">
				<option value="1" <?php echo ($user_data["Enabled"]==1)?"SELECTED":"";?>><?php echo $text["Enabled"];?></option>
				<option value="0" <?php echo ($user_data["Enabled"]==0)?"SELECTED":"";?>><?php echo $text["Disabled"];?></option>							
			</select>
		</td>		
	</tr>
-->
<!--
	<tr>
		<td></td>
		<td><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
-->
</table>
</form>

</div>
