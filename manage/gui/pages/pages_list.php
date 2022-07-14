<?php
// =========================================================================================================================================
function set_cache() {
    global $wm;
    $arr = array();
    $id = intval($_GET['id']);
    $wm->getChildrenRecursiveIDs($arr, $id);
    $ids=implode(",", $arr);
    $_SESSION['searchSuggest_time'] = time();
    $_SESSION['searchSuggest_cache'] = gzcompress($ids);
}
// =========================================================================================================================================
function is_cached() {
    if (@$_SESSION['searchSuggest_cache']) {
        if (time() - $_SESSION['searchSuggest_time'] > 60) set_cache();         // 1 min "invalidation"
        //echo "is cache..";
        return true;
    } else return false;
}
// =========================================================================================================================================
function get_full_path($id) {                                                   // show the entire path for the page
    global $wm, $string;
    $arr_navigator=$wm->getParentsArray($id);

    $out = "";
    for($i=0;$i<count($arr_navigator);$i++){
        if(strcmp($arr_navigator[$i]["Name"], "Root")==0) $arr_navigator[$i]["Name"]=$text["Root"];
        if($i>0) $out .= " / ";
        $out .= $string->shorten($arr_navigator[$i]["Name"]);
        //echo "<a href=\"index.php?show=pages/pages&id=".$arr_navigator[$i]["ID"]."\">".$string->shorten($arr_navigator[$i]["Name"])."</a>";
    }
    return $out;
}
// =========================================================================================================================================
if (isset($_GET['cache'])) {
    set_cache();                                                                // prepare the cache
    echo "cache done";
}
// =========================================================================================================================================
?>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery-1.8.0.min.js"></script>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery-ui-1.8.23.custom.min.js"></script>
<?php if ($gui->getDir()=="rtl"){?>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery.ui.datepicker-he.js"></script>
<?php }?>
<link type="text/css" href="JS/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />

<script type="text/javascript">
  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {
    $("#test-list").sortable({
      handle : '.handle',
      update : function () {
		var order = $('#test-list').sortable('serialize');
		$("#info").load("../interface/tree_operations/order_jquery.php?"+order);
		//alert(order);
      }
    });
});
</script>
<script language="JavaScript" type="text/javascript" src="pages/ajax_search.js"></script>
<?php
require_once('../../classes/pager/class.pager.php'); 
//$arr_tree=$wm->getArray($id, " ORDER BY Ordering");

$isDeleted=0;

if($_REQUEST["isDeleted"]){
	$isDeleted=1;
}

if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}

$query="SELECT DISTINCT wm_pages.ID,wm_pages.Deleted,wm_pages.Parent,wm_pages.Ordering, wm_pages.Alias, wm_pages.Link, wm_pages.Menu_Name, wm_pages.ShowOnTicker, wm_pages.ShowOnHomepage, wm_pages.Hide_On_Menu, wm_pages.rss, wm_pagetype.icon, wm_pagetype.Name AS PageTypeName, wm_pages.Start_Date, wm_pages.noindex, wm_pages.Lang ";

if($_REQUEST["comments"]){
	$query.=" , (SELECT COUNT(*) FROM wm_comments WHERE wm_comments.wm_pages=wm_pages.ID) AS numComments";
}

$query.=	"
		FROM wm_pages 
		INNER JOIN wm_pagetype ON wm_pagetype.ID=wm_pages.Page_Type ";

if($_REQUEST["comments"]){
	$query.=	" INNER JOIN wm_comments ON wm_comments.wm_pages=wm_pages.ID ";
}

$query.=	"
		WHERE 1 ";




$row["Type"]=$wm->getPageType($row["ID"]);
if(!$row["Type"]["order_by"]){
	$row["Type"]["order_by"]="Ordering";
}


