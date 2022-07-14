<?php

require_once(dirname(__FILE__).'/../../conf/conf.data.php');
require_once(dirname(__FILE__).'/../../classes/time/class.date_time.php');
require_once(dirname(__FILE__).'/../../classes/browser/class.browser.php');
require_once(dirname(__FILE__).'/../../classes/pager/class.super_pager.php');
require_once(dirname(__FILE__).'/../../classes/string/class.string.php');
require_once(dirname(__FILE__).'/../../classes/content_management/class.content_updater.php');
require_once(dirname(__FILE__).'/../../classes/site_users/class.site_users.php');
require_once(dirname(__FILE__).'/../../classes/store/class.store_users.php');
/*require_once('redirect_arr.php');*/


/*check wich redirect arr to bring*/

switch ($_SERVER['SERVER_NAME']) {
	case 'talpiot.sheba.co.il':
		require_once('redirect_arr_talpiot.php');
		break;
	case 'sns.sheba.co.il':
		require_once('redirect_arr_sns.php');
		break;
	case 'shikum.sheba.co.il':
		require_once('redirect_arr_shikum.php');
		break;
	case 'rehabilitation.sheba.co.il':
		require_once('redirect_arr_rehabilitation.php');
		break;
	case 'international.sheba.co.il':
		require_once('redirect_arr_international.php');
		break;
	case 'imaging.sheba.co.il':
		require_once('redirect_arr_imaging.php');
		break;
	case 'heart.sheba.co.il':
		require_once('redirect_arr_heart.php');
		break;
	case 'ella.sheba.co.il':
		require_once('redirect_arr_ella.php');
		break;
	case 'dimut.sheba.co.il':
		require_once('redirect_arr_dimut.php');
		break;
	case 'cancer.sheba.co.il':
		require_once('redirect_arr_cancer.php');
		break;
	case 'yeladim.sheba.co.il':
		require_once('redirect_arr_yeladim.php');
		break;
		
	case 'nashim.sheba.co.il':
		require_once('redirect_arr_nashim.php');
		break;
	case 'heart-surgery.sheba.co.il':
		if($_SERVER["REQUEST_URI"]=='/'){
			header('HTTP/1.1 301 Moved Permanently');
			header("location: https://heart.sheba.co.il");
			exit;
		}
		require_once('redirect_arr_heart_surgery.php');
		break;
		
	
	default:
		require_once('redirect_arr.php');
		break;
}

$aliasId=null;
$a=NULL;


function checkRedirect($link){
	global $cfg;

	/*list($oldAlias, $newLink)=explode("\t", $link);	*/
	list($oldAlias, $newLink)=array_pad(explode("\t", $link),2,null);
	if($oldAlias=="/".$_GET["a"] || $oldAlias==$cfg["WM"]["Server"].$_SERVER["REQUEST_URI"]){
		header('HTTP/1.1 301 Moved Permanently');
		header("location: ".$newLink);
		exit;
	}
}



$ghostAliases=array("item");

/* header("X-Frame-Options: SAMEORIGIN"); */

/*
if($_SERVER["REQUEST_URI"]!="/" && !end(explode("/", $_SERVER["REQUEST_URI"]))){
	header("location: ".rtrim($_SERVER["REQUEST_URI"], "/"));
	exit;
}
*/



if(isset($_GET["a"])){
	$getParams=explode("/", $_GET["a"]);
	//$wm->fixLanguage();
    
    $arrLinks=explode("\n", $redirectText);

	array_map("checkRedirect", $arrLinks);
}else{
	$getParams=NULL;
/*
	if(!isset($_SESSION["WM"]["Lang"])){
		$_SESSION["WM"]["Lang"]=$cfg["WM"]["Default_Language"];
	}
*/
}


if(!empty($getParams)){
	$a=$getParams[0];
}


if($a === "0"){
	$wm->get404();
	exit;
}


if($a=="Doctors"){
	header("location: https://".DOMAIN."/55554", true, 302);
	exit;    		
}

