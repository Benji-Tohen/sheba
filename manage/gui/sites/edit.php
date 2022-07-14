<?php
require_once('../../classes/file/class.file.php');

$id=$_REQUEST["id"];

$update_table="wm_sites";
$content_update=new ContentUpdater($db, $update_table);


if($_POST){

	$arrFields=array(
		"Parent"			=>	0,
		"Name"				=>	$_POST["Name"],
		"Shortcut"			=>	$_POST["Shortcut"],
		"Email"				=>	$_POST["Email"],		
		"Lyrics"			=>	$_POST["Lyrics"],
		"Synopsis"			=>	$_POST["Synopsis"]
	);

/*
		"Greeting"			=>	$_POST["Greeting"],
		"Creator_Lyrics"	=>	$_POST["Creator_Lyrics"],
		"Creator_Tune"		=>	$_POST["Creator_Tune"],
		"Creator_Production"=>	$_POST["Creator_Production"],
		"Creator_Singer"	=>	$_POST["Creator_Singer"],
		"Creator_Design"	=>	$_POST["Creator_Design"]

*/

	if(!$id){
		$query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table;
		$max_ordering=$db->getField($query, "max_ordering");
		
		$ordering=$max_ordering+1;
		
		$arrFields["Ordering"]=$ordering;
	}
	
		
	$new_id=$content_update->update($id, $arrFields);
	
	if(!$id){
		$id=$new_id;
	}
	
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/Sites/".$id."/";
	$full_file_path="../../".$file_path; 

	
	$file=new File();
	$file->checkPath($full_file_path);
	

	if(is_uploaded_file($_FILES['user_file']['tmp_name'])){
		$file_name=$_FILES['user_file']['name'];
		
		$content_update->update($id, array("File_Name_1"=>$file_path.$file_name));
		move_uploaded_file($_FILES['user_file']['tmp_name'], $full_file_path.$file_name);
		chmod($full_file_path.$file_name, 0777);
	}
	
	if(is_uploaded_file($_FILES['user_file1']['tmp_name'])){
		$file_name=$_FILES['user_file1']['name'];
		
		$content_update->update($id, array("File_Name_2"=>$file_path.$file_name));
		move_uploaded_file($_FILES['user_file1']['tmp_name'], $full_file_path.$file_name);
		chmod($full_file_path.$file_name, 0777);
	}
	
	if(is_uploaded_file($_FILES['user_file3']['tmp_name'])){
		$file_name=$_FILES['user_file3']['name'];
		
		$content_update->update($id, array("File_Name_3"=>$file_path.$file_name));
		move_uploaded_file($_FILES['user_file3']['tmp_name'], $full_file_path.$file_name);
		chmod($full_file_path.$file_name, 0777);
	}		
	

	if(!$_POST["SubmitAdd"]){
		header("location: index.php?show=sites/index");
		exit;
	}else{
		$id=NULL;
	}
}

if($id && $id!=NULL){
	$row=$content_update->getValues($id);
}else{
	$row=NULL;
}



$gui=new Gui("he");
?>
<?php require_once('common/header.php');?>
<script type="text/javascript" src="FCKeditor/fckeditor_<?php echo $gui->getDir();?>.js"></script>
<?php require_once('common/body.php');?>
<div class="navigator_line">
<?php echo $text["Sites"];?> -> <?php echo $row_picture?$row["Name"]:$text["Add Item"];?>
</div>

<div style="padding-left: 30px;padding-right: 30px; padding-top: 10px;color: #ffffff;font-weight: bold;">

<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="sites/edit" />
<input type="hidden" name="id" value="<?php echo $row["ID"];?>" />

