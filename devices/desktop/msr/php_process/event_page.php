<?php


$mofaId = intval($getParams[1]);

if($mofaId != '' && $getParams[0]!='item'){/*first check if we came for specific "mofa"*/
    $mofaArr = $db->getRow("SELECT * FROM wm_events WHERE ID =".intval($mofaId));
    if(count($mofaArr)==0){
        $mofaId=0;
    }
    $wmPage['Start_Date'] = $mofaArr['Start_Date'];
    $wmPage['Start_Time'] = $mofaArr['Start_Time'];
    
}else{
    $mofaArr = $db->getRow("SELECT * FROM wm_events WHERE wm_pages =".intval($wmPage['ID'])." LIMIT 0,1");
    $mofaId = $mofaArr['ID'];
    $wmPage['Start_Time'] = $mofaArr['Start_Time'];
}
 
$arr_pictures=$wm->getGalleryItems($id);
$arrDynamicFields = $wm->getDynamicFieldsByPageType($id,$wmPage['Type']['ID']);
//$arrChildrenContent = $wm->getMenuLevel($id);
$arrPlace = $db->getRow("SELECT * FROM wm_places WHERE ID =".$mofaArr["wm_places"]);
if($wmPage["wm_forms"]){
	if($_POST){
		require_once(dirname(__FILE__)."/../../../../site/php_components/form_process.php");
	}else{
		require_once(dirname(__FILE__)."/../../../../site/php_components/form.php");
	}
}
?>
