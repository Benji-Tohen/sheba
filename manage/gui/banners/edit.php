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
            array("url"         => $_POST["URL"]),
            array("number"      => $_POST["Banner_Type"]),
            array("string255"   => $_POST["Start_Date"]),
            array("string255"   => $_POST["End_Date"]),
            array("string255"   => $_POST["custom_class"])
        );
        
        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {

            $arrFields=array(
                    "Parent"			=>	0,
                    "Name"				=>	$_POST["Name"],
                    "Value"				=>	$_POST["Value"],
                    "URL"				=>	$_POST["URL"],
                    "Banner_Type"       =>  $_POST["Banner_Type"],
                    "is_important"      =>  isset($_POST["is_important"]) ? 1: 0,
                    "Start_Date"       	=>  date("Y-m-d", $dt->timestampFromText($_POST['Start_Date'])),
                    "End_Date"          =>  date("Y-m-d", $dt->timestampFromText($_POST['End_Date'])),
                    "custom_class"       	=>  $_POST["custom_class"]
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

            $file_path="webfiles/".$update_table."/".$id."/";
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
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery-ui-1.8.23.custom.min.js"></script>
<?php if ($gui->getDir()=="rtl"){?>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery.ui.datepicker-he.js"></script>
<?php }?>
<link type="text/css" href="JS/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<script src="ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript">
function chooseFile(filePath){
	document.edit.Code.value=filePath;
}
$(document).ready(function(){
    $(".Start_Date").datepicker({ dateFormat: 'dd/mm/yy' });
    $(".End_Date").datepicker({ dateFormat: 'dd/mm/yy' });
    <?php 
    if($id==0){/*new banner - default date for datepicker is today*/?>
        $(".Start_Date").datepicker("setDate", new Date());
        $(".End_Date").datepicker("setDate", new Date());
    <?php }?>
    
});

</script>
<?php require_once('common/body.php');?>
<div class="navigator_line">

<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $text["Links"];?></a> -> <?php echo $row_picture?$row_picture["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding" style="overflow-y: scroll;  height: 640px;">
    <a style="float: left;margin-left: 20px;" href="javascript:history.back()"><img border="0" src="images/icons/back.gif" alt="Back" /></a>
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
			<img src="<?php echo "../../".$row_picture["File_Name"];?>" width="100" />
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
                <td><input placeholder="<?php echo $text["insert full link"];?>" type="text" name="URL" value="<?php echo $row_picture["URL"];?>" dir="ltr" style="width: 300px;" /></td>		
	</tr>	
        <tr>
		<td><?php echo $text["is_important"];?>:</td>
		<td><input type="checkbox" name="is_important" <?php echo ($row_picture['is_important'] == 1 ? 'checked="checked"': '')?> dir="ltr" style="width: 14px;" /></td>		
	</tr>
        <tr>
		<td><?php echo $text["Start Date"];?>:</td>
		<td><input type="text" name="Start_Date" class="Start_Date" value="<?php echo date("d/m/Y", $dt->timestampFromMysql($row_picture["Start_Date"]));?>"  /> </td>		
	</tr>
        <tr>
		<td><?php echo $text["End Date"];?>:</td>
		<td><input type="text" name="End_Date" class="End_Date" value="<?php echo date("d/m/Y", $dt->timestampFromMysql($row_picture["End_Date"]));?>"  /> </td>		
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
		<td valign="top"><?php echo $text["Content"];?>:</td>
		<td><textarea name="Value" style="width: 300px; height: 100px;"><?php echo $row_picture["Value"];?></textarea></td>		
	</tr>	
        <script>
        CKEDITOR.replace( 'Value',
                {
        <?php if($gui->getDir()=="rtl"){?>
        language: 'he'
        <?php }else{?>
        language: 'en'
        <?php }?>		
                });
        </script>

 
      <tr>
		<td valign="top"><?php echo $text["Banner_Type"];?>:</td>
		    
		<td>
        <select name="Banner_Type">

        <?php 
		for ($i=0;$i<count($banner_names);++$i){
			$select_line = "<option value = \"".($i+1)."\" ";
			if ($row_picture["Banner_Type"] == ($i+1))
			{
				$select_line = $select_line." selected "; 
			}
			$select_line =$select_line. " >".$banner_names[$i]."</OPTION>";
			echo $select_line;  
        }?>

         </select>
        </td>
        		
	</tr>

 
    
    
    
    
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
