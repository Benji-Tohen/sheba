<?php

function mb_range($start, $end) {
    // if start and end are the same, well, there's nothing to do
    if ($start == $end) {
        return array($start);
    }
    
    $_result = array();
    // get unicodes of start and end
    list(, $_start, $_end) = unpack("N*", mb_convert_encoding($start . $end, "UTF-32BE", "UTF-8"));
    // determine movement direction
    $_offset = $_start < $_end ? 1 : -1;
    $_current = $_start;
    while ($_current != $_end) {
        $_result[] = mb_convert_encoding(pack("N*", $_current), "UTF-8", "UTF-32BE");
        $_current += $_offset;
    }
    $_result[] = $end;
    return $_result;
}
$totalItems=$wm->getNumShowenItems($id);

$numItems=intval($params->getValue(rtrim($wmPage["Type"]["Page"], ".php")."_num_items"));

if($wm->loadForGoogle()){
	$numItems=1000;
}

/*$page=$getParams[1];

if(!$page){
    $page=1;
}*/

//$sp=	$wm->getOrderingNewsPager($wmPage["ID"], $numItems);
/*$sp=	$wm->getNewsListPager($wmPage["ID"],"Start_Date DESC, Start_Time DESC, Name", $numItems);
$arr=	$sp->getPage($page);*/
/*$arr=$wm->getItems($id, "LIMIT 0,".$numItems);*/
/*$arr=$wm->getNewsList($id);*/
/*get menu letters according to language*/
switch ($_SESSION["WM"]["Lang"]) {
    case 'fr':
    case 'en':
        $arrLetters = mb_range('a', 'z');
        break;
    case 'he':
        $arrLetters = mb_range('א', 'ת');
        unset($arrLetters[10],$arrLetters[13],$arrLetters[15],$arrLetters[19],$arrLetters[21]);
        break;
    case 'ru':
        $arrLetters = mb_range('б', 'я');
        array_unshift($arrLetters,'a');
        break;
    default:
        break;
}
//$arrAllDoctors = $wm->getPagesByPageType(96,"Name ASC");

$queryDocs = "SELECT  wm_pages.* ,dy1.VALUE AS firtsName,dy1.wm_forms_fields AS type1, dy2.value as lastName,dy2.wm_forms_fields AS type2
FROM wm_pages
JOIN wm_pages_dynamic_field_values as dy1 ON dy1.wm_pages = wm_pages.ID 
JOIN wm_pages_dynamic_field_values as dy2 on dy2.wm_pages = wm_pages.ID
WHERE wm_pages.Page_Type=96 AND dy1.wm_forms_fields=15 AND dy2.wm_forms_fields=16 AND deleted =0
ORDER BY lastName,firtsName ASC LIMIT 0,1000";


//$getDoctors=$db->getArray($queryDocs);
//$arrAllDoctors = $getDoctors;
$arrExpertise = $db->getArray("SELECT * FROM wm_doctor_expertise order by Name");
//$arrUnits = $wm->getUnitsByPageType(95,"Name");

//for en support adding $mainInstitutionsID in hebraw (in dev) id = 30987 in english (in dev) id = 183328
if($wmPage['Lang'] == 'en'){
    $mainInstitutionsID = 183328;
}else{
    $mainInstitutionsID = 30987;
}
$doctorExpertiseInLang = $wmPage["Lang"] == 'he' ? 'Name' :'Value';

$arrUnitsNew = $wm->getOrderingNews($mainInstitutionsID);
$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/";

?>
