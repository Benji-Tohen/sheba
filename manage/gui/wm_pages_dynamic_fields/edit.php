<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');


$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);




$content_update=new ContentUpdater($db, $update_table);


if($_POST){

        $check_inputs = array(
            array("string255"   => $_POST["Name"]),
            array("string255"   => $_POST["Value"]),
            array("url"         => $_POST["URL"]),
            array("number"      => $_POST["page_type"]),
            array("number"      => $_POST["wm_forms_field_types"]),
            array("number"      => $_POST["mandatory"]),
            array("number"      => $_POST["block_num"])
        );
        
        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {

            $arrFields=array(
                    "Parent"			=>	0,
                    "Name"				=>	$_POST["Name"],
                    "Value"				=>	$_POST["Value"],
                    "URL"				=>	$_POST["URL"],
                    "page_type"				=>	$_POST["page_type"],
                    "wm_forms_field_types"	=>	$_POST["wm_forms_field_types"],
                    "mandatory"				=>	$_POST["mandatory"],
                    "block_num"				=>	$_POST["block_num"]
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
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_picture["Name"];?>" dir="ltr" style="width: 300px;" /></td>		
	</tr>	
	<tr>
		<td><?php echo $text["Page Type"];?>:</td>
		<td>
			<select name="page_type">
				<?php $arr=$db->getArray("SELECT * FROM wm_pagetype ORDER BY Ordering");?>
				<?php foreach($arr as $item){?>
					<option value="<?php echo $item["ID"];?>" <?php echo $item["ID"]==$row_picture["page_type"]?"selected":"";?>><?php echo $item["Name"];?></option>
				<?php }?>
			</select>
		</td>		
	</tr>
	<tr>
		<td><?php echo $text["Form Field Types"];?>:</td>
		<td>
			<select name="wm_forms_field_types">
				<?php $arr=$db->getArray("SELECT * FROM wm_forms_field_types ORDER BY Ordering");?>
				<?php foreach($arr as $item){?>
					<option value="<?php echo $item["ID"];?>" <?php echo $item["ID"]==$row_picture["wm_forms_field_types"]?"selected":"";?>><?php echo $item["Name"];?></option>
				<?php }?>
			</select>
		</td>		
	</tr>
	<tr>
		<td><?php echo $text["Mandatory"];?>:</td>
		<td>
			<select name="mandatory">
				<?php $arr=array("0","1");?>
				<?php foreach($arr as $item){?>
					<option value="<?php echo $item["ID"];?>" <?php echo $item["ID"]==$row_picture["mandatory"]?"selected":"";?>><?php echo $item["Name"];?></option>
				<?php }?>
			</select>
		</td>		
	</tr>	
        
        <tr>
		<td><?php echo $text["display in block"];?>:</td>
		<td>
			<select name="block_num">
				<?php $arr = range(1, 10);?>
				<?php foreach($arr as $number){?>
					<option value="<?php echo $number;?>" <?php echo $number==$row_picture["block_num"]?"selected":"";?>><?php echo $number;?></option>
				<?php }?>
			</select>
		</td>		
	</tr>
	<?php
	/*

	<tr>
		<td valign="top"><?php echo $text["Content"];?>:</td>
		<td><textarea name="Value" style="width: 300px; height: 100px;"><?php echo $row_picture["Value"];?></textarea></td>		
	</tr>	
	*/
	?>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
