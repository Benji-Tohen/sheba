<?php

$arr_pictures=$wm->getGalleryItems($id);
/*bring all dynamic fields that are not empty*/
$arrDynamicFieldsFirstBlock  = $wm->getDynamicFieldsByPageType($id,$wmPage['Type']['ID'],1);
$arrDynamicFieldsSecondBlock  = $wm->getDynamicFieldsByPageType($id,$wmPage['Type']['ID'],2);
$arrDynamicFieldsThirdBlock  = $wm->getDynamicFieldsByPageType($id,$wmPage['Type']['ID'],3);
$drTitle = $db->getRow("SELECT wm_doctor_title.Name FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$id);
$drPic = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$id);
$drExpertise = $db->getRow("SELECT wm_doctor_expertise.Name FROM wm_pages INNER JOIN wm_doctor_expertise ON wm_doctor_expertise.ID = wm_pages.wm_doctor_expertise WHERE wm_pages.ID = ".$id);
$drExpertise=array('Name'=>$trans->getText('Areas of Expertise'),'Value'=>$drExpertise['Name']);
$arrDynamicFieldsSecondBlock[]=$drExpertise;
$connectedInstitutes = $wm->getConnectedPages($id,"95");
$drInstitues = array();
$drInstitues['Value']='';
foreach ($connectedInstitutes as $institute) {
    $drInstitues['Value'].="<a href=".$cfg["WM"]["Server"]."/".$institute['ID'].">".$institute['Name']."</a><br/>";
}
$drInstitues['Value'] = rtrim($drInstitues['Value'],",");
$drInstitues['Name']=$trans->getText('units');

$arrDynamicFieldsSecondBlock[]=$drInstitues;
if($wmPage["wm_forms"]){
	if($_POST){
		require_once(dirname(__FILE__)."/../../../../site/php_components/form_process.php");
	}else{
		require_once(dirname(__FILE__)."/../../../../site/php_components/form.php");
	}
}
?>
