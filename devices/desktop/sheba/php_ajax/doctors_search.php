<?php
/*$params=new Parameters($db);*/
$wm = new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans = new Translate($db, $_SESSION["WM"]["Lang"]);

$parentPageId = intval($_POST['parentPageId']);

/*if we have in post search only specialist - add it to sql query*/
if (intval($_POST['search_only_specialist_doctors']) > 0) {
  $andQuery = " AND wm_pages.is_specialist_doctor = 1 ";
} else {
  $andQuery = "  ";
}

if ($homePageId == 2 || $homePageId == 2374) {
  if (isset($_POST['searchedAlpha'])) {/*search by first letter of name*/
    $firstLetter = $_POST['searchedAlpha'];
    $query = "SELECT DISTINCT wm_pages.ID,wm_pages.wm_doctor_title, wm_pages.Top_Header, dy1.VALUE AS firtsName,dy1.wm_forms_fields AS type1, dy2.value as lastName,dy2.wm_forms_fields AS type2  FROM wm_pages 
          INNER JOIN wm_pages_dynamic_field_values
          ON wm_pages.ID = wm_pages_dynamic_field_values.wm_pages
          INNER JOIN wm_pages_dynamic_fields
          ON wm_pages_dynamic_fields.ID = wm_pages_dynamic_field_values.wm_forms_fields
          JOIN wm_pages_dynamic_field_values as dy1 ON dy1.wm_pages = wm_pages.ID 
          JOIN wm_pages_dynamic_field_values as dy2 on dy2.wm_pages = wm_pages.ID
          WHERE ( (dy2.value LIKE '" . mysqli_real_escape_string($db->conn, $firstLetter) . "%')
          OR (dy1.value LIKE '" . mysqli_real_escape_string($db->conn, $firstLetter) . "%') )"
      . "AND wm_pages.Page_Type = 96
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0
          AND dy1.wm_forms_fields=15 
          AND dy2.wm_forms_fields=16 
          AND wm_pages.Parent =" . $parentPageId . "
          ORDER BY dy2.value,dy1.value ASC";

  } else {/*regular 3 fields search*/
    $searchedName = ($_POST['searchedName'] == '' ? '' : " AND (wm_pages_dynamic_field_values.Value LIKE '%" . mysqli_real_escape_string($db->conn, $_POST['searchedName']) . "%' OR wm_pages.Name LIKE '%" . mysqli_real_escape_string($db->conn, $_POST['searchedName']) . "%')");
    $searchByMedDomain = ($_POST['searchByMedDomain'] == '' ? '' : " AND wm_pages.wm_doctor_expertise = " . intval($_POST['searchByMedDomain']));
    $searchByUnit = ($_POST['searchByUnit'] == '' ? '' : " AND wm_connected_pages_ids.wm_connected_wm_pages_ids = " . intval($_POST['searchByUnit']));

    $query = "SELECT DISTINCT wm_pages.ID,wm_pages.wm_doctor_title,wm_pages.Name, wm_pages.Top_Header, wm_pages.is_specialist_doctor, dy1.VALUE AS firtsName,dy1.wm_forms_fields AS type1, dy2.value as lastName,dy2.wm_forms_fields AS type2 
    FROM wm_pages
    JOIN wm_pages_dynamic_field_values as dy1 ON dy1.wm_pages = wm_pages.ID 
    JOIN wm_pages_dynamic_field_values as dy2 on dy2.wm_pages = wm_pages.ID";
    if ($_POST['searchedName'] != '') {
      $query .= ' INNER JOIN wm_pages_dynamic_field_values
                    ON wm_pages.ID = wm_pages_dynamic_field_values.wm_pages
                    ';
    }
    if ($_POST['searchByMedDomain'] != '') {
      $query .= " INNER JOIN wm_doctor_expertise
                       ON wm_doctor_expertise.ID = wm_pages.wm_doctor_expertise";
    }
    if ($_POST['searchByUnit'] != '') {
      $query .= " INNER JOIN wm_connected_pages_ids
                       ON wm_connected_pages_ids.wm_pages = wm_pages.ID";
    }
    $query .= " WHERE wm_pages.Page_Type = 96 " . $searchedName . $searchByMedDomain . $searchByUnit;
    $query .= $andQuery;
    $query .= " AND wm_pages.Hide_On_Menu = 0 AND wm_pages.Deleted = 0 AND dy1.wm_forms_fields=15 AND dy2.wm_forms_fields=16 AND wm_pages.Parent =" . $parentPageId . " ORDER BY dy2.value,dy1.value ASC";
  }
} else {
  if (isset($_POST['searchedAlpha'])) {/*search by first letter of name*/
    $firstLetter = $_POST['searchedAlpha'];
    $query = "SELECT DISTINCT wm_pages.ID,wm_pages.wm_doctor_title, wm_pages.Top_Header, dy1.VALUE AS firtsName,dy1.wm_forms_fields AS type1, dy2.value as lastName,dy2.wm_forms_fields AS type2  FROM wm_pages 
          INNER JOIN wm_pages_dynamic_field_values
          ON wm_pages.ID = wm_pages_dynamic_field_values.wm_pages
          INNER JOIN wm_pages_dynamic_fields
          ON wm_pages_dynamic_fields.ID = wm_pages_dynamic_field_values.wm_forms_fields
          INNER JOIN wm_connected_pages_ids
          ON wm_connected_pages_ids.wm_pages = wm_pages.ID
          JOIN wm_pages_dynamic_field_values as dy1 ON dy1.wm_pages = wm_pages.ID 
          JOIN wm_pages_dynamic_field_values as dy2 on dy2.wm_pages = wm_pages.ID
          WHERE  (dy2.value LIKE '" . mysqli_real_escape_string($db->conn, $firstLetter) . "%')
           "
      . "AND wm_connected_pages_ids.wm_connected_wm_pages_ids = $parentPageId  
          AND wm_pages.Page_Type = 96
          AND wm_pages.Hide_On_Menu = 0
          AND wm_pages.Deleted = 0
          AND dy1.wm_forms_fields=15 
          AND dy2.wm_forms_fields=16 
          ORDER BY dy2.value,dy1.value ASC";
  } else {/*regular 3 fields search*/
    $searchedName = ($_POST['searchedName'] == '' ? '' : " AND (wm_pages_dynamic_field_values.Value LIKE '%" . mysqli_real_escape_string($db->conn, $_POST['searchedName']) . "%' OR wm_pages.Name LIKE '%" . mysqli_real_escape_string($db->conn, $_POST['searchedName']) . "%')");
    $searchByMedDomain = ($_POST['searchByMedDomain'] == '' ? '' : " AND wm_pages.wm_doctor_expertise = " . intval($_POST['searchByMedDomain']));
    $searchByUnit = ($_POST['searchByUnit'] == '' || !isset($_POST['searchByUnit']) ? '' : " AND unitConnected.wm_connected_wm_pages_ids = " . intval($_POST['searchByUnit']));

    $query = "SELECT DISTINCT wm_pages.ID,wm_pages.wm_doctor_title,wm_pages.Name, wm_pages.Top_Header,wm_pages.is_specialist_doctor, dy1.VALUE AS firtsName,dy1.wm_forms_fields AS type1, dy2.value as lastName,dy2.wm_forms_fields AS type2 
      FROM wm_pages
      INNER JOIN wm_connected_pages_ids
        ON wm_connected_pages_ids.wm_pages = wm_pages.ID
      JOIN wm_pages_dynamic_field_values as dy1 ON dy1.wm_pages = wm_pages.ID 
      JOIN wm_pages_dynamic_field_values as dy2 on dy2.wm_pages = wm_pages.ID";
    if ($_POST['searchedName'] != '') {
      $query .= ' INNER JOIN wm_pages_dynamic_field_values
                      ON wm_pages.ID = wm_pages_dynamic_field_values.wm_pages
                      ';
    }
    if ($_POST['searchByMedDomain'] != '') {
      $query .= " INNER JOIN wm_doctor_expertise
                         ON wm_doctor_expertise.ID = wm_pages.wm_doctor_expertise";
    }
    if ($_POST['searchByUnit'] != '') {
      $query .= " INNER JOIN wm_connected_pages_ids as unitConnected
                         ON unitConnected.wm_pages = wm_pages.ID";
    }
    $query .= " WHERE wm_pages.Page_Type = 96 " . $searchedName . $searchByMedDomain . $searchByUnit;
    $query .= $andQuery;
    $query .= " AND wm_connected_pages_ids.wm_connected_wm_pages_ids = $parentPageId AND wm_pages.Hide_On_Menu = 0 AND wm_pages.Deleted = 0  AND dy1.wm_forms_fields=15 AND dy2.wm_forms_fields=16 ORDER BY dy2.value,dy1.value ASC";
  }

}
$arrAllDoctors = $db->getArray($query);
for ($i = 0; $i < count($arrAllDoctors); $i++) { ?>
	<?php $link = $wm->getLink($arrAllDoctors[$i]); ?>
	<?php include(dirname(__FILE__) . "/../php_html/doctors_search.php"); ?>
<?php } ?>
