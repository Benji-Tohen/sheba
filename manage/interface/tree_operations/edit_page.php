<?php
set_time_limit(0);
ini_set('upload_max_filesize', '64M');
ini_set('post_max_size', '64M');
ini_set('max_input_time', '0');
ini_set('max_execution_time', '0');
ini_set('memory_limit', '16M');

require_once(dirname(__FILE__).'/../../../conf/conf.data.php');
require_once(dirname(__FILE__).'/../../../classes/file/class.file.php');
require_once(dirname(__FILE__).'/../../../classes/thumb/phpthumb.class.php');
require_once(dirname(__FILE__).'/../../../classes/elad/elad_integration.class.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$wmVersions=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["PagesVersions"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$dt = new DateTime1();
$id =	intval($_REQUEST["id"]);

$oldParent=$wm->get($id, "Parent");

if($oldParent!=$_POST["Parent"]){
	$fa["Deleted"]=0;
}

if(!$id){
	$id=1;
}

$fa["Name"]=            strip_tags($_REQUEST["Name"]);

if($_REQUEST["h1"]){
    $fa["h1"]=          strip_tags($_REQUEST["h1"]);
} else {
    $fa["h1"]=			strip_tags($_REQUEST["Name"]);
}

$fa["domain"]=			$_REQUEST["domain"];

$fa["Color"]=			$_REQUEST["Color"];

$fa["price"]=			intval($_REQUEST["price"]);
$fa["quantity"]=		intval($_REQUEST["quantity"]);

$fa["noindex"]=			$_REQUEST["noindex"];
$fa["hasConnectedBanners"]=     $_REQUEST["hasConnectedBanners"];
$fa["canonical"]=		$_REQUEST["canonical"];
$fa["moved_type"]=		$_REQUEST["moved_type"];

$fa["alternate"]=			$_REQUEST["alternate"];


$fa["wm_landing_pages_customers"]=		$_REQUEST["wm_landing_pages_customers"];
$fa["wm_forms"]=		intval($_REQUEST["wm_forms"]);

if($_REQUEST["Menu_Name"]){
	$fa["Menu_Name"]=		strip_tags($_REQUEST["Menu_Name"]);
}else{
	$fa["Menu_Name"]=		strip_tags($_REQUEST["Name"]);
}

$fa['search_only_specialist_doctors'] = $_REQUEST['search_only_specialist_doctors'] ? 1:0;
$fa['is_specialist_doctor'] = $_REQUEST['is_specialist_doctor'] ? 1:0;

$fa["Ordering"]=		$_REQUEST["Ordering"];

$fa["max_participants"]=		$_REQUEST["max_participants"];
$fa["City"]=				intval($_REQUEST["City"]);
$fa["Special"]=				intval($_REQUEST["Special"]);
$fa["show_in_block"]=		        intval($_REQUEST["show_in_block"]);
$fa["event_price"]=		        intval($_REQUEST["event_price"]);
$fa["event_currency"]=		        isset($_REQUEST["event_currency"]) ? $_REQUEST["event_currency"]:'' ;
$fa["wm_doctor_title"]=			intval($_REQUEST["wm_doctor_title"]);
$fa["wm_doctor_expertise"]=	        (implode(',', $_REQUEST["wm_doctor_expertise"]));

$fa["show_doc_gallery"]=                   ($_REQUEST["show_doc_gallery"]?1:0);
$fa["Show_Event_Calendar"]=                   ($_REQUEST["Show_Event_Calendar"]?1:0);
$fa["show_extended"]=                   ($_REQUEST["show_extended"]?1:0);
$fa["is_messer_page"]=                   ($_REQUEST["is_messer_page"]?1:0);
$fa["logo_link_to_subdomain_home_page"]=                   ($_REQUEST["logo_link_to_subdomain_home_page"]?1:0);

$fa["ShowOnHomepage"]=			$_REQUEST["ShowOnHomepage"];
$fa["ShowOnTicker"]=			$_REQUEST["ShowOnTicker"];
$fa["rss"]=				$_REQUEST["rss"];


$fa["AddThis"]=		($_REQUEST["AddThis"]?1:0);
$fa["cancel_event"]=     ($_REQUEST["cancel_event"]?1:0);

$fa["facebook_comments"]=		($_REQUEST["facebook_comments"]?1:0);
$fa["facebook_like"]=			($_REQUEST["facebook_like"]?1:0);

$fa["wm_categories"]=			$_REQUEST["wm_categories"];

$fa["checkbox_line"]=			$_REQUEST["checkbox_line"];

$fa["Form_Btn_Text"]=			$_REQUEST["Form_Btn_Text"];

$fa["Email_Address"]=                   $_REQUEST["Email_Address"];
$fa["Email_Subject"]=                   $_REQUEST["Email_Subject"];
$fa["Email_Body"]=                      $_REQUEST["Email_Body"];

$fa["Answer_Text"]=			$_REQUEST["Answer_Text"];

$fa["Comments"]=			$_REQUEST["Comments"];

$fa["hide_elad_chat"]= ($_POST["hide_elad_chat"]?1:0);

$fa["hide_newsletter_footer"] = ($_POST["hide_newsletter_footer"]?1:0);
$fa["newsletter_btn_link"] = $_REQUEST["newsletter_btn_link"];

$fa["Enable_Dropdown"]=	($_POST["Enable_Dropdown"]?1:0);

$fa["vertical_images"]= ($_POST["vertical_images"]?1:0);

$fa["hide_banners"]=	($_POST["hide_banners"]?1:0);

$fa["Enable_SideContent"]=	($_POST["Enable_SideContent"]?1:0);

$fa["dontShowInUnitsSearch"]=  ($_POST["dontShowInUnitsSearch"]?1:0);

$fa["Open_In"]=				$_REQUEST["Open_In"];

$fa["Conversion"]=          $_REQUEST["Conversion"];

$fa["custom_class"]=			$_REQUEST["custom_class"];

$fa["Author"]=			$_POST["Author"];

$fa["Sub_Title"]=			$_POST["Sub_Title"];

$fa["External_Sub_Title"]=			$_POST["External_Sub_Title"];

$fa["Link"]=			$_POST["Link"];

$fa["Email"]=			$_POST["Email"];

$fa["Scroller"]=			$_POST["Scroller"];

$fa["Content"]=			$_POST["Content"];

$fa["Menu_File_Text"]=			$_POST["Menu_File_Text"];

$fa["Menu_File_Display_Mode"]=			$_POST["Menu_File_Display_Mode"];

$fa["Content_Center"]=	$_POST["Content_Center"];

$fa["btn_name"]=  $_POST["btn_name"];

$fa["btn_url"]=  $_POST["btn_url"];

$fa["Content_Bottom"]=	$_POST["Content_Bottom"];

$fa["Lang"]=			$_REQUEST["Lang"];

$fa["Hide_On_Menu"]=	$_REQUEST["Hide_On_Menu"];

$fa["Page_Type"]=		$_REQUEST["Page_Type"];
$fa["Secondary_Page_Type"]=       $_REQUEST["Secondary_Page_Type"];
$fa['Menu_File_Alt'] = $_POST['Menu_File_Alt'];
$fa['Top_Header_Alt'] = $_POST['Top_Header_Alt'];
$fa['Top_Header2_Alt'] = $_POST['Top_Header2_Alt'];
$fa['Top_Header3_Alt'] = $_POST['Top_Header3_Alt'];

if($_REQUEST["Start_Date"]){
	$fa["Start_Date"]=date("Y-m-d", $dt->timestampFromText($_REQUEST["Start_Date"]));
}else{
	$fa["Start_Date"]=date("Y-m-d", $TIME);
}
$fa['YearMonth']= $_REQUEST['YearMonth'];

$fa['End_Date']= $_REQUEST['End_Date'];

$fa['Start_Time']= $_REQUEST['Start_Time'];

$fa['End_Time']= $_REQUEST['End_Time'];

$fa["Video_Text"]=$_POST["Video_Text"];

$fa["Image_Text"]=$_POST["Image_Text"];

$fa["Video_Embed"]=$_POST["Video_Embed"];

$fa["META_Title"]=$_POST["META_Title"];

$fa["META_Description"]=$_POST["META_Description"];

$fa["Parent"]=$_POST["Parent"];

$fa["META_Kerywords"]=$_POST["META_Kerywords"];

$fa["Protected"] = (isset($_POST['Protected'])) ? 1 : 0;


$fa["Username"]=$_POST["Username"];

$fa["Password"]=$_POST["Password"];

$fa["Top_Header_Height"]=$_POST["Top_Header_Height"];

$fa["UpdatedTime"]=time();


$fa["Show_On_Time"]=	($_POST["Show_On_Time"]?1:0);
$fa["Expire_On_Time"]=	($_POST["Expire_On_Time"]?1:0);


$fa["wm_template"]=$_POST["wm_template"];

$fa["header_type"]=$_POST["header_type"];

if($_POST["AudioFile"]){
    $fa["AudioFile"]=$_POST["AudioFile"];
}
/*
if($_POST["existing_AudioFile"]){
	$fa["AudioFile"]=$_POST["existing_AudioFile"];
}
*/

if($_POST["existing_File"]){
	$fa["File_Name"]=$_POST["existing_File"];
}

if($_POST["existing_Top_Header"]){
	$fa["Top_Header"]=$_POST["existing_Top_Header"];
}

if($_POST["existing_video_file"]){
	$fa["Video_Embed"]=$_POST["existing_video_file"];
}

if($_POST["existing_Top_Header2"]){
	$fa["Top_Header2"]=$_POST["existing_Top_Header2"];
}

if($_POST["existing_Top_Header3"]){
	$fa["Top_Header3"]=$_POST["existing_Top_Header3"];
}

if($_POST["existing_og_image"]){
	$fa["og_image"]=$_POST["existing_og_image"];
}

if($_POST["existing_bg_image"]){
	$fa["bg_image"]=$_POST["existing_bg_image"];
}

if($_POST["set_bg_color"]){
	$fa["bg_color"]=$_POST["bg_color"];
} else {
	$fa["bg_color"]=NULL;
}

if($_POST["existing_Menu_File"]){
	$fa["Menu_File"]=$_POST["existing_Menu_File"];
}

if($_POST["existing_Menu_File_Logo"]){
	$fa["Menu_File_Logo"]=$_POST["existing_Menu_File_Logo"];
}

if($_POST["existing_Menu_File_Selected"]){
	$fa["Menu_File_Selected"]=$_POST["existing_Menu_File_Selected"];
}

$fa["schema_markup"] = $_POST["schema_markup"];


$alias=$_REQUEST["Alias"];
if($alias){
	$alias=str_replace(" ", "-", $alias);
	$alias= $wm->removeDomainFromAlias($alias, $id);
	$alias=$wm->addDomainToAlias($alias, $fa['Parent']);
	$fa["Alias"]=		$alias;	
}else{
	$fa["Alias"]=		"";	
}


//TODO: update dynamic fields

/*need to do foreach on $_post and if the string 'dynamic_field' is found - update the value in the specific feild*/
/*first delete all values in wm_pages_dynamic_field_values related to this page*/
$db->runQuery("DELETE FROM wm_pages_dynamic_field_values WHERE wm_pages=".$id);
/*now check if fields have values and need to go into DB*/

$pageDynamicFields = $db->getArray('SELECT * FROM `wm_pages_dynamic_fields` WHERE `page_type` = '.$_REQUEST["Page_Type"].' ORDER BY `ID` DESC');


foreach ($pageDynamicFields as $key => $pageDynamicField) {
	if(isset($_POST['dynamic_field_'.$pageDynamicField['ID']])) {
		$value = $_POST['dynamic_field_'.$pageDynamicField['ID']];
	} else {
		$value = '';
	}
	
	$wm_pages_dynamic_field_values = [
		'Value'=>$value,
		'wm_pages'=>$id,
		'wm_forms_fields'=>$pageDynamicField['ID']];
	$db->updateData("wm_pages_dynamic_field_values",$wm_pages_dynamic_field_values);

	/*
	// Will update field default value
	$wm_pages_dynamic_fields = [
		'Value'=>$value,
	];
	$db->updateData("wm_pages_dynamic_fields",$wm_pages_dynamic_fields, $pageDynamicField['ID']);
	*/
}

/*
foreach ($_POST as $key => $value) {
	if(strpos($key,'dynamic_field') !== FALSE){//we found a dynamic field that was updated - now insert
		$fieldId = explode('dynamic_field_', $key);
		$fieldId = $fieldId[1];//the id of the field in db
		$dfValues = [
			'Value'=>$value,
			'wm_pages'=>$id,
			'wm_forms_fields'=>$fieldId];
		$df = [
			'Value'=>$value,
		];
		$db->updateData("wm_pages_dynamic_field_values",$dfValues);
		$db->updateData("wm_pages_dynamic_fields",$df, $fieldId);

	}
}
*/

/*need to update connected pages*/
/*first delete all values in wm_connected_pages_ids related to this page */

//-- $db->runQuery("DELETE FROM wm_connected_pages_ids WHERE wm_pages=".$id." OR wm_connected_wm_pages_ids=$id");


if(isset($_POST['connectedPages'])){//need to update pages

    $thisPageType = $db->getRow("SELECT Page_Type FROM wm_pages WHERE ID = $id");
    $_POST['connectedPages'] = array_unique($_POST['connectedPages'], SORT_REGULAR);
    foreach ($_POST['connectedPages'] as $page) {
        $pageType = $db->getRow("SELECT Page_Type FROM wm_pages WHERE ID = $page");
        $connectionExists = $db->getRow("SELECT wm_connected_wm_pages_ids FROM wm_connected_pages_ids WHERE wm_pages=$page AND wm_connected_wm_pages_ids=$id");
        $reverseConnectionExists = $db->getRow("SELECT wm_connected_wm_pages_ids FROM wm_connected_pages_ids WHERE wm_pages=$id AND wm_connected_wm_pages_ids=$page");
        // --------------------------------------------------------------------------------------------------------------------------
        $arr = array(
            'wm_pages'=>$page,
            'wm_connected_wm_pages_ids'=>$id,
            'wm_connected_page_type'=>$thisPageType['Page_Type']
        );
        if ($connectionExists) {                                                // page already connected - update pagetype
            $out = array();
            $query = "UPDATE wm_connected_pages_ids SET ";
            foreach ($arr as $key=>$val) $out[]="$key=".intval($val);
            $query .= implode(",",$out)." WHERE wm_pages=$page AND wm_connected_wm_pages_ids=$id";
            $db->runQuery($query);
        } else {                                                                // <-- page not connected, then add connection!
            $arr['Ordering'] = 99;
            $db->updateData("wm_connected_pages_ids", $arr);
        }
        // --------------------------------------------------------------------------------------------------------------------------
        $arr = array(
            'wm_pages'=>$id,
            'wm_connected_wm_pages_ids'=>$page,
            'wm_connected_page_type'=>$pageType['Page_Type']
        );
        if ($reverseConnectionExists) {                                         // page already connected - update pagetype
            $out = array();
            $query = "UPDATE wm_connected_pages_ids SET ";
            foreach ($arr as $key=>$val) $out[]="$key=".intval($val);
            $query .= implode(",",$out)." WHERE wm_pages=$id AND wm_connected_wm_pages_ids=$page";
            $db->runQuery($query);
        } else {                                                                // <-- page not connected, then add connection!
            $arr['Ordering'] = 99;
            $db->updateData("wm_connected_pages_ids", $arr);
        }
    }
    // step two - now get list of unique page IDs connected , and if something is found there that is not on our current array - delete it!
    $db_ids = array();
    $existing_ids = array();
    foreach ($_POST['connectedPages'] as $page) $existing_ids[$page] = 1;       // collect our existing connected pages
    $connectedPages = $db->getArray("SELECT wm_connected_wm_pages_ids FROM wm_connected_pages_ids WHERE wm_pages=$id");
    foreach ($connectedPages as $num=>$array) $db_ids[$array['wm_connected_wm_pages_ids']] = 1; // collect our database connections
    // now = move over existing connections, and remove them from the list of database connections.  this way we'll know what connections
    //       has to be removed from the DB
    foreach ($existing_ids as $existing_id=>$val) if ($db_ids[$existing_id]) unset($db_ids[$existing_id]);
    if ($db_ids) {                                                              // if there are still connections left in DB - delete them!
        foreach ($db_ids as $db_id=>$v) {
            $db->runQuery("DELETE FROM wm_connected_pages_ids WHERE wm_pages=$db_id AND wm_connected_wm_pages_ids=$id");
            $db->runQuery("DELETE FROM wm_connected_pages_ids WHERE wm_pages=$id AND wm_connected_wm_pages_ids=$db_id");
        }
    }
}else{
    //delete all connected pages
    $db_ids = array();
    $existing_ids = array();
    $connectedPages = $db->getArray("SELECT wm_connected_wm_pages_ids FROM wm_connected_pages_ids WHERE wm_pages=$id");
    foreach ($connectedPages as $num=>$array) $db_ids[$array['wm_connected_wm_pages_ids']] = 1; // collect our database connections
    // now = move over existing connections, and remove them from the list of database connections.  this way we'll know what connections
    //       has to be removed from the DB
    if ($db_ids) {                                                              // if there are still connections left in DB - delete them!
        foreach ($db_ids as $db_id=>$v) {
            $db->runQuery("DELETE FROM wm_connected_pages_ids WHERE wm_pages=$db_id AND wm_connected_wm_pages_ids=$id");
            $db->runQuery("DELETE FROM wm_connected_pages_ids WHERE wm_pages=$id AND wm_connected_wm_pages_ids=$db_id");
        }
    }
}




$check_inputs = array(
        array("string255"=>$fa["Name"]),
        array("string255"=>$fa["domain"]),
        array("string255"=>$fa["Color"]),
        array("number"=>$fa["price"]),
        array("number"=>$fa["quantity"]),
        array("number"=>$fa["noindex"]),
        array("string255"=>$fa["canonical"]),
        array("number"=>$fa["moved_type"]),
        array("text"=>$fa["alternate"]),
        array("number"=>$fa["wm_landing_pages_customers"]),
        array("number"=>$fa["wm_forms"]),
        array("string255"=>$fa["Menu_Name"]),
        array("number"=>$fa["Ordering"]),
        array("number"=>$fa["max_participants"]),
        array("number"=>$fa["City"]),
        array("number"=>$fa["Special"]),
        array("number"=>$fa["show_in_block"]),
        array("number"=>$fa["event_price"]),
        array("string255"=>$fa["event_currency"]),
        array("number"=>$fa["wm_doctor_title"]),
        array("string1000"=>$fa["wm_doctor_expertise"]),
        array("number"=>$fa["show_doc_gallery"]),
        array("number"=>$fa["show_extended"]),
        array("number"=>$fa["ShowOnHomepage"]),
        array("number"=>$fa["ShowOnTicker"]),
        array("number"=>$fa["rss"]),
        array("number"=>$fa["AddThis"]),
        array("number"=>$fa["cancel_event"]),
        array("number"=>$fa["facebook_comments"]),
        array("number"=>$fa["facebook_like"]),
        array("number"=>$fa["wm_categories"]),
        array("string255"=>$fa["checkbox_line"]),
        array("text"=>$fa["Answer_Text"]),
        array("string255"=>$fa["Comments"]),
        array("number"=>$fa["Enable_Dropdown"]),
        array("number"=>$fa["vertical_images"]),
        array("number"=>$fa["hide_banners"]),
        array("number"=>$fa["Enable_SideContent"]),
        array("number"=>$fa["dontShowInUnitsSearch"]),
        array("string10"=>$fa["Open_In"]),
        array("text"=>$fa["Conversion"]),
        array("text"=>$fa["custom_class"]),
        array("string255"=>$fa["Author"]),
        array("text"=>$fa["Sub_Title"]),
        array("text"=>$fa["External_Sub_Title"]),
        array("url"=>$fa["Link"]),
        array("string255"=>$fa["Email"]),
        array("text"=>$fa["Scroller"]),
        array("text"=>$fa["Content"]),
        array("text"=>$fa["Content_Center"]),
        array("text"=>$fa["Menu_File_Text"]),
        array("number"=>$fa["Menu_File_Display_Mode"]),
        array("text"=>$fa["Content_Bottom"]),
        array("string10"=>$fa["Lang"]),
        array("number"=>$fa["Hide_On_Menu"]),
        array("number"=>$fa["Page_Type"]),
        array("number"=>$fa["Secondary_Page_Type"]),
        array("string255"=>$fa["Start_Date"]),
        array("string255"=>$fa['YearMonth']),
        array("string255"=>$fa['End_Date']),
        array("string10"=>$fa['Start_Time']),
        array("string10"=>$fa['End_Time']),
        array("string255"=>$fa["Video_Text"]),
        array("string255"=>$fa["Image_Text"]),
        array("string255"=>$fa["Video_Embed"]),
        array("string255"=>$fa["META_Title"]),
        array("string255"=>$fa["META_Description"]),
        array("number"=>$fa["Parent"]),
        array("string255"=>$fa["META_Kerywords"]),
        array("number"=>$fa["Protected"]),
        array("string255"=>$fa["Username"]),
        array("string255"=>$fa["Password"]),
        array("number"=>$fa["Top_Header_Height"]),
        array("number"=>$fa["UpdatedTime"]),
        array("number"=>$fa["Show_On_Time"]),
        array("number"=>$fa["Expire_On_Time"]),
        array("number"=>$fa["wm_template"]),
        array("string255"=>$fa["Email_Address"]),
        array("string255"=>$fa["Email_Subject"]),
        array("string255"=>$fa["Email_Body"]),
	array("string255"=>$fa["AudioFile"]),
	array("string255"=>$fa["File_Name"]),
	array("string255"=>$fa["File_Name_Second"]),
	array("string255"=>$fa["Top_Header"]),
	array("string255"=>$fa["Top_Header2"]),
	array("string255"=>$fa["Top_Header3"]),
        array("string255"=>$fa["Top_Header_Alt"]),
        array("string255"=>$fa["Top_Header2_Alt"]),
        array("string255"=>$fa["Top_Header3_Alt"]),
	array("string255"=>$fa["Menu_File"]),
        array("string255"=>$fa["Menu_File_Alt"]),
        array("string255"=>$fa["Menu_File_Logo"]),
	array("string255"=>$fa["Menu_File_Selected"]),
    array("string255"=>$fa["og_image"]),
    array("string255"=>$fa["bg_color"]),
    array("text"=>$fa["bg_image"])
);

$secureTexts = new secure_inputs();
$error = $secureTexts->isNotSecure($check_inputs);

// if ($error) die($error);

if($error){
    $errorPath = "location: ../../gui/index.php?show=pages/page_edit&id=".$id."&display=".$_POST["submitDisplay"]."&page=".$page."&error=".base64_encode($error);
    header($errorPath);
    exit;
}

//	update versions table
$versionsFa=$fa;
$versionsFa["wm_pages"]=$id;

$versionId=$_POST["versionId"];
if(!$versionId || !$_POST["preview"]){
	$versionId=$wmVersions->add();
}
$wmVersions->setValues($versionId, $versionsFa);


$fa["wm_pages_versions"]=$versionId;

$file=new File();

if($_POST["delete_AudioFile"]){

	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("AudioFile"=>NULL));
	}else{
		//$wm->setValues($id, array("AudioFile"=>NULL));
		$wmVersions->setValues($versionId, array("AudioFile"=>NULL));
	}
	if($_POST["existing_AudioFile"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/audio_files/".$_POST["existing_AudioFile"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}

if($_POST["delete_File"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("File_Name"=>NULL));
	}else{
		//$wm->setValues($id, array("File_Name"=>NULL));
		$wmVersions->setValues($versionId, array("File_Name"=>NULL));
	}
	if($_POST["existing_File"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/files/".$_POST["existing_File"];
		$full_file_path="../../../".$file_path;
        $wmVersions->setValues($versionId, array("Alias"=>NULL));
	}	
}

if($_POST["delete_Top_Header"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Top_Header"=>NULL));
	}else{
		//$wm->setValues($id, array("Top_Header"=>NULL));
		$wmVersions->setValues($versionId, array("Top_Header"=>NULL));
	}

	if($_POST["existing_Top_Header"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/headers/".$_POST["existing_Top_Header"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}

if($_POST["delete_Video_Embed"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Video_Embed"=>NULL));
	}else{
		$wmVersions->setValues($versionId, array("Video_Embed"=>NULL));
	}

	if($_POST["existing_Top_Header"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/videos/".$_POST["existing_video_file"];
		$full_file_path="../../../".$file_path;
	}	
}


if($_POST["delete_Top_Header2"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Top_Header2"=>NULL));
	}else{
		//$wm->setValues($id, array("Top_Header2"=>NULL));
		$wmVersions->setValues($versionId, array("Top_Header2"=>NULL));
	}

	if($_POST["existing_Top_Header2"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/headers2/".$_POST["existing_Top_Header2"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}


if($_POST["delete_Top_Header3"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Top_Header3"=>NULL));
	}else{
		//$wm->setValues($id, array("Top_Header3"=>NULL));
		$wmVersions->setValues($versionId, array("Top_Header3"=>NULL));
	}

	if($_POST["existing_Top_Header3"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/headers3/".$_POST["existing_Top_Header3"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}

if($_POST["delete_og_image"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("og_image"=>NULL));
	}else{
		//$wm->setValues($id, array("og_image"=>NULL));
		$wmVersions->setValues($versionId, array("og_image"=>NULL));
	}

	if($_POST["existing_og_image"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/og_images/".$_POST["existing_og_image"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}

if($_POST["delete_bg_image"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("bg_image"=>NULL));
	}else{
		//$wm->setValues($id, array("og_image"=>NULL));
		$wmVersions->setValues($versionId, array("bg_image"=>NULL));
	}

	if($_POST["existing_bg_image"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/bg_images/".$_POST["existing_bg_image"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}

if($_POST["delete_Menu_File"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Menu_File"=>NULL));
	}else{
		//$wm->setValues($id, array("Top_Header3"=>NULL));
		$wmVersions->setValues($versionId, array("Menu_File"=>NULL));
	}

	if($_POST["existing_Menu_File"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/Menu_File/".$_POST["existing_Menu_File"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}

if($_POST["delete_Menu_File_Logo"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Menu_File_Logo"=>NULL));
	}else{
		//$wm->setValues($id, array("Top_Header3"=>NULL));
		$wmVersions->setValues($versionId, array("Menu_File_Logo"=>NULL));
	}

	if($_POST["existing_Menu_File_Logo"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/Menu_File_Logo/".$_POST["existing_Menu_File_Logo"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}

if($_POST["delete_Menu_File_Selected"]){
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Menu_File_Selected"=>NULL));
	}else{
		//$wm->setValues($id, array("Top_Header3"=>NULL));
		$wmVersions->setValues($versionId, array("Menu_File_Selected"=>NULL));
	}

	if($_POST["existing_Menu_File_Selected"]){
		$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/Menu_File_Selected/".$_POST["existing_Menu_File_Selected"];
		$full_file_path="../../../".$file_path;
		//unlink($full_file_path);
	}	
}


if(is_uploaded_file($_FILES['Menu_File']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/Menu_File/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['Menu_File']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	//$file_name="header_".$id."_".md5(time())."_.".$real_file_ext;
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;

	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Menu_File"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("Top_Header"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("Menu_File"=>$file_path.$file_name));
	}

	
	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['Menu_File']['tmp_name'], $full_file_path.$file_name);
	//chmod($full_file_path.$file_name, 0777);


	//$file->resizeImage($file_name, $full_file_path, 600, 200);

}

if(is_uploaded_file($_FILES['Menu_File_Logo']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/Menu_File_Logo/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['Menu_File_Logo']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	//$file_name="header_".$id."_".md5(time())."_.".$real_file_ext;
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;

	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Menu_File_Logo"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("Top_Header"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("Menu_File_Logo"=>$file_path.$file_name));
	}

	
	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['Menu_File_Logo']['tmp_name'], $full_file_path.$file_name);
	//chmod($full_file_path.$file_name, 0777);


	//$file->resizeImage($file_name, $full_file_path, 600, 200);

}

if(is_uploaded_file($_FILES['Menu_File_Selected']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/Menu_File_Selected/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['Menu_File_Selected']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	//$file_name="header_".$id."_".md5(time())."_.".$real_file_ext;
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;

	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Menu_File_Selected"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("Top_Header"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("Menu_File_Selected"=>$file_path.$file_name));
	}	

	
	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['Menu_File_Selected']['tmp_name'], $full_file_path.$file_name);
	chmod($full_file_path.$file_name, 0777);


	//$file->resizeImage($file_name, $full_file_path, 600, 200);

}



if(is_uploaded_file($_FILES['header_file']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/headers/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['header_file']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	//$file_name="header_".$id."_".md5(time())."_.".$real_file_ext;
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
    $eladTopHeader = $file_path.$file_name;
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Top_Header"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("Top_Header"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("Top_Header"=>$file_path.$file_name));
	}	

	
	$file->checkPath($full_file_path);

	$filesize = filesize($_FILES['header_file']['tmp_name']);
		if($filesize > 200000){ 
			die("THE INNER IMAGE YOU UPLOADED IS MORE THEN 200KB. PLEASE UPLOAD LESS THEN 200KB.");
		} else {
			move_uploaded_file($_FILES['header_file']['tmp_name'], $full_file_path.$file_name);
			chmod($full_file_path.$file_name, 0777);
		}
	
	//$file->resizeImage($file_name, $full_file_path, 600, 200);

}

if(is_uploaded_file($_FILES['video_file']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/videos/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['video_file']['name'];

	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";

	if ($extension != '.mp4') {
		die("THE VIDEO FILE YOU UPLOADED IS NOT IN MP4 FORMAT. PLEASE UPLOAD VIDEO IN MP4.");
	} else {
		$file_name=md5(time()).$extension;
		$eladTopHeader = $file_path.$file_name;
		if($_POST["preview"]){
			$wmVersions->setValues($versionId, array("Video_Embed"=>$file_path.$file_name));
		}else{
			$wmVersions->setValues($versionId, array("Video_Embed"=>$file_path.$file_name));
		}	
	
		$file->checkPath($full_file_path);
		
		/* CHECK IF FILE IS MORE THEN X */
		$filesize = filesize($_FILES['video_file']['tmp_name']);
		if($filesize > 8000000){ //5000000 -> 5MB
			die("THE VIDEO FILE YOU UPLOADED IS MORE THEN 8MB. PLEASE UPLOAD LESS THEN 8MB.");
		} else {
			move_uploaded_file($_FILES['video_file']['tmp_name'], $full_file_path.$file_name);
			chmod($full_file_path.$file_name, 0777);
		}
	}
}




if($_POST["selectionParams"]){
	//$full_file_path="../../../";
	//$file->cropImage($_POST["existing_Top_Header"], $full_file_path, $_POST["selectionParams"]);
}

if(is_uploaded_file($_FILES['header_file2']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/headers2/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['header_file2']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	//$file_name="header_".$id."_".md5(time())."_.".$real_file_ext;
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
	
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Top_Header2"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("Top_Header2"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("Top_Header2"=>$file_path.$file_name));
	}	

	//$wm->setValues($id, array("Top_Header2"=>$file_path.$file_name));


	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['header_file2']['tmp_name'], $full_file_path.$file_name);
	chmod($full_file_path.$file_name, 0777);

	//$file->resizeImage($file_name, $full_file_path, 800, 600);
}

if(is_uploaded_file($_FILES['header_file3']['tmp_name'])){
	
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/headers3/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['header_file3']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	//$file_name="header_".$id."_".md5(time())."_.".$real_file_ext;
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
	
	//$wm->setValues($id, array("Top_Header3"=>$file_path.$file_name));

	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Top_Header3"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("Top_Header3"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("Top_Header3"=>$file_path.$file_name));
	}


	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['header_file3']['tmp_name'], $full_file_path.$file_name);
	chmod($full_file_path.$file_name, 0777);

	//$file->resizeImage($file_name, $full_file_path, 800, 600);



}

if(is_uploaded_file($_FILES['og_image']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/og_images/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['og_image']['name'];
	
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
	
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("og_image"=>$file_path.$file_name));
	}else{
		$wmVersions->setValues($versionId, array("og_image"=>$file_path.$file_name));
	}	

	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['og_image']['tmp_name'], $full_file_path.$file_name);
	chmod($full_file_path.$file_name, 0777);
}

if(is_uploaded_file($_FILES['background_image']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/fck/image/bg_images/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['background_image']['name'];
	
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
	
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("bg_image"=>$file_path.$file_name));
	}else{
		$wmVersions->setValues($versionId, array("bg_image"=>$file_path.$file_name));
	}	

	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['background_image']['tmp_name'], $full_file_path.$file_name);
	chmod($full_file_path.$file_name, 0777);
}



if(is_uploaded_file($_FILES['Menu_File']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/menu_files/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['Menu_File']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
	
	//$wm->setValues($id, array("Menu_File"=>$file_path.$file_name));
	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("Menu_File"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("Menu_File"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("Menu_File"=>$file_path.$file_name));
	}
	

	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['Menu_File']['tmp_name'], $full_file_path.$file_name);
	chmod($full_file_path.$file_name, 0777);
}

if(is_uploaded_file($_FILES['AudioFile']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/audio_files/";
	$full_file_path="../../../".$file_path;
	
	$real_file_name=$_FILES['AudioFile']['name'];

	list($real_file_name1, $real_file_ext)=explode("[.]", $real_file_name);
	$real_file_name1=str_replace(" ", "_", $real_file_name);
	//$file_name=$real_file_name1."_".md5(time())."_.".strtolower($real_file_ext);
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
	
	//$wm->setValues($id, array("AudioFile"=>$file_path.$file_name));

	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("AudioFile"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("AudioFile"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("AudioFile"=>$file_path.$file_name));
	}

	$file->checkPath($full_file_path);

	move_uploaded_file($_FILES['AudioFile']['tmp_name'], $full_file_path.$file_name);
	chmod($full_file_path.$file_name, 0777);
}

if(is_uploaded_file($_FILES['File']['tmp_name'])){
	$file_path=$cfg["WM"]["File_Uploades_Folder"]."/files/";
	$full_file_path="../../../".$file_path;
	
	
	
	$real_file_name=$_FILES['File']['name'];
	//$real_file_name=explode("[.]", $real_file_name);
	//$real_file_ext=$real_file_name[count($real_file_name)-1];
	
	//$file_name="header_"."_".md5(time())."_.".".".$real_file_ext;
	$extension = end(explode(".", $real_file_name));
    $extension = $extension ? ".".$extension : "";
    $file_name=md5(time()).$extension;
	
	//$wm->setValues($id, array("File_Name"=>$file_path.$file_name));

	if($_POST["preview"]){
		$wmVersions->setValues($versionId, array("File_Name"=>$file_path.$file_name));
	}else{
		//$wm->setValues($id, array("File_Name"=>$file_path.$file_name));
		$wmVersions->setValues($versionId, array("File_Name"=>$file_path.$file_name));
	}

	$file->checkPath($full_file_path);
	
	move_uploaded_file($_FILES['File']['tmp_name'], $full_file_path.$file_name);
	//chmod($full_file_path.$file_name, 0777);
        
        $pathinfo=pathinfo($full_file_path.$file_name);
        //$fa["Alias"]=$fa["ID"].".".$pathinfo['extension'];
        $alias=$wm->addDomainToAlias($id.".".$pathinfo['extension'], $id);
        
        $wm->setValues($id, array("Alias"=>$alias));
        $wmVersions->setValues($versionId, array("Alias"=>$alias));
}



if($id && !$eladTopHeader){
	$wmPageTopHeader=$wm->get($id, "Top_Header");
	if($wmPageTopHeader){
		$eladTopHeader=$wmPageTopHeader;
	}	
}


/*after submit edit page - we update the email in elad servers - if the page is connected to a from - the form will send to email to elad*/

if ($fa["Page_Type"]==98) {                         // if its an event ..
    
    $elad = new EladIntegration();
    if($fa['Email_Address']=='')
    {
        $fa['Email_Address']="Marketing@sheba.health.gov.il";
    }
    $formPage = $wm->getIdByPageType("6", $fa['Lang']);
    $event = array(
        "ID"                => $id,
        "Alias"             => $fa['Alias'],
        "Name"              => $fa['Name'],
        "Sub_Title"         => $fa['Sub_Title'],
        "Content"           => $fa['Content'],
        "Content_Center"    => $fa['Content_Center'],
        "Lang"              => $fa['Lang'],
        "Top_Header"        => $cfg["WM"]["Server"]."/".$eladTopHeader,
        "UpdatedTime"       => time(),
        "Event_Currency"    => $fa['event_currency'],
        "Event_Price"       => $fa['event_price'],
        "Sheba_Yashir"      => $fa['is_sheba_yashir'],      // put 1 if its sheba yashir, and 0 if not
        "EMailAddress"      => $fa['Email_Address'],
        "EMailSubject"      => $fa['Email_Subject'],
        "EMailBody"         => $fa['Email_Body'],
        "EventType_ID"      => 1,
        "Event_URL"         => $cfg["WM"]["Server"]."/item/".$formPage."/".$fa["Page_Type"]."/".$id,
    );

    $elad->update_event($event, $id);
    $old_cancel_event_mode=$wm->get($id, "cancel_event");
    if($fa["cancel_event"]==1 && $old_cancel_event_mode==0){
        $elad->delete_event($id);
    }
}elseif($fa["Page_Type"]==116 || $fa["Page_Type"]==115){/*sends to elad donation*/

     if($fa['Email_Address']=='')
    {
        $fa['Email_Address']="Marketing@sheba.health.gov.il";
    }
    $elad = new EladIntegration();

    $event = array(
        "ID"                => $id,
        "Alias"             => $fa['Alias'],
        "Name"              => $fa['Name'],
        "Sub_Title"         => $fa['Sub_Title'],
        "Content"           => $fa['Content'],
        "Content_Center"    => $fa['Content_Center'],
        "Lang"              => $fa['Lang'],
        "Top_Header"        => $cfg["WM"]["Server"]."/".$eladTopHeader,
        "UpdatedTime"       => time(),
        "Event_Currency"    => $fa['event_currency'],
        "Event_Price"       => $fa['event_price'],
        "Sheba_Yashir"      => $fa['is_sheba_yashir'],      // put 1 if its sheba yashir, and 0 if not
        "EMailAddress"      => $fa['Email_Address'],
        "EMailSubject"      => $fa['Email_Subject'],
        "EMailBody"         => $fa['Email_Body'],
        "EventType_ID"      => 3,
        "Event_URL"         => $cfg["WM"]["Server"]."/item/".$formPage."/".$fa["Page_Type"]."/".$id,
    );
    $elad->update_event($event, $id);


}elseif (($fa["Page_Type"]==1 || $fa["Page_Type"]==161) && $fa['wm_forms']!=0 || $fa["Page_Type"]==95 && $fa['wm_forms']!=0 || 
    ($getParams[0]=="item" && $getParams[1]=="57328") || ($getParams[0]=="57328")){                         // if its no an event ..
     if($fa['Email_Address']=='')
    {
        $fa['Email_Address']="Marketing@sheba.health.gov.il";
    }
    $elad = new EladIntegration();
    $formPageId=$wm->getIdByPageType(6);
    $formPageData=$wm->getValues($formPageId);
    $formLink=$wm->getLink($formPageData);
    $thisPageAlias=$fa['ID'];
    if($fa["Alias"]){
        $pageAliasUrl=explode("/", $fa["Alias"]);
        $thisPageAlias=end($pageAliasUrl);
    }

	if ($fa["Page_Type"]==161) {
		$id = intval($_REQUEST["id"]);
	}

    $event = array(
        "ID"                => $id,
        "Alias"             => $fa['Alias'],
        "Name"              => $fa['Name'],
        "Sub_Title"         => $fa['Sub_Title'],
        "Content"           => $fa['Content'],
        "Content_Center"    => $fa['Content_Center'],
        "Lang"              => $fa['Lang'],
        "Top_Header"        => $cfg["WM"]["Server"]."/".$eladTopHeader,
        "UpdatedTime"       => time(),
        "Event_Currency"    => $fa['event_currency'],
        "Event_Price"       => $fa['event_price'],
        "Sheba_Yashir"      => $fa['is_sheba_yashir'],      // put 1 if its sheba yashir, and 0 if not
        "EMailAddress"      => $fa['Email_Address'],
        "EMailSubject"      => $fa['Email_Subject'],
        "EMailBody"         => $fa['Email_Body'],
        "EventType_ID"      => 2,
        "Event_URL"         => $formLink["Link"]."/שיבא/".$thisPageAlias,
    );

    $isSent=$elad->update_event($event, $id);
    
}



if(!$_POST["preview"]){
	$faWmPages=$wmVersions->getValues($versionId);
	$faWmPages["ID"]=			$faWmPages["wm_pages"];
	$faWmPages["wm_pages_versions"]=	$versionId;
	unset($faWmPages["wm_pages"]);



	$wm->setValues($id, $faWmPages)."--";
}



$parent=$wm->getParent($id);

$log->write("Page edited: '".$fa["Name"]."' id: ".$id." parent: ".$parent, "edit");



if($_REQUEST["page"]){
	$page=$_REQUEST["page"];
}else{
	$page=1;
}

if($_POST["preview"]){
	header("location: ../../gui/index.php?show=pages/page_edit&version=".$versionId."&id=".$id."&display=1&page=".$page);
	exit;	
}

if($_POST["submitReturn"]){
	header("location: ../../gui/index.php?show=pages/pages&id=".$parent."&page=".$page);
	exit;
}else{
	header("location: ../../gui/index.php?show=pages/page_edit&id=".$id."&display=".$_POST["submitDisplay"]."&page=".$page);
	exit;
}

//$respond=$id;
//require_once("../xml/responder.php");

?>
