<?php
// need to copy wm_forms , wm_forms_fields
$form_id = intval($_GET['form_id']);
$form = $db->getRow("SELECT * FROM wm_forms WHERE ID=$form_id");
$fields = $db->getArray("SELECT * FROM wm_forms_fields WHERE wm_forms=$form_id");
// copy form..
unset($form['ID']);
$form['Name'] .= " (Copy)";
$new_form_id = $db->updateData("wm_forms", $form);                              // copy form
foreach ($fields as $n=>$field) {
    unset($field['ID']);
    $field['wm_forms'] = $new_form_id;
    $db->updateData("wm_forms_fields", $field);                               // copy field
}
//
//function updateData($table, $fieldsArray, $id=NULL, $index_field_name="ID", $useIdAsString=false){
//print_r($form);
//print_r($fields);
//echo "KAZINO!";
header("Location: /manage/gui/index.php?show=wm_forms/index");
?>
