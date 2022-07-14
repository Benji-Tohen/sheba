<?php
require_once('../../../conf/conf.data.php');
require_once('../../../classes/content_management/class.content_updater.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

///Make sure that a value was sent.
if (isset($_GET['search']) && $_GET['search'] != '') {
	$search=$_GET['search'];
	//Add slashes to any quotes to avoid SQL problems.
	$search = addslashes($search);
        /*$pageType = $db->getRow("SELECT Name, ID,Page_Type FROM wm_pages WHERE ID=".intval($_GET["thisId"]));
        $isConnected = $db->getRow("SELECT connected_Page_Types FROM wm_pagetype WHERE ID =".$pageType['Page_Type']);
	$arrConnectedTypes = explode(',', $isConnected['connected_Page_Types']);*/
	echo "<u style='line-height: 30px;'>תוצאות חיפוש</u><br />";
	$arrWmPages = $db->getArray("SELECT Name, ID FROM wm_pages WHERE Name LIKE '%".mysqli_real_escape_string($db->conn, $search)."%'");
	if(!empty($arrWmPages)){
		echo "<div style='border: 1px solid;padding: 10px;margin-bottom: 10px;max-height: 300px;overflow-y: auto;'>";
		echo $pageType['Name'].'<br />';
		echo '---------------'.'<br />';
		
		foreach ($arrWmPages as $key => $page) {/*display connected pages*/
				$isChecked = $db->getRow("SELECT ID FROM wm_gallery_page WHERE wm_pages=".$page['ID']." AND wm_gallery_id=".intval($_GET["thisId"]));
				if(!$isChecked){
					?><input id="check<?php echo $page['ID']?>" onclick="saveChecked(<?php echo $page['ID']?>)" type="checkbox" name="connectedPages[]" value="<?php echo $page['ID']?>"/><?php echo $page['Name'];?><br />
				<?php  }

		}
		echo "</div>";
	}else{
		echo "לא נמצאו דפים";	
	}

	exit;
}
?>
