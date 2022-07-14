<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');


if($_REQUEST["template"]){
	$_SESSION["template"]=intval($_REQUEST["template"]);
}

if(!$_SESSION["template"]){
	$_SESSION["template"]=1;
}

$template=$_SESSION["template"];

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);

if($_REQUEST["parent"]){
	$parent=$fileName=intval($_REQUEST["parent"]);
}else{
	$parent=	$fileName=$db->getField("SELECT Parent FROM ".$update_table." WHERE ID=".intval($id), "Parent");
}

$content_update=new ContentUpdater($db, $update_table);


if($_POST){
    
        $check_inputs = array(
            array("string255"   => $_POST["Name"]),
            array("text"        => $_POST["Value"]),
            array("number"      => $_POST["parent"]),
            array("string255"   => $_POST["nice_name"])
        );

        $secureTexts = new secure_inputs();
        //$error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {

            $arrFields=array(
                    "Name"			=>	$_POST["Name"],
                    "Value"			=>	$_POST["Value"],
                    "Parent"			=>	$_POST["parent"],
                    "nice_name"			=>	$_POST["nice_name"]	
            );

            if($_POST["delImage"]){
                    $fileName=$db->getField("SELECT File_Name FROM ".$update_table." WHERE ID=".intval($id), "File_Name");
                    //@unlink("../../".$fileName);
                    $arrFields["File_Name"]="";
            }

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


            if(!$_POST["SubmitAdd"]){
                    if(!$parent){
                            $parent=$_POST["Parent"];
                    }
                    header("location: index.php?show=".$folderName."/index&page_id=".$page_id."&parent=".$parent);
                    exit;
            }else{
                    $id=NULL;
            }
        }
}

if($id && $id>0){
	$row_item=$content_update->getValues($id);	
}else{
	$row_item["Parent"]=$parent;
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

<a href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a>
<?php if($row_item["Parent"]){echo " -> ".$db->getField("SELECT Name FROM ".$update_table." WHERE ID=".$row_item["Parent"], "Name");
}?>
 -> <?php echo $row_item?$row_item["Name"]:$text["Add Item"];?> 
</div>

<div class="editPagePadding">
<div class="SecurityMessage"><?php echo $error;?></div>

<form action="index.php" name="edit" method="post" enctype="multipart/form-data" style="height: 650px; overflow: auto; padding-right: 20px;">

<div style="position: absolute; left: 20px;">
		<?php if($row_item["File_Name"] && file_exists("../../".$row_item["File_Name"])){?>
			
<?php 
$fileNameArr=$row_item["File_Name"];
list($name, $ext)=explode("[.]", $fileNameArr);
?>
<?php if($ext=="swf"){?>
<object width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"><param name="movie" value="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>"></param><param name="wmode" value="transparent"></param><embed src="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"></embed></object>
<?php }elseif($row_item["File_Name"]){?>			
<img src="<?php echo $cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?w=300&amp;h=150&amp;src=../../".$row_item["File_Name"];?>" />
<?php }?>

		<input type="checkbox" name="delImage" value="1" /> <?php echo $text["Delete"];?>
		<?php };?>
</div>

<input type="hidden" name="show" value="<?php echo $folderName;?>/edit" />
<input type="hidden" name="id" value="<?php echo $row_item["ID"];?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />
<!--<input type="hidden" name="parent" value="<?php echo $parent;?>" />-->
<table>		
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_item["Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Parent"];?>:</td>
		<td>
			<select name="parent" id="parent">
				<option value="0">ROOT</option>
				<?php
				$parents_array = $db->getArray("SELECT ID, Name FROM ".$update_table." where Parent='0' ORDER BY Ordering");
				foreach($parents_array as $item){
					echo "<option value='".$item['ID']."'";
					if ($parent == $item['ID']) echo " selected";
					echo ">".$item['Name']."</option>";
				}
				?>
			</select>
		</td>		
	</tr>

<?php if(true || $row_item["Parent"]>0){?>
	<tr>
		<td valign="top"><?php echo $text["Nice Name"];?>:</td>
		<td valign="top"><input type="text" name="nice_name" value="<?php echo $row_item["nice_name"];?>" /></td>		
	</tr>

	<tr>
		<td valign="top"><?php echo $text["Value"];?>:</td>
		<td valign="top"><textarea name="Value"><?php echo $row_item["Value"];?></textarea></td>		
	</tr>
<?php }?>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
