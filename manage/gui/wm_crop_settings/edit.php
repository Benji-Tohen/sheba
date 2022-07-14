<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

// prepare array with page types for nice display
$page_types = array();
$pageTypes = $db->getArray("SELECT * FROM wm_pagetype ORDER BY ID asc");
foreach ($pageTypes as $n=>$array) $page_types[$array['ID']] = $text[$array['Name']];
// translation for image type ..
$image_types = array(
    "Top_Header" => "תמונה חיצונית",
    "Top_Header2" => "תמונה פנימית"
);
// create proportions table ..
$proportions = array(   "1:1",
                        "2:1",
                        "3:1",
                        "4:1",
                        "5:1",
                        "1:2",
                        "1:3",
                        "1:4",
                        "1:5",
                        "3:2",
                        "1903:486",
                        "5:4",
                        "65:81",
                        "360:217",
                        "46:59",
                        "18:25",
                        "​16:9"      );


$id=$_REQUEST["id"];

$content_update=new ContentUpdater($db, $update_table);

if($_POST){

        $check_inputs = array(
            array("string10"    => $_POST["Proportion"]),
            array("number"      => $_POST["Page_Type"]),
            array("string255"   => $_POST["Image_Type"])
        );
    
        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {
        
            $arrFields=array(
                "Proportion"    => $_POST["Proportion"],
                "Page_Type"     => $_POST["Page_Type"],
                "Image_Type"    => $_POST["Image_Type"]
            );

    /*
            if(!$id){
                    $query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE WM_Pages=".$_POST["page_id"];
                    $max_ordering=$db->getField($query, "max_ordering");

                    $ordering=$max_ordering+1;

                    $arrFields["Ordering"]=$ordering;
            }
    */	

            $new_id=$content_update->update($id, $arrFields);

            if(!$id){
                    $id=$new_id;
            }



    /*
            if(is_uploaded_file($_FILES['user_file']['tmp_name'])){
                    $file_path="webfiles/".$folderName."/".$id."/";
                    $full_file_path="../../".$file_path; 
                    @chmod($full_file_path, 0777);

                    $file=new File();
                    $file->checkPath($full_file_path);

                    $file_name=str_replace(" ", "_", $_FILES['user_file']['name']);

                    $content_update->update($id, array("File_Name"=>$file_path.$file_name));
                    move_uploaded_file($_FILES['user_file']['tmp_name'], $full_file_path.$file_name);
                    @chmod($full_file_path.$file_name, 0777);
            }
    */
            if(!$_POST["SubmitAdd"]){
                    header("location: index.php?show=".$folderName."/index&page_id=".$page_id."&search=".$_REQUEST["search"]);
                    exit;
            }else{
                    $id=NULL;
            }
        }
}

if($id && $id>0){
	$row_item=$content_update->getValues($id);
	
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

<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $row_item?$row_item["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding">
<div class="SecurityMessage"><?php echo $error;?></div>
<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<input type="hidden" name="search" value="<?php echo $_REQUEST["search"];?>" />
<table>		
	<tr>
		<td><?php echo $text["Page Type"];?>:</td>
		<td>
			<select name="Page_Type" style="width:300px">
				<option value="0">בחר..</option>
				<?php foreach($page_types as $page_type=>$page_name){?>
					<option value="<?php echo $page_type;?>" <?php echo $page_type==$row_item["Page_Type"]?"selected":"";?>><?php echo $page_name;?></option>
				<?php }?>
			</select>
		</td>
	</tr>
	<tr>
		<td><?php echo $text["Image"];?>:</td>
                <td>
			<select name="Image_Type" style="width:300px">
				<option value="0">בחר..</option>
				<?php foreach($image_types as $image_type=>$image_name){?>
					<option value="<?php echo $image_type;?>" <?php echo $image_type==$row_item["Image_Type"]?"selected":"";?>><?php echo $image_name;?></option>
				<?php }?>
			</select>
                </td>		
	</tr>
        
	<tr>
		<td>יחס חיתוך:</td>
                <td>
			<select name="Proportion" style="width:300px">
				<option value="0">בחר..</option>
				<?php foreach($proportions as $proportion){?>
					<option value="<?php echo $proportion;?>" <?php echo $proportion==$row_item["Proportion"]?"selected":"";?>><?php echo $proportion;?></option>
				<?php }?>
			</select>
                </td>		
	</tr>

	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
<script language="javascript" type="text/javascript">
document.edit.Name.focus();
</script>
