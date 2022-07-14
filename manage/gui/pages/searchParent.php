<?php
require_once('../../../conf/conf.data.php');
require_once('../../../classes/content_management/class.content_updater.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);



///Make sure that a value was sent.
if (isset($_GET['search']) && $_GET['search'] != '') {
	$search=$_GET['search'];
	//Add slashes to any quotes to avoid SQL problems.
	$search = addslashes($search);
	



	$arrParents=$db->getArray("SELECT ID, Name FROM wm_pages WHERE Deleted=0 AND Name LIKE '%".mysqli_real_escape_string($db->conn, $search)."%' AND ID<>".intval($_GET["thisId"])." ORDER BY Name LIMIT 0, 10");

	if(count($arrParents)){
		foreach($arrParents as $parent){
			echo "<div>";
			$arr_navigator=$wm->getParentsArray($parent["ID"]);

echo "ראשי";

for($i=0;$i<count($arr_navigator);$i++){
	
	if(strcmp($arr_navigator[$i]["Name"], "Root")==0){
		$arr_navigator[$i]["Name"]=$text["Root"];
	}

	if($i>0){
		echo " -> ";
	}
	echo $arr_navigator[$i]["Name"];
}
			

			echo "&nbsp;&nbsp;&nbsp;<input type=\"button\" name=\"choose\" value=\"בחר\" onclick=\"changeParent('".$parent["ID"]."', '".$parent["Name"]."');\" /></div>";
		}
	}else{
		echo "לא נמצאו דפים";	
	}
}
?>
