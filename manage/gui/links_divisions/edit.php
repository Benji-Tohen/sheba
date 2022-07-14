<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');


$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);




$content_update=new ContentUpdater($db, $update_table);


if($_POST){

	
	$arrFields=array(
		"Parent"			=>	0,
		"Name"				=>	$_POST["Name"],
		"Value"				=>	$_POST["Value"],
		"URL"				=>	$_POST["URL"],
		"Lang"				=>	$_POST["Lang"]
	);

	if(!$id){
		$query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE WM_Pages=".$_POST["page_id"];
		$max_ordering=$db->getField($query, "max_ordering");
		
		$ordering=$max_ordering+1;
		
		$arrFields["Ordering"]=$ordering;
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
<? require_once('common/body.php');?>
<div class="navigator_line">

<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $row_picture?$row_picture["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding">

<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_picture["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<table>		
	<tr>
		<td colspan="2">
		<?php if($row_picture["File_Name"] && file_exists("../../".$row_picture["File_Name"])){?>
			<img src="<?php echo "../../".$row_picture["File_Name"];?>" width="300" />
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
		<td><?php echo $text["Lang"];?>:</td>
		<td>
		    <?php 
		    $querylangs="SELECT Name, Lang FROM  `wm_languages`";
		    $langs=	$db->getArray($querylangs);
		    ?>
			<select name="Lang">
			<?php foreach($langs as $lang){ ?>
				<option value="<?php echo $lang["Lang"]; ?>" <?php echo $row_picture["Lang"]==$lang["Lang"]?"selected":"";?>><?php echo $lang["Name"]; ?></option>
			<?php } ?>
			</select>
		</td>		
	</tr>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
