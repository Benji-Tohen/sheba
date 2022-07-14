<?php
 
/*$params=new Parameters($db);*/
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);
/*need to decide if general wm_pages_dynamic_field_values.Value or by field type - for example - ID = 16 wich is last name */
if(isset($_POST['searchedAlpha'])){/*search by first letter of name*/
    $firstLetter = $_POST['searchedAlpha'];
    $query = "SELECT DISTINCT wm_pages.Name, wm_pages.Top_Header, wm_pages.ID FROM wm_pages 
          WHERE  (wm_pages.Name LIKE '".mysqli_real_escape_string($db->conn,$firstLetter)."%'
          AND wm_pages.Page_Type = 112
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0)
          ";
    
}else{/*regular 3 fields search*/
    $query = "SELECT DISTINCT wm_pages.Name, wm_pages.Top_Header, wm_pages.ID FROM wm_pages 
          WHERE  (wm_pages.Name LIKE '%".mysqli_real_escape_string($db->conn,$firstLetter)."%' OR wm_pages.Content LIKE '%".mysqli_real_escape_string($db->conn,$firstLetter)."%')
          AND wm_pages.Page_Type = 112
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0
          ";
}


$arrAllDoctors=$db->getArray($query);

for($i=0;$i<count($arrAllDoctors);$i++){?>
	<?php $link=$wm->getLink($arrAllDoctors[$i]);?>
	<?php include(dirname(__FILE__)."/../php_html/bdikot.php");?>
<?php }?>