$_GET["a"] = isset($_GET["a"]) ? $_GET["a"]: '';
/* DO 301 Redirects from old sitec	*/
$aliasTest=$wm->getAliasID($a);
if((!is_numeric($a) && !$aliasTest)){

	$allUri=$_GET["a"];
	if(strlen($allUri)>1){
	    $query="SELECT ID, Alias 
	            FROM wm_pages WHERE Deleted=0  AND oldalias=\"".mysqli_real_escape_string($db->conn, $allUri)."\"";
	    $page=$db->getRow($query);


	    if(!empty($page)){
	        if($page["Alias"]){
	           header('HTTP/1.1 301 Moved Permanently');
	            header("location: https://".$page["Alias"]);
	            exit;
	        }elseif($page["ID"]){
	           header('HTTP/1.1 301 Moved Permanently');
	            header("location: https://".DOMAIN."/".$page["ID"]);
	            exit;    
	        }
	    } else {

            }
	}
}else{
        if ($_GET["a"]=="About_Us/Our_History/") {
            if ($_GET["mod"] && $_GET["mb_id"]) {
                $path = $_SERVER['DOCUMENT_ROOT'];
                $file = "$path/webfiles/shebaPics/shebaMain/_media/mediabank/".$_GET['mb_id'];
                $arr = explode(".", $_GET['mb_id']);
                $extention = array_pop($arr);
                header("Content-Type: image/jpeg");
                echo file_get_contents($file);
                exit;
            }
        }
	//echo "---".$aliasTest;
	//exit;
}














/*
if($getParams[0]=="test"){
	$_SESSION["test"]=true;
	header("location: ".$cfg["WM"]["Server"]);
	exit;
}

if($getParams[0]=="notest"){
	$_SESSION["test"]=false;
	header("location: ".$cfg["WM"]["Server"]);
	exit;
}


if(!$_SESSION["test"] && $params->getValue("intest")){
	header('HTTP/1.1 301 Moved Permanently');
	header("location: http://www.tohen-media.com");
	exit;
}
*/




if($getParams[0]=="nocache"){
	$_SESSION["siteParams"]=NULL;
	$_SESSION["ADMIN_TRANS"]=NULL;
}




/*
if(true || $params->getValue("store_enable")){
	require_once(dirname(__FILE__).'/../../classes/store/class.store.php');
	require_once(dirname(__FILE__).'/../../classes/store/class.store_orders.php');
	require_once(dirname(__FILE__).'/../../classes/store/class.store_orders_details.php');
	$store=new Store($db, "wm_pages");
}
*/





$login=new Login($db, $cfg["WM"]["DATABASE_TABLE"]["Users"]);
$dt=new DateTime1();
$string=new String();


if(isset($_REQUEST["test"]) && $_REQUEST["test"]){
	$_SESSION["test"]=true;
}

//echo $_GET["a"];
//exit;




require_once("find_device.php");



if(isset($_GET["a"])){
	$aExplode=explode("/", $_GET["a"]);
}

if($a=="notify_tranzila"){
	require_once("site/php_components/notify_tranzila.php");
	exit;
}


if($a=="rss"){
	require_once("site/php_components/rss.php");
	exit;
}

if($a=="sitemap.xml"){
	require_once("site/php_components/sitemap.php");
	exit;
}

if($a=="sitemap_images.xml"){
	require_once("site/php_components/sitemapimages.php");
	exit;
}


if($a=="ajax"){
	require_once(dirname(__FILE__).'/../../classes/file/class.file.php');

	if(isset($getParams[1])){
		/*$getParams[1]=trim($getParams[1], "../");*/
		$getParams[1]=str_replace('../', '', $getParams[1]);
	}

	$file=new File();
	$ajaxFile=$file->dirHasFile($device."/php_ajax/", $getParams[1].".php");

	//$ajaxFile=$device."/php_ajax/".$ajaxFile.".php";

	if(file_exists($ajaxFile)){
		require_once($ajaxFile);
	}else{
	/*
		$alias_id=$wm->getAliasID("p404");
		$id=$alias_id;
		$wmPage=$wm->getValues($id);
		$link=$wm->getLink($wmPage);
		header("HTTP/1.0 404 Not Found");
//		header("location: ".$link["Link"]);
		$id=$alias_id;
		*/
		$id=$wm->get404();
	}
	exit;
}

