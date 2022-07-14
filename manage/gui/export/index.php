<?php
if($_REQUEST["export"] && $_REQUEST["table"]){
	require_once('../../classes/export/class.export.php');
	require_once('../../classes/file/class.file.php');
	
	$table=$_REQUEST["table"];

	$ex=new Export($cfg["WM"]["DBServer"], $cfg["WM"]["DBName"], $cfg["WM"]["DBUser_Name"], $cfg["WM"]["DBPassword"]);

	$filePath="../../".$cfg["WM"]["File_Uploades_Folder"]."/export/";

	$file=new File();
	$file->checkPath($filePath);

	$fileName=$filePath.$table."__".date("d_m_Y__H_i_s", time()).".csv";

	
	
	$ex->exportToFile($table, $fileName);
}
?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line">Export</div>
<div class="editPagePadding">
<a href="index.php?show=export/index&export=true&table=wm_siteusers">Export Site Users</a>
</div>
