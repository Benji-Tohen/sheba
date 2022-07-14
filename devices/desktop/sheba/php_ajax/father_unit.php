<?php

/*$params=new Parameters($db);*/
$searchedText = mysqli_real_escape_string($db->conn,$_POST['searchedText']);
$parentId = $_POST['parentId'];
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);

$arr = array();
if($searchedText == ''){//if no searchtext bring back all children and granchildren and....
    $wm->getChildrenRecursive($arr,$parentId);
}else{
    $wm->getSearchArrRecursive($arr, $searchedText,$parentId,array('Name','META_Title','META_Description'));
}
for($i=0;$i<count($arr);$i++){?>
	<?php $link=$wm->getLink($arr[$i]);
              $nav =  $wm->getNavigator($arr[$i]['ID'],"","/");
              $nav = substr($nav, 2);
        ?>
	<?php include(dirname(__FILE__)."/../php_html/Institutions.php");?>
<?php }?>
