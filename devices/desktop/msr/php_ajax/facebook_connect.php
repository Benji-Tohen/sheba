<?php
$wm->initGetParams();
$fuid=$_GET["fuid"];
$_SESSION["fuid"]=$fuid;

$su->loginFacebookUser($fuid);
?>
