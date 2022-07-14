<?php
/*	Display Tree	*/
$arr_navigator=$wm->getParentsArray($wm_page_id);
?>

<?php
for($i=0;$i<count($arr_navigator);$i++){
	
	if(strcmp($arr_navigator[$i]["Name"], "Root")==0){
		$arr_navigator[$i]["Name"]=$text["Root"];
	}

	if($i>0){
		echo " / ";
	}

	echo "<a href=\"index.php?show=pages/pages&id=".$arr_navigator[$i]["ID"]."\">".$string->shorten($arr_navigator[$i]["Name"])."</a>";

}?>

