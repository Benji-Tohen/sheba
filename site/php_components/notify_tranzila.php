<?php
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
    // Create file that contains post
    $created_at = new DateTime();
    $headers = headers_list();
    $content = array_merge($headers, $_POST);

    file_put_contents(
        $_SERVER['DOCUMENT_ROOT'].'/site/tranzila_logs/notify_'.$created_at->format('d-m-Y-h-i-s').'.json', 
        json_encode($content, true)
    );

    exit;
?>