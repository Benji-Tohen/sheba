<?php
class CurlFunctions{



	
	function getRemoteFile($url){
	  $curl = curl_init();
	

	  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
	  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
	  $header[] = "Cache-Control: max-age=0";
	  $header[] = "Connection: keep-alive";
	  $header[] = "Keep-Alive: 300";
	  
	  //$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	  
	  $header[] = "Accept-Charset: windows-1255,utf-8;q=0.7,*;q=0.7";
	  $header[] = "Accept-Language: en-us,en;q=0.5";
	  $header[] = "Pragma: "; // browsers keep this blank.
	
	  curl_setopt($curl, CURLOPT_URL, $url);
	  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	  curl_setopt($curl, CURLOPT_REFERER, 'http://www.oryarok.co.il');
	  curl_setopt($curl, CURLOPT_AUTOREFERER, true);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	
	  $html = curl_exec($curl); 
	  curl_close($curl);
	
	  return $html; 
	}






	function download ($file_source, $file_target)
	{
	  // Preparations
	  $file_source = str_replace(' ', '%20', html_entity_decode($file_source)); // fix url format
	  if (file_exists($file_target)) { chmod($file_target, 0777); } // add write permission

	  // Begin transfer
	  if (($rh = fopen($file_source, 'rb')) === FALSE) { return false; } // fopen() handles
	  if (($wh = fopen($file_target, 'wb')) === FALSE) { return false; } // error messages.
	  while (!feof($rh))
	  {
		// unable to write to file, possibly because the harddrive has filled up
		if (fwrite($wh, fread($rh, 1024)) === FALSE) { fclose($rh); fclose($wh); return false; }
	  }

	  // Finished without errors
	  fclose($rh);
	  fclose($wh);
	  return true;
	}

}
?>