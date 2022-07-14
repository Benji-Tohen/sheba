<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

$id=$_REQUEST["id"];
$page_id=$_REQUEST["page_id"];

if(!$id && $_POST["ID"]){
	$id=$_POST["ID"];
}

$content_update=new ContentUpdater($db, $update_table);

$arrFields=$db->getAllTableFields($update_table);

if($_POST){
    
        $check_inputs = array(
            array("number" => $_POST['ID']),
            array("number" => $_POST['Parent']),
            array("number" => $_POST['Ordering']),
            array("string255" => $_POST['Name']),
            array("string255" => $_POST['Page']),
            array("string255" => $_POST['Icon']),
            array("number" => $_POST['Admin_Enable']),
            array("number" => $_POST['Admin_Level']),
            array("number" => $_POST['Admin_Enable_Edit']),
            array("number" => $_POST['Admin_Enable_Link']),
            array("number" => $_POST['Admin_Enable_Author']),
            array("number" => $_POST['Admin_Enable_Email']),
            array("number" => $_POST['Admin_Enable_Delete']),
            array("number" => $_POST['Admin_Enable_Image']),
            array("number" => $_POST['Admin_Enable_Protection']),
            array("number" => $_POST['Admin_Enable_Advanced']),
            array("number" => $_POST['Admin_Enable_Children']),
            array("number" => $_POST['Admin_Start_Date']),
            array("number" => $_POST['Admin_Sub_Title']),
            array("number" => $_POST['Admin_Is_Gallery']),
            array("number" => $_POST['Admin_Answer_Text']),
            array("number" => $_POST['Admin_Store']),
            array("number" => $_POST['ShowOnMenu']),
            array("number" => $_POST['ShowChildrenOnMenu']),
            array("number" => $_POST['ShowChildrenOnHomePage']),
            array("number" => $_POST['ShowOnHomepage']),
            array("number" => $_POST['showOnBreadcrumbs']),
            array("string255" => $_POST['order_by']),
            array("string255" => $_POST['Redirect']),
            array("number" => $_POST['GotoFirstChild']),
            array("string255" => $_POST['Related_Table']),
            array("number" => $_POST['Default_Child_Type']),
            array("string255" => $_POST['connected_Page_Types'])
        );

    
        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {

            for($i=0;$i<count($arrFields);$i++){
                    if($arrFields[$i]!="ID"){
                            $fieldsArr[$arrFields[$i]]=$_POST[$arrFields[$i]];
                    }
            }




            $new_id=$content_update->update($id, $fieldsArr);

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
	$row=$content_update->getValues($id);
	
}else{
	$row["ID"]=NULL;

	$row=array(
		"ID" => 0
		,"Parent" => 0
		,"Ordering" => 0
		,"Name" => ""
		,"Page" => "some_page.php"
		,"Icon" => "page01.png"
		,"Admin_Enable" => 1
        ,"Admin_Level" => 0
        ,"connected_Page_Types" => ""
        ,"showOnBreadcrumbs" => 1
        ,"order_by" => "Ordering"
        ,"Redirect" => 1
        ,"Related_Table" => ""
        ,"Admin_Store" => 0
		,"Admin_Enable_Edit" => 1
		,"Admin_Enable_Link" => 1
		,"Admin_Enable_Author" => 0
		,"Admin_Enable_Email" => 0
		,"Admin_Enable_Delete" => 1
		,"Admin_Enable_Image" => 1
		,"Admin_Enable_Protection" => 1
		,"Admin_Enable_Advanced" => 1
		,"Admin_Enable_Children" => 1
		,"Admin_Start_Date" => 0
		,"Admin_Sub_Title" => 1
		,"Admin_Is_Gallery" => 1
		,"Admin_Answer_Text" => 0
		,"ShowOnMenu" => 1
		,"ShowChildrenOnMenu" => 1
		,"ShowChildrenOnHomePage" => 1
		,"ShowOnHomepage" => 1
		,"Redirect" => NULL
		,"GotoFirstChild" => 0
		,"Related_Table" => NULL
		,"Default_Child_Type" => 1
	);
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

<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $row?$row_item["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding" dir="ltr">
<div class="SecurityMessage"><?php echo $error;?></div>

<form action="index.php" name="edit" method="post" enctype="multipart/form-data" style="height: 650px; overflow: auto; padding-right: 20px;">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<table>
<?php for($i=0;$i<count($arrFields);$i++){?>
	<tr>
		<td><?php echo $arrFields[$i];?></td>
		<td><input type="text" name="<?php echo $arrFields[$i];?>" value="<?php echo $row[$arrFields[$i]];?>" /></td>		
	</tr>	
<?php }?>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
<script language="javascript" type="text/javascript">
document.edit.Name.focus();
</script>
