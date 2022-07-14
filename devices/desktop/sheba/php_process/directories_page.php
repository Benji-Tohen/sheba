<?php
/*

$csv_data = array();
$columns = array();

$csv = file_get_contents(dirname(__file__)."/phones.csv");
$lines = explode("\n",$csv);
// ---------------------------------------------------------------------------------------------------------------------------------------
$out = "";  $outs = "";
foreach ($lines as $n=>$line) {
    $arr = explode(",", $line);
    $csv_data[] = $arr;
    $phoneNumber = $arr[3];
    if($arr[5]){
        $phoneNumber.=", ".$arr[5];
    }
    if($arr[11]){
        $phoneNumber.=", ".$arr[11];
    }
     $query = "INSERT INTO wm_phones (Name,AudioFile) VALUES ('".$arr[1]."','". $phoneNumber."');";
     echo  $query."<br/>";
     $db->runQuery($query);
    }
    




*/

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
        break;
    case 'ru':
        $arrLetters = mb_range('б', 'я');
        array_unshift($arrLetters,'a');
        break;
    default:
        break;
}
/*$arrAllDoctors = $wm->getPagesByPageType(96);*/
$arrUnits = $db->getArray("SELECT * FROM wm_phones ORDER BY Ordering");
/*$arrUnits = $wm->getPagesByPageType(95,"Name ASC");*/
$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/";

?>
