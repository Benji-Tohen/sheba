<?php
require_once('../../../conf/conf.data.php');

$checkName=str_replace(" ","",$_GET["checkName"]).".php";
$query="SELECT * FROM wm_pagetype where Page like '".mysqli_real_escape_string($db->conn, $checkName)."'";
$namesArr=$db->getArray($query);
if($namesArr){
    echo "taken";
}else{
    echo "ok";
}