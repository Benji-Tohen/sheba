<?php
require_once('../../../classes/file/class.file.php');
require_once('../../../classes/gui/class.gui.php');

$gui=new Gui("en");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
<link href="../design/basic_html.css" type="text/css" rel="stylesheet"/>
<link href="../design/tables.css" type="text/css" rel="stylesheet"/>
<link href="../design/objects.css" type="text/css" rel="stylesheet"/>
<script language="javascript" type="text/javascript" src="../JS/layers.js"></script>
<script language="javascript" type="text/javascript" src="../JS/ajax.js"></script>
<script language="javascript" type="text/javascript" src="../JS/general.js"></script>
<style type="text/css" media="all">
.fbDir{
	background-image: url(../images/icons/folder.gif);
	background-repeat: no-repeat;
	color: #ffffff;
	font-weight: bold;
	height: 18px;
	padding-top: 2px;
	padding-left: 27px;
	margin-top: 5px;
}

.fbFile{
	background-image: url(../images/icons/video.gif);
	background-repeat: no-repeat;
	color: #ffffff;
	font-weight: bold;
	height: 18px;
	padding-top: 2px;
	padding-left: 27px;	
}

.fbFile a{
	color: #ffffff;
	font-weight: bold;
}

.fileBrowser{
	padding: 10px;
}
</style>
<?php require_once('../common/body.php');?>

<div class="fileBrowser">
<h3>Choose a file</h3>
<?php

$file=new File();
$file->simpleFileBrowser("../../../video", "<a href=\"#\" onclick=\"opener.chooseFile('[#FILE_PATH#]');\">[#FILE_NAME#]</a>");


?>
</div>
<?php require_once('../common/footer.php');?>