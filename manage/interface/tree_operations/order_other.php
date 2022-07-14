<?php
require_once('../../../conf/conf.data.php');

$tree=new TreeData($db, $_REQUEST["table"]);

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);

$cond="1";

if($page_id){
	$cond="WM_Pages=".$page_id;
}

if(strcmp($_REQUEST["order"], "up")==0){
	$tree->orderUp($id, $cond);
}else{
	$tree->orderDown($id, $cond);
}

header("location: ".$_SERVER['HTTP_REFERER']);
exit;
?>
