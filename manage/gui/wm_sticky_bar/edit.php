<?php

require_once('../../classes/file/class.file.php');
require_once('data.php');


$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);




$content_update=new ContentUpdater($db, $update_table);


if($_POST){

        $check_inputs = array(
            array("string255"   => $_POST["Name"]),
            array("text"        => $_POST["Value"]),
            array("url"         => $_POST["URL"])
        );
        
        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {
            
            $arrFields=array(
                    "Parent"			=>	0,
                    "Name"				=>	$_POST["Name"],
                    "Value"				=>	$_POST["Value"],
                    "URL"				=>	$_POST["URL"],
                    "Lang"              =>	$_POST["Lang"],
                    "Target"            => $_POST["Target"],
                    "homePageId"            => $_POST["homePageId"],
                    "custom_class"            => $_POST["custom_class"],
                    
            );

        if(!$id){/*
                    $query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE ID=".$_POST["page_id"];
                    $max_ordering=$db->getField($query, "max_ordering");
                    $ordering=$max_ordering+1;
                    $arrFields["Ordering"]=$ordering;
                    */
                    $arrFields["Ordering"]=0;
            }


            $new_id=$content_update->update($id, $arrFields);

            if(!$id){
                    $id=$new_id;
            }

            $file_path="webfiles/".$folderName."/".$id."/";
            $full_file_path="../../".$file_path; 
            chmod($full_file_path, 0777);

            $file=new File();
            $file->checkPath($full_file_path);


            if(is_uploaded_file($_FILES['user_file']['tmp_name'])){
                    $file_name=str_replace(" ", "_", $_FILES['user_file']['name']);

                    $content_update->update($id, array("File_Name"=>$file_path.$file_name));
                    move_uploaded_file($_FILES['user_file']['tmp_name'], $full_file_path.$file_name);
                    chmod($full_file_path.$file_name, 0777);
            }

            if(!$_POST["SubmitAdd"]){
                    header("location: index.php?show=".$folderName."/index&page_id=".$page_id);
                    exit;
            }else{
                    $id=NULL;
            }
        }
}

if($id){
	$row_picture=$content_update->getValues($id);
}

$gui=new Gui("he");
?>
<?php require_once('common/header.php');?>
<script language="javascript" type="text/javascript">
function chooseFile(filePath){
	document.edit.Code.value=filePath;
}
</script>
<?php require_once('common/body.php');?>
<div class="navigator_line">

<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $row_picture?$row_picture["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding">
<div class="SecurityMessage"><?php echo $error;?></div>
<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_picture["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<table>		
	<tr>
		<td colspan="2">
		<?php if($row_picture["File_Name"] && file_exists("../../".$row_picture["File_Name"])){?>
			<img src="<?php echo "../../".$row_picture["File_Name"];?>" height="300" width="300" />
		<?php };?>
		</td>
	</tr>
	<tr>
		<td><?php echo $text["Image"];?>:</td>
		<td><input type="file" name="user_file" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_picture["Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Link"];?>:</td>
		<td><input type="text" name="URL" value="<?php echo $row_picture["URL"];?>" dir="ltr" style="width: 300px;" /></td>		
	</tr>	
	<tr>
		<td valign="top"><?php echo $text["Content"];?>:</td>
		<td><textarea name="Value" style="width: 300px; height: 100px;"><?php echo $row_picture["Value"];?></textarea></td>		
	</tr>
    <tr>
        <?php $arrLangs = $db->getArray("SELECT Lang FROM wm_languages")?>
		<td valign="top"><?php echo $text["Lang"];?>:</td>
                <td>
                    <select name="Lang">
                        <?php 
                        foreach ($arrLangs as $lang) {?>
                        <option <?php echo ($lang['Lang'] == $row_picture['Lang'] ? 'selected': '')?> value="<?php echo $lang['Lang']?>"><?php echo $lang['Lang']?></option>
                        <?php }?>
                        
                    </select>
                </td>		
	</tr>
      <tr>
        <?php $arrTargets = $db->getArray("SELECT Name FROM wm_targets")?>
        <td valign="top"><?php echo $text["target"];?>:</td>
                <td>
                    <select name="Target">
                        <option></option>
                        <?php 
                        foreach ($arrTargets as $target) {?>
                        <option <?php echo ($target['Name'] == $row_picture['Target'] ? 'selected': '')?> value="<?php echo $target['Name']?>"><?php echo $text[$target['Name']]?></option>
                        <?php }?>
                        
                    </select>
                </td>       
    </tr>
    <tr>
        <?php $arrHompages = $db->getArray("SELECT ID,Name FROM wm_pages WHERE Page_Type = 5")?>
        <td valign="top"><?php echo $text["connected home page"];?>:</td>
                <td>
                    <select name="homePageId">
                        <option></option>
                        <?php 
                        foreach ($arrHompages as $page) {?>
                        <option <?php echo $row_picture['homePageId']==$page['ID'] ? 'selected': ''?> value="<?php echo $page['ID']?>"><?php echo $page['Name']?></option>
                        <?php }?>
                        
                    </select>
                </td>       
    </tr>

    <tr>
        <td valign="top"><?php echo $text["custom_class"];?></td>
        <td>
            <?php if($login->getLevel()<=$adminLevel || $adminLevel==0){?>
            <input type="text" name="custom_class" style="width: 300px;" value="<?php echo $row_picture["custom_class"];?>" dir="ltr" />
            <?php } else { ?>
            <input type="hidden" name="custom_class" style="width: 300px;" value="<?php echo $row_picture["custom_class"];?>" dir="ltr" />
            <?php } ?>
        </td>
    </tr>

	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
