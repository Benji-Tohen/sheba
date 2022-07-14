<?php

require_once('../conf/conf.data.php');
require_once('../classes/parameters/class.parameters.php');
require_once('../classes/gui/class.gui.php');

$gui=new Gui($cfg["WM"]["Default_Language"]);


$login=new Login($db, $cfg["WM"]["DATABASE_TABLE"]["Users"]);
$params=new Parameters($db);



if($params->getValue("admin_enable_site_admin") && !$login->isManager()){
	header('location: gui/index.php?show=login&se=true');
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link href="gui/design/framedesign.css" type="text/css" rel="stylesheet"/>
</head>
<frameset rows="50, *, 20">
	<frame name="top" src="http://www.tohen-media.com/global_admin/top.php" scrolling="no" noresize="noresize" frameborder="0" />	
	<?php if($gui->isRTL()){?>
		<frameset cols="*, 100">
			<frame name="main1" scrolling="auto" src="gui/index.php" frameborder="0" />			
			<frame name="menu" src="menu.php" noresize="noresize" frameborder="0" />
		</frameset>
	<?php }else{?>
		<frameset cols="100, *">
			<frame name="menu" src="menu.php" noresize="noresize" frameborder="0" />
			<frame name="main1" scrolling="auto" src="gui/index.php" frameborder="0" />			
		</frameset>
	<?php }?>
	<frame name="bottom" src="bottom.php" noresize="noresize" frameborder="0" />		
</frameset><noframes></noframes>
</html>
