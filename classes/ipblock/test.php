<?php
require_once dirname(__FILE__)."/../../conf/conf.data.php";
require_once dirname(__FILE__)."/ipblock.class.php";
$ip = new ipblock($db);
//$ip->block_ip();
$ip->trigger_suspicious_action();
echo "ip allowed result = ".$ip->is_ip_allowed()."<br>";
echo time();
?>
