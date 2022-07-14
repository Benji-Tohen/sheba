<?php
if (!$_SESSION['csrf']) {                                                       // create CSRF
    $_SESSION['csrf'] = sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

$formSent=false;

$csrf_display = strrev($_SESSION['csrf']);

function recaptcha_serverkey() {
    switch ($_SERVER["SERVER_NAME"]) {
        case "sheba.tohendns.com":
            return "6Lc5hgYTAAAAAOwUBtHY9LOweMmkEN-UXrpxS8Ms";
            break;
        case "www.sheba.co.il":
            return "6Lc_3AsTAAAAAAcPHhGqtI91y9ihuJ2fSz42BAIm";
            break;
        case "www.shebatest.co.il":
            return "6LfeUQ4TAAAAAO7VBd0BlZpIPGSgDzLKmVkw5lsQ";
            break;
		case "eng.msr.org.il":
            return "6LdbT1MUAAAAAMP4agmMRarOgBReWuhwyO-ICqcY";
            break;
        case "msr.org.il":
        case "www.msr.org.il": // Captcha settings in analytics@tohen-media.com
            return "6LcG8E0UAAAAAB_90qiBCHZjZWAKX35rR0HyY4dj";
            break;
    }
}

function checkCaptcha($greCaptchaResponse){
    $secret = recaptcha_serverkey();
    $response = $greCaptchaResponse;
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
        return true;
    }else{
        return false;
        //return true;
    }
}
//require_once ('conf/conf.data.php');
require_once 'classes/elad/elad_integration.class.php';

/*require_once("classes/phpmailer/class.send_mail.php");
require_once("classes/phpmailer/sendmail.php");*/



require_once("classes/content_management/class.content_updater.php");
require_once("classes/forms/class.forms.php");
require_once("classes/DB/class.database.php");
//$form = ($form) ? $form : $subElement;

/*first get page type and id from $getParams*/
$pageType = intval($getParams[1]);




