<?php
require_once('../../classes/file/class.file.php');
require_once('../../classes/time/class.date_time.php');
require_once('../../classes/elad/elad_integration.class.php');
require_once('data.php');

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);

$page_row=$wm->getValues($page_id);

$content_update=new ContentUpdater($db, $update_table);

if($_POST){

        $check_inputs = array(
            array("string255"   => $_POST["Name"]),
            array("text"        => $_POST["Value"]),
            array("number"      => $_POST["page_id"]),
            array("number"      => $_POST["wm_cities"]),
            array("number"      => $_POST["wm_places"]),
            array("string255"   => $_POST["Start_Date"]),
            array("string255"   => $_POST["Start_Time"]),
            array("string255"   => $_POST["End_Time"]),
            array("string255"   => $_POST["Phone"]),
            array("text"        => $_POST["Details"]),
            array("url"         => $_POST["URL"]),
            array("string255"   => $_POST["LinkText"])
        );
        
        $secureTexts = new secure_inputs();
        $error = $secureTexts->isNotSecure($check_inputs);
        if (!$error) {
    
            list($d,$m,$y)=split("/", $_POST["Start_Date"]);
            $startDate=$y."-".$m."-".$d;

            $arrFields=array(
                    "Name"			=>	$_POST["Name"],
                    "Value"			=>	$_POST["Value"],
                    "wm_pages"			=>	$_POST["page_id"],
                    "wm_cities"			=>	$_POST["wm_cities"],
                    "wm_places"			=>	$_POST["wm_places"],
                    "Start_Date"		=>	$startDate,
                    "Start_Time"		=>	$_POST["Start_Time"],
                    "End_Time"			=>	$_POST["End_Time"],
                    "Phone"			=>	$_POST["Phone"],
                    "Details"			=>	$_POST["Details"],
                    "URL"			=>	$_POST["URL"],
                    "LinkText"			=>	$_POST["LinkText"]
            );

    /*
            if(!$id){
                    $query="SELECT MAX(Ordering) AS max_ordering FROM ".$update_table." WHERE WM_Pages=".$_POST["page_id"];
                    $max_ordering=$db->getField($query, "max_ordering");

                    $ordering=$max_ordering+1;

                    $arrFields["Ordering"]=$ordering;
            }
    */	
            
            $elad = new EladIntegration();
            $event_id = $arrFields["wm_pages"];

            $event = array(
                "ID"                => $id,
                "Name"              => $arrFields["Name"],
                "Content"           => trim($arrFields["Content"]),
                //"Start_Date"        => "/Date(".strtotime($arrFields["Start_Date"]." ".$arrFields["Start_Time"]).")/",
                "Start_Date"        => $arrFields["Start_Date"]." ".$arrFields["Start_Time"],                //"End_Date"          => ""
                "End_Date"          => $arrFields["Start_Date"]." ".$arrFields["End_Time"]
            );

            $new_id=$content_update->update($id, $arrFields);
            
            if(!$id){
                    $id=$new_id;
                    $elad->insert_event_show($event, $event_id, $id);
                } else {
                $elad->update_event_show($event, $event_id, $id);
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
	$row_item=$content_update->getValues($id);

	list($hour,$minute,$trash)=split(":", $row_item["Start_Time"]);
	$startTime=intval($hour).":".intval($minute);

	list($hour,$minute,$trash)=split(":", $row_item["End_Time"]);
	$endTime=intval($hour).":".intval($minute);
}else{
	$row_item["Name"]=$page_row["Name"];
	$row_item["Start_Date"]=date("Y-m-d", time());

	
	$startTime=	date("H:i", time());
	$endTime=	date("H:i", time());
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
<script language="javascript" type="text/javascript">
function chooseFile(filePath){
	document.edit.Code.value=filePath;
}


function checkForm(){
	if(document.edit.wm_cities.selectedIndex==0){
		alert("אנא בחר עיר");
		return false;
	}

	return true;
}
$(document).ready(function() {
    $( ".Start_Date" ).datepicker({ dateFormat: 'dd/mm/yy' });
});
</script>




<?php require_once('common/body.php');?>
<div class="navigator_line">

<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index&page_id=<?php echo $page_id;?>"><?php echo $pageName;?></a> -> <?php echo $row_item?$row_item["Name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding">
<div class="SecurityMessage"><?php echo $error;?></div>

<h3><?php echo $page_row["Name"];?></h3>

<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data" onsubmit="return checkForm();";>
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
list($name, $ext)=split("[.]", $fileNameArr);
?>
<?php if($ext=="swf"){?>
<object width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"><param name="movie" value="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>"/><param name="wmode" value="transparent"/><embed src="<?php echo $cfg["WM"]["Server"]."/".$row_item["File_Name"];?>" type="application/x-shockwave-flash" wmode="transparent" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>"></embed></object>
<?php }elseif($row_item["File_Name"]){?>			
<img src="<?php echo "../../".$row_item["File_Name"];?>" width="<?php echo $row_item["width"];?>" height="<?php echo $row_item["height"];?>" />
<?php }?>


		<?php };?>
		</td>
	</tr>
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row_item["Name"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["City"];?>:</td>
		<td>
			<select name="wm_cities" style="width: 150px;" onchange="questAjax('wm_events/ajaxGetPlacesByCity.php','wm_cities='+this.value+'&wm_places=<?php echo $row_item["wm_places"];?>','placesDiv','get');">
			<option value=""></option>			
			<?php $arrCities=$db->getArray("SELECT * FROM wm_cities ORDER BY Ordering");?>
			<?php foreach($arrCities as $city){?>
				<option value="<?php echo $city["ID"];?>" <?php echo $city["ID"]==$row_item["wm_cities"]?"selected":"";?>><?php echo $city["Name"];?></option>
			<?php }?>
			</select>
		</td>		
	</tr>
	<tr>
		<td><?php echo $text["Places"];?>:</td>
		<td>
			<div id="placesDiv"></div>
			<script language="javascript" type="text/javascript">
				questAjax('wm_events/ajaxGetPlacesByCity.php','wm_cities=<?php echo $row_item["wm_cities"];?>&wm_places=<?php echo $row_item["wm_places"];?>','placesDiv','get');
			</script>
		</td>		
	</tr>
	<tr>
		<td><?php echo $text["Date"];?>:</td>
		<td><input type="text" name="Start_Date" class="Start_Date" value="<?php echo date("d/m/Y", $dt->timestampFromMysql($row_item["Start_Date"]));?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["Start Time"];?>:</td>
		<td><input type="text" name="Start_Time" value="<?php echo $startTime;?>" /></td>		
	</tr>
	<tr>
		<td valign="top"><?php echo $text["Details"];?>:</td>
		<td><textarea name="Details" style="width: 200px; height: 100px;"><?php echo $row_item["Details"];?></textarea></td>		
	</tr>

<!--
	<tr>
		<td><?php echo $text["End Time"];?>:</td>
		<td><input type="text" name="End_Time" value="<?php echo $endTime;?>" /></td>		
	</tr>
-->
	<?php/*<tr>
		<td><?php echo $text["Link"];?>:</td>
		<td><input type="text" name="URL" value="<?php echo $row_item["URL"];?>" /></td>		
	</tr>
	<tr>
		<td><?php echo $text["LinkText"];?>:</td>
		<td><input type="text" name="LinkText" value="<?php echo $row_item["LinkText"];?>" /></td>		
	</tr>*/?>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
<script language="javascript" type="text/javascript">
document.edit.Name.focus();
</script>
