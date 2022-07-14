<?php
/*
require_once("classes/mobiledetect/Mobile_Detect.php");
$detect = new Mobile_Detect();
$layout = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
*/

$layout = "desktop";

$template=$params->getValue($layout."_template");

if($_SERVER["HTTP_HOST"]=="shebayashir.sheba.co.il"){
	$template="sheba_yashir";
} elseif($_SERVER["HTTP_HOST"]=="connect.sheba.co.il"){
	$template="sheba_connect";
} elseif($_SERVER["HTTP_HOST"]=="www.msr.org.il" || $_SERVER["HTTP_HOST"]=="eng.msr.org.il"){
	$template="msr";
}



$_SESSION["DEVICE"]="devices/".$layout."/".$template;
if(!file_exists($_SESSION["DEVICE"]."/index.php")){
	$_SESSION["DEVICE"]="devices/".$cfg["WM"]["Device"]["Default"];
}
$device=$_SESSION["DEVICE"];


?>
