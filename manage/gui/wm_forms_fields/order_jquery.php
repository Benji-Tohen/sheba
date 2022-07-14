<?php
require_once('../../../conf/conf.data.php');
require_once('data.php');

$form_id=intval($_REQUEST["form_id"]);

$query="
	SELECT MIN(Ordering) AS minOrdering FROM ".$update_table." WHERE ID IN (".implode(",", $_GET["listItem"]).")
";
$minOrdering=$db->getField($query, "minOrdering");

$i=$minOrdering;
foreach($_GET["listItem"] as $id){
	$query="UPDATE ".$update_table." SET Ordering='".$i."' WHERE wm_forms=".intval($form_id)." AND ID=".intval($id);
	$db->runQuery($query);
	$i++;
}
?>
