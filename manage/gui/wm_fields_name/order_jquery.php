<?php

require_once('../../../conf/conf.data.php');
require_once('data.php');

$query="
	SELECT MIN(Ordering) AS minOrdering FROM ".$update_table." WHERE ID IN (".implode(",", $_GET["listItem"]).")
";
$minOrdering=$db->getField($query, "minOrdering");

$i=$minOrdering;
foreach($_GET["listItem"] as $id){
	$query="UPDATE ".$update_table." SET Ordering='".$i."' WHERE ID=".intval($id);
	$db->runQuery($query);
	$i++;
}
?>