if($a=="ajaxPage"){

	$exists=false;

	$id=intval($getParams[1]);
	$wmPage=$wm->getValues($id);
	$wmPage["Type"]=$wm->getPageType($id,true);

	$ajaxFileProcess=$device.'/php_process/'.$wmPage["Type"]["Page"];
	$ajaxFileDisplay=$device.'/php_display/'.$wmPage["Type"]["Page"];
	if(file_exists($ajaxFileProcess)){
		require_once($ajaxFileProcess);
	}

	if(file_exists($ajaxFileDisplay)){
		require_once($ajaxFileDisplay);
		$exists=true;
	}

	if(!$exists){
	/*
		$alias_id=$wm->getAliasID("p404");
		$id=$alias_id;
		$row=$wm->getValues($id);
		$link=$wm->getLink($row);
		header("HTTP/1.0 404 Not Found");
		$id=$alias_id;
		*/
		$id=$wm->get404();
	}

	exit;
}

if($a=="css"){
	$direction=$getParams[count($getParams)-1];
	$direction=trim($direction, ".css");

	if($direction=="rtl" || $direction=="ltr"){
		$gui=new Gui(NULL, $direction);
	}

	$exists=false;

	$id=intval($getParams[1]);

	if($id){
		$wmPage=$wm->getValues($id);
		$wmPage["Type"]=$wm->getPageType($id,true);
		if(!$wm->userAllowed($id)){
			$wmPage["Type"]["Page"]="login_page.php";
		}
	}else{
		$wmPage["Type"]["Page"]="index.php";
	}

	$ajaxFileHeader=$device.'/php_header/css/'.$wmPage["Type"]["Page"];


	$wm->writeHeaders();

	header('Content-type: text/css; charset=UTF-8');
	echo "@charset \"utf-8\";\n";

	if(file_exists($ajaxFileHeader)){
		require_once($ajaxFileHeader);
		$exists=true;
	}

	exit;
}



if($a=="js"){

	$exists=false;

	$id=trim($getParams[1].".js");

	$id=intval($id);

	if($id){
		$wmPage=$wm->getValues($id);
		$wmPage["Type"]=$wm->getPageType($id,true);
		if(!$wm->userAllowed($id)){
			$wmPage["Type"]["Page"]="login_page.php";
		}
	}else{
		$wmPage["Type"]["Page"]="index.php";
	}

	$ajaxFileHeader=$device.'/php_header/js/'.$wmPage["Type"]["Page"];

	$wm->writeHeaders();

	//header('Connection: Keep-Alive');
	header("Content-type: text/javascript; charset=UTF-8");

	if(file_exists($ajaxFileHeader)){
		require_once($ajaxFileHeader);
		$exists=true;
	}

	exit;
}

if($a=="mainjs"){

	$exists=false;

	$id=trim($getParams[1].".js");

	$id=intval($id);
	$wmPage=$wm->getValues($id);
	$wmPage["Type"]["Page"]="index.php";

	$ajaxFileHeader=$device.'/php_header/js/'.$wmPage["Type"]["Page"];

	$wm->writeHeaders();

	//header('Connection: Keep-Alive');
	header("Content-type: text/javascript; charset=UTF-8");

	if(file_exists($ajaxFileHeader)){
		require_once($ajaxFileHeader);
		$exists=true;
	}

	exit;
}




if(!$a){
	$domainName=trim($_SERVER["SERVER_NAME"], "www.");

	$alias_id=$wm->getHomePageByDomain($domainName);

	if($alias_id){
		$a=$domainName;
		$id=$alias_id;
		$a=$id;
	}
	
}




if(isset($getParams[1]) && $getParams[1]=="logout"){
	$login->logoutUser();
	header("location: ".$_SERVER["HTTP_REFERER"]);
	exit;
}


require_once('cron_scripts.php');



if($a=="preview"){

}else{

	if($a){
		$alias_id=$wm->getAliasID($a);
			/* Check If Page Deleted */
		$checkIfDeleted=$wm->checkIfPageDeleted($a);
		if(intval($checkIfDeleted["Deleted"])!==0){
		   
		    $id=$wm->get404();
		}

		if(is_numeric($a) && !$alias_id){

			$id=intval($a);


			$alias=$wm->get($id, "Alias");
			if($alias){
				$redirectPage=$wm->getValues($id);
				$link=$wm->getLink($redirectPage);
				header('HTTP/1.1 301 Moved Permanently');
				header("location: ".$link["Link"]);
				exit;
			}
		}else{
       
			if($alias_id){
				$id=$alias_id;
			}else{
				if(strpos($_SERVER['REQUEST_URI'],'/item/')===FALSE){/* "/item/" pages dont send 404 anymore...*/
					$id=$wm->get404();
				}
			}
		}



	}else{
	/*
		if(!$_SESSION["WM"]["Lang"]){
			$_SESSION["WM"]["Lang"]=$cfg["WM"]["Default_Language"];
		}
		*/
	}


}


