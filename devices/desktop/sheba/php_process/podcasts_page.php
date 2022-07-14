<?php
$totalItems=$wm->getNumShowenItems($id);

$numItems=1000;
// $numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));
if($wm->loadForGoogle()){
	$numItems=1000;
}
$arr=$wm->getOrderingNews($id, "LIMIT 0,".$numItems);
?>
