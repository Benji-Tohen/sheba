<?php 
	$thumb_call_banner=$cfg["WM"]["Server"]."/webfiles/images/cache/1140X134/zcX1/";
	//$lobiPageItems=$wm->getNewsList($wmPage["ID"]);
	$lobiPageItems=$wm->getConnectedPages($wmPage["ID"], 98, "Start_Date ASC, Start_Time DESC, Name", "0,1000", "Start_Date >= '".date("Y-m-d")."' AND Hide_On_Menu=0");
?> 