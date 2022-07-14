<?php
require_once "encrypt.class.php";
$ec = new encrypt();
echo "{$ec->salt} -> {$ec->key}";
//$msg = $ec->encrypt("Miki Berkovich");
//$msg = $ec->decrypt("UFipnczHEgRCy6pAwV4hr4PECaOjWsY+CLvPJX1QkN4=");
echo $msg;
?>
