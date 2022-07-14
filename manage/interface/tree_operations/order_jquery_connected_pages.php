<?php
require_once('../../../conf/conf.data.php');
$_POST["listItem"] = str_replace('&listItem[]=', ',', $_POST["listItem"]);
$_POST["listItem"] = str_replace('listItem[]=', '', $_POST["listItem"]);
$_GET["listItem"] = explode(',',$_POST["listItem"]);

$query="
	SELECT MIN(Ordering) AS minOrdering FROM wm_connected_pages_ids WHERE wm_connected_wm_pages_ids IN (".$_POST["listItem"].") 
";

$minOrdering=$db->getField($query, "minOrdering");

$i=$minOrdering;
foreach($_GET["listItem"] as $id){
	$query="UPDATE wm_connected_pages_ids SET Ordering='".$i."' WHERE wm_connected_wm_pages_ids=".intval($id)." AND wm_pages = ".intval($_POST['sentFromPageID']) ;
	$db->runQuery($query);
	$i++;
}

?>
