<?php
require_once(dirname(_FILE_).'/../../../conf/conf.data.php');

$q=	$_GET["q"];

$query="SELECT META_Kerywords AS keyword  
	FROM wm_pages 
	WHERE META_Kerywords LIKE '%".mysqli_real_escape_string($db->conn, $q)."%'";

$arr=$db->getArray($query);

$txt="";

foreach($arr as $item){
	$txt.=",".$item["keyword"];
}

$arrWords=explode(",", $txt);
$arrWords=array_unique($arrWords, SORT_STRING);

header("Content-Type: text/html; charset=UTF-8");



foreach($arrWords as $item){
	$start=strpos($item, $q, 0);
	if($start===0){
		echo "<div class=\"suggestItem\">".$item."</div>";
	}
}
exit;
?>
