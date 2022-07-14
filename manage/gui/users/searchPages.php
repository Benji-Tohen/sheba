<?php
// perform a search for pages that we will give permissions to edit for users
require_once('../../../conf/conf.data.php');
require_once('../../../classes/content_management/class.content_updater.php');
// ------------------------------------------------------------------------------------------------------------------------------------------
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
///Make sure that a value was sent.
if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = $_GET['search'];
    $search = addslashes($search);                                              //Add slashes to any quotes to avoid SQL problems.
    $arrConnectedTypes = array(1,95,96,5,104);                                  //Predefined list of page types we search in
    echo "<u style='line-height: 30px;'>תוצאות חיפוש</u><br />";
    foreach ($arrConnectedTypes as $key => $value) {                            /*display connected pages categories*/
        $pageType = $db->getRow("SELECT Name, ID FROM wm_pagetype WHERE ID=".$value);
        $arrWmPages = $db->getArray("SELECT Name, ID FROM wm_pages WHERE Page_Type =".$pageType['ID']." AND Deleted = 0 AND Name LIKE '%".mysqli_real_escape_string($db->conn, $search)."%'");  // bring same page type
        //$arrWmPages = $db->getArray("SELECT Name, ID FROM wm_pages WHERE Deleted = 0 AND Name LIKE '%".mysqli_real_escape_string($db->conn, $search)."%'");   // bring all page types
        if(count($arrWmPages) > 0){
            echo "<div style='border:1px solid;padding:10px;margin-bottom:10px;max-height:150px;overflow-y:auto;'>";
            echo $pageType['Name'].'<br />';
            echo '---------------'.'<br />';
            // --------------------------------------------------------------------------------------------------------------------------
            foreach ($arrWmPages as $key => $page) {/*display connected pages*/
                $isChecked = $db->getRow("SELECT ID FROM wm_connected_pages_ids WHERE wm_connected_wm_pages_ids=".$page['ID']." AND wm_pages=".intval($_GET["thisId"]));
                if(count($isChecked) == 0) {
                    ?><input id="check<?php echo $page['ID']?>" onclick="saveChecked(<?php echo $page['ID']?>)" type="checkbox" name="connectedPages[]" value="<?php echo $page['ID']?>"/><?php echo $page['Name'];?><br />
<?php           }
            }
            echo "</div>";
        }
    }
}
?>
