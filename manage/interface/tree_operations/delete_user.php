<?php
require_once('../../../conf/conf.data.php');

$login=new Login($db, $cfg["WM"]["DATABASE_TABLE"]["Users"]);

$id=intval($_REQUEST["id"]);

if($id){
	$login->delete($id);
}

header("location: ".$_SERVER['HTTP_REFERER']);
exit;
?>
