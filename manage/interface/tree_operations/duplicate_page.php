<?php
require_once('../../../conf/conf.data.php');

$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$dt=new DateTime1();
$id=		intval($_REQUEST["id"]);

function duplicate_page($item_id, $parent_id=NULL, $new_parent_id=NULL){
	global $db;
	global $wm;

	//create item
	$arrValues=$wm->getValues($item_id);
	$arrValues["ID"]=0;
	if ($new_parent_id){
		$arrValues["Parent"] = $new_parent_id;
	} else {
		$arrValues["Parent"] = $wm->getParent($item_id);
		$arrValues["Name"]="Copy of ".$arrValues["Name"];
		$arrValues["Menu_Name"]="Copy of ".$arrValues["Menu_Name"];
	}

	$arrValues["Alias"]="";

	$new_parent_id=$db->updateData("wm_pages", $arrValues);
	
	//add gallery	
	if ($arrGallery = $wm->getGalleryItems($item_id)){
		foreach($arrGallery as $key => $value){
			$arrGallery[$key]['ID'] = 0;
			$arrGallery[$key]['WM_Pages'] = $new_parent_id;
			$db->updateData("wm_pages_gallery", $arrGallery[$key]);
		}
		//die(print_r($arrGallery));
	}

	//recursive
	$query = "SELECT * FROM wm_pages WHERE Parent=".intval($item_id);
	$childrens = $db->getArray($query);
	foreach($childrens as $child){
		duplicate_page($child['ID'], $item_id, $new_parent_id);
	}
	
	return $new_parent_id;
}

$new_parent_id=duplicate_page($id);

//header("location: ../../gui/index.php?show=pages/pages&id=".$new_parent_id);
?>
<script type="text/javascript">
parent.document.location='<?php echo $cfg["WM"]["Server"];?>/<?php echo $new_parent_id;?>';
</script>