/*
echo "Alias:".($_REQUEST["Alias"] ? "X":"-")." | "
	."Menu_Name:".($_REQUEST["Menu_Name"] ? "X":"-")." | "
	."ShowOnHomepage:".($_REQUEST["ShowOnHomepage"] ? "X":"-")." | "
	."ShowOnTicker:".($_REQUEST["ShowOnTicker"] ? "X":"-");
*/
if(!$isDeleted){

	$query.=" AND wm_pages.Deleted<1 ";

	if($_REQUEST["home"] || $_REQUEST["ticker"] || $_REQUEST["rss"] || $_REQUEST["comments"] || $_REQUEST["metatags"] || $_REQUEST["Alias"] || $_REQUEST["META_Title_Miss"]){
		if($_REQUEST["home"]){
			$query.=" AND wm_pages.ShowOnHomepage=1";
		}elseif($_REQUEST["ticker"]){
			$query.=" AND wm_pages.ShowOnTicker=1";
		}elseif($_REQUEST["rss"]){
			$query.=" AND wm_pages.rss=1";
		}elseif($_REQUEST["comments"]){
			//$query.=" AND numComments>0";
		}elseif($_REQUEST["metatags"]){
			$query.=" AND wm_pages.META_Description=''";
		}elseif($_REQUEST["Alias"]){
            $query.=" AND wm_pages.Alias=''";
        }elseif($_REQUEST["META_Title_Miss"]){
            $query.=" AND wm_pages.META_Title=''";
        }

		$query.=" AND Lang='".$_REQUEST["Lang"]."'";

	}else{
                // http://sheba.tohendns.com/manage/gui/index.php?id=1&Lang=he&txtSearch=about&x=0&y=0&searchOptions=children&searchPages=
		if($_REQUEST["txtSearch"]){
			$keywords=explode(" ", $_REQUEST["txtSearch"]);
			$query.=" AND (";
			$i=0;
			foreach($keywords as $keyword){
				if($i>0){
					$query.=" AND";
				}

                $query.=" wm_pages.Name LIKE '%".mysqli_escape_string($db->conn, $keyword)."%'";
                

				$i++;
			}
			$query.=")";
                        
                        if ($_REQUEST["searchOptions"]=="children") {
                            if (!is_cached()) set_cache();
                            $ids = gzuncompress($_SESSION['searchSuggest_cache']);
                            $query .= " AND wm_pages.ID IN ($ids)";
                        }
                        
		}else{
			$query.=" AND wm_pages.Parent=".intval($id);
		}

	//		$query.=" AND NOT wm_pages.Deleted<>0 ";

                
                //echo $query;
	}


	if($_REQUEST["comments"]){
		$query.=" ORDER BY numComments DESC";
	}elseif($_REQUEST["metatags"]){
		$query.=" ORDER BY wm_pages.UpdatedTime DESC";
	}else{
/*
		if($wm->getProperty($arr_tree[$i]["ID"], "ID")==3){
			$query.=" ORDER BY wm_pages.Start_Date DESC";
		}else{
			$query.=" ORDER BY wm_pages.Ordering";
		}		
*/

			$query.=" ORDER BY wm_pages.".$row["Type"]["order_by"];
	}
}else{
		$query.=" AND wm_pages.Deleted>0 ORDER BY wm_pages.Deleted DESC";
}

//echo "[". $query ."]";


//echo $query;


//$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");
$numItemsPerPage = (intval($_REQUEST['num_items'])) ? intval($_REQUEST['num_items']) : $params->getValue("pages_list_num_items_per_page");


if($_REQUEST["txtSearch"]){
//	$numItemsPerPage = 10;
//	$limit=10;
	$limit=$numItemsPerPage;
}else{
	$limit=$numItemsPerPage;
}

$page=$_REQUEST["page"];
if(!$page){
	$page=1;
}




$p = new Pager;
$start = $p->findStart($limit); 
$count = $db->getNumRecords($query);
$pages = $p->findPages($count, $limit); 
$pagelist = $p->pageList($page, $pages); 


$arr_tree=$db->getArray($query." LIMIT ".$start.", ".$limit);

//print_r($arr_tree);


$value = $_GET[current(preg_grep('/^ticker_/', array_keys($_GET)))];

