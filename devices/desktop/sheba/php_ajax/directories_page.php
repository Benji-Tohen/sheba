<?php
 
/*$params=new Parameters($db);*/
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);
/*need to decide if general wm_pages_dynamic_field_values.Value or by field type - for example - ID = 16 wich is last name */
if(isset($_POST['searchedAlpha'])){/*search by first letter of name*/
    $firstLetter = $_POST['searchedAlpha'];

    $query = "SELECT DISTINCT wm_phones.Name, wm_phones.AudioFile FROM wm_phones 
          WHERE wm_phones.Name LIKE '".mysqli_real_escape_string($db->conn,$firstLetter)."%'";

    
}else{/*regular 3 fields search*/
    $searchedName  = $_POST['searchedName'];
    /*$searchByMedDomain = ($_POST['searchByMedDomain'] == '' ? '': " AND wm_pages.wm_doctor_expertise = ".intval($_POST['searchByMedDomain']));
    $searchByUnit = ($_POST['searchByUnit'] == '' ? '': " AND wm_connected_pages_ids.wm_connected_wm_pages_ids = ".intval($_POST['searchByUnit']));*/
    

    $query = "SELECT * FROM wm_phones WHERE wm_phones.Name LIKE '%$searchedName%'";

}


$arrUnits=$db->getArray($query);
for($i=0;$i<count($arrUnits);$i++){?>
	<?php /*$link=$wm->getLink($arrUnits[$i]);*/?>
	<?php include(dirname(__FILE__)."/../php_html/directories_page.php");?>
<?php }?>
