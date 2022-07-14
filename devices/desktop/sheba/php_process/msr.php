<?php 

$arrHomeNewsRelated = $wm->getConnectedPages($id,103,"wm_connected_pages_ids.Ordering ASC","0,6");
$arrHomeEventsRelated = $wm->getConnectedPages($id,98,"wm_connected_pages_ids.Ordering ASC","0,6");
/*$arrHomeEventsRelated1 = array_slice($arrHomeEventsRelated,0,3);
$arrHomeEventsRelated2 = array_slice($arrHomeEventsRelated,3,3);
$arrHomeEventsRelated = array_merge($arrHomeEventsRelated2,$arrHomeEventsRelated1);*/


$parent = $db->getRow("SELECT ID FROM wm_pages WHERE Parent = ".intval($homePageId)." AND Deleted=0 AND Page_Type=63");
$arrCenterBanners=$db->getArray("SELECT * FROM wm_pages WHERE Parent=".$parent['ID']." AND Hide_On_Menu=0 AND Deleted=0 ORDER BY Ordering ASC");
		
?>
