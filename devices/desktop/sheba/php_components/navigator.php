<?php
/*special fix for item ghost pages*/
$idOrg = $id;
if($id!==$wmPage["ID"]){
    $id=$wmPage["ID"];
}
		

if($wmPage["Parent"]!=1){ 
	if($wmPage["Page_Type"]==6||$wmPage["Page_Type"]==84){
		$nav=$wm->getNavigator($id, NULL, "/",$form["Name"]);
	}else{
                /*old func*/
		$nav=$wm->getNavigator($id, NULL, "/");
                /*new func*/
               // $nav = $wm->getNavigatorByAncestry($id, NULL, "/");
                
	}

$nav=trim($nav, " /");
echo $nav; 
} 
$id = $idOrg;
?>