switch ($pageType) {
    case '98':/* event - we have mofa id - get event connected to it */
        $mofaId = intval($getParams[2]);
        if ($mofaId != '' && $mofaId!=0) {
            $mofaArr = $db->getRow("SELECT * FROM wm_events WHERE ID =" . intval($mofaId));
            $wmPageArr = $db->getRow("SELECT * FROM wm_pages WHERE ID =" . intval($mofaArr['wm_pages']));
        }else{
             header('HTTP/1.0 403 Forbidden');
            echo 'You are forbidden!';exit;
        }
        /* send data to elad after submit  - fisrt chack captcha*/
        if ($_POST && (checkCaptcha($_POST['g-recaptcha-response']))) {

         
            if (strrev($_POST['csrf'])!=$_SESSION['csrf']){
                header('HTTP/1.0 403 Forbidden');
                echo 'You are forbidden!';exit;
            }
            /* now check input data */
            $check_inputs = array(
                array("string255" => $_POST["First_Name"]),
                array("string255" => $_POST["Last_Name"]),
                array("email" => $_POST["Email"]),
                /*array("number" => $_POST["Patient_ID"]),*/
                array("number" => $_POST["Phone"]),
            );

            $secureTexts = new secure_inputs();
            $error = $secureTexts->isNotSecure($check_inputs);
            $Content_Data=array();
            foreach ($_POST as $key => $value) {
                $indexon++;
                $keyArray=explode("_", $key);
                if($keyArray[0]!="field"){
                    continue;
                }
                 //if the field is select take the id from the second cell
                if (count($keyArray)==3){
                    $ID=$keyArray[1];
                }else{
                    $ID=end($keyArray);
                }
                $fieldName = $db->getRow("SELECT Name,wm_forms_field_types FROM wm_forms_fields WHERE ID =".$ID);
                
                switch ($fieldName['wm_forms_field_types']) {
                    case '22':
                        $_POST['First_Name']=$value;
                        break;
                    case '21':
                        $_POST['Last_Name']=$value;
                        break;
                    case '20':
                        $_POST['Email']=$value;
                        break;
                    case '19':
                        $_POST['Phone']=$value;
                        break;
                    case '23':
                        $_POST['MobilePhone']=$value;
                        break;
                    case '18':
                        $_POST['ID']=$value;
                        break;

                }
                $fieldName = $fieldName['Name'];
                $rowArray=array(
                    "ID"    =>  $indexon,
                    "Show_ID"   => $mofaId,
                    "Field_ID"   => $ID,
                    "Field_Name"   => trim($fieldName), //$fieldName,
                    "Field_Value"   => $value //$value,
                );
                array_push($Content_Data, $rowArray);
            }
            
            if (!$error) {
                /* send form data to elad */
                if(!$_POST['ID'])
                    $_POST['ID']=000000000;
                $elad = new EladIntegration();

                $event_data = array(
                    "Email" => $_POST['Email'],
                    "First_Name" => trim($_POST['First_Name']),
                    "Last_Name" => trim($_POST['Last_Name']),
                    "Form_Data" => "",
                    "Content_Data" => $Content_Data,
                    "Patient_ID" => $_POST['ID'],
                    "EventType_ID" => 1,
                    "Phone" => trim($_POST['Phone']),
                    "MobilePhone" => trim($_POST['MobilePhone']),
                    "Sheba_ID" => -1,/*temp fix*/
                    "Show_ID" => intval($mofaId)
                );  
                 
                $isSent = $elad->register_patient_to_event_show($event_data, $mofaId);
                $formSent=true;
                //echo $isSent;
            }
        }
        break;
    case '1000':/*just preview*/
        /*page ID is 59650 - default page for preview forms!*/
        $db->runQuery("UPDATE wm_pages SET wm_forms=".intval($getParams[2])." WHERE ID = 59650");
        $wmPageArr = $db->getRow("SELECT * FROM wm_pages WHERE ID =59650");
        
        break;
    case '0':/*general subscribe to newsletter*/
        break;
    default:/*general - get page type from $_GET and proceed*/
    	
    


        $wmPageID = intval($getParams[3]);
        if ($wmPageID != '' && $wmPageID!=0) {
            $wmPageArr = $db->getRow("SELECT * FROM wm_pages WHERE ID =" . intval($wmPageID));
            if(empty($wmPageArr)){
                header('HTTP/1.0 403 Forbidden');
            echo 'You are forbidden!';exit;
            }
        }else{
            header('HTTP/1.0 403 Forbidden');
            echo 'You are forbidden!';exit;
        }
        /* send form data like in example above!*/
        /* send data to elad after submit  - fisrt chack captcha*/
        if ($_POST && checkCaptcha($_POST['g-recaptcha-response'])) {
            if (strrev($_POST['csrf'])!=$_SESSION['csrf']){
                header('HTTP/1.0 403 Forbidden');
                echo 'You are forbidden!';exit;
            }
            
/*
array(
    array(
        "field_name" => "doctor_name",
        "field_id"  =>  "823",
        "fiedl_value"   =>  "tomer"
    ),
    array(
        "field_name" => "doctor_name",
        "field_id"  =>  "823",
        "fiedl_value"   =>  "tomer"
    )    
)SELECT Name 
FROM  `wm_forms_fields` 
WHERE  `ID` =826

{
    {"field_name": "doctor_name", "field_id": "823", "fiedl_value": "tomer"},
   {"field_name": "doctor_name", "field_id": "823", "fiedl_value": "tomer"},

}
*/          
            $Content_Data=array();
            foreach ($_POST as $key => $value) {
                $indexon++;
                $keyArray=explode("_", $key);
                if($keyArray[0]!="field"){
                    continue;
                }
                //if the field is select take the id from the second cell
                if (count($keyArray)==3){
                    $ID=$keyArray[1];
                }else{
                    $ID=end($keyArray);
                }
                if(is_array($value)){
                    $value=implode(",",$value);
                }
                $fieldName = $db->getRow("SELECT Name,wm_forms_field_types FROM wm_forms_fields WHERE ID =".$ID);
                switch ($fieldName['wm_forms_field_types']) {
                    case '22':
                        $_POST['First_Name']=$value;
                        break;
                    case '21':
                        $_POST['Last_Name']=$value;
                        break;
                    case '20':
                        $_POST['Email']=$value;
                        break;
                    case '19':
                        $_POST['Phone']=$value;
                        break;
                    case '23':
                        $_POST['MobilePhone']=$value;
                        break;
                      case '18':
                        $_POST['ID']=$value;
                        break;

                }

                
                $fieldName = $fieldName['Name'];
                $rowArray=array(
                    "ID"    =>  $indexon,
                    "Show_ID"   => $mofaId,
                    "Field_ID"   => $ID,
                    "Field_Name"   => trim($fieldName), //$fieldName,
                    "Field_Value"   => $value //$value,
                );
                array_push($Content_Data, $rowArray);

            }

            
            $elad = new EladIntegration();
            if(!$_POST['ID'])
                    $_POST['ID']=000000000;
            $event_data = array(
                "Email" => trim($_POST['Email']),
                "First_Name" => trim($_POST['First_Name']),
                "Last_Name" => trim($_POST['Last_Name']),
                "Form_Data" => "",
                "Content_Data" => $Content_Data,
                "EventType_ID" => 2,
                "Patient_ID" => $_POST['ID'], 
                "MobilePhone" => trim($_POST['MobilePhone']),
                "Phone" => trim($_POST['Phone']),
                "Sheba_ID" => -1
            );
            $isSent = $elad->register_patient_to_event($event_data, intval($wmPageArr["ID"]));
            $formSent=true;
            $eladResult = json_decode($isSent);
            $eladResult=$eladResult->{'Success'};
        }
        break;
}
/*connect wm page to matching form*/

