<?php
require_once('../../../conf/conf.data.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	$_GET["id"];
$field=	$_GET["field"];
$value=	$_GET["value"];
if(!$value){
	$value=0;
}

$wm->setValue($id, $field, $value);
exit;
?>
