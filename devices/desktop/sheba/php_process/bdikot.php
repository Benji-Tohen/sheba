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

$arrLetters = mb_range('א', 'ת');
$arrLettersEn = mb_range('a', 'z');
$arrLetters = array_merge($arrLetters,$arrLettersEn);
$arrAllDoctors = $wm->getPagesByPageType(112,"Name ASC");
$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/";

?>