if($value){
	$num=intval(trim(current(preg_grep('/^ticker_/', array_keys($_GET))), "ticker_"));
	$arr_tree=$wm->getLinkedPagesAdmin($num, $row["Lang"]);
}


$is_allow_edit = $wm->getPermissions($id, $_SESSION["User_Data"]["ID"], $_SESSION["User_Data"]["Level"]);
?>
<?php require_once('common/header.php');?>

<script language="javascript" type="text/javascript">
$(document).ready(function() {
<?php if($_REQUEST["addpage"]){?>
  showLayer('newPageForm');
<?php }?>
});
	
<?php if ($id) echo 'search_parent_id='.$id.';'; ?>
</script>




<?php require_once('common/body.php');?>
<form name="search" style="margin-top: 8px; width: 750px;">
	<input type="hidden" name="id" value="<?php echo $id;?>" />
	<input type="hidden" name="Lang" value="<?php echo $row["Lang"];?>" />
	<div class="searchIcons">

		<?php if(!$isDeleted && ($id>1 || $login->isSuperManager())) if ($is_allow_edit||$_SESSION["User_Data"]["Level"]==2) {?>
			<img border="0" src="images/icons/add_Page01.png" onclick="showLayer('newPageForm');" style="cursor: pointer; float: <?php echo $gui->getRight();?>" alt="Add a page" />
		<?php }?>
	</div>
	<br />
	<div style="float: <?php echo $gui->getLeft();?>; padding-<?php echo $gui->getRight();?>: 5px; padding-top: 2px;"><?php echo $text["Search"];?></div>
	<input type="text" id="txtSearch" class="txtSearch" name="txtSearch" autocomplete="off" value="<?php echo $_REQUEST["txtSearch"];?>" />
	<input type="image" src="images/icons/Search01.png" style="border: none; height: 18px; float: <?php echo $gui->getLeft();?>;" alt="חפש" />


	<div style="float: <?php echo $gui->getLeft();?>; width: 200px; padding-<?php echo $gui->getLeft();?>: 10px;">
	<?php echo "חפש ב";?>
	<select name="searchOptions" id="searchOptions" onchange="if(this.value=='children')searchCache()">
		<option value="">כל האתר</option>
		<option value="children" <?php echo $_REQUEST["searchOptions"]=="children"?"selected":"";?>><?php echo "כל הדפים תחת עץ זה";?></option>
	</select>
	</div>

	<div style="float: <?php echo $gui->getLeft();?>; width: 200px; padding-<?php echo $gui->getLeft();?>: 10px;">
	<?php echo $text["Display by"];?>
	<select name="searchPages" onchange="document.location='index.php?show=pages/pages&'+this.value+'=1&Lang=<?php echo $row["Lang"];?>';">
		<option></option>
		<option value="home" 		<?php echo $_REQUEST["home"]=="1"?"selected":"";?>><?php echo $text["Home"];?></option>
		<option value="ticker"		<?php echo $_REQUEST["ticker"]=="1"?"selected":"";?>><?php echo $text["Ticker"];?></option>
		<option value="rss"		<?php echo $_REQUEST["rss"]=="1"?"selected":"";?>><?php echo $text["Rss"];?></option>
		<option value="isDeleted"	<?php echo $_REQUEST["isDeleted"]=="1"?"selected":"";?>><?php echo $text["Deleted Items"];?></option>
		<option value="comments"	<?php echo $_REQUEST["comments"]=="1"?"selected":"";?>><?php echo $text["Comments"];?></option>
		<option value="metatags"	<?php echo $_REQUEST["metatags"]=="1"?"selected":"";?>><?php echo $text["Metatags"];?></option>
		<option value="Alias"	<?php echo $_REQUEST["Alias"]=="1"?"selected":"";?>><?php echo $text["Alias"];?></option>
		<option value="META_Title_Miss"	<?php echo $_REQUEST["META_Title_Miss"]=="1"?"selected":"";?>><?php echo $text["META_Title_Miss"];?></option>
		<option value="Menu_Name"	<?php echo $_REQUEST["Menu_Name"]=="1"?"selected":"";?>><?php echo $text["Menu_Name"];?></option>

		<optgroup label="<?php echo $text["Ticker"];?>">
		<?php for($tickerNum=1;$tickerNum<=5;$tickerNum++){?>
			<option value="ticker_<?php echo $tickerNum;?>" <?php echo (isset($_REQUEST["searchPages"]) && $_REQUEST["searchPages"]=="ticker_".$tickerNum)?"selected":"";?>><?php echo $text["ticker_".$tickerNum];?></option>
		<?php }?>
		</optgroup>
	</select>
	</div>

	<br />
	<div id="search_suggest"></div>
	<div style="clear: both;"></div>
