<?php
    /**
     * This file will generate sitemap & sitemap_X.xml file.
     * To request cache version just browse to /sitemap.xml
     * To request genetation browse to /sitemap.xml?force
     */
    $nowDate = new DateTime();
    $cacheFileName = 'sitemap_'.HOMEPAGEID.'.xml';
    $cacheFilePath = $_SERVER['DOCUMENT_ROOT'].'/webfiles/sitemaps';

    // Make $_GET available
    $wm->initGETParams();

    // Create sitemaps folder
    if (!file_exists($cacheFilePath)) {
        mkdir($cacheFilePath, 0775, true);
    }

    // Get cache file last creation time if exist
    /*
    $cacheFileDate = new DateTime();
    if(file_exists($cacheFilePath.'/'.$cacheFileName)){
        $cacheFileDate->setTimestamp(filemtime($cacheFilePath.'/'.$cacheFileName));
    } else {
        $cacheFileDate->setTimestamp(0);
    }
    $cacheTime = $cacheFileDate->diff($nowDate);
    $cacheDaysOld = $cacheTime->format('%a');
    */

    // Clean white spaces if exist in PHP
	// Attention! This will not show any Notice/Error/Warnings before Document
	ob_clean();flush();
    // XML Header
    header('Content-Type: application/xml; charset=utf-8');

    if(file_exists($cacheFilePath.'/'.$cacheFileName) && !isset($_GET['force'])){
        // Get from cache
        $sitemapContent = file_get_contents($cacheFilePath.'/'.$cacheFileName);
    } else {
        // Create sitemap
        $sitemapContent = $wm->getSitemap(HOMEPAGEID);
    }

    // Store in cache
    if($sitemapContent){
        file_put_contents($cacheFilePath.'/'.$cacheFileName, $sitemapContent);
        chmod($cacheFilePath.'/'.$cacheFileName, 0664);
    }

    // Print sitemap
    echo $sitemapContent;
exit;