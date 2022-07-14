<?php
class File{
	
	var $filePath;
	var $dirPath;

	function File($filePath=NULL, $dirPath=NULL){
		$this->filePath=$filePath;
		$this->dirPath=$dirPath;
	}
	
	/*
		Make sure a file path exists, otherwise create it
	*/
	function checkPath($dirPath=NULL, $perm=0777){

		if(!$dirPath && $this->dirPath){
			$dirPath=$this->dirPath;
		}	
		 $checked="";
		 $file_split=explode("/", $dirPath);

		 for($i=0;$i<count($file_split);$i++){
			 $checked.=$file_split[$i]."/";
			 if(!is_dir($checked)){
				mkdir($checked, $perm);
					//FtpMkdir("", $checked, 777);	
			 }
		 }

		 return true;
	}
	

	/*
		Delete directories recursivly
	*/
	function rm_rf($path){
		if (@is_dir($path)) {
			$dp = opendir($path);
			while ($ent = readdir($dp)) {
				if ($ent == '.' || $ent == '..') {
					continue;
				}
				$file = $path . "/" . $ent;
				if (@is_dir($file)) {
					$this->rm_rf($file);
				} else {
					unlink($file);
				}
			}
			closedir($dp);
			return rmdir($path);
		} else {
			return @unlink($path);
		}
	}
	
	
	
	
	
	/**
		Not Configured
	**/
	function FtpMkdir($path, $newDir, $perm) {
	 
		   $server=''; // ftp server
		   $connection = ftp_connect($server); // connection
	 
	 
		   // login to ftp server
		   $user = "";
		   $pass = "";
		   $result = ftp_login($connection, $user, $pass);
	
	   // check if connection was made
		 if ((!$connection) || (!$result)) {
		   return false;
		   exit();
		   } else {
			 ftp_chdir($connection, $path); // go to destination dir
		   if(ftp_mkdir($connection, $newDir)) { // create directory
		   ftp_site($connection, "CHMOD ".$perm." $path/$newDir") or die("FTP SITE CMD failed.");
			   return $newDir;
		   } else {
			   return false;     
		   }
	  
	   ftp_close($connection); // close connection
	   }
	}	
	
	
	/*
		Return folder size in bytes
	*/
	function getFolderSize($directory){
       $folderSize=0;
	   $directory = realpath($directory).DIRECTORY_SEPARATOR;
	   
	   if(strcmp($directory, "/")==0){
	   	return false;	   
	   }
	   
	   foreach (scandir($directory) as $folderItem){
		   if ($folderItem != "." AND $folderItem != ".."){
			   if (is_dir($directory.$folderItem.DIRECTORY_SEPARATOR)){
			  		$folderSize+=$this->getFolderSize($directory.$folderItem.DIRECTORY_SEPARATOR);
			   }else{
			   		$folderSize+=filesize($directory.$folderItem);
			   }
		   }
	   }
	
	   return $folderSize;
	} 



	function listdir($start_dir='.') {
	
	  $files = array();
	  if (is_dir($start_dir)) {
		$fh = opendir($start_dir);
		while (($file = readdir($fh)) !== false) {
		  # loop through the files, skipping . and .., and recursing if necessary
		  if (strcmp($file, '.')==0 || strcmp($file, '..')==0 || strcmp($file, '.ftpquota')==0) continue;
		  $filepath = $start_dir  . $file;
		  if ( is_dir($filepath) )
			$files = array_merge($files, $this->listdir($filepath));
		  else
			array_push($files, $filepath);
		}
		closedir($fh);
	  } else {
		# false if the function was called with an invalid non-directory argument
		$files = false;
	  }
	
	  return $files;
	
	}

	function dirHasFile($dir, $fileName){
		$arrFiles=$this->listDir($dir);

		if(in_array($dir.$fileName, $arrFiles)){

			$key=array_search($dir.$fileName, $arrFiles);
			return $arrFiles[$key];
		}

		return false;
	}
	

