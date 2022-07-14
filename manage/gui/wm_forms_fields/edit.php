<?php
require_once('../../classes/file/class.file.php');
require_once('../../classes/string/class.string.php');
require_once('data.php');

$id =		intval($_REQUEST["id"]);
$page_id =	intval($_REQUEST["page_id"]);
$form_id =	intval($_REQUEST["form_id"]);

$content_update=new ContentUpdater($db, $update_table);
$form_content_update=new ContentUpdater($db, "wm_forms");
$form_content_form_types=new ContentUpdater($db, "wm_forms_field_types");

if($_POST){
    /*first make sure id number field exists...if not add it! - removed on 21.7.21 - on sheba's request (etti)
    $idExists = $db->getArray("SELECT ID FROM wm_forms_fields WHERE wm_forms_field_types = 18 AND wm_forms = ".$form_id);
    if(count($idExists) == 0){
    
    **add field**
        $db->runQuery("INSERT INTO  `wm_forms_fields` (  `Parent` ,  `Ordering` ,  `Name` ,  `Value` ,  `db_name` ,  `wm_forms_field_types` ,  `Mandatory` ,  `Mandatory_Text` ,  `wm_forms` ,  `placeholder` , `validation_Type_ID` ) 
        VALUES ( 0, 0,  '".$trans->getText('id number')."',  '',  '', 18, 1,  '', $form_id,  '".$trans->getText('id number')."', 0 )");
    }
    */
    $check_inputs = array(
        array("string255"   => $_POST["Name"]),
        array("text"        => $_POST["Value"]),
        array("string255"   => $_POST["db_name"]),
        array("number"      => $_POST["Mandatory"]),
        array("string255"   => $_POST["Mandatory_Text"]),
        array("string255"   => $_POST["Mandatory_Text"]),
        array("number"      => $_POST["form_id"]),
        array("number"      => $_POST["wm_forms_field_types"]),
        array("string255"   => $_POST["placeholder"]),
        array("string255"   => $_POST["default_value"]),
        array("number"      => $_POST["validation_Type_ID"])
    );
        
    $secureTexts = new secure_inputs();
    $error = $secureTexts->isNotSecure($check_inputs);
    if (!$error) {
        $_SESSION["Translate"]["refresh"]=true;
        $arrFields=array(
            "Name"			=>	$_POST["Name"],
            "Value"			=>	$_POST["Value"],
            "db_name"			=>	$_POST["db_name"],
            "Mandatory"			=>	$_POST["Mandatory"],
            "Mandatory_Text"	=>	$_POST["Mandatory_Text"],
            "wm_forms"			=>	$_POST["form_id"],
            "wm_forms_field_types"	=>	$_POST["wm_forms_field_types"],
            "Mandatory"			=>	$_POST["Mandatory"],
            "Mandatory_Text"	=>	$_POST["Mandatory_Text"],
            "placeholder"		=>	$_POST["placeholder"],
            "validation_Type_ID"=>  $_POST["validation_Type_ID"],
            "default_value"	    =>	$_POST["default_value"]
        );

        $new_id=$content_update->update($id, $arrFields);
        if(!$id){$id=$new_id;}

        if(!$_POST["SubmitAdd"]){
            header("location: index.php?show=".$folderName."/index&form_id=".$form_id."&page_id=".$page_id."&search=".$_REQUEST["search"]);
            exit;
        }else{
            $id=NULL;
        }
    }
}

if($id && $id>0){
	$row_item =	$content_update->getValues($id);
	$form_id  =	$row_item["wm_forms"];
}

$gui=new Gui("he");

?>
<?php require_once('common/header.php');?>

<script src="ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript">
    function chooseFile(filePath){
        document.edit.Code.value=filePath;
    }
</script>

