<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);


if($_REQUEST["delId"]){
	$queryDelete="
			DELETE FROM 
			wm_seo_expressions_occurrences 
			WHERE ID=".intval($_REQUEST["delId"])."
	";
	$db->runQuery($queryDelete);
}


$content_update=new ContentUpdater($db, $update_table);




if($_POST){

	$arrFields=array(
		"Name"				=>	$_POST["Name"],
		"Value"				=>	$_POST["Value"]
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
		<td><textarea name="Name" style="width: 200px; height: 20px;" <?php echo $id?"readonly":"";?>><?php echo $row_item["Name"];?></textarea></td>		
	</tr>
<?php if(!$id){?>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>
<?php }?>	
</table>
</form>

<?php 
$query="
		SELECT ID, num_occurences, DATE_FORMAT(check_date, '%d/%m/%Y %H:%i:%s') AS check_date 
		FROM wm_seo_expressions_occurrences 
		WHERE wm_seo_expressions=".$id."
		ORDER BY check_date DESC
";
$arrOcc=$db->getArray($query);
?>
<table>
<?php foreach($arrOcc as $occ){?>
	<tr>
		<td><?php echo $occ["check_date"];?></td>
		<td> - </td>
		<td><?php echo $occ["num_occurences"];?> הופעות</td>
		<td><a href="index.php?show=<?php echo $folderName;?>/edit&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $id;?>&amp;delId=<?php echo $occ["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
</table>
</div>
