<?php
require_once('../../../conf/conf.data.php');
require_once('../../../classes/content_management/class.content_updater.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);



///Make sure that a value was sent.
if (isset($_GET['search']) && $_GET['search'] != '') {
	$search=$_GET['search'];
	//Add slashes to any quotes to avoid SQL problems.
	$search = addslashes($search);
	
        $pageType = $db->getRow("SELECT Name, ID,Page_Type,Secondary_Page_Type FROM wm_pages WHERE ID=".intval($_GET["thisId"]));
        if($pageType["Secondary_Page_Type"]){
        	$pageType['Page_Type']=$pageType["Secondary_Page_Type"];
        }
        $isConnected = $db->getRow("SELECT connected_Page_Types FROM wm_pagetype WHERE ID =".$pageType['Page_Type']);
	$arrConnectedTypes = explode(',', $isConnected['connected_Page_Types']);
        echo "<u style='line-height: 30px;'>תוצאות חיפוש</u><br />";
        foreach ($arrConnectedTypes as $key => $value) {/*display connected pages categories*/
		//$pageTypeName = $db->getRow("SELECT Name FROM wm_pagetype WHERE ID=".$value[$key]);
		$pageType = $db->getRow("SELECT Name, ID FROM wm_pagetype WHERE ID=".$value);
		$arrWmPages = $db->getArray("SELECT Name, ID FROM wm_pages WHERE Page_Type =".$pageType['ID']." AND Deleted = 0 AND Name LIKE '%".mysqli_real_escape_string($db->conn, $search)."%'");
                if(count($arrWmPages) > 0){
                    echo "<div style='border: 1px solid;padding: 10px;margin-bottom: 10px;max-height: 300px;overflow-y: auto;'>";
                    echo $pageType['Name'].'<br />';
                    echo '---------------'.'<br />';
                    
                    foreach ($arrWmPages as $key => $page) {/*display connected pages*/
                            $isChecked = $db->getRow("SELECT ID FROM wm_connected_pages_ids WHERE wm_connected_wm_pages_ids=".$page['ID']." AND wm_pages=".intval($_GET["thisId"]));
                            if(count($isChecked) == 0){
                                ?><input id="check<?php echo $page['ID']?>" onclick="saveChecked(<?php echo $page['ID']?>)" type="checkbox" name="connectedPages[]" value="<?php echo $page['ID']?>"/><?php echo $page['Name'];?><br />
                           <?php  }

                    }
                    echo "</div>";
                }
	}
                
                
                
                exit;/*code below is irrelevent..*/
	$arrParents=$db->getArray("SELECT ID, Name FROM wm_pages WHERE Deleted=0 AND Page_Type =".$pageType['ID']." AND Name LIKE '%".mysqli_real_escape_string($db->conn, $search)."%' ORDER BY Name LIMIT 0, 10");

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