</form>

<div></div>


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">
<?php 
for($i=0;$i<count($arr_tree);$i++){
	$link=$wm->getLink($arr_tree[$i]);
	?>
	<li id="listItem_<?php echo $arr_tree[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">
		<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["txtSearch"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["txtSearch"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />
		<div class="listItemContent">
			<div class="listItemPageType">
				<a href="<?php echo $link["Link"];?>"  target="<?php echo $arr_tree[$i]["Link"]?"_blank":"_top";?>"><img src="images/icons/<?php echo $arr_tree[$i]["icon"];?>" alt="<?php echo $arr_tree[$i]["PageTypeName"];?>" border="0" /></a>
			</div>
			<div class="listItemText" dir="<?php echo $gui->getDir();?>" style="width: 300px;">

				<?php if($wm->getProperty($arr_tree[$i]["ID"], "Admin_Enable_Children")){?>
					<a href="index.php?show=pages/pages&id=<?php echo $arr_tree[$i]["ID"];?>" <?php 
						if(isset($_REQUEST["txtSearch"])){
							echo "title=\"".get_full_path($arr_tree[$i]["ID"])."\"";
						}
						?>>
<strong <?php echo ($wm->hasChildren($arr_tree[$i]["ID"]))?'style="color: #ff0000;"':''; ?>><?php echo $string->shorten($arr_tree[$i]["Menu_Name"], 50);?></strong>

					</a>
				<?php }else{?>
					<?php echo $string->shorten($arr_tree[$i]["Menu_Name"], 50);?>
				<?php }?>

				<div>
				  <?php if($arr_tree[$i]["Start_Date"]){
							list($y,$m,$d)=explode("-", $arr_tree[$i]["Start_Date"]);
							$startDate=$d."/".$m."/".$y;
							echo $startDate."&nbsp;&nbsp;";
						}?>
				</div>
			</div>

	<?php if(!$isDeleted){?>
			<div class="listItemIcon">
				<?php if (($wm->getProperty($arr_tree[$i]["ID"], "Admin_Enable_Delete")) && ($is_allow_edit||$_SESSION["User_Data"]["Level"]==2) && ($arr_tree[$i]["Parent"]!=1 || $_SESSION["User_Data"]["Level"]==1)) {?>
					<a href="../interface/tree_operations/delete_page.php?id=<?php echo $arr_tree[$i]["ID"];?>" onclick="highlight('listItem_<?php echo $arr_tree[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr_tree[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
				<?php }else{?>
					<img border="0" src="images/icons/DelletPage00.png" alt="Delete" />
				<?php }?>
			</div>
			<div class="itemSap"></div>
			<div class="listItemIcon">
				<a href="../interface/tree_operations/change_param.php?field=Hide_On_Menu&amp;page=<?php echo $page;?>&amp;value=<?php echo $arr_tree[$i]["Hide_On_Menu"]?"0":"1";?>&amp;id=<?php echo $arr_tree[$i]["ID"];?>"><img border="0" src="images/icons/Eye0<?php echo $arr_tree[$i]["Hide_On_Menu"]?"0":"1";?>.png" alt="Hide On Menu" title="Hide On Menu" /></a>
			</div>
			<div class="itemSap"></div>
			<div class="listItemIcon">
				<a href="../interface/tree_operations/change_param.php?field=noindex&amp;page=<?php echo $page;?>&amp;value=<?php echo $arr_tree[$i]["noindex"]?"0":"1";?>&amp;id=<?php echo $arr_tree[$i]["ID"];?>"><img border="0" src="images/icons/noindex0<?php echo $arr_tree[$i]["noindex"]?"0":"1";?>.png" alt="index" title="index" /></a>
			</div>
			<div class="itemSap"></div>
			<div class="listItemIcon">
				<?php if (($wm->getProperty($arr_tree[$i]["ID"], "Admin_Enable_Edit")) && ($is_allow_edit||$_SESSION["User_Data"]["Level"]==2)) {?>
					<a href="index.php?show=pages/page_edit&amp;id=<?php echo $arr_tree[$i]["ID"];?>&amp;page=<?php echo $page;?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
				<?php } else {?>
	                <img border="0" src="images/icons/Edit01.png" style="-webkit-filter:grayscale(100%);filter:grayscale(100%)" alt="Edit" />
	            <?php } ?>
			</div>
			<div class="itemSap"></div>
	        <?php if($row["Type"]['ID'] == 105){?>
	        <div class="listItemIcon">
				<a href="<?php echo $cfg["WM"]["Server"];?>/manage/gui/index.php?show=wm_events/index&page_id=<?php echo $arr_tree[$i]["ID"];?>"><img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/events.png" border="0" /></a>
	        </div>
	        <?php }?>

        	<div class="itemSap"></div>
        	
        	<div class="listItemIcon tickersWrap" style="width: 180px;overflow:hidden;max-height:34px;">
		        <?php for($tickerNum=1;$tickerNum<=5;$tickerNum++){?>
		        	<a style="float:left;width:32px;" href="<?php echo $cfg["WM"]["Server"];?>/manage/interface/tree_operations/link_to.php?page=<?php echo $page;?>&amp;value=<?php echo $tickerNum;?>&amp;id=<?php echo $arr_tree[$i]["ID"];?>" class="listItemIconTicker">
		        		<img src="<?php echo $cfg["WM"]["Server"];?>/manage/gui/images/icons/ticker-<?php echo $wm->isLinkedTo($arr_tree[$i]["ID"], $tickerNum)?"active":"disable";?>.png" border="0" />
		        		<div class="listItemIconTickerText"><?php echo $text["ticker_".$tickerNum];?></div>
		        	</a>
		        <?php }?>
	        </div>
	<?php }else{?>
			<div class="listItemIcon">
				<?php if($wm->getProperty($arr_tree[$i]["ID"], "Admin_Enable_Edit")) if ($is_allow_edit) {?>
					<a href="index.php?show=pages/page_edit&amp;id=<?php echo $arr_tree[$i]["ID"];?>&amp;page=<?php echo $page;?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
				<?php } else { ?>
	                    <img border="0" src="images/icons/Edit01.png" style="-webkit-filter:grayscale(100%);filter:grayscale(100%)" alt="Edit" />
	            <?php } ?>
			</div>
			<div class="itemSap"></div>
	<?php }?>
			<div style="clear: both;"></div>
		</div>
	</li>
<?php }?>
</ul>
<div class="listItemLast"></div>
</div>
</div>
<br />
<?php echo $text["Showing"];?> 
<select name="num_items" onchange="document.location='index.php?show=pages/pages&id=<?php echo $id;?>&txtSearch=<?php echo $_REQUEST['txtSearch']?>&searchOptions=<?php echo $_REQUEST['searchOptions']?>&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
	<option value="500" <?php echo ($numItemsPerPage==500)?"selected":"";?>>500</option>
</select>
<?php echo $text["items on page"];?>

<div class="pager_numbers"><?php echo $pagelist;?></div>

<?php if(!$isDeleted){?>

<?php }else{?>
		<div id="list_0" class="list_tr_0"><a href="../interface/tree_operations/delete_archive.php" onclick="return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');">מחק ארכיון</a></div>
<?php }?>

<div id="info" style="display:none;"></div>
