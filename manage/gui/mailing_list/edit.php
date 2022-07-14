<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);




$content_update=new ContentUpdater($db, $update_table);


if($_POST){

	$arrFields=array(
		"Name"		=>	$_POST["Name"],
		"Content"	=>	$_POST["Content"],
		"Lang"		=>	$_POST["Lang"]
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
		//header("location: index.php?show=".$folderName."/index&page_id=".$page_id);
		//exit;
	}else{
		$id=NULL;
	}
}

if($id && $id>0){
	$row_item=$content_update->getValues($id);
	
}

if(!$row_item["Lang"]){
	$row_item["Lang"]=$cfg["WM"]["Default_Language"];
}

$gui=new Gui($row_item["Lang"]);
?>
<?php require_once('common/header.php');?>
<script language="javascript" type="text/javascript">
function chooseFile(filePath){
	document.edit.Code.value=filePath;
}
</script>
<?php require_once('common/body.php');?>
<div class="navigator_line">

<a href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $row_item?$row_item["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding">


<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />


<h4><?php echo $text["Language"];?></h4>
<select name="Lang" onchange="document.edit.submit();">
	<option value="he" <?php echo $row_item["Lang"]=="he"?"selected":"";?>>עברית</option>
	<option value="en" <?php echo $row_item["Lang"]=="en"?"selected":"";?>>English</option>
</select>



<h4><?php echo $text["Subject"];?></h4>
<input type="text" name="Name" value="<?php echo $row_item["Name"];?>" style="width: 494px;" />

<h4><?php echo $text["Content"];?></h4>
<?php require_once('FCKeditor/fckeditor.php');?>
<div id="richTextEditor" style="width: 494px;">
<?php
$sBasePath = "FCKeditor/";

$oFCKeditor = new FCKeditor('Content') ;
$oFCKeditor->BasePath = $sBasePath ;
$oFCKeditor->Height= "400";

$oFCKeditor->Config['AutoDetectLanguage']	= false;
$oFCKeditor->Config['DefaultLanguage']		= $gui->lang;
$oFCKeditor->Config['ContentLangDirection']	= $gui->getDir();


$oFCKeditor->Value = $row_item["Content"] ;
$oFCKeditor->Create() ;
?>
</div>


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

<br />


<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" />











</form>
</div>

