<?php
//require_once('../../classes/google/class.spreadsheet.php');
//echo "test";
//exit;

$affectedRows=0;
if($_REQUEST["import"] && $_REQUEST["table"] && is_uploaded_file($_FILES["fileToImport"]["tmp_name"])){

	require_once('../../classes/import/class.import.php');
	require_once('../../classes/file/class.file.php');
	
	$table=$_REQUEST["table"];

	$im=new Import($db);

	$filePath="../../".$cfg["WM"]["File_Uploades_Folder"]."/program/";

	$file=new File();
	$file->checkPath($filePath);

	$fileName=$_FILES["fileToImport"]["name"];
	
	$fullFilePath=$filePath.$fileName;
	move_uploaded_file($_FILES["fileToImport"]["tmp_name"], $fullFilePath);

	
	
	$results=$im->importPrograms($fullFilePath);
}

if($_REQUEST["importGoogle"] && $_REQUEST["table"] && is_uploaded_file($_FILES["fileToImport"]["tmp_name"])){

	

	

}

?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Import"];?></div>


<div class="editPagePadding">




<form name="import" method="post" enctype="multipart/form-data" style="padding: 0px; margin: 0px;">
	<input type="hidden" name="show" value="<?php echo $show;?>" />
	<input type="hidden" name="import" value="1" />
	<input type="hidden" name="table" value="wm_siteusers" />
	<input type="file" name="fileToImport" />
	<input type="submit" name="submit" value="ייבא" />
</form>

<br />
<!--
<form name="importGoogle" method="post" enctype="multipart/form-data" style="padding: 0px; margin: 0px;">
	<input type="hidden" name="show" value="<?php echo $show;?>" />
	<input type="hidden" name="importGoogle" value="1" />
	<input type="hidden" name="table" value="wm_siteusers" />
	<input type="file" name="fileToImport" />
	<input type="submit" name="submit" value="העלה קובץ לגוגל דוקס" />
</form>

<br /><br />
-->
<?php 
if($_POST){
	if($results){?>
	<div>ייבוא מוצלח של <?php echo $results["affectedRows"];?> רשומות</div>
	<div>מתוכם <?php echo $results["modifiedRows"];?> עדכונים</div>
	<?php }else{?>
	<div>מצטער, לא היה מה לייבא</div>
	<?php }
}
?>

<br /><br />
<?php
/*
$gs=new GSpreadsheet();
if($gs->gConnect()){

	//$documantFeed=$gs->uploadSpreadsheet("spreadsheet.xls", "My doc ".date("d.m.Y h.i", time()));


	$spreadsheets=$gs->getSpreadsheets();
	$firstSpreadsheet=$spreadsheets[0];




	

	$spreadsheetKey=$gs->getKey($firstSpreadsheet);
	
	$worksheets=$gs->getWorkSheets($spreadsheetKey);
	$firstWorksheet=$worksheets[0];

	

	$worksheetKey=$gs->getKey($firstWorksheet);

	$rows=$gs->getWorksheetRows($spreadsheetKey, $worksheetKey);


	foreach($rows->entries as $row){
		echo "<br>-----------------------".$row->id." - ".$row->getTitle()."<br>";
		$rowData = $row->getCustom();

		
		
		foreach($rowData as $customEntry) {

				
			echo "<br>".$customEntry->getColumnName() . " = " . $customEntry->getText();




		}
	}

}
*/
?>

</div>
