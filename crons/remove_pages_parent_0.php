<?php 
if($_SERVER['DOCUMENT_ROOT']==''){
	$_SERVER['DOCUMENT_ROOT'] = '/www-data/public_html';
}
require_once($_SERVER['DOCUMENT_ROOT'].'/conf/conf.data.php');
$res = $db->getArray("SELECT ID,Name,Deleted FROM wm_pages WHERE Parent = 0 AND ID != 1 ");
foreach ($res as $key => $value) {
	$db->runQuery("UPDATE wm_pages SET Parent = 666 ,Deleted = ".time()." WHERE ID =".intval($value['ID']));
}
echo 'finish';
?>