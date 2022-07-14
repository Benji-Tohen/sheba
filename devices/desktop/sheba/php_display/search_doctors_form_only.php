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

//$sp=  $wm->getOrderingNewsPager($wmPage["ID"], $numItems);
/*$sp=  $wm->getNewsListPager($wmPage["ID"],"Start_Date DESC, Start_Time DESC, Name", $numItems);
$arr=   $sp->getPage($page);*/
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
$arrUnitsNew = $wm->getOrderingNews(30987);
$thumbWidth=$params->getValue("units_page_image_width");
$thumbHeight=$params->getValue("units_page_image_height");

$thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."100"."X"."100"."/zcX1/";




$currentMedDomain=0;
if(isset($getParams[1])){
	$currentMedDomain=$getParams[1];
}

// Define path and name of cached file    
$cachefile = $_SERVER['DOCUMENT_ROOT'].'/webfiles/html/docs/docsCache.html';    

// How long to keep cache file?   
/*if(isset($_SESSION['User_Data']['ID']) && $_SESSION['User_Data']['ID']!=''){/*we are in admin - disable cache*/
if(true){
    $cachetime = 1;
}else{
    $cachetime = 86400;
}  

// Is cache file still fresh? If so, serve it.    

if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {    
include($cachefile);
   
}else{   
// if no file or too old, render and capture HTML page.
ob_start();?>

        <div class="col-12 col-lg-12 doctorSearchPage">
            <div class="searchRow">
                <form method="post" id="searchDoctorsFormOnly" action="https://www.sheba.co.il/כל_הרופאים<?php /*echo $cfg['WM']['Server'].'/'.$wm->getIdByPageTypeNoHomepageID(97)*/?>">
                    <input type="hidden" name="searchDoctorsFormOnly" value="1">
                    <input type="hidden" name="search_only_specialist_doctors" value="<?php echo $currentItem['search_only_specialist_doctors'] ==1 ? 1: 0?>">
                    <input class="searchBox" id="searchByName" type="text" name="docName" placeholder="<?php echo $trans->getText("Type doctor's name")?>" />
                    <select id="searchByMedDomain" class="searchBox" name="medicalDomain">
                        <option value="0"><?php echo $trans->getText("Health field")?></option>
                        <?php 
                        foreach ($arrExpertise as $value) {?>
                            <option value="<?php echo $value['ID']?>" <?php echo ($value['ID']==$currentMedDomain)?"selected":"";?>><?php echo $string->shorten($trans->getText($value['Name']), 50);?></option>
                        <?php }?>
                    </select>
                    <select id="searchByUnit" class="searchBox" name="medicalUnit">
                        <option value="0"><?php echo $trans->getText("Unit")?></option>
                        <?php
                        foreach ($arrUnitsNew as $value) {
                        /*$ancestorsArr = $wm->getAncestors($value['ID']);
                            if($ancestorsArr[2]=='2'){/*show only units under sheba main*/?>
                                <option value="<?php echo $value['ID']?>"><?php echo $trans->getText($value['Name'])?></option>
                            <?php /*}*/
                            ?>
                        <?php }?>
                    </select>
                    <div tabindex="0" onclick="$('#searchDoctorsFormOnlySubmit').click()" onkeypress="$('#searchDoctorsFormOnlySubmit').click()" class="searchBoxButton" style="    display: inline-block;width: 80px;margin: 10px 0 10px 0;"><?php echo $trans->getText("Search")?></div>
                    <input type="submit" name="submit" id="searchDoctorsFormOnlySubmit" style="visibility: hidden;height: 1px;width: 1px;">
                </form>
                
            </div>
            
            <!--Doctors Search Items-->
          <?php /*  <h2 class="searchCategodyTitle"></h2>*/?>
            <div id="childrenWrap">
                <?php /*
                $numAllDoctors = count($arrAllDoctors);
                for($i=0;$i<$numAllDoctors;$i++){?>
                    <?php include(dirname(__FILE__)."/../php_html/".$wmPage["Type"]["Page"]);?>
                <?php }*/?>
            </div>
            <!--end-->
        </div>
       
   
<?php   
// Save the cached content to a file    
$fp = fopen($cachefile, 'w');    
fwrite($fp, ob_get_contents());    
fclose($fp);    

// Send browser output    
ob_end_flush();
}?>
