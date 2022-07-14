<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

$id=$_REQUEST["id"];
$page_id=$_REQUEST["page_id"];

$content_update=new ContentUpdater($db, $update_table);

if($_POST){

	$_SESSION["Translate"]["refresh"]=true;


	$arrFields=array(
		"Name"				=>	$_POST["Name"],
		"Value"				=>	$_POST["Value"],
		/*"Multiple"			=>	$_POST["Multiple"]*/
	);

	
	$new_id=$content_update->update($id, $arrFields);
	
	if(!$id){
		$id=$new_id;
	}
	
	/*send updates to ELAD*/
	
	require_once '../../classes/elad/elad_integration.class.php';
	$elad = new EladIntegration();
	/*get all data from table*/
	$dataFromTable = $db->getArray("SELECT Name as Field_Name FROM wm_fields_name");
	foreach ($dataFromTable as $key => $value) {
		$dataFromTable[$key]['Field_Caption']=$trans->getText($value['Field_Name']);
	}

	$isSent = $elad->update_custom_fields($dataFromTable);
	/*send updates to ELAD - END*/

	if(!$_POST["SubmitAdd"]){
		header("location: index.php?show=".$folderName."/index&page_id=".$page_id."&search=".$_REQUEST["search"]);
		exit;
	}else{
		$id=NULL;
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

<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<input type="hidden" name="search" value="<?php echo $_REQUEST["search"];?>" />
<table>		
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
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_item["Name"];?>" dir="ltr" /></td>		
	</tr>
	<tr>
		<td valign="top"><?php echo $text["Value"];?>:</td>
		<td>
			<textarea name="Value" style="width: 400px; height: 200px;" dir="ltr"><?php echo $row_item["Value"];?></textarea>
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
