<?php
$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));


$arr=$wm->getAllChildren($id,'Ordering');


$thumb_call=$cfg["WM"]["Server"]."/";

?>
