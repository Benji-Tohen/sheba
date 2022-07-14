<?php
 
/*$params=new Parameters($db);*/
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);
/*need to decide if general wm_pages_dynamic_field_values.Value or by field type - for example - ID = 16 wich is last name */
if(isset($_POST['searchedAlpha'])){/*search by first letter of name*/
    $firstLetter = $_POST['searchedAlpha'];
    $query = "SELECT DISTINCT wm_pages.Name, wm_pages.Top_Header, wm_pages.ID, wm_pages.AudioFile FROM wm_pages 
          WHERE wm_pages.Name LIKE '".mysqli_real_escape_string($db->conn, $firstLetter)."%'
          AND wm_pages.Page_Type = 95
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0
          ";

    
}else{/*regular 3 fields search*/
    $searchedName  = $_POST['searchedName'];
    /*$searchByMedDomain = ($_POST['searchByMedDomain'] == '' ? '': " AND wm_pages.wm_doctor_expertise = ".intval($_POST['searchByMedDomain']));
    $searchByUnit = ($_POST['searchByUnit'] == '' ? '': " AND wm_connected_pages_ids.wm_connected_wm_pages_ids = ".intval($_POST['searchByUnit']));*/
    
    $query = "SELECT DISTINCT wm_pages.Name, wm_pages.Top_Header,wm_pages.AudioFile, wm_pages.ID FROM wm_pages";
          $query.=" WHERE wm_pages.Name LIKE '%".mysqli_real_escape_string($db->conn, $searchedName)."%' OR wm_pages.Sub_Title LIKE '%".mysqli_real_escape_string($db->conn, $searchedName)."%'";
          $query.=" AND wm_pages.Page_Type = 95 ";
          $query.=" AND wm_pages.Hide_On_Menu = 0 AND wm_pages.Deleted = 0";
}


$arrUnits=$db->getArray($query);

for($i=0;$i<count($arrUnits);$i++){?>
	<?php $link=$wm->getLink($arrUnits[$i]);?>
	<?php include(dirname(__FILE__)."/../php_html/directories_page.php");?>
<?php }?>