/*
if(!$_SESSION["WM"]["Lang"]){
	$_SESSION["WM"]["Lang"]=$cfg["WM"]["Default_Language"];
}
*/


if(isset($_POST["username"]) && $_POST["username"] && isset($_POST["password"]) && $_POST["password"]){
	//$wm->getProtectedPage($_POST["username"] , $_POST["password"]);
	$protected_id=$wm->loginSiteUser($_POST["username"] , $_POST["password"]);
	if($protected_id){
		//header("location: ?p=".$protected_id);
		header("location: /".$protected_id."/");
		exit;
	}
}




/*	
	Get Homepage  by language
*/



if(!isset($id) || !$id){
	
	$id=$wm->getHomePageByDomain(DOMAIN);

	if($getParams[0]=="item"){
		$id=intval($getParams[1]);
	}

/*
	if($layout!="desktop"){	//	Mobile
		$id=$wm->getIdByPageType(53, $_SESSION["WM"]["Lang"]);
	}else{			//	Web
		$id=$wm->getHomePageByDomain(DOMAIN);
	}
	*/
}else{

	if($wm->get($id, "Lang")){
		$_SESSION["WM"]["Lang"]=$wm->get($id, "Lang");
	}else{
		$id=$wm->get404();
	}

}








if(!$id){
	if($a){
		$id=$wm->get404();
	}else{
		$_SESSION["WM"]["Lang"]=$cfg["WM"]["Default_Language"];
		$id=$wm->getHomePageByDomain(DOMAIN);
	}
}