	function simpleFileBrowser($dir, $filelink, $deep=0){
		
		$dirDisplay=str_replace("../", "", $dir);
		

		if ($handle = opendir($dir)) {
			$i=0;
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && $file!=".ftpquota") {
					if(is_dir($dir."/".$file)){
						echo "<div class=\"fbDir\" style=\"margin-left: ".($deep*5)."px;\">".$file."</div>";
						$this->simpleFileBrowser($dir."/".$file, $filelink, ($deep+1));
						//$this->fbArray[$dirDisplay][$file]=$this->simpleFileBrowser($dir."/".$file, ++$deep);
					}else{
						echo "<div class=\"fbFile\" style=\"margin-left: ".($deep*20)."px;\">".str_replace("[#FILE_NAME#]", $file, str_replace("[#FILE_PATH#]", $dirDisplay."/".$file, $filelink))."</div>";
						
						//$this->fbArray[$dirDisplay][$i]=$file;
						$i++;
					}
				}
			}
			closedir($handle);
		}
		
	}

	function writeToFile($file_path, $contents){
		$fh = fopen($file_path, 'w');
		fwrite($fh, $contents);
		fclose($fh);
	}


	function resizeImage($file_name, $full_file_path, $width, $height){
			
		list($fileNameOnly, $ext)=explode("[.]", $file_name);
		$thumb_name=$fileNameOnly."_thumb.".$ext;

		/*	Resize Image and Generate Thumb	*/
		if(file_exists($full_file_path.$file_name)){
		   

	

		   $phpThumb = new phpThumb();

	

		   copy($full_file_path.$file_name, $full_file_path."tmp_".$file_name);
		   chmod($full_file_path."tmp_".$file_name, 0777);
	
			//	Resize Image
		   $phpThumb->setSourceFilename($full_file_path.$file_name); 
		   $phpThumb->setParameter('w', $width);
		   $phpThumb->setParameter('h', $height);
		   $outputFilename = $full_file_path.$file_name;


		    if ($phpThumb->GenerateThumbnail()) { 
			if ($phpThumb->RenderToFile($outputFilename)) { 
				chmod($outputFilename, 0777);
				//echo "<img src=\"".$outputFilename."\" />";	
			   // do something on success
			} else {
			   //failed
				echo "Error generation thumb";
				exit;
			}
		    } else {
			// failed
			echo "Error generation thumb 1";
			exit;
		    }


		    unlink($full_file_path."tmp_".$file_name);
		}
	}

/*
	function cropImage($file_name, $full_file_path, $params){
		
		list($sx, $sy, $width, $height)=explode(",", $params);

		list($fileNameOnly, $ext)=explode("[.]", $file_name);
		$thumb_name=$fileNameOnly."_thumb.".$ext;

		//	Resize Image and Generate Thumb	
		if(file_exists($full_file_path.$file_name)){

		   
		   
		   $phpThumb = new phpThumb();

		   copy($full_file_path.$file_name, $full_file_path."tmp_".$file_name);
		   chmod($full_file_path."tmp_".$file_name, 0777);
	
			//	Resize Image
		   $phpThumb->setSourceFilename($full_file_path.$file_name);
		   
		   $phpThumb->setParameter('sw', $width);
		   $phpThumb->setParameter('sh', $height);
		   $phpThumb->setParameter('sx', $sx);
		   $phpThumb->setParameter('sy', $sy);
		   $phpThumb->setParameter('aoe', 1);	



			//sx=600&sy=5&sw=100&sh=100&aoe=1
		   $outputFilename = $full_file_path.$file_name;


		    if ($phpThumb->GenerateThumbnail()) { 
			
			if ($phpThumb->RenderToFile($outputFilename)) { 
		
				chmod($outputFilename, 0777);
				//echo "<img src=\"".$outputFilename."\" />";	
			   // do something on success
			} else {
			   //failed
				echo "Error generation thumb";
				exit;
			}
		    } else {
			// failed
			echo "Error generation thumb 1";
			exit;
		    }


		    unlink($full_file_path."tmp_".$file_name);
		}

	}
*/

	function cropImage($file_name, $full_file_path, $params){
		
		list($sx, $sy, $width, $height)=explode(",", $params);

		list($fileNameOnly, $ext)=explode("[.]", $file_name);
		$thumb_name=$fileNameOnly."_thumb.".$ext;

		

		//	Resize Image and Generate Thumb	
		if(file_exists($full_file_path.$file_name)){
  


		   $phpThumb = new phpThumb();

		   copy($full_file_path.$file_name, $full_file_path."tmp_".$file_name);
		   chmod($full_file_path."tmp_".$file_name, 0777);
	
			//	Resize Image
		   $phpThumb->setSourceFilename($full_file_path.$file_name);
		   
		   $phpThumb->setParameter('sw', $width);
		   $phpThumb->setParameter('sh', $height);
		   $phpThumb->setParameter('sx', $sx);
		   $phpThumb->setParameter('sy', $sy);
		   $phpThumb->setParameter('aoe', 1);	



			//sx=600&sy=5&sw=100&sh=100&aoe=1
		   $outputFilename = $full_file_path.$file_name;


		    if ($phpThumb->GenerateThumbnail()) { 
			
			if ($phpThumb->RenderToFile($outputFilename)) { 
		
				chmod($outputFilename, 0777);
				//echo "<img src=\"".$outputFilename."\" />";	
			   // do something on success
			} else {
			   //failed
				echo "Error generation thumb";
				exit;
			}
		    } else {
			// failed
			echo "Error generation thumb 1";
			exit;
		    }


		    unlink($full_file_path."tmp_".$file_name);
		}

	}

}
?>
