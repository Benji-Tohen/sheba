<?php
$arr_pictures=$wm->getGalleryItems($id);
$arrDynamicFields  = $wm->getDynamicFieldsByPageType($id,$wmPage['Type']['ID']);
$arr_connected_doctors = $wm->getConnectedPages($id,96,"wm_connected_pages_ids.Ordering DESC");
//$arr1 = array_slice($arr_connected_doctors,0,4);    // <-- change the order of the array, because the carousel shows the last 4 elements when started
//$arr2 = array_slice($arr_connected_doctors,4);
//$arr_connected_doctors = array_merge($arr2,$arr1);

//$len = count($arr_connected_doctors);
//$arr1 = array_slice($arr_connected_doctors,5);
//$arr2 = array_slice($arr_connected_doctors,5);
//print_r($arr1);
//print_r($arr2);
//exit;
if($wmPage["wm_forms"]){
	if($_POST){
		require_once(dirname(__FILE__)."/../../../../site/php_components/form_process.php");
	}else{
		require_once(dirname(__FILE__)."/../../../../site/php_components/form.php");
	}
}
/*if($_SERVER['REMOTE_ADDR'] == '31.168.120.186'){
echo "shery: ";
foreach ($arr_connected_doctors as $key => $value) {
	# code...
print_r($value["Name"]);
echo "<br/>";
print_r($value["Ordering"]);

} // ^^ debugging
}*/
if($wmPage['show_extended'] == 1){/*if is extended require search module from Institutions.php*/
   require_once (dirname(__FILE__).'/../php_process/Institutions.php');
   //echo "<style>";
   //require_once (dirname(__FILE__).'/../php_header/css/Institutions.php');
   //echo "</style>";
}

?>
