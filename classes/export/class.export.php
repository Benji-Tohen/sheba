<?php
class Export extends DB{
	
	function exportToFile($table, $fileName, $fieldsArr=NULL, $orderBy=NULL){
		if(!$fileName){return false;}

		$this->connect();
		
		if(!$fieldsArr){
			$fieldsArr=$this->getAllTableFields($table);
		}

		
		$fl=fopen($fileName, 'a');


		/*	Create Headers	*/
		foreach($fieldsArr as $val){
			$line.="\"".$val."\",";
		}
		$line=trim($line, ",");
		$line.="\n";
		fwrite($fl, $line);				
		

			/*Dump The Data	*/
		$query="SELECT ".implode(",", $fieldsArr)." FROM ".$table;				
		if($orderBy){
			$query.=" ORDER BY ".$orderBy;			
		}
		//$result=mysql_query($query);
/*
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$line="";
			foreach ($row as $col_value) {
				$line.="\"".addslashes(iconv("utf-8", "windows-1255", $col_value))."\",";
			}
			$line=trim($line, ",");
			$line.="\n";
			fwrite($fl, $line);
		}
*/

		$arrFields = $this->getArray($query);
		foreach ($arrFields as $row) {
			$line="";
			foreach ($row as $col_value) {
				$line.="\"".addslashes(iconv("utf-8", "windows-1255", $col_value))."\",";
			}
			$line=trim($line, ",");
			$line.="\n";
			fwrite($fl, $line);
		}
		fclose($fl);
		//mysql_free_result($result);
		$onlyFileName=explode("/", $fileName);
		$onlyFileName=$onlyFileName[count($onlyFileName)-1];

		
		/*	Download	*/
		header ( "Content-Type: application/force-download" );
		header ( "Content-Type: application/octet-stream" );
		header ( "Content-Type: application/download" );
		header ( "Content-Type: text/csv" );
		header ( "Content-Disposition: attachment; filename=".$onlyFileName );
		header ( "Content-Transfer-Encoding: binary" );
		header ( "Accept-Ranges: bytes" );
		header ( "Content-Length: ".filesize($fileName) );

		readfile($fileName);
		exit;
	}



	function exportQueryToFile($query, $fileName, $fields){
		if(!$fileName){return false;}

		$this->connect();
		
		if(!$fieldsArr){
			//$fieldsArr=$this->getAllTableFields($table);
			$fieldsArr=explode(",", $fields);
		}

		
		$fl=fopen($fileName, 'a');


		/*	Create Headers	*/
		foreach($fieldsArr as $val){
			$line.="\"".$val."\",";
		}
		$line=trim($line, ",");
		$line.="\n";
		fwrite($fl, $line);				
		

		/*	Dump The Data	
		$result=mysqli_query($query);

		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)){
			$line="";
			foreach ($row as $col_value) {
				$line.="\"".addslashes(iconv("utf-8", "windows-1255", $col_value))."\",";
			}
			$line=trim($line, ",");
			$line.="\n";
			fwrite($fl, $line);
		}
*/
		$arrFields=$this->getArray($query);
		foreach ($arrFields as $row) {
			$line="";
			foreach ($row as $col_value) {
				$line.="\"".addslashes(iconv("utf-8", "windows-1255", $col_value))."\",";
			}
			$line=trim($line, ",");
			$line.="\n";
			fwrite($fl, $line);	
		}
		fclose($fl);

		//mysql_free_result($result);


		$onlyFileName=explode("/", $fileName);
		$onlyFileName=$onlyFileName[count($onlyFileName)-1];

		
		/*	Download	*/
		header ( "Content-Type: application/force-download" );
		header ( "Content-Type: application/octet-stream" );
		header ( "Content-Type: application/download" );
		header ( "Content-Type: text/csv" );
		header ( "Content-Disposition: attachment; filename=".$onlyFileName );
		header ( "Content-Transfer-Encoding: binary" );
		header ( "Accept-Ranges: bytes" );
		header ( "Content-Length: ".filesize($fileName) );

		readfile($fileName);
		exit;
	}

	function exportMultiArrayToCSV($csvArr, $fileName, $downloadFile=true){
		global $cfg;

		$csvFilePath = $_SERVER["DOCUMENT_ROOT"]."/webfiles/export/";
	    $onlyFileName = $fileName."_".date("d_m_Y__H_i_s", time()).".csv";
	    $csvFilename = $csvFilePath.$onlyFileName;
	    $fileToBeSaved = fopen($csvFilename,"w");

		// Write UTF-8
		$fileToBeSaved=fopen($csvFilename, 'a');
		fwrite($fileToBeSaved, "\xEF\xBB\xBF");

	    foreach ($csvArr as $line) {
	        fputcsv($fileToBeSaved,$line);
	    }

	    fclose($fileToBeSaved);

		// Download
		if($downloadFile){
			header ( "Content-Type: application/force-download" );
			header ( "Content-Type: application/octet-stream" );
			header ( "Content-Type: application/download" );
			header ( "Content-Type: text/csv" );
			header ( "Content-Disposition: attachment; filename=".$onlyFileName );
			header ( "Content-Transfer-Encoding: binary" );
			header ( "Accept-Ranges: bytes" );
			header ( "Content-Length: ".filesize($csvFilename) );

			readfile($csvFilename);
			exit;
		}
	}
}
?>
