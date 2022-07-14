<?php
 /*in prod 141 - in dev - 134*/
/*$params=new Parameters($db);*/
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);
/*need to decide if general wm_pages_dynamic_field_values.Value or by field type - for example - ID = 16 wich is last name */
if(isset($_POST['searchedAlpha'])){/*search by first letter of name*/
    $firstLetter = $_POST['searchedAlpha'];
    $query = "SELECT DISTINCT wm_pages.Name, wm_pages.Top_Header, wm_pages.ID, wm_pages.Page_Type, wm_pages.Parent FROM wm_pages 
          WHERE  (wm_pages.Name LIKE '".mysqli_real_escape_string($db->conn,$firstLetter)."%'
          AND (wm_pages.Page_Type = 112 OR wm_pages.Page_Type = 141 OR wm_pages.Page_Type = 134 )
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0)
          ";
    

} else if(isset($_POST['searchFor']) && $_POST['searchFor'] == "all") {
    $query = "SELECT DISTINCT wm_pages.Name, wm_pages.Top_Header, wm_pages.ID, wm_pages.Page_Type, wm_pages.Parent FROM wm_pages 
          WHERE (wm_pages.Page_Type = 112 OR wm_pages.Page_Type = 141 OR wm_pages.Page_Type = 134)
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0
          ";
}else{/*regular 3 fields search*/

    if(mb_strlen($_POST['searchedName'],'UTF-8')<3){
        echo "<h3>".$trans->getText("please insert at least 3 characters")."</h3>";
        exit;
    }

    $query = "SELECT DISTINCT wm_pages.Name, wm_pages.Top_Header, wm_pages.ID, wm_pages.Page_Type, wm_pages.Parent FROM wm_pages 
          WHERE  ((wm_pages.Name LIKE '%".mysqli_real_escape_string($db->conn,$_POST['searchedName'])."%') OR (wm_pages.META_Description LIKE '%".mysqli_real_escape_string($db->conn,$_POST['searchedName'])."%'))
          AND ( wm_pages.Page_Type = 134)
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0
          ";
}


$arrAllDoctors=$db->getArray($query);

if(count($arrAllDoctors)==0){
    echo "<h3>".$trans->getText("no bdikot results found")."</h3>";
        exit;
}

/*foreach ($arrAllDoctors as $key => $value) {
    // If children of bdika_test page (141), get original bdika_test_page instead
    if($value["Page_Type"] == 1){
        $itemParent = $wm->getValues($value["Parent"]);
        if($itemParent["Page_Type"] == 141 || $itemParent["Page_Type"] == 134){
            $arrAllDoctors[$key] = $wm->getValues($value["Parent"]);
        } else {
            unset($arrAllDoctors[$key]);
        }
    }
}*/


for($i=0;$i<count($arrAllDoctors);$i++){
    /*dont show "ghost" items*/
    if($arrAllDoctors[$i]['ID']==0){
        continue;
    } 
    ?>
	<?php $link=$wm->getLink($arrAllDoctors[$i]);?>
	<?php include(dirname(__FILE__)."/../php_html/bdikot.php");?>
<?php }?>
