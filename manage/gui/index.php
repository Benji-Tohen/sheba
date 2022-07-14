<?php
require_once('../../conf/conf.data.php');
require_once('../../classes/gui/class.gui.php');
require_once('../../classes/content_management/class.content_updater.php');
require_once('../../classes/parameters/class.parameters.php');
require_once('../../classes/string/class.string.php');
require_once('../../classes/lpusers/class.lpusers.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$login=new Login($db, $cfg["WM"]["DATABASE_TABLE"]["Users"]);
$lpusers=new lpusers($db);
$dt=new DateTime1();
$params=new Parameters($db);
$string=new String();

header("X-Frame-Options: SAMEORIGIN");


/*
if($_REQUEST["test"]){
	$_SESSION["test"]=true;
}


if(!$_SESSION["test"]){
	exit;
}
*/

$id=		intval($_REQUEST["id"]);
$page_id=	intval($_REQUEST["page_id"]);
$versionId=	intval($_REQUEST["versionId"]);



if(!$id && $page_id){
	$id=$page_id;
}

if(!$id){
	$id=1;
}

//$id=621;

$row=$wm->getValues($id);

//print_r($_SESSION["LPMEDIA"]["USER_DATA"]);

//echo ($login->isUser()?"YES":"NO")." - ".$userPageId;
//exit;


if($login->isUser() && !$login->isManager()){

	$pageArea=explode("/", $_REQUEST["show"]);

	if($pageArea[0]=="landing_pages_site_users" || $pageArea[0]=="landing_pages_export_users"){

	}else{

		if(!$lpusers->isPageBelongs($row)){

			$userPageId=$wm->getLandpageByUser();

			if(!$userPageId){
				echo "Login error";
				exit;
			}
	
			header("location: ".$cfg["WM"]["Server"]."/manage/gui/index.php?show=pages/pages&id=".$userPageId);
			exit;
		}else{

		}
	}
}



if($versionId){
	$wmVersions=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["PagesVersions"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
	$row=$wmVersions->getValues($versionId);
	$row["ID"]=$row["wm_pages"];
	$id=$row["ID"];
	$row["wm_pages_versions"]=$versionId;
}elseif($row["wm_pages_versions"]){
	$versionId=$row["wm_pages_versions"];
}

$wmVer=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["PagesVersions"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$wmVer1 = $wmVer->getValues($versionId);

/*?>
<script type="text/javascript">
    if(//<?php echo count($row); ?> != <?php echo count($wmVer1); ?>)
//	alert("there is diffrent between wmPages and Wmversions");
</script>
//<?php
 */
/*
if($login->isUser() && !$login->isManager()){

	$pageArea=explode("/", $_REQUEST["show"]);

	if($pageArea[0]=="landing_pages_site_users" || $pageArea[0]=="landing_pages_export_users"){
		
	}else{
		if(!$lpusers->isPageBelongs($row)){
			$userPageId=$wm->getLandpageByUser();
			header("location: ".$cfg["WM"]["Server"]."/manage/gui/index.php?show=pages/pages&id=".$userPageId);
			exit;
		}
	}
}
*/



if(!$row["Lang"]){
	if($_REQUEST["Lang"]){
		$row["Lang"]=$_REQUEST["Lang"];
	}else{
		$row["Lang"]=$cfg["WM"]["Default_Language"];
	}
}

$gui=new Gui($row["Lang"]);

/*
if (file_exists('lang/'.$row["Lang"].'.php')){
	require_once('lang/'.$row["Lang"].'.php');
}else{
	require_once('lang/en.php');
}
*/

$text=$wm->getAdminTranslation($row["Lang"]);
if(empty($text)){
	$text=$wm->getAdminTranslation("en");
}


if($login->isManager() || $login->isUser()){
	if(!$_REQUEST["show"]){
		//require_once('pages/pages.php');
		$show="pages/pages";
	}else{
		$show=$_REQUEST["show"];
	}
	if(file_exists("scripts_".$show.".php")){
		require_once("scripts_".$show.".php");	
	}

	require_once($show.".php");
}else{
	require_once("login.php");
}


/*
?>
<div style="padding: 30px; color: #ffffff; font-weight: bold;">
<?php 
if($login->isManager()){
	echo nl2br($params->getValue("admin_welcome_message"));
}
?>
</div>


<?php 
*/
?>
<script type="text/javascript">
if(parent && parent.inSite){
	//alert("test");
	parent.$("#adminLayer").slideDown(500,function(){});
}
</script>
<?php
require_once('common/footer.php');
?>
