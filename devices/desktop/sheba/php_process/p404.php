<?php
    $thumbWidth=$params->getValue("imgThumbWidth");
    $thumbHeight=$params->getValue("imgThumbHeight");
    $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/"."855"."X"."386"."/zcX1/";

    $desktopImg = $cfg["WM"]["Server"].'/'.$wmPage["Top_Header"];
    $mobileImg = $wmPage["Top_Header2"] ? $cfg["WM"]["Server"].'/'.$wmPage["Top_Header2"] : $cfg["WM"]["Server"].'/'.$wmPage["Top_Header"];
?>
