<?php
require_once('../conf/conf.data.php');
require_once('../classes/gui/class.gui.php');

$gui=new Gui($cfg["WM"]["Default_Language"]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link href="gui/design/framedesign.css" type="text/css" rel="stylesheet"/>
</head>
<frameset rows="100%">
	<frame name="main1" scrolling="auto" src="gui/index.php" frameborder="0" />
</frameset><noframes></noframes>
</html>
