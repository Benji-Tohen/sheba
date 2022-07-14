<?php 

// Images thumbs
$thumb_desktop_img = $cfg["WM"]["Server"]."/webfiles/images/cache/1110X450/zcX1/";
$thumb_mobile_img = $cfg["WM"]["Server"]."/webfiles/images/cache/450X450/zcX1/";
$thumb_item_img = $cfg["WM"]["Server"]."/webfiles/images/cache/480X320/zcX1/";
$thumb_doctor_img = $cfg["WM"]["Server"]."/webfiles/images/cache/165X165/zcX1/";
$thumb_stories_img = $cfg["WM"]["Server"]."/webfiles/images/cache/165X165/zcX1/";
$thumb_gallery_img = $cfg["WM"]["Server"]."/webfiles/images/cache/750X380/zcX1/";

// Form process
include_once($device.'/php_components/dynamic_form/form_process.php');

// Gallery
$arr_pictures = $wm->getGalleryItems($wmPage["ID"]);

// Dynamic fields
$dynamicFields = $wm->getDynamicFieldsByPageType($wmPage['ID'], $wmPage['Type']['ID']);

$display_header_logo = $params->dynamicValue($dynamicFields, 'display_header_logo');
$display_header_logo = $display_header_logo['Value'];

$medical_zone_contact_title = $params->dynamicValue($dynamicFields, 'medical_zone_contact_title');
$medical_zone_contact_title = $medical_zone_contact_title['Value'];

$medical_zone_contact_content = $params->dynamicValue($dynamicFields, 'medical_zone_contact_content');
$medical_zone_contact_content = $medical_zone_contact_content['Value'];

$medical_zone_contact_btn_link = $params->dynamicValue($dynamicFields, 'medical_zone_contact_btn_link');
$medical_zone_contact_btn_link = $medical_zone_contact_btn_link['Value'];

$medical_zone_contact_btn_title = $params->dynamicValue($dynamicFields, 'medical_zone_contact_btn_title');
$medical_zone_contact_btn_title = $medical_zone_contact_btn_title['Value'];

$medical_zone_contact_link_url = $params->dynamicValue($dynamicFields, 'medical_zone_contact_link_url');
$medical_zone_contact_link_url = $medical_zone_contact_link_url['Value'];

$medical_zone_contact_link_title = $params->dynamicValue($dynamicFields, 'medical_zone_contact_link_title');
$medical_zone_doctors_title = $params->dynamicValue($dynamicFields, 'Doctors_title') ;
$medical_zone_doctors_title = $medical_zone_doctors_title['Value'];
$medical_zone_contact_link_title = $medical_zone_contact_link_title['Value'];

//Gallery title
$gallery_title = $params->dynamicValue($dynamicFields, 'Bottom banner title') ;
$gallery_title = $gallery_title['Value'];

//countdown
$medical_zone_coundown_to = $params->dynamicValue($dynamicFields, 'medical_zone_coundown_to');
$medical_zone_coundown_to = $medical_zone_coundown_to['Value'];

// field_of_activity (162)
$field_of_activity = $wm->getChild($wmPage['ID'], 162);
$field_of_activity_children = [];
if(!empty($field_of_activity)){
    $field_of_activity_children = $wm->getNewsList($field_of_activity['ID'], 'Ordering', 'LIMIT 50');
}

$field_of_activity_rows = $wm->getChild($wmPage['ID'], 169);
$field_of_activity_rows_children = [];
if(!empty($field_of_activity_rows)){
    $field_of_activity_children_rows = $wm->getNewsList($field_of_activity_rows['ID'], 'Ordering', 'LIMIT 50');
}


// doctors
$arr_connected_doctors = $wm->getConnectedPages($id, 96, 'Ordering');

// medical_zone_tests (163)
$medical_zone_tests = $wm->getChild($wmPage['ID'], 163);
$medical_zone_tests_children = [];
if(!empty($medical_zone_tests)){
    $medical_zone_tests_children = $wm->getNewsList($medical_zone_tests['ID'], 'Ordering', 'LIMIT 50');
}

// treatments (164)
$treatments = $wm->getChild($wmPage['ID'], 164);
$treatments_children = [];
if(!empty($treatments)){
    $treatments_children = $wm->getNewsList($treatments['ID'], 'Ordering', 'LIMIT 50');
}

// clinical_studies (165)
$clinical_studies = $wm->getChild($wmPage['ID'], 165);
$clinical_studies_children = [];
if(!empty($clinical_studies)){
    $clinical_studies_children = $wm->getNewsList($clinical_studies['ID'], 'Ordering', 'LIMIT 50');
}

// stories (166)
$stories = $wm->getChild($wmPage['ID'], 166);
$stories_children = [];
if(!empty($stories)){
    $stories_children = $wm->getNewsList($stories['ID'], 'Ordering', 'LIMIT 50');
}

// medical_zone_more (167)
$medical_zone_more = $wm->getChild($wmPage['ID'], 167);
$medical_zone_more_children = [];
if(!empty($stories)){
    $medical_zone_more_children = $wm->getNewsList($medical_zone_more['ID'], 'Ordering', 'LIMIT 50');
}
