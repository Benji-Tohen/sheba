<?php
require_once('../../classes/file/class.file.php');
require_once('data.php');

$id=		intval($_REQUEST["id"]);
$gallery_id=	intval($_REQUEST["gallery_id"]);
$content_update=new ContentUpdater($db, $update_table);

if($_POST){
        $check_inputs = array(
            array("string255" => $_POST["Name"]),
        );

        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {
            $arrFields=array(
                "Name" => $_POST["Name"],
            );

            if(!$id){
                $arrFields["Ordering"]=0;
            }

            $new_id=$content_update->update($id, $arrFields);

            if(!$id){
                $id=$new_id;
            }

            if(!$_POST["SubmitAdd"]){
                    header("location: index.php?show=".$folderName."/index&gallery_id=".$gallery_id);
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
<input type="hidden" name="gallery_id" value="<?php echo $gallery_id;?>" />
<table>		
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_picture["Name"];?>" /></td>		
	</tr>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
