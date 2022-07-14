<?php    
/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    
    
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
	
    $PNG_TEMP_DIR = str_replace("classes/phpqrcode/temp/", "webfiles/qr/", $PNG_TEMP_DIR);





    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
//    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = "Q";    

    $matrixPointSize = 2;
    if (isset($_REQUEST['size']))
    	$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
  



    if (isset($_REQUEST['data'])) { 
    
	$data=$_REQUEST['data'];
	$data=urldecode($data);

        //it's very important!
        if (trim($data) == ''){
		exit;
         //   die('data cannot be empty! <a href="?">back</a>');
        }
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';




        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
 

	header('Content-Type: image/png');
	readfile($filename);
	exit;
      
    } else {    
    /*
        //default data
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
      */  
    }    
        
    //display generated file
   // echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" alt="'.$_REQUEST['data'].'" />';  



       
    // benchmark
  //  QRtools::timeBenchmark();    

?>