<table>
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row["Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Shortcut"];?>:</td>
		<td><input type="text" name="Shortcut" value="<?php echo $row["Shortcut"];?>" dir="ltr" /></td>		
	</tr>	
	<tr>
		<td><?php echo $text["Email"];?>:</td>
		<td><input type="text" name="Email" value="<?php echo $row["Email"];?>" dir="ltr" /></td>		
	</tr>	

	<tr>
		<td><?php echo $text["Image"];?>:</td>
		<td>
		<?php if($row["File_Name_1"]){?>
			<img src="../../<?php echo $row["File_Name_1"];?>" width="70" alt="Image" />
			<br />
		<?php }?>		
		<input type="file" name="user_file" />
		</td>		
	</tr>
	
	<tr>
		<td><?php echo $text["Image"];?>:</td>
		<td>
		<?php if($row["File_Name_3"]){?>
			<img src="../../<?php echo $row["File_Name_3"];?>" width="70" alt="Image" />
			<br />
		<?php }?>		
		<input type="file" name="user_file3" />
		</td>		
	</tr>	

	<tr>
		<td><?php echo $text["Audio"];?>:</td>
		<td>
		<?php if($row["File_Name_2"]){
$mediaURL=$cfg["WM"]["Server"]."/".$row["File_Name_2"];		
		
		?>
<br />
<object width="300" height="84" data="../../../site/flash/player/player.swf?songLocation=<?php echo $mediaURL;?>" type="application/x-shockwave-flash" wmode="transparent"><param name="movie" value="../../../site/flash/player/player.swf?songLocation=<?php echo $mediaURL;?>"></param><param name="wmode" value="transparent"></param><embed src="../../../site/flash/player/player.swf?songLocation=<?php echo $mediaURL;?>" type="application/x-shockwave-flash" wmode="transparent"  width="300" height="84"></embed>
</object>
<br />
		<?php }?>
		<input type="file" name="user_file1" /></td>		
	</tr>	

<!--
	<tr>
		<td><?php echo $text["Creator_Lyrics"];?>:</td>
		<td><input type="text" name="Creator_Lyrics" value="<?php echo $row["Creator_Lyrics"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Creator_Tune"];?>:</td>
		<td><input type="text" name="Creator_Tune" value="<?php echo $row["Creator_Tune"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Creator_Production"];?>:</td>
		<td><input type="text" name="Creator_Production" value="<?php echo $row["Creator_Production"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Creator_Singer"];?>:</td>
		<td><input type="text" name="Creator_Singer" value="<?php echo $row["Creator_Singer"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Creator_Design"];?>:</td>
		<td><input type="text" name="Creator_Design" value="<?php echo $row["Creator_Design"];?>" /></td>		
	</tr>				
-->


<!--
	<tr>
		<td valign="top"><?php echo $text["Greeting"];?>:</td>
		<td><textarea name="Greeting" style="width: 220px; height: 100px;"><?php echo $row["Greeting"];?></textarea></td>		
	</tr>

	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"></td>		
	</tr>
-->		
</table>


<h3><?php echo $text["Synopsis"];?></h3>
<div id="richTextEditor" style="width: 500px;">
<?php

//$sBasePath = $_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;

include("FCKeditor/fckeditor.php");
$sBasePath = "FCKeditor/";

$oFCKeditor = new FCKeditor('Synopsis');
$oFCKeditor->BasePath = $sBasePath ;

$oFCKeditor->ToolbarSet='Middle';

//$oFCKeditor->Width = 500;
//$oFCKeditor->Height = 300;

//$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/default/' ;

$oFCKeditor->Value = $row["Content"];



$fckconfig_file="../fckconfig_he.js";

$oFCKeditor->Create($fckconfig_file);

?>
</div>


<h3><?php echo $text["Lyrics"];?></h3>
<div id="richTextEditor1" style="width: 500px;">
<?php

//$sBasePath = $_SERVER['PHP_SELF'] ;
//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;




$oFCKeditor1 = new FCKeditor('Lyrics');
$oFCKeditor1->BasePath = $sBasePath ;

$oFCKeditor1->ToolbarSet='Middle';

//$oFCKeditor->Width = 500;
//$oFCKeditor->Height = 300;

//$oFCKeditor->Config['SkinPath'] = $sBasePath . 'editor/skins/default/' ;

$oFCKeditor1->Value = $row["Lyrics"];



$fckconfig_file="../fckconfig_he.js";

$oFCKeditor1->Create($fckconfig_file);

?>
</div>


<input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" />


</form>
</div>
