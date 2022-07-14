<?php
require_once('../../../conf/conf.data.php');
require_once('../../../classes/content_management/class.content_updater.php');
// =========================================================================================================================================
function set_cache() {
    global $wm;
    $arr = array();
    $id = intval($_GET['id']);
    $wm->getChildrenRecursiveIDs($arr, $id);
    $ids=implode(",", $arr);
    $_SESSION['searchSuggest_time'] = time();
    $_SESSION['searchSuggest_cache'] = gzcompress($ids);
}
// =========================================================================================================================================
function is_cached() {
    if (@$_SESSION['searchSuggest_cache']) {
        if (time() - $_SESSION['searchSuggest_time'] > 60) set_cache();         // 1 min "invalidation"
        //echo "is cache..";
        return true;
    } else return false;
}
// =========================================================================================================================================
if (isset($_GET['cache'])) {
    set_cache();                                                                // prepare the cache
    echo "cache done";
}
// =========================================================================================================================================
///Make sure that a value was sent.
if (isset($_GET['search']) && $_GET['search'] != '') {
	$search=$_GET['search'];
	//Add slashes to any quotes to avoid SQL problems.
	$search = addslashes($search);
	if ($_GET['options']=="children") {
            //echo "tester";
            if (!is_cached()) set_cache();
            //$arr = array();
            //$id = intval($_GET['id']);
            //$wm->getChildrenRecursiveIDs($arr, $id);
            //$ids=implode(",", $arr);
            $ids = gzuncompress($_SESSION['searchSuggest_cache']);
            $arrNames=$db->getArrayForField("SELECT Name FROM wm_pages WHERE ID IN($ids) AND Deleted=0 AND Name LIKE '$search%' ORDER BY Name LIMIT 0, 10", "Name");
            foreach($arrNames as $name) echo $name."\n";
            
        } else {
            $arrNames=$db->getArrayForField("SELECT Name FROM wm_pages WHERE Deleted=0 AND Name LIKE '$search%' ORDER BY Name LIMIT 0, 10", "Name");
            foreach($arrNames as $name) echo $name."\n";
        }
}
?>
