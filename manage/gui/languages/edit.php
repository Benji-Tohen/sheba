<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

$id=$_REQUEST["id"];
$page_id=$_REQUEST["page_id"];

$content_update=new ContentUpdater($db, $update_table);

if($_POST){
    
    $check_inputs = array(
        array("string255"   => $_POST["Name"]),
        array("string255"   => $_POST["Lang"])
    );
    
    $secureTexts = new secure_inputs();
    $error = $secureTexts->isNotSecure($check_inputs);
    if (!$error) {
        $arrFields=array(
            "Name"				=>	$_POST["Name"],
            "Lang"				=>	$_POST["Lang"],
        );

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

        if(is_uploaded_file($_FILES['user_file1']['tmp_name'])){	
            $file_name_second=str_replace(" ", "_", $_FILES['user_file1']['name']);

            $content_update->update($id, array("File_Name_Second"=>$file_path.$file_name_second));
            move_uploaded_file($_FILES['user_file1']['tmp_name'], $full_file_path.$file_name_second);
            chmod($full_file_path.$file_name_second, 0777);
        }

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
$gui=new Gui("he");?>

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
                <td colspan="2">
                <?php if($row_picture["File_Name"] && file_exists("../../".$row_picture["File_Name"])){?>
                    <img src="<?php echo "../../".$row_picture["File_Name"];?>" width="300" />
                <?php };?>
                </td>
            </tr>
            <tr>
                <td><?php echo $text["Logo Image"];?>:</td>
                <td><input type="file" name="user_file" /></td>		
            </tr>
            <tr>
                <td colspan="2">
                <?php if($row_item["File_Name"] && file_exists("../../".$row_item["File_Name"])){?>
                    <img src="<?php echo "../../".$row_item["File_Name"];?>" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>" />
                <?php };?>
                </td>
            </tr>
            <tr>
                <td><?php echo $text["Language Icon"];?>:</td>
                <td><input type="file" name="user_file1" /></td>		
            </tr>
            <tr>
            <td colspan="2">
                <?php if($row_item["File_Name_Second"] && file_exists("../../".$row_item["File_Name_Second"])){?>
                    <img src="<?php echo "../../".$row_item["File_Name_Second"];?>" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>" />
                <?php };?>
                </td>
            </tr>
            <tr>
                <td><?php echo $text["Name"];?>:</td>
                <td><input type="text" name="Name" value="<?php echo $row_item["Name"];?>" dir="ltr" /></td>		
            </tr>
            <tr>
                <td><?php echo $text["Lang"];?>:</td>
                <td><input type="text" name="Lang" value="<?php echo $row_item["Lang"];?>" dir="ltr" /></td>		
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
