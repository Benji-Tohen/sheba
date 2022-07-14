<?php

//ini_set('display_errors', '1');
require_once('../../../conf/conf.data.php');
require_once('../../../classes/file/class.file.php');


$newName=str_replace(" ","",$_POST["newFileName"]);
$selectedNewFileName=str_replace(" ","",$_POST["newFileName"]).'.php';
$id=$_REQUEST["id"];


$fileNameQuery="SELECT Page FROM wm_pagetype WHERE ID=".$id;
$fileName=$db->getRow($fileNameQuery);
$oldFileName=$fileName["Page"];


$newPageName=$newName;

$queryInsert="INSERT INTO wm_pagetype(`Parent`, `Ordering`, `Name`, `Page`, `Icon`, `Admin_Enable`, `Admin_Level`, `Admin_Enable_Edit`, `Admin_Enable_Link`, `Admin_Enable_Author`, `Admin_Enable_Email`,
 `Admin_Enable_Delete`, `Admin_Enable_Image`, `Admin_Enable_Protection`, `Admin_Enable_Advanced`, `Admin_Enable_Children`, `Admin_Start_Date`, `Admin_Sub_Title`, `Admin_Is_Gallery`, `Admin_Answer_Text`, `Admin_Store`,
 `ShowOnMenu`, `ShowChildrenOnMenu`, `ShowChildrenOnHomePage`, `ShowOnHomepage`, `showOnBreadcrumbs`, `order_by`, `Redirect`, `GotoFirstChild`, `Related_Table`, `Default_Child_Type`)
  SELECT 0 as `Parent`,0 as `Ordering`,'".$newPageName."' as `Name`,'".$selectedNewFileName."' as Page, `Icon`,`Admin_Enable`,`Admin_Level`,`Admin_Enable_Edit`,`Admin_Enable_Link`,`Admin_Enable_Author`,`Admin_Enable_Email`,`Admin_Enable_Delete`,`Admin_Enable_Image`,`Admin_Enable_Protection`,`Admin_Enable_Advanced`, `Admin_Enable_Children`,`Admin_Start_Date`,`Admin_Sub_Title`,`Admin_Is_Gallery`,`Admin_Answer_Text`,`Admin_Store`,`ShowOnMenu`,`ShowChildrenOnMenu`, `ShowChildrenOnHomePage`, `ShowOnHomepage`, `showOnBreadcrumbs`, `order_by`, `Redirect`, `GotoFirstChild`,`Related_Table`, `Default_Child_Type`
  FROM `wm_pagetype` WHERE ID=".$id;

$db->runQuery($queryInsert);



$devicesDir=$_SESSION["DEVICE"];


$arrFolders=array("php_display","php_header","php_header/css","php_header/js","php_html","php_process","php_ajax");

function copyPagetypeFile($folder){
	global $selectedNewFileName;
	global $oldFileName;
	global $devicesDir;
	$rootFolder=$_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/";

	if(file_exists($rootFolder.$folder."/".$selectedNewFileName)){
	    echo "file already exist ".$folder;
	}else{
	    if(file_exists($rootFolder.$folder."/".$oldFileName)){
		copy($rootFolder.$folder."/".$oldFileName, $rootFolder.$folder."/".$selectedNewFileName);
	    }
	}
}

array_map("copyPagetypeFile", $arrFolders);

/*
//copy file to php display
if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_display/".$selectedNewFileName)){
    echo "file already exist-display";
}else{
    if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_display/".$oldFileName)){
        copy($_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_display/".$oldFileName, $_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_display/".$selectedNewFileName);
    }
}

//copy file to php header
if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_header/".$selectedNewFileName)){
    echo "file already exist-header";
}else{
    if(file_exists($_SERVER["DOCUMENT_ROOT"].$devicesDir."/php_header/".$oldFileName)){
        copy($_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_header/".$oldFileName, $_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_header/".$selectedNewFileName);
    }
}

//copy file to php header-css
if(file_exists($_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_header/css/".$selectedNewFileName)){
    echo "file already exist-header CSS";
}else{
    if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_header/css/".$oldFileName)){
        copy($_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_header/css/".$oldFileName, $_SERVER["DOCUMENT_ROOT"]."/".$devicesDir."/php_header/css/".$selectedNewFileName);
    }
}

//copy file to php header-js
if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_header/js/".$selectedNewFileName)){
    echo "file already exist-header JS";
}else{
    if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_header/js/".$oldFileName)){
        copy("/home/tohendns/public_html/".$devicesDir."/php_header/js/".$oldFileName, "/home/tohendns/public_html/".$devicesDir."/php_header/js/".$selectedNewFileName);
    }
}

//copy file to php_html
if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_html/".$selectedNewFileName)){
    echo "file already exist-html";
}else{
    if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_html/".$oldFileName)){
        copy("/home/tohendns/public_html/".$devicesDir."/php_html/".$oldFileName, "/home/tohendns/public_html/".$devicesDir."/php_html/".$selectedNewFileName);
    }
}

//copy file to php_process
if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_process/".$selectedNewFileName)){
    echo "file already exist-process";
}else{
    if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_process/".$oldFileName)){
        copy("/home/tohendns/public_html/".$devicesDir."/php_process/".$oldFileName, "/home/tohendns/public_html/".$devicesDir."/php_process/".$selectedNewFileName);
    }
}

//copy file to php_ajax
if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_ajax/".$selectedNewFileName)){
    echo "file already exist-php_ajax";
}else{
    if(file_exists("/home/tohendns/public_html/".$devicesDir."/php_ajax/".$oldFileName)){
        copy("/home/tohendns/public_html/".$devicesDir."/php_ajax/".$oldFileName, "/home/tohendns/public_html/".$devicesDir."/php_ajax/".$selectedNewFileName);
    }
}
*/

header("Location: ".$_SERVER['HTTP_REFERER']);
exit;
