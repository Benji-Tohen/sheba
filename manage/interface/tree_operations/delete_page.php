<?php
require_once('../../../conf/conf.data.php');
require_once('../../../classes/file/class.file.php');
require_once('../../../classes/elad/elad_integration.class.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);

$id=	intval($_REQUEST["id"]);

if($id){
        $row=$wm->getValues($id);
        if ($row['Page_Type']==98) {
            $elad = new EladIntegration();
            $elad->delete_event($id);
        }
        
	$log->write("Page archived: '".$wm->get($id, "Name")."' id: ".$id." parent: ".$wm->getParent($id), "archive");	
	//$wm->delete($id);
	$wm->archive($id);
        /*delete pages connected for this page ID*/
        $db->runQuery("DELETE FROM wm_connected_pages_ids WHERE wm_pages =".$id." OR wm_connected_wm_pages_ids =".$id);
}

header("location: ".$_SERVER['HTTP_REFERER']);
exit;
?>
