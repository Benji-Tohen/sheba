<?php 
require_once('../../classes/site_users/class.site_users.php');
require_once("../../classes/forms/class.forms.php");




if (isset($_POST['updateForm'])){
	require_once("form_process.php");
	?>
	<script type="text/javascript">
	document.location = "index.php?show=landing_pages_site_users/edit_user&user_id=<?php echo $_GET['userID'];?>";
	</script>
	<?php
}

if($_GET['wmPage']){

	$forms=new Forms($db);

	$formFields=$forms->getFormFieldsValues($_GET['wmPage'], $_GET['postID']);

	$jsMandatory="";
	$jsFields="";
	$jsFieldsGet="";
	$htmlFields="";
	$dbNameFields="";
	
	
	foreach($formFields as $field){
/*
		if($field["db_name"]){
			$fieldName=$field["db_name"];
		}else{
			$fieldName="field_".$field["updateID"];
		}
*/

		$fieldName="field_".$field["updateID"];

		if($field["db_name"]){
			if ($field["db_name"]=="Email") {
				$dbNameFields.="\r\n<input type=\"hidden\" name=\"Email\" value=\"".$field["userValue"]."\" />";
			}else{
				$dbNameFields.="\r\n<input type=\"hidden\" name=\"".$field["db_name"]."\" value=\"$fieldName\" />";
			}
		}
		


		if($field["Multiple"]){
			$fieldHTML="<div class=\"genFormMultipleTitle\">".$field["Name"].":</div>";
			$values=explode("\r\n", $field["FieldValues"]);

			foreach($values as $value){
				//$value=$string->htmlentities($value);

				
				$fieldItemHTML=$field["HTML"];
				$fieldItemHTML=str_replace('[#FIELD_NAME#]', 	$fieldName, 	$fieldItemHTML);
				$fieldItemHTML=str_replace('[#NAME#]',		$value, 	$fieldItemHTML);
				$fieldHTML=str_replace('[#DEFAULT_VALUE#]', 	$field["userValue"], 	$fieldHTML);
				$fieldItemHTML=str_replace('[#CHECKED#]', 	(strstr($field["userValue"], $value))? "checked":"", $fieldItemHTML);
				$fieldHTML.="\r\n".$fieldItemHTML;
			}

			if($field["Mandatory"]){
				$jsMandatory.="
				if(!$('#".$fieldName.":checked').length){
					//new Dialog().showMessage('מילוי פרטים','".$field["Mandatory_Text"]."');
					alert(\"".$field["Mandatory_Text"]."\");
					document.getElementById('".$fieldName."').focus();
					return false;
				}
				";
			}

		}else{
			$fieldHTML=$field["HTML"];
			$fieldHTML=str_replace('[#FIELD_NAME#]', 	$fieldName, 	$fieldHTML);
			$fieldHTML=str_replace('[#NAME#]', 		$field["Name"].":", 	$fieldHTML);
			$fieldHTML=str_replace('[#DEFAULT_VALUE#]', 	$field["userValue"], 	$fieldHTML);
			$fieldHTML=str_replace('</textarea>', 	$field["userValue"]."</textarea>", 	$fieldHTML);


			if($field["Mandatory"]){
				if(strtolower($field["db_name"])=="email"){
					$jsMandatory.="
					if(!isValidEmail(document.getElementById('".$fieldName."').value)){
						//new Dialog().showMessage('מילוי פרטים','".$field["Mandatory_Text"]."');
						alert(\"".$field["Mandatory_Text"]."\");
						document.getElementById('".$fieldName."').focus();
						return false;
					}
					";
				}else{
					$jsMandatory.="
					if(document.getElementById('".$fieldName."').value==''){
						//new Dialog().showMessage('מילוי פרטים','".$field["Mandatory_Text"]."');
						alert(\"".$field["Mandatory_Text"]."\");
						document.getElementById('".$fieldName."').focus();
						return false;
					}
					";
				}	
			}
		}
	
		$jsFields.="'".$fieldName."' : document.getElementById('".$fieldName."').getValue(),";
		$jsFieldsGet.="\"&".$fieldName."=\"+document.getElementById('".$fieldName."').getValue()+";
		$jsFieldsGet=trim($jsFieldsGet, "&");
		$htmlFields.="\r\n".$fieldHTML;//."<div style=\"clear: both;\"></div>";	
		
	}
	$htmlFields.="\r\n".$dbNameFields;
}
?>
<style>
	body{
		direction: rtl;
		text-align: right;
		padding: 40px;
		color: #FFFFFF;
	}
	.genFormTextText{
		float: right;
		width: 80px;
	}
	.genFormMultipleTitle{
		float: right;
		width: 80px;
	}
	.genFormCheckboxField{
		float: right;
	}
</style>
<form method="post">
	<input type="hidden" name="landPageId" value="<?php echo $_GET['wmPage'];?>" />
	<input type="hidden" name="userID" value="<?php echo $_GET['userID'];?>" />
	<input type="hidden" name="postID" value="<?php echo $_GET['postID'];?>" />
	<?php echo $htmlFields; ?>
	<div style="clear:both"></div>
	<input type="submit" name="updateForm" value="<?php echo $text['Send'];?>" class="sendButton" />
</form>
