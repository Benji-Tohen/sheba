<?php

session_start();

$userID = intval($_SESSION["LPMEDIA"]["USER_DATA"]["ID"]);

if($_REQUEST["export"]){
	require_once('../../classes/export/class.export.php');
	require_once('../../classes/file/class.file.php');

	$queryCond="";
	if ($_REQUEST['startDate']) {
		list($d,$m,$y)=explode("/", $_GET["startDate"]);
		$startDate=$y."-".$m."-".$d;
		$queryCond .= " AND JoiningDate>='".$startDate." 00:00:00'";
	}
	if ($_REQUEST['endDate']) {
		list($d,$m,$y)=explode("/", $_GET["endDate"]);
		$endDate=$y."-".$m."-".$d;
		$queryCond .= " AND JoiningDate<='".$endDate." 23:59:59'";
	}



	$table="wm_landing_pages_site_users_customer_".$userID;

	$ex=new Export($cfg["WM"]["DBServer"], $cfg["WM"]["DBName"], $cfg["WM"]["DBUser_Name"], $cfg["WM"]["DBPassword"]);

	$filePath="../../".$cfg["WM"]["File_Uploades_Folder"]."/landing_pages_customers/".$userID."/Export/";

	$file=new File();
	$file->checkPath($filePath);

	$fileName=$filePath."landpage_users"."__Date_".date("d_m_Y__H_i_s", time()).".csv";
	


	if ($_REQUEST['landingPage']){
		$landPage = intval($_REQUEST['landingPage']);

		$query = "SELECT wm_forms FROM wm_pages WHERE ID='$landPage' LIMIT 1";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$wm_forms = $row['wm_forms'];

		$query = "SELECT ID, Name FROM wm_forms_fields WHERE wm_forms=".$wm_forms;
//		$result = mysql_query($query);
//		while($row = mysql_fetch_array($result))$fieldsHeader[] = $row['Name'];


		$fieldsHeader=$db->getArray($query);


		$i=0;
		foreach($fieldsHeader as $field){

			$ii=0;
			//$query = "SELECT JoiningDate, Value FROM wm_landing_pages_site_users_values_customer_$userID WHERE Name='".$field."' AND wm_landing_pages=".$landPage;
			$query = "SELECT JoiningDate, Value FROM wm_landing_pages_site_users_values_customer_$userID WHERE wm_forms_fields=".$field["ID"]." AND wm_landing_pages=".$landPage;
			$query.=$queryCond;

			$result = mysql_query($query);

			while($row = mysql_fetch_array($result)){
				if($i==$ii){
					//$outputArray['Date'][] = $row['JoiningDate'];
				}

				//$row['Value']=str_replace(",", "-", $row['Value']);

				$outputArray[$field["ID"]][] = iconv("utf-8", "windows-1255", $row['Value']);

				$ii++;
			}

			$i++;
		}




		/*	Download	*/

		header ( "Content-Type: application/force-download" );
		header ( "Content-Type: application/octet-stream" );
		header ( "Content-Type: application/download" );
		header ( "Content-Type: text/csv" );
		header ( "Content-Disposition: attachment; filename="."landpage_users"."__Date_".date("d_m_Y__H_i_s", time()).".csv" );
		header ( "Content-Transfer-Encoding: binary" );
		header ( "Accept-Ranges: bytes" );
		//header ( "Content-Length: ".filesize($fileName) );




		$outputArrayHeader = array_keys($outputArray);
		foreach($outputArrayHeader as $headerItem){
			$output .= iconv("utf-8", "windows-1255", $db->getField("SELECT Name FROM wm_forms_fields WHERE ID=".$headerItem, "Name")).",";
		}
		$output = rtrim($output, ",");
		$output .= "\n";
		
		for($xi=0; $xi<count($outputArray[$outputArrayHeader[0]]); $xi++){
			foreach($outputArrayHeader as $key=>$value){

				$outputArray[$outputArrayHeader[$key]][$xi]=str_replace(",", ";", $outputArray[$outputArrayHeader[$key]][$xi]);
				$outputArray[$outputArrayHeader[$key]][$xi]=str_replace("\n", ";", $outputArray[$outputArrayHeader[$key]][$xi]);
				$outputArray[$outputArrayHeader[$key]][$xi]=str_replace("\r", ";", $outputArray[$outputArrayHeader[$key]][$xi]);

				$output .= $outputArray[$outputArrayHeader[$key]][$xi].",";

			}
			$output = rtrim($output, ",");
			$output .= "\n";
		}
		echo $output;
		die;
	}
	else{
		$ex->exportToFile($table, $fileName);
	}
}
?>
<?php
/*
session_start();

if(!$login->isUser() || !$_SESSION["LPMEDIA"]["USER_DATA"]["ID"]){
	header("location: index.php?show=login");
	exit;
}

if(!$_SESSION["LPMEDIA"]["USER_DATA"]["ID"]){
	exit;
}



if($_REQUEST["export"]){
	require_once('../../classes/export/class.export.php');
	require_once('../../classes/file/class.file.php');
	
	$userID = intval($_SESSION["LPMEDIA"]["USER_DATA"]["ID"]);

	$table="wm_landing_pages_site_users_customer_".$userID;

	$ex=new Export($cfg["WM"]["DBServer"], $cfg["WM"]["DBName"], $cfg["WM"]["DBUser_Name"], $cfg["WM"]["DBPassword"]);

	$filePath="../../".$cfg["WM"]["File_Uploades_Folder"]."/landing_pages_customers/".$_SESSION["LPMEDIA"]["USER_DATA"]["ID"]."/Export/";

	$file=new File();
	$file->checkPath($filePath);

	$fileName=$filePath."landpage_users"."__Date_".date("d_m_Y__H_i_s", time()).".csv";
	//$ex->exportToFile($table, $fileName);
	
	//Getting CSV Header
	$csvHeader = array("First_Name", "Last_Name", "Email", "Enabled", "JoiningDate", "Phone", "Address", "LandingPage", "LandingPageName");
	$csvUserValuesHeader = array();
	$query = "SELECT DISTINCT ID, Name FROM wm_landing_pages_site_users_values_customer_".$userID;
	$result = mysql_query($query);
	//while ($row = mysql_fetch_array($result)) $csvUserValuesHeader[] = $row['Name'];
	
	$outputCSV = implode(",", $csvHeader).",";
	$outputCSV .= implode(",", iconv("utf-8", "windows-1255", $csvUserValuesHeader));
	$outputCSV .= "\n";

	//Getting DATA
	foreach($csvUserValuesHeader as $item){
		$queryUserValues = "SELECT Value FROM wm_landing_pages_site_users_values_customer_".$userID." WHERE Name='".$item."' AND wm_landing_pages_site_users_customer_".$userID."=".$row['ID'];
		$resultUserValues = mysql_query($queryUserValues);
		$rowUserValues = mysql_fetch_array($resultUserValues);
		$outputCSV .= iconv("utf-8", "windows-1255", $rowUserValues['Value']).",";
	}
	
	$query = "SELECT ".implode(",", $csvHeader)." FROM wm_landing_pages_site_users_customer_".$userID;
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		foreach($row as $key => $value) 
		{
			if (in_array($key, $csvHeader)) {
				$outputCSV .= iconv("utf-8", "windows-1255", $value).",";
			}
		}
		foreach($csvUserValuesHeader as $item){
			$queryUserValues = "SELECT Value FROM wm_landing_pages_site_users_values_customer_".$userID." WHERE Name='".$item."' AND wm_landing_pages_site_users_customer_".$userID."=".$row['ID'];

			$resultUserValues = mysql_query($queryUserValues);
			$rowUserValues = mysql_fetch_array($resultUserValues);
			$outputCSV .= iconv("utf-8", "windows-1255", $rowUserValues['Value']).",";
		}
		$outputCSV .= "\n";
	}
	
	//Output File
	header ( "Content-Type: application/force-download" );
	header ( "Content-Type: application/octet-stream" );
	header ( "Content-Type: application/download" );
	header ( "Content-Type: text/csv" );
	header ( "Content-Disposition: attachment; filename="."landpage_users"."__Date_".date("d_m_Y__H_i_s", time()).".csv" );
	header ( "Content-Transfer-Encoding: binary" );
	header ( "Accept-Ranges: bytes" );
	echo $outputCSV;
	die;
}
*/
?>
