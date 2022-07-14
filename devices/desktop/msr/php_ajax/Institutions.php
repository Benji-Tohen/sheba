<?php
$fromAjax = 1;
/*$params=new Parameters($db);*/
$searchedText = mysqli_real_escape_string($db->conn,$_POST['searchedText']);
$parentId = $_POST['parentId'];
$searchType = isset($_POST['searchType']) ? $_POST['searchType']: 'all';
$wm=new WebMaster($db, $cfg["WM"]["DATABASE_TABLE"]["Pages"], $cfg["WM"]["DATABASE_TABLE"]["PageType"]);
$trans=new Translate($db, $_SESSION["WM"]["Lang"]);

$arr = array();
if($searchedText == ''){//if no searchtext bring back all children and granchildren and....
    $wm->getChildrenRecursive($arr,$parentId);
}else{
    // kids = 33014
    // shikum = 53707
    // women = 54188, 30551, 55178
    // heart = 36465
    // heart-surgery = 53565, 53582, 53544 (crew)
    $homePageId = $wm->getHomePageById($parentId);
    if($searchType == 'all'){
        $searchFieldNames=array('Name','META_Title','META_Description');
    }else{
        $searchFieldNames=array('Name','META_Title','META_Description');
    }
    
    //if ($parentId==30987) {     // if main site ..
    if ($homePageId==2) {         // if main site ..
        $searchKey=trim($searchedText);
        $query="SELECT ID, Name, Sub_Title, Alias, Top_Header, Link  
                FROM wm_pages WHERE Page_Type=95 AND Deleted=0 AND Hide_On_Menu=0";

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
        //foreach ($searchFieldNames as $key=>$value) {
        //    $query.= $value." LIKE '%".mysqli_real_escape_string($db->conn, $searchKey)."%'";
        //    if($numSearchFieldNames-1 > $key){$query.=" OR ";}
        //}
        $query.=") ORDER BY ORDERING";
    //echo $query;
        $arr = $db->getArray($query);
    } else $wm->getSearchArrRecursive($arr, $searchedText,$parentId,$searchFieldNames);
}
for($i=0;$i<count($arr);$i++){?>
    <?php $link=$wm->getLink($arr[$i]);
              $nav =  $wm->getNavigator($arr[$i]['ID'],"","/");
              $nav = substr($nav, 2);
        ?>
    <?php include(dirname(__FILE__)."/../php_html/Institutions.php");?>
<?php }?>
