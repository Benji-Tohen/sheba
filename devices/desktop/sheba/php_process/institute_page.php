<?php
$arr_pictures=$wm->getGalleryItems($id);
$arrDynamicFields  = $wm->getDynamicFieldsByPageType($id,$wmPage['Type']['ID']);
$navig_waze_link       = $params->dynamicValue($arrDynamicFields ,'navigWazeLink');
$navig_with_waze_label = $params->dynamicValue($arrDynamicFields ,'navigWithWazeLabel');
$navig_waze_link   =  parse_url($navig_waze_link['Value'],PHP_URL_QUERY);

if(phpversion() < 7){
	parse_str($navig_waze_link, $latLng);
} else {
	$latLng = parse_str($navig_waze_link);
}
$latLng = $latLng["ll"];

$arr_connected_doctors = $wm->getConnectedPages($id,96,"wm_connected_pages_ids.Ordering ASC");


if($wmPage["wm_forms"]){
	if($_POST){
		require_once(dirname(__FILE__)."/../../../../site/php_components/form_process.php");
	}else{
		require_once(dirname(__FILE__)."/../../../../site/php_components/form.php");
	}
}

if($wmPage['show_extended'] == 1){
   require_once (dirname(__FILE__).'/../php_process/Institutions.php');
}

?>