/* get page contents  */
if($a=="preview"){
	$wmVersions=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["PagesVersions"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
	$previewId=intval($getParams[1]);
	$wmPage=$wmVersions->getValues($previewId);
	$id=$wmPage["ID"]=$wmPage["wm_pages"];
	$wmPage["Type"]=$wm->getPageType($wmPage["ID"]);

}else{




	$wmPage=$wm->getValues($id);
	$wmPage["Type"]=$wm->getPageType($wmPage["ID"]);
	$_SESSION["WM"]["Lang"]=$wmPage["Lang"];	
	
}

//echo "------".$alias_id;


if(!$alias_id && !$aliasId && !empty($wmPage)){

	$homePageId=$wm->getHomePageById($wmPage["ID"]);
	$domain=$wm->get($homePageId, "domain");
	
	define("HOMEPAGEDOMAIN", $domain);

	if(HOMEPAGEDOMAIN && DOMAIN!=HOMEPAGEDOMAIN && !in_array($a, $ghostAliases)){
		header('HTTP/1.1 301 Moved Permanently');
		header("location: http://".HOMEPAGEDOMAIN.$_SERVER["REQUEST_URI"]);
		exit;
	}
}


/* 404 Pages from old site 
$hirarchyparents=$wm->getAncestors(intval($id));
$topPageId=$hirarchyparents[1];

if($topPageId==1450){
	$id=$wm->get404();
	$wmPage=$wm->getValues($id);
	$wmPage["Type"]=$wm->getPageType($id);
}*/



if($wmPage["Deleted"]){
	$id=$wm->get404();
	$wmPage=$wm->getValues($id);
	$wmPage["Type"]=$wm->getPageType($id);
}

if($wmPage["Link"]){
	$link=$wm->getLink($wmPage);

	//header('HTTP/1.1 301 Moved Permanently');
	$wmPage["moved_type"]=$wmPage["moved_type"]?$wmPage["moved_type"]:NULL;
	header("location: ".$link["Link"], true, $wmPage["moved_type"]);
	exit;
}

if($wmPage["File_Name"]){
	 
	$file = $wmPage["File_Name"];
	 
	$fileArr=explode("/", $file);
	$fileName=$fileArr[count($fileArr)-1];



	     //@ob_end_flush();
         //flush();
/*
	     // Set headers
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$fileName");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
*/
        
        $malExt=array("exe");
         
        if(in_array($pathinfo['extension'], $malExt)){
            echo "Error!";
            exit;
        }
        
        $pathinfo=pathinfo($fileName); 
         
        header("Content-Type: application/".$pathinfo['extension']);


         
	     // Read the file from disk
	     readfile($file);

	exit;
}
/*
if(!$wmPage["Top_Header"]){
	$wmPage["Top_Header"]=$wm->getTopValue($id, "Top_Header");
}

if(!isset($wmPage["Top_Header4"]) || !$wmPage["Top_Header4"]){
	$wmPage["Top_Header4"]=		$wm->getTopValue($id, "Top_Header4");
}
*/

if(!$wmPage["Type"]){
	$wmPage["Type"]=array("Page" => "home_page.php");
}




if($wmPage["Type"]["GotoFirstChild"] && $wm->hasChildren($wmPage["ID"])){
	header('HTTP/1.1 301 Moved Permanently');
	$fc=	$wm->getFirstChild($wmPage["ID"]);
	$alias=	$wm->get($fc, "Alias");
	$alias=($alias?$alias:$fc);
	header("location: ".$_SESSION["WM"]["Server"]."/".$alias);
	exit;
}




$gui=new Gui($_SESSION["WM"]["Lang"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);
//$_SESSION["trans"]=$trans;
$topLangId=$wm->getLangMain($_SESSION["WM"]["Lang"]);
//require_once('site/lang/'.$_SESSION["WM"]["Lang"].'.php');
$pages = $wm->getMenuLevel(MAINPAGEID);



foreach ($pages as $key => $item){
        if($item['Hide_On_Menu'] == 1){continue;}/*dont show hidden sites in langauge menu*/
	$language = $wm->getLanguageRow($wm->get($item['ID'], "Lang"));
	$arrLanguages[$key]["ID"] = $language['ID'];
	$arrLanguages[$key]["Lang"] = $language['Lang'];
	$arrLanguages[$key]["Name"] = $language['Name'];
	$arrLanguages[$key]["Alias"] = ($pages[$key]['Alias']) ? $pages[$key]['Alias'] : $pages[$key]['ID'];
}




if(!$wm->userAllowed($id)){
	$wmPage["Type"]["Page"]="login_page.php";
}




$arrTopMenu=	$wm->getMenuLevel($wm->getIdByPageType(35, $_SESSION["WM"]["Lang"]));
$headerRow=	$wm->getHeaderRow();
$logo=		$headerRow["File_Name"];

//$wmPage["Name"]=str_replace("&", "&amp;", $wmPage["Name"]);

$searchId=$wm->getIdByPageType(12, $wmPage["Lang"]);
$searchAlias=$wm->getLink($wm->getValues($searchId));


$pageContentId=$id;
$wmPageContent=NULL;


//	Check if it is a News items page and display like it is in this domain
if(in_array($a, $ghostAliases)){
	if($getParams[1]==57328 && $getParams[2]==1000){/*special preview form page*/
		
		header("location: ".$_SESSION["WM"]["Server"]."/טופס/".$getParams[2].'/'.$getParams[3]);
		exit;
	}
	if(is_numeric($getParams[1])){
		$pageContentId=intval($getParams[1]);
	}else{

		if($a=="news"){
		
			$mainSites=$wm->getMainDomains(1382);
			foreach($mainSites as $mainSite){
				$mainNewsItemAlias=	$mainSite["domain"]."/".$getParams[1];
				$pageContentId=		$wm->getAliasIdNoDomain($mainNewsItemAlias);
				if($pageContentId){
					break;
				}
			}
		// add support to alias in /item
		}elseif($a=="item"){
			$pageContentId=$wm->getAliasID($getParams[1]);
			$getParams[1]=$pageContentId;
		}
	}
        

	
	
	$wmPageContent=		$wm->getValues($pageContentId);
	if($pageContentId == 2 || !$pageContentId || empty($wmPageContent)){
		$pageContentId=$wm->get404();		
		$wmPageContent=		$wm->getValues($pageContentId);
	}
		if(isset($arrGetOrigianlof)){
			foreach($arrGetOrigianlof as $originalItemField){
            	$wmPage[$originalItemField]=$wmPageContent[$originalItemField]; 
        	}
		}
        
        
        $wmPage["Type"]=	$wm->getPageType($wmPageContent["ID"]);



        /*not sure about this. i put this here to fix /item/ when lang change - for exmple in search results page*/
        $wmPage['Content']=$wmPageContent['Content'];
        $wmPage['Name']=$wmPageContent['Name'];
        $wmPage['ID']=$wmPageContent['ID'];
        $wmPage['Top_Header2']=$wmPageContent['Top_Header2'];
        $wmPage['Top_Header']=$wmPageContent['Top_Header'];
         $wmPage['Start_Date']=$wmPageContent['Start_Date'];
        $wmPage['Parent']=$wmPageContent['Parent'];
	$wmPage['Lang']=$wmPageContent['Lang'];
	$wmPage['Enable_SideContent']=$wmPageContent['Enable_SideContent'];
	$wmPage['wm_forms']=$wmPageContent['wm_forms'];
	
	

        $_SESSION["WM"]["Lang"]=$wmPage['Lang'];
        $gui=new Gui($_SESSION["WM"]["Lang"]);
        /*not sure about this..END*/
}




if($wmPage["Type"]["ID"]==62){	//	Proccess Page
	if(file_exists('site/php_components/'.$wmPage["Type"]["Page"])){
		require_once('site/php_components/'.$wmPage["Type"]["Page"]);
	}
	exit;
}



$isSecondaryArr = $wm->getPageType($wmPage["ID"],true);
 if($isSecondaryArr['Page'] !== $wmPage["Type"]["Page"]){
    $wmPage["Type"]["Page"] = $isSecondaryArr['Page'];
 }

 
if(file_exists($device.'/php_process/'.$wmPage["Type"]["Page"])){
	require_once($device.'/php_process/'.$wmPage["Type"]["Page"]);
}



/* Get Page Title */
$pageType=$wm->getPageType($wmPage["ID"]);
$pageTypeParent=$wm->getPageType($wmPage["Parent"]);

if($wmPage["META_Title"]){
    $mtitle=$wmPage["META_Title"];
}else{
    if(intval($pageType["showOnBreadcrumbs"])==1){
        $mtitle=$wmPage["Name"];
    }
}


if(intval($pageTypeParent["showOnBreadcrumbs"])==1){
    if(!$wmPage["META_Title"] || intval($pageType["showOnBreadcrumbs"])==1){
       // $mtitle.=", ";
    }
    if(!$wmPage["META_Title"])$mtitle.=", ".$wm->get($wmPage["Parent"], "Name");
}




if($wmPage["META_Title"] || intval($pageType["showOnBreadcrumbs"])==1 || intval($pageTypeParent["showOnBreadcrumbs"])==1){
    $mtitle.=" | ";
}
$mtitle.=$wm->get(HOMEPAGEID, "Sub_Title") ?  $wm->get(HOMEPAGEID, "Sub_Title") : $wm->get(HOMEPAGEID, "Name") ;

if(($wmPage["Parent"])==1) {
    $mtitle=$wm->get(HOMEPAGEID, "Name");
}
/*end*/

if($wmPage["Page_Type"] == 5){
    $mtitle= $wmPage["META_Title"] ? $wmPage["META_Title"] : $wmPage["Name"] ;
}

$template=$wm->getTemplate(MAINPAGEID);






$logo = $wm->getLink($wm->getValues($wm->getHomePageByDomain(DOMAIN)));
$logoQuery="
	SELECT *  
FROM  wm_languages
WHERE  Lang='".mysqli_escape_string($db->conn, $_SESSION["WM"]["Lang"])."'
";
$logoRow=$db->getRow($logoQuery, "File_Name");
$logo['File_Name'] = $logoRow['File_Name'];




$lastAlias=$wm->getAlias($wmPage);
if($lastAlias!="p404" && $lastAlias!="2"){
	$_SESSION["LAST_PAGE_BEFORE_LOGIN"]=$cfg["WM"]["Server"]."/".$lastAlias;
}elseif(!$_SESSION["LAST_PAGE_BEFORE_LOGIN"]){
	$_SESSION["LAST_PAGE_BEFORE_LOGIN"]=$cfg["WM"]["Server"];
}


?>
