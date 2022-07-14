<?php
require_once('../conf/conf.data.php');
require_once('../classes/gui/class.gui.php');
require_once('../classes/parameters/class.parameters.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$login=new Login($db, $cfg["WM"]["DATABASE_TABLE"]["Users"]);
$dt=new DateTime1();
$params=new Parameters($db);

$gui=new Gui($cfg["WM"]["Default_Language"]);
/*
if ('gui/lang/'.$cfg["WM"]["Default_Language"].'.php') require_once('gui/lang/'.$cfg["WM"]["Default_Language"].'.php');
else require_once('gui/lang/en.php')
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu</title>
<link href="gui/design/basic_html.css" type="text/css" rel="stylesheet"/>
<link href="gui/design/framedesign.css" type="text/css" rel="stylesheet"/>
<script language="javascript" type="text/javascript">
var lastObj=null;
function changeLayer(obj){

	if(lastObj){
		lastObj.className="menuLink";
	}

	obj.className="menuLinkSelected";
	lastObj=obj;
}
</script>
</head>
<body dir="<?php echo $gui->getDir();?>">
<div class="menuHeadline"><?php echo $text["Menu"];?></div>
<div class="menuLinks" id="menuLinks">

<?php 

$query="
	SELECT * 
	FROM wm_admin_menu 
	WHERE Parent=0 AND admin_level>=".intval($_SESSION["User_Data"]["Level"])." AND admin_enable=1 
";

$arrMenuHeaders=$db->getArray($query);

?>
<?php foreach($arrMenuHeaders as $menuHeader){
	$query="
		SELECT * 
		FROM wm_admin_menu 
		WHERE Parent=".intval($menuHeader["ID"])." AND admin_enable=1  
	";
	$arrMenu=$db->getArray($query);
	?>
	<div class="menuHeader"><?php echo $menuHeader["Name"];?></div>
	<?php foreach($arrMenu as $menuLink){?>
		<div class="menuLink" id="menuLink_<?php echo $menuLink["ID"];?>" onclick="changeLayer(this); top.main1.location='gui/index.php?show=<?php echo $menuLink["URL"];?>';"><?php echo $menuLink["Name"];?></div><?php /*<a href="gui/index.php?show=<?php echo $menuLink["URL"];?>" target="main1"></a>*/?>
	<?php }?>
<?php }?>

<?php
/*

<?php if($login->isSuperManager()){?>

	<a href="gui/index.php?show=settings/index" target="main1">הגדרות כלליות</a>
	<br />
	<a href="gui/index.php?show=users/users" target="main1"><?php echo $text["Users"];?></a>
	<br />
	<a href="gui/index.php?show=translate/index" target="main1">תרגומים</a>
	<br />
	<a href="gui/index.php?show=page_types/page_types" target="main1"><?php echo $text["Page Types"];?></a>
	<br />	
	<a href="gui/index.php?show=css_settings/index" target="main1">הגדרות עיצוב</a>
	<br />
	<a href="gui/index.php?show=header_settings/index" target="main1">הגדרות לוגו</a>
	<br />
	<br />	

<?php if($params->getValue("store_allow")){?>
	<div class="menuHeader">חנות</div>

	<a href="gui/index.php?show=store_items/pages_list" target="main1">מוצרים</a>
	<br />
	<a href="gui/index.php?show=store_customers/index" target="main1">לקוחות</a>
	<br />
	<a href="gui/index.php?show=store_orders/index" target="main1">הזמנות</a>
	<br />
	<a href="gui/index.php?show=store_shipments/index" target="main1">סוגי משלוח</a>
	<br />
<?php }?>

	<br />





	<div class="menuHeader">אתר</div>
	








	<!--
	<a href="gui/index.php?show=sites/index" target="main1"><?php echo $text["Sites"];?></a>
	<br />
	

-->


<?php }?>
<?php if($login->isManager()){?>	
	<a href="gui/index.php" target="main1"><?php echo $text["Site Content"];?></a>
	<br />

	<?php if($params->getValue("allow_banners")){?>
	<a href="gui/index.php?show=banners/index" target="main1"><?php echo $text["Banners"];?></a>
	<br />
	<?php }?>

	<?php if($params->getValue("allow_links")){?>
	<a href="gui/index.php?show=links/index" target="main1"><?php echo $text["Links"];?></a>
	<br />
	<?php }?>	

	<?php if($params->getValue("allow_seker")){?>
	<a href="gui/index.php?show=questionair/index" target="main1"><?php echo $text["Questionair"];?></a>
	<br />	
	<?php }?>

<br />	
<?php if($params->getValue("mailing_list_allow")){?>
	<div class="menuHeader">רשימת תפוצה</div>
	<a href="gui/index.php?show=mailing_list/index" target="main1">עריכת רשימה</a>
	<br />
	<a href="gui/index.php?show=site_users/users" target="main1">רשימות גולשים</a>
	<br />
	<a href="gui/index.php?show=import/index" target="main1">ייבוא אנשי קשר</a>
	<br />
	<a href="gui/index.php?show=site_users/relations" target="main1">שיוך לקבוצות</a>
	<br />
<?php }else{?>
	<a href="gui/index.php?show=site_users/users" target="main1">רשימות גולשים</a>
<?php }?>


	<br />
	<a href="gui/index.php?show=statistics/index" target="main1">נתונים כלליים</a>
	<br />	

	<a href="gui/index.php?show=log/index" target="main1">יומן פעולות</a>
	<br />	

<?php }?>




		<br /><br />
		<br /><br />		
		<?php if($login->userLoggedIn()){?>
			<a href="gui/index.php?show=login" onclick="document.location=document.location" target="main1"><?php echo $text["Logout"];?></a>			
		<?php }?>

*/		
?>	
</div>
</body>
</html>
