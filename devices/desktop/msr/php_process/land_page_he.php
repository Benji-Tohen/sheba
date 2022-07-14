<?php 
// tranzilla processing.. processing and sending to elad is done in section_3.php (process)
if ($_POST[ConfirmationCode]!="0000000") {                       // if tranzilla successful transaction ..
    $tranzillaProcess = true;
    $tranzillaError = false;
} else /*if ($_GET['mode']=="FAILED")*/ {              // if tranzilla failed transaction ..
    $tranzillaProcess = true;
    $tranzillaError = "error";
}


function getChildrenContent($db, $id){
	$query="SELECT * FROM wm_pages WHERE Parent=".intval($id)." ORDER BY Ordering";
	$arr=$db->getArray($query);
	return $arr;
}
$children=getChildrenContent($db, $wmPage["ID"]);
$childrenNum=count($children);

$filepath = $cfg["WM"]["Server"]."/devices/desktop/sheba/php_process/land_page_he_files/lib";
for($i=0;$i<$childrenNum;$i++){
	$sec=$children[$i];
	$file=dirname(__FILE__)."/land_page_he_files/php_process/section_".($i+1).".php";

	if(file_exists($file)){
		include($file);
	}
}

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="he">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $wmPage["META_Title"];?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="description" content="<?php echo $wmPage["META_Description"];?>" />
<meta name="keywords" content="<?php echo $wmPage["META_Keywords"];?>" />
<?php for($i=0;$i<$childrenNum;$i++){
	$sec=$children[$i];
	$file=dirname(__FILE__)."/land_page_he_files/php_header/section_".($i+1).".php";
	if(file_exists($file)){
		include($file);		
	}
}?>
</head>
<body <?php echo $gui->getDir();?>>
    
<?php for($i=0;$i<$childrenNum;$i++){
	$sec=$children[$i];
	$file=dirname(__FILE__)."/land_page_he_files/php_display/section_".($i+1).".php";
	if(file_exists($file)){
		include($file);		
	}
}?>
    
    
</body>
<?php exit;?>