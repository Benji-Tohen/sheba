<?php
require_once('../../../conf/conf.data.php');
require_once('../../../classes/content_management/class.content_updater.php');

function isUsername($element) {
	return !preg_match('/[^A-Za-z0-9אבגדהוזחטיכלמנסעפצקרשתךףץןם._\\-]/', $element);
}

$thisId=intval($_GET["thisId"]);

///Make sure that a value was sent.
if (isset($_GET['alias']) && $_GET['alias'] != '') {
	$alias=$_GET['alias'];
	//Add slashes to any quotes to avoid SQL problems.

	$lang=$wm->get($thisId, "Lang");

	$arrNames=$db->getArrayForField("SELECT Name FROM wm_pages WHERE Deleted=0 AND Lang='".$lang."' AND Alias='".mysqli_escape_string($db->conn, $alias)."' AND ID!=".intval($thisId)." ORDER BY Name LIMIT 0, 1", "Name");
	if(count($arrNames)){
		echo "<b style=\"color: #ff0000;\">This alias already exists, please try another</b>";
	}elseif(isUsername($alias)){
		echo "<b style=\"color: #00ff00;\">OK!</b>";
	}else{
		echo "<b style=\"color: #ff0000;\">Please type a name with unerscores and letters only</b>";
	}
}
?>
