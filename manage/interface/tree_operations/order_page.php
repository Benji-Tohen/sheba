<?php
require_once('../../../conf/conf.data.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	intval($_REQUEST["id"]);

if($id){
	if(strcmp($_REQUEST["order"], "up")==0){
		$wm->orderUp($id);
		$log->write("Order up: '".$wm->get($id, "Name")."' id: ".$id." parent: ".$wm->getParent($id), "order");
	}else{
		$wm->orderDown($id);
		$log->write("Page down: '".$wm->get($id, "Name")."' id: ".$id." parent: ".$wm->getParent($id), "order");
	}
}

header("location: ".$_SERVER['HTTP_REFERER']);
exit;
?>
