<?php 
require_once(dirname(__FILE__)."/../../classes/content_management/class.content_updater.php");
require_once(dirname(__FILE__)."/../../classes/forms/class.forms.php");
//$form = ($form) ? $form : $subElement;


// echo "<div style='display: none;'>";			//** SHERY!!! **
// echo 'shery';
// print_r($wmPage);
//echo "</div>";

$form = $wmPage;
if($form["wm_forms"]){
        
	$formId=$form["ID"];



	$forms=new Forms($db);

	$formFields=$forms->getPageFormFields($formId);
        


	$labelCol="";
	$col="";
/*
	if($subElement["form_type"]=="form-horizontal"){
		$labelCol=	"col-sm-2";
		$col=		"col-sm-10";
	}
*/
if(isset($parentElement)){
	if($parentElement["label_col_large"]){
		$labelColLarge = 	"col-lg-".$parentElement["label_col_large"];
		$labelCol.=" ".$labelColLarge;
	}
	if($parentElement["label_col_medium"]){
		$labelColMedium = 	"col-md-".$parentElement["label_col_medium"];
		$labelCol.=" ".$labelColMedium;
	}
	if($parentElement["label_col_small"]){
		$labelColSmall = 	"col-xs-".$parentElement["label_col_small"];
		$labelCol.=" ".$labelColSmall;
	}

	if($parentElement["input_col_large"]){
		$inputColLarge = 	"col-lg-".$parentElement["input_col_large"];
		$col.=" ".$inputColLarge;
	}

	if($parentElement["input_col_medium"]){
		$inputColMedium = 	"col-md-".$parentElement["input_col_medium"];
		$col.=" ".$inputColMedium;
	}

	if($parentElement["input_col_small"]){
		$inputColSmall = 	"col-xs-".$parentElement["input_col_small"];
		$col.=" ".$inputColSmall;
	}
}



	/*
	$labelCol=$labelColLarge." ".$labelColMedium." ".$labelColSmall;
	$col=	  $inputColLarge." ".$inputColMedium." ".$inputColSmall;
	*/
        


	$jsMandatory="";
	
	$jsMandatoryArr[$formId]="";
	
	$jsFields="";
	$jsFieldsGet="";
	$htmlFields="";
	$validationTypes = $db->getArray("SELECT * FROM wm_form_fields_validation");
	foreach($formFields as $field){
                

		$field["Name"]=str_replace("\"", "&quot;", $field["Name"]);

		if($field["db_name"]){
			$fieldName=$field["db_name"];
		}else{
			$fieldName="field_".$field["ID"];
		}

		$hideLabel="";
		if(isset($form["form_hide_lables"]) && $form["form_hide_lables"]){
			$hideLabel="sr-only";
		}

		if($field["Multiple"]){
			
			$values=explode("\r\n", $field["FieldValues"]);

			if($field["fieldTypeId"]==7){
				//$fieldHTML="<div class=\"form-control genFormTextText [#COL#]\">".$field["Name"]."</div>";
				$fieldHTML.="\r\n<select id=\"".$fieldName."\" name=\"".$fieldName."\" class=\"genFormInputText selectpicker\">";
				$fieldHTML.="<option value=\"\">".$field["Name"]."</option>";
			}else{
				$fieldHTML="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>";
			}

			foreach($values as $value){
				$value=$string->htmlentities($value);
				$fieldItemHTML=$field["HTML"];
				$fieldItemHTML=str_replace('[#FIELD_NAME#]', 	$fieldName, 	$fieldItemHTML);
				$fieldItemHTML=str_replace('[#NAME#]',		$value, 	$fieldItemHTML);
				$fieldItemHTML=str_replace('[#CHECKED#]', 	"", 		$fieldItemHTML);
				$fieldItemHTML=str_replace('[#SELECTED#]', 	"", 		$fieldItemHTML);
				$fieldHTML.="\r\n".$fieldItemHTML;
			}
			


		//	if($field["fieldTypeId"]==7){
				$fieldHTML.="\r\n</select>";
		//	}

			if($field["Mandatory"]){
				$valString="$('#landPageForm_".$formId."').find('#".$fieldName."').val()";
				$focusString="$('#landPageForm_".$formId."').find('#".$fieldName."').focus()";
				
				$jsMandatoryArr[$formId].="

				if(".$valString."==''){
					//new Dialog().showMessage('מילוי פרטים','".$field["Mandatory_Text"]."');
					alert(\"".$field["Mandatory_Text"]."\");
					".$focusString.";
					return false;
				}
				";	


				$jsMandatory.="

				if($('#".$fieldName."').val()==''){
					//new Dialog().showMessage('מילוי פרטים','".$field["Mandatory_Text"]."');
					alert(\"".$field["Mandatory_Text"]."\");
					document.getElementById('".$fieldName."').focus();
					return false;
				}
				";
			
			}

		}else{
                        /*validation*/
                        
                        $validation = $validationTypes[$field["validation_Type_ID"]-1]['Value'];
                        
			$placeholder="";
			if($hideLabel){/*dont konw waht this is..*/
				$placeholder=$field["placeholder"];
			}
                        $placeholder=$field["placeholder"];
                        if($field["Mandatory"]){
                            $mandatory = "required";
                        }
                        
			$fieldHTML=$field["HTML"];
                        $fieldHTML=str_replace('[#VALIDATION#]', 	$validation, 	$fieldHTML);
			$fieldHTML=str_replace('[#LABEL_COL#]', 	$labelCol, 	$fieldHTML);
			$fieldHTML=str_replace('[#COL#]', 		$col, 	$fieldHTML);
			$fieldHTML=str_replace('[#HIDE_LABLE#]', 	$hideLabel, 	$fieldHTML);
			$fieldHTML=str_replace('[#PLACEHOLDER#]', 	$placeholder, 	$fieldHTML);
			$fieldHTML=str_replace('[#FIELD_NAME#]', 	$fieldName, 	$fieldHTML);
			$fieldHTML=str_replace('[#NAME#]', 		$field["Name"].":", 	$fieldHTML);
			$fieldHTML=str_replace('[#DEFAULT_VALUE#]', 	$field["FieldValues"], 	$fieldHTML);
                        $fieldHTML=str_replace('placeholder', 	$mandatory.' placeholder', 	$fieldHTML);
                        
                        
                        if(strpos($fieldHTML, '[#CITY_AUTOCOMPLETE#]') !== false){/*this is city autocomplete fieled*/
                            $fieldHTML=str_replace('[#CITY_AUTOCOMPLETE#]', 	"onkeyup='getCitiesAjax(this)'", 	$fieldHTML);
                            $fieldHTML.="<div id='autocompleteDiv'></div>";
                        }
                        
                        

			if($field["Mandatory"]){
				$valString="$('#landPageForm_".$formId."').find('#".$fieldName."').val()";
				$focusString="$('#landPageForm_".$formId."').find('#".$fieldName."').focus()";
			
			
				if(strtolower($field["db_name"])=="email"){
					$jsMandatoryArr[$formId].="
					
					if(!isValidEmail(".$valString.")){

						alert(\"".str_replace("\"", "''", $field["Mandatory_Text"])."\");
						".$focusString.";
						return false;
					}
					";
					
					
					$jsMandatory.="
					if(!isValidEmail(document.getElementById('".$fieldName."').value)){

						alert(\"".str_replace("\"", "''", $field["Mandatory_Text"])."\");
						document.getElementById('".$fieldName."').focus();
						return false;
					}
					";
				}else if(strtolower($field["db_name"])=="phone"){
					$jsMandatoryArr[$formId].="
					var phoneNo=".$valString.";
					var phoneNoLen=phoneNo.length;
					if(phoneNoLen==0){

						alert(\"".str_replace("\"", "''", $field["Mandatory_Text"])."\");
						".$focusString.";
						return false;
					}
					";				
				
			 		$jsMandatory.="
					var phoneNo=".$valString.";
					var phoneNoLen=phoneNo.length;
					if(phoneNoLen==0){

						alert(\"".str_replace("\"", "''", $field["Mandatory_Text"])."\");
						document.getElementById('".$fieldName."').focus();
						return false;
					}
					";
				}else{
					$jsMandatoryArr[$formId].="
					if(".$valString."==''){

						alert(\"".str_replace("\"", "''", $field["Mandatory_Text"])."\");
						".$focusString.";
						return false;
					}
					";
				
					$jsMandatory.="
					if(document.getElementById('".$fieldName."').value==''){

						alert(\"".str_replace("\"", "''", $field["Mandatory_Text"])."\");
						".$focusString.";
						return false;
					}
					";
				}	
			}
		}
                
		$fieldHTML="<div class=\"form-group\">".$fieldHTML."</div>";

		$jsFields.="'".$fieldName."' : document.getElementById('".$fieldName."').getValue(),";
		$jsFieldsGet.="\"&".$fieldName."=\"+document.getElementById('".$fieldName."').getValue()+";
		$jsFieldsGet=trim($jsFieldsGet, "&");
		$htmlFields.="\r\n".$fieldHTML;//."<div style=\"clear: both;\"></div>";
		
		

	}

}
?>


