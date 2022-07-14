<?php
require_once('../../../conf/conf.data.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	intval($_GET["id"]);
//$field=	$_GET["field"];
$value=	intval($_GET["value"]);

if(!$value){
	$value=0;
}

//$wm->setValue($id, $field, $value);

$wm->toggleLink($id, $value);


if(!$_SERVER['HTTP_REFERER']){
	$ref=$wm->get($id, "Alias");
	header("location: ".$cfg["WM"]["Server"]."/".($ref?$ref:$id));
}else{
	header("location: ".$_SERVER['HTTP_REFERER']);
}
exit;
?>