<?php require_once('common/body.php');?>
<div class="navigator_line">
    <a style="color: #ffffff;" href="index.php?show=wm_forms/index"><?php echo $text['all forms'];?></a>
    <a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index&form_id=<?php echo $form_id;?>"><?php echo $pageName;?></a> "<?php echo $form_content_update->get($form_id, "Name");?>" -> <?php echo $row_item?$row_item["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding">
    <div class="SecurityMessage"><?php echo $error;?></div>
    <br /><br />
    <form action="index.php" name="edit" method="post" enctype="multipart/form-data">
        <input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
        <input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
        <input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
        <input type="hidden" name="form_id" value="<?php echo $form_id;?>" />
        <input type="hidden" name="search" value="<?php echo $_REQUEST["search"];?>" />
        <table style="width:100%;" >		
            <tr>
                <td colspan="2">
                    <?php if($row_item["File_Name"] && file_exists("../../".$row_item["File_Name"])){?>             
                        <?php 
                            $fileNameArr=$row_item["File_Name"];
                            list($name, $ext)=explode("[.]", $fileNameArr);
                        ?>
                        <?php if($ext=="swf"){?>
                            <object width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"><param name="movie" value="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>"></param><param name="wmode" value="transparent"></param><embed src="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"></embed></object>
                        <?php }elseif($row_item["File_Name"]){?>			
                            <img src="<?php echo "../../".$row_item["File_Name"];?>" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>" />
                        <?php }?>
                    <?php };?>
                </td>
            </tr>
            <?php $nameFields = $db->getArray("SELECT * FROM wm_fields_name");?>

            <tr>
                <td>
                    <label for="Name" style="margin-bottom:5px;display:block; font-size:14px;" >שם:</label>
                    <select  id="Name" style="width:100%; text-overflow: ellipsis;" name="Name" size="1">
                        <?php foreach ($nameFields as $key => $value) {?>
                            <option  style="width:100%; text-overflow: ellipsis; white-space: break-spaces;"<?php echo $row_item["Name"]==$value['Name'] ? 'selected': '' ?>><?php echo $string->shorten($value['Name'],250);?></option>
                        <?php }?>  
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <?php $arrTypes=$form_content_form_types->getArray();?>
                    <label for="wm_forms_field_types" style="margin-bottom:5px;display:block; font-size:14px;"  >סוג:</label>
                    <select style="width:100%;"  name="wm_forms_field_types" id="wm_forms_field_types">
                        <?php foreach($arrTypes as $type){?>
                            <option value="<?php echo $type["ID"]?>" <?php echo $type["ID"]==$row_item["wm_forms_field_types"]?"selected":"";?>><?php echo $text[$type["Name"]]?></option>
                        <?php }?>
                    </select>
                </td>		
            </tr>
            <tr>
                <td>
                    <label style="margin-bottom:5px;display:block; font-size:14px;"  for="Value">ערך:</label>
                    <textarea name="Value"  id="Value" style="width: 200px; height: 100px;"><?php echo $row_item["Value"];?></textarea>
                </td>		
            </tr>
            <tr>
                <td>
                    <label for="Mandatory" style="margin-bottom:5px;display:block; font-size:14px;" ><?php echo $text["חובת מילוי:"]?></label>
                    <select  id="Mandatory" name="Mandatory">
                        <option value="0" <?php echo $row_item["Mandatory"]?"":"selected";?>>לא חובה</option>
                        <option value="1" <?php echo $row_item["Mandatory"]?"selected":"";?>>חובה</option>
                    </select>
                </td>		
            </tr>        
            <tr>
                <td>
                    <label style="margin-bottom:5px;display:block; font-size:14px;"  for="placeholder"><?php echo $text["שומר מקום:"]?></label>
                    <input type="text" name="placeholder" id="placeholder" value="<?php echo $row_item["placeholder"];?>" />
                </td>		
            </tr>
            <tr>
                <td>
                    <?php $validationTypes = $db->getArray("SELECT * FROM wm_form_fields_validation");?>
                    <label for="validation_Type_ID" style="margin-bottom:5px;display:block; font-size:14px;"  ><?php echo $text["סוג ולידציה:"]?></label>
                    <select style="width:100%;" id="validation_Type_ID" name="validation_Type_ID" size="1">
                        <?php foreach ($validationTypes as $validationType) {?>
                            <option value="<?php echo $validationType['ID']?>" <?php echo $row_item["validation_Type_ID"] == $validationType['ID']?"selected":"";?>><?php echo $validationType['Name']?></option>
                        <?php }?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label style="margin-bottom:5px;display:block; font-size:14px;"  for="default_value"><?php echo $text["ערך ברירת מחדל (בצ'קבוקסים יש לכתוב 1 או 0):"]?></label>
                    <input type="text" name="default_value" id="default_value" value="<?php echo $row_item["default_value"];?>" />
                </td>        
            </tr>
            <tr>
                <td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
            </tr>		
        </table>
        <script type="text/javascript">
            function ckOrDie(){
                var selectInput = document.getElementById('wm_forms_field_types');
                var selectedType = selectInput.options[selectInput.selectedIndex].value;

                if(selectedType === "10"){ // 10 == Free text
                    CKEDITOR.replace( 'Value',
                    {                        
                        height:250,
                        height:250,
                        basicEntities : false,
                        tabSpaces : 0,
                        <?php if($gui->getDir()=="rtl"){?>
                        language: 'he'
                        <?php }else{?>
                        language: 'en'
                        <?php }?>       
                    });
                } else {
                    if(typeof CKEDITOR.instances['Value'] != 'undefined'){
                        CKEDITOR.instances['Value'].destroy();
                    }
                }
            }

            ckOrDie();
            document.getElementById('wm_forms_field_types').addEventListener('change', function(){
                ckOrDie();
            });
        </script>
    </form>
    <center><a href="javascript:history.back()"><img border="0" src="images/icons/back.gif" alt="Back" /></a></center>
</div>

<script language="javascript" type="text/javascript">
    document.edit.Name.focus();
</script>
