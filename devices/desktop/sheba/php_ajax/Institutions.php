<?php
$fromAjax = 1;
$searchedText = mysqli_real_escape_string($db->conn,$_POST['searchedText']);
$parentId = $_POST['parentId'];
$searchType = isset($_POST['searchType']) ? $_POST['searchType']: 'all';
$searchType= '';
$lang =  $_POST['lang'];
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);

$arr = array();
if($searchedText == ''){//if no searchtext bring back all children
    $arr = $wm->getAllChildren($parentId,"Ordering",true);
}else{
    $homePageId = $wm->getHomePageById($parentId);
    if($searchType == 'all'){
        $searchFieldNames=array('Name','META_Title','META_Description');
    }else{
        $searchFieldNames=array('Name','META_Title','META_Description');
    }
    if ($homePageId==2) {         // if main site ..
        $searchKey=trim($searchedText);
        $query="SELECT ID, Name, Sub_Title, Alias, Top_Header, Link, Lang  
                FROM wm_pages WHERE Page_Type=95 AND Deleted=0 AND Hide_On_Menu=0";
        $query.=" AND Lang = '$lang'";

        if($searchType == 'all'){
            $searchKeysArr= explode(" ", $searchKey);
            $numSearchFieldNames = count($searchFieldNames);
            $query.=" AND (";
            foreach($searchKeysArr as $num=>$val){
                    if($val==" ") continue;
                    foreach ($searchFieldNames as $key=>$value) {
                        $query.= $value." LIKE '%".mysqli_real_escape_string($db->conn, $val)."%'";
                        if($numSearchFieldNames-1 > $key){$query.=" OR ";}
                    }
            $query .= " OR ";
            }
        }else{
            $query.=" AND (Name LIKE '%$searchKey%'";
        }
        
    if (substr($query,strlen($query)-4)==" OR ") $query = substr($query,0,strlen($query)-4);
        $query.=") ORDER BY ORDERING";
        $arr = $db->getArray($query);
    } else $wm->getSearchArrRecursive($arr, $searchedText,$parentId,$searchFieldNames);
}
for($i=0;$i<count($arr);$i++){?>
    <?php $link=$wm->getLink($arr[$i]);
        ?>
    <?php include(dirname(__FILE__)."/../php_html/Institutions.php");?>
<?php }?>
