gallery_personal<?php
require_once('../../classes/file/class.file.php');

$id=$_REQUEST["id"];
$page_id=$_REQUEST["page_id"];


$update_table="wm_personal_gallery";

$content_update=new ContentUpdater($db, $update_table);


if($_POST){

	
	$arrFields=array(
		"Parent"			=>	0,
		"WM_Pages"			=>	$page_id,
		"Name"				=>	$_POST["Name"],
		"Content"			=>	$_POST["Content"],
		"Code"				=>	$_POST["Code"]
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
	
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/GalleryPersonal/".$page_id."/".$id."/";
	$full_file_path="../../".$file_path; 

	
	$file=new File();
	$file->checkPath($full_file_path);
	

	if(is_uploaded_file($_FILES['user_file']['tmp_name'])){
		$file_name="image.jpg";
		
		$content_update->update($id, array("File_Name"=>$file_path.$file_name));
		move_uploaded_file($_FILES['user_file']['tmp_name'], $full_file_path.$file_name);
		chmod($full_file_path.$file_name, 0777);
	}
	
	if(is_uploaded_file($_FILES['user_file1']['tmp_name'])){
		$file_name="sound.mp3";
		
		$content_update->update($id, array("File_Name_1"=>$file_path.$file_name));
		move_uploaded_file($_FILES['user_file1']['tmp_name'], $full_file_path.$file_name);
		chmod($full_file_path.$file_name, 0777);
	}	
	

	if(!$_POST["SubmitAdd"]){
		header("location: index.php?show=gallery_personal/gallery_pictures&page_id=".$page_id);
		exit;
	}else{
		$id=NULL;
	}
}

if($id){
	$row_picture=$content_update->getValues($id);
}

$row_page=$wm->db->getRow("SELECT * FROM wm_sites WHERE ID=".$page_id);

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
<?php if($page_row["Parent"]){?>
<a style="color: #ffffff;" href="index.php?id=<?php echo $page_row["Parent"];?>&show=gallery_personal/gallery_pictures"><?php echo $text["Gellery"];?></a> ->
<?php }?>
<a style="color: #ffffff;" href="index.php?page_id=<?php echo $page_id;?>&show=gallery_personal/gallery_pictures"><?php echo $row_page["Name"];?></a> -> <?php echo $row_picture?$row_picture["Name"]:$text["Add Item"];?>
</div>

<div style="padding-left: 30px;padding-right: 30px; padding-top: 10px;color: #ffffff;font-weight: bold;">

<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="gallery_personal/gallery_pictures_edit" />
<input type="hidden" name="id" value="<?php echo $row_picture["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<table>		
	<?php if($row_page["Page_Type"]==8){?>
	<tr>
		<td valign="top"><?php echo $text["Video"];?>:</td>
		<td><input type="text" name="Code" value="<?php echo $row_picture["Code"];?>" dir="ltr" /> <a style="color: #ffffff !important;" href="#" onclick="window.open('gallery_personal/browse.php',
'Browser','menubar=0,resizable=1,width=350,height=250');"><?php echo $text["Choose"];?></a></td>		
	</tr>
	<?php }?>
	<tr>
		<td colspan="2">
		<?php if($row_picture["File_Name"] && file_exists("../../".$row_picture["File_Name"])){?>
			<img src="<?php echo "../../".$row_picture["File_Name"];?>" width="100" />
		<?php };?>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<?php if($row_page["Page_Type"]==9 && $row_picture["File_Name_1"] && file_exists("../../".$row_picture["File_Name_1"])){?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="300" height="75" id="mp3_player" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="../../site/flash/mp3_player.swf?myMedia=http://www.orlanoar.com/<?php echo $row_picture["File_Name_1"];?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="../../site/flash/mp3_player.swf?myMedia=http://www.orlanoar.com/<?php echo $row_picture["File_Name_1"];?>" quality="high" bgcolor="#ffffff" width="300" height="75" id="mp3_player" name="mp3_player" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>		
			
		<?php };?>
		</td>
	</tr>	

	<tr>
		<td><?php echo $text["Image"];?>:</td>
		<td><input type="file" name="user_file" /></td>		
	</tr>

	<?php if($row_page["Page_Type"]==9){?>
	<tr>
		<td><?php echo $text["Audio"];?>:</td>
		<td><input type="file" name="user_file1" /></td>		
	</tr>	
	<?php }?>
	
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_picture["Name"];?>" /></td>		
	</tr>
	<tr>
		<td valign="top"><?php echo $text["Content"];?>:</td>
		<td><textarea name="Content" style="width: 220px; height: 100px;"><?php echo $row_picture["Content"];?></textarea></td>		
	</tr>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /></td>		
	</tr>		
</table>
</form>
</div>