<?php require_once('common/header.php');?>
<script language="javascript" type="text/javascript">
<!--
function getRemoteMainPage(){
	setTimeout("getRemoteMainPageOnTime()", 100);
}

function getRemoteMainPageOnTime(){
	document.location="http://www.tohen-media.com/global_admin/main.php";
}
-->
</script>
</head>
<body dir="<?php echo $gui->getDir();?>" onLoad="if(top.menu){top.menu.location=top.menu.location;};getRemoteMainPage();">
<div style="padding: 30px;color: #ffffff;">
<?php //echo $text["Wellcome to admin"];?>
</div>
