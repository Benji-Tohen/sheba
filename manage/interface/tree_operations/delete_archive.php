<?php
require_once('../../../conf/conf.data.php');
require_once('../../../classes/file/class.file.php');


$log->write("Delete archive", "delete");	


$query="
DELETE 
FROM wm_pages_versions 
WHERE wm_pages IN (SELECT ID FROM wm_pages WHERE Deleted>0)
";

$db->runQuery($query);

$db->runQuery("DELETE FROM wm_pages WHERE Deleted>0");



header("location: ".$_SERVER['HTTP_REFERER']);
exit;
?>
