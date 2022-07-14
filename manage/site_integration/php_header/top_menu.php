<?php //if($params->getValue("admin_enable_site_admin") && $login->isManager()){?>
<?php if($params->getValue("admin_enable_site_admin") && $login->isUser()){//$login->isManager()?>
<style>
body{
	padding: 0px;
	margin: 0px;
/*
	padding-top: 65px;
*/
}

.adminMenu{
	position: fixed;
	width: 100%;
	height: 58px;
	bottom: 0px;
	z-index: 101;
	background-image: url(<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/UpperBar.jpg);
	background-repeat: repeat-x;
	
	border-bottom: 1px solid #c0c0c0;
	text-align: right;
}

.adminTopMenuLeft{
	float: left;
	
}

.adminTopMenuCenter{
	float: left;
	width: 30%;
}

.adminTopMenuRight{
	float: right;

	text-align: right;
}


.adminButtonIcon{
	
	font-size: 12px;
	padding-left: 3px;
	padding-right: 3px;
	float: right;
	cursor: pointer;
	font-weight: bold;
	padding-top: 7px;
	text-align: center;
	color: #ffffff !important;
}

.adminButtonIcon img{
	
}

.adminButton, .adminButtonRight{
	padding-left: 10px;
	padding-right: 10px;
	cursor: pointer;
	font-weight: bold;
	text-align: center;
	color: #ffffff !important;
	font-size: 14px;
}

.adminButtonRight{
	float: right;
	padding-top: 5px;
}


#adminLayer {
	position: absolute;
	top: 68px;
        left: 50%;
        margin-left: -350px;
	width: 800px; 
	height: 700px; 
	float: left; 

	z-index: 100;
	display: none;
	border-top: 0px;
	text-align: right;
}

#adminMenuLayer{
	position: absolute; /*fixed;*/
	top: 68px;
	width: 168px;
	height: 800px;
	right: 10px;
	z-index: 101;
	display: none;
	text-align: right;
	overflow: hidden;
}

.adminMenuLayerTop{

	background-image: url(<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/admin_menu_top.png);
	background-repeat: no-repeat;

	height: 12px;
	cursor: move;
}

.adminLayerTop{
	background-image: url(<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/admin_top.png);
	background-repeat: no-repeat;

	height: 12px;
	cursor: move;
}

.grabBullet{
	float: left;
	background-image: url(<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/admin_grab.png);
	background-repeat: no-repeat;
	width: 29px;
	height: 5px;
	margin-left: 5px;
	margin-top: 4px;
}

#adminMenu{
	border: 1px solid #000000;
	border-top: none;
}

#main1{
	border: 1px solid #000000;
	border-top: none;
}

.closeButton{
	float: right;
	width: 8px;
	height: 8px;
	background-image: url(<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/admin_close.png);
	background-repeat: no-repeat;
	margin-right: 2px;
	margin-top: 2px;
	cursor: pointer;
}

.frameClass{
	background-image: url(<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/site_integration/admin_window_button_bg.png);
	background-repeat: repeat-x;
	background-color: #54839F;
	z-index: 5;
}


.adminTopMenuSap{
	float: right;
	width: 1px;
	height: 58px;
	border-left: 1px solid #8e8e8e;
	border-right: 1px solid #525252;
	margin-right: 10px;
	margin-left: 10px;
}









div.fadehover {
	position: relative;
	}
 
img.firstImage {
	position: absolute;
	left: 0;
	top: 0;
        z-index: 10;
	}
 
img.secondImage {
	position: absolute;
	left: 0;
	top: 0;
	}




iframe{

}


</style>
<script type="text/javascript">
var inSite=true;
</script>
<!-- <script language="javascript" type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/jquery-ui/js/jquery-ui-1.8.23.custom.min.js"></script>
<link type="text/css" href="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" /> -->
<?php
/*
<!--
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/themes/base/jquery-ui.css"/>
-->











<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/jquery-ui/js/jquery-1.8.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css"/>

?>

<!--	Draggable
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/drag/iutil.js"></script>
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/drag/idrag.js"></script>
-->

<!--	Resizable	
<link type="text/css" href="http://jqueryui.com/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/resizable/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/resizable/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/resizable/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/JS/resizable/jquery.ui.resizable.js"></script>
	Resizable	-->


<?php
*/

}?>