$form = $wmPageArr;


/*start form process*/




if(is_array($form)){
        
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
        /*get data for select inputs..*/
        $query = "SELECT * FROM wm_units ORDER BY Name";
   	$arrUnits = $db->getArray($query);
        $query = "SELECT * FROM wm_how_pay";
   	$arrHowPay = $db->getArray($query);
        $query = "SELECT * FROM wm_reason_of_contact";
   	$arrReasonOfContact = $db->getArray($query);
        $query = "SELECT * FROM wm_patient_status";
   	$arrPatientStatus = $db->getArray($query);
        $query = "SELECT * FROM wm_name_of_insurance";
   	$arrInsuranceName = $db->getArray($query);
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
        
	$stam=0;
	$jsMandatory="";
	$jsMandatoryArr[$formId]="";
	$jsFields="";
	$jsFieldsGet="";
	$htmlFields="";
	$validationTypes = $db->getArray("SELECT * FROM wm_form_fields_validation");
	foreach($formFields as $field){
                
                //echo "field = "; print_r($field);
		$field["Name"]=str_replace("\"", "&quot;", $field["Name"]);
                if($field["Mandatory"]){
                            $field["Name"] = "<span id='mandatorySign'> * </span> ".$field["Name"];
                        }
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
                        //echo "values = "; print_r($values);
                        $fieldHTML="";
			if($field["fieldTypeId"]==7){//select field
				/*?>
				<script type="text/javascript">
				    window.onload = function() {
				        var eSelect = document.getElementById('<?php echo $fieldName.'_'.$stam;?>');
				        var optOtherReason = document.getElementById('<?php echo 'otherdetail_'.$fieldName.'_'.$stam;?>');
				        console.log(optOtherReason);
				        eSelect.onchange = function() {
				        	window.alert("sometext");
				            if(eSelect.selectedIndex === 2) {

				                optOtherReason.style.display = 'block';
				                
				            } else {
				                optOtherReason.style.display = 'none';
				            }
				        }
				    }
				  </script>
				<?php */ 
                $htmlFields.="
				<script type='text/javascript'>
                                    var selectedIndexes".$fieldName."=[];
					function jsFunction".$fieldName."(){
						/*optOtherReason='';*/
						var eSelect = document.getElementById('".$fieldName.'_'.$stam."');
					 	var optOtherReason = document.getElementById('".'otherdetail_'.$fieldName."');
                                                
                                                //var selectHtml = ($('#".$fieldName.'_'.$stam." option:selected').val());
                                                //var isInput = $('#". $fieldName.'_'.$stam." option:selected').val().indexOf('$$');
                                              
					  	if(selectedIndexes". $fieldName.".indexOf(eSelect.selectedIndex) === -1) {/*check if input field should be displayed*/
                                                    optOtherReason.style.display = 'none';
                                                } else {
                                                    optOtherReason.style.display = 'block';
                                                }
					}
				 </script>
                 ";
				//$fieldHTML="<div class=\"form-control genFormTextText [#COL#]\">".$field["Name"]."</div>";
				$fieldHTML.="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>"."\r\n<select id=\"".$fieldName."\" onChange=\"jsFunction".$fieldName."()\"  name=\"".$fieldName."\" class=\"genFormInputText selectpicker\">";
				$fieldHTML.="<option value=\"\">".$trans->getText("בחר אפשרות מהרשימה")."</option>";
				



			}else if($field["fieldTypeId"]==11){
				//$fieldHTML="<div class=\"form-control genFormTextText [#COL#]\">".$field["Name"]."</div>";
				$fieldHTML.="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>"."\r\n<select id=\"".$fieldName."\" name=\"".$fieldName."\" class=\"genFormInputText selectpicker\">";
                                $fieldHTML.="<option value=\"\">".$trans->getText("בחר אפשרות מהרשימה")."</option>";
                                foreach ($arrUnits as $arrCell) {
                                    $fieldHTML.="<option value=\"".$arrCell["Name"]."\">".$arrCell["Name"]."</option>";
                                }
			}else if($field["fieldTypeId"]==12){
				//$fieldHTML="<div class=\"form-control genFormTextText [#COL#]\">".$field["Name"]."</div>";
 				$fieldHTML.="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>"."\r\n<select id=\"".$fieldName."\" name=\"".$fieldName."\" class=\"genFormInputText selectpicker\">";
                                $fieldHTML.="<option value=\"\">".$trans->getText("בחר אפשרות מהרשימה")."</option>";
                                foreach ($arrHowPay as $arrCell) {
                                    $fieldHTML.="<option value=\"".$arrCell["Name"]."\">".$arrCell["Name"]."</option>";
                                }
			}else if($field["fieldTypeId"]==13){
				//$fieldHTML="<div class=\"form-control genFormTextText [#COL#]\">".$field["Name"]."</div>";
				$fieldHTML.="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>"."\r\n<select id=\"".$fieldName."\" name=\"".$fieldName."\" class=\"genFormInputText selectpicker\">";
                                $fieldHTML.="<option value=\"\">".$trans->getText("בחר אפשרות מהרשימה")."</option>";
                                foreach ($arrReasonOfContact as $arrCell) {
                                    $fieldHTML.="<option value=\"".$arrCell["Name"]."\">".$arrCell["Name"]."</option>";
                                }
			}else if($field["fieldTypeId"]==14){
				//$fieldHTML="<div class=\"form-control genFormTextText [#COL#]\">".$field["Name"]."</div>";
				$fieldHTML.="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>"."\r\n<select id=\"".$fieldName."\" name=\"".$fieldName."\" class=\"genFormInputText selectpicker\">";
                                $fieldHTML.="<option value=\"\">".$trans->getText("בחר אפשרות מהרשימה")."</option>";
                                foreach ($arrPatientStatus as $arrCell) {
                                    $fieldHTML.="<option value=\"".$arrCell["Name"]."\">".$arrCell["Name"]."</option>";
                                }
			}else if($field["fieldTypeId"]==15){
				//$fieldHTML="<div class=\"form-control genFormTextText [#COL#]\">".$field["Name"]."</div>";
				$fieldHTML.="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>"."\r\n<select id=\"".$fieldName."\" name=\"".$fieldName."\" class=\"genFormInputText selectpicker\">";
                                $fieldHTML.="<option value=\"\">".$trans->getText("בחר אפשרות מהרשימה")."</option>";
                                foreach ($arrInsuranceName as $arrCell) {
                                    $fieldHTML.="<option value=\"".$arrCell["Name"]."\">".$arrCell["Name"]."</option>";
                                }
			}else if($field["fieldTypeId"]!=10){//ןif radio button with text field
				$fieldHTML="<div class=\"genFormMultipleTitle [#COL#]\">".$field["Name"]."</div>";
			}
                        if($field["Mandatory"]){
                            $mandatory = "required";
                        }else{
                            $mandatory="";
                        }
           
			foreach($values as $key=> $value){
				$value=$string->htmlentities($value);
				$fieldItemHTML=$field["HTML"];
				$fieldItemHTML=str_replace('[#FIELD_NAME#]', 	$fieldName, 	$fieldItemHTML);
				$fieldItemHTML=str_replace('[#NAME#]',		$value, 	$fieldItemHTML);
				$fieldItemHTML=str_replace('[#CHECKED#]', 	"", 		$fieldItemHTML);
				$fieldItemHTML=str_replace('[#SELECTED#]', 	"", 		$fieldItemHTML);
                $fieldHTML=str_replace('placeholder', 	$mandatory.' placeholder', 	$fieldHTML);
				$fieldHTML.="\r\n".$fieldItemHTML;
                if($field["fieldTypeId"]==3){/*check if show\hide text input near checkbox*/
                    if(strpos($value,'@@')===FALSE){//fine the position of the first @@
                        $fieldHTML=str_replace('[#STYLE#]','display:none;', $fieldHTML);
                    }else{
                        $fieldHTML=str_replace('@@','', $fieldHTML);
                    }
                    $fieldHTML.="<br />";
                    // fix for different ID
                }
                
                if($field["fieldTypeId"]==7){/*check if show\hide text input near checkbox*/
                    if(strpos($value,'$$')===FALSE){//find the position of the first $$
                        //$fieldHTML=str_replace('[#STYLE#]','display:none;', $fieldHTML);
                    }else{
                        echo "<script>selectedIndexes$fieldName.push(".($key+1).");</script>";
                        $fieldHTML=str_replace('$$','', $fieldHTML);
                    }
                    $fieldHTML.="<br />";
                    // fix for different ID
                }
                $fieldHTML=str_replace(array('id="'.$fieldName.'"','for="'.$fieldName.'"'),array('id="'.$fieldName.'_'.$stam.'"','for="'.$fieldName.'_'.$stam.'"'), $fieldHTML);
                $fieldHTML=str_replace(array('name="'.$fieldName.'"','for="'.$fieldName.'"'),array('name="'.$fieldName.'_'.$stam.'"','for="'.$fieldName.'_'.$stam.'"'), $fieldHTML);
                $stam++;
			}
			


			if($field["fieldTypeId"]==7 || $field["fieldTypeId"]==11 || $field["fieldTypeId"]==12 || $field["fieldTypeId"]==13 || $field["fieldTypeId"]==14 || $field["fieldTypeId"]==15){
				$fieldHTML.="\r\n</select>";
			}
             if($field["fieldTypeId"]==7){
				$fieldHTML.="<div id=\"otherdetail_".$fieldName."\"  style=\"display: none;\">
					<input name=\"".$fieldName."0\" type=\"text\"  id=\"".$fieldName."\" class=\"form-control genFormInputText\" value=\"\"></div>"; 
             //$fieldHTML.="<div id=\"otherdetail\" style=\"display: none;\">More Detail Here Please</div>";           
     		}


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
                            $placeholder.=' *';
                        }else{
                            $mandatory="";
                            //$kohavit='';
                        }
                        
			$fieldHTML=$field["HTML"];
            $fieldHTML=str_replace('[#VALIDATION#]', 	$trans->getText($validation), 	$fieldHTML);
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
                        
                        

			if($field["Mandatory"] &&FALSE){/*old irrelevent validation*/
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




/*end form process*/











/*$wmPage=$db->getRow("SELECT * FROM wm_pages WHERE ID =".$wmPage["Id"]);
require_once(dirname(__FILE__)."/../../../../site/php_components/form.php");/


/*
if(isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]){		//	use $_POST or $_GET

	if(!$wmPage["Email"]){
		$wmPage["Email"]=$params->getValue("site_mail_default_email");
	}
	
	$toList=	$wmPage["Email"];//$cfg["WM"]["Email"]["To"];						//	The Email Address
	$subject=	$trans->getText("New form filled at: ")." ".$cfg["WM"]["Server"]." ".$wmPage["Name"];		//	The Subject
	$from=		$params->getValue("mailing_list_sender_email");//$cfg["WM"]["Email"]["To"];	//	From EMail address
									
	//$body="This is an email from Website<br /><br />";	//	Some Initial Text
	$body="";
    $_POST["New_Url"]="<a href='".urldecode($_POST["hidden_url"])."'>".$trans->getText("Link")."</a>";
    //die($_POST["New_Url"]);
	$postLang=array(
        "New_Url"    =>  "קישור לטופס",
		"First_Name"	=>	"שם מלא",
		"Company"		=>	"חברה",
		"Service"		=>	"שירות",
		"Email"			=>	"דואל",
		"Phone"			=>	"טלפון",		
		"Address"		=>	"כתובת",		
		"Comments"		=>	"תוכן הפניה",
		"submit"		=>	"כפתור שנלחץ"
	);
	
	$body.=getFormTable($_POST, $postLang);	//	use $_POST or $_GET	
	$toArray=explode(",", $toList);
	foreach($toArray as $to){
		$to=trim($to);
		sendSingleMail($subject, $body, $to, $from);
	}

	require_once('../../../../classes/content_management/class.content_updater.php');
	require_once('../../../../classes/site_users/class.site_users.php');
	$siteUsers=new SiteUsers($db, "wm_siteusers");
	
	$enable=1;
	if($_POST["SendMail"]){
		$enable=1;
	}
	
	$arrFields=array(
		"Name"			=>	$_POST["First_Name"],
		"First_Name"		=>	$_POST["First_Name"],
		"Company"		=>	$_POST["Company"],
		"Service"		=>	$_POST["Service"],
		"Email"			=>	$_POST["Email"],
		"Phone"			=>	$_POST["Phone"],		
		"Address"		=>	$_POST["Address"],		
		"Comments"		=>	$_POST["Comments"],
		"Enabled"		=>	$enable,
                "fullUri"		=>	$_POST["hidden_url"]
            
	);
	
	$user_id=$siteUsers->addUser($arrFields);

	$exists=$db->getField("SELECT ID FROM wm_siteusers_forms WHERE wm_siteusers=".intval($user_id)." AND form_id=".intval($wmPage["ID"]), "ID");
	
	$fieldsArr=array(
		"wm_siteusers"	=>	$user_id,
		"form_id"	=>	$wmPage["ID"],
		"form_name"	=>	$wmPage["Name"],
		"content"	=>	$_POST["Comments"]	
	);
	$db->updateData("wm_siteusers_forms", $fieldsArr, $exists);
}*/
?>
