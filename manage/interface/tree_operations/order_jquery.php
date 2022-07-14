<?php
require_once('../../../conf/conf.data.php');

$query="
	SELECT MIN(Ordering) AS minOrdering FROM wm_pages WHERE ID IN (".implode(",", $_GET["listItem"]).")
";
$minOrdering=$db->getField($query, "minOrdering");


$i=$minOrdering;
foreach($_GET["listItem"] as $id){
	$query="UPDATE wm_pages SET Ordering='".$i."' WHERE ID=".intval($id);
	$db->runQuery($query);
	$i++;
}
?>
