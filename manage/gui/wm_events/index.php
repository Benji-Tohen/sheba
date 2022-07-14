<?php
require_once('../../classes/pager/class.pager.php');
require_once('../../classes/elad/elad_integration.class.php');
require_once('data.php');



$id=		intval($_REQUEST["id"]);
$page=		intval($_REQUEST["page"]);
$page_id=	intval($_REQUEST["page_id"]);

$page_row=$wm->getValues($page_id);

$content_update=new ContentUpdater($db, $update_table);

if(strcmp($_REQUEST["do"], "del")==0 && $id){
/*
	$file_to_delete=$content_update->get($id, "File_Name");
	if($file_to_delete){
		@unlink("../../".$file_to_delete);
	}
*/
	$content_update->delete($id);
        $elad = new EladIntegration();
        $elad->delete_event_show($page_id, $id);
}

if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");



//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

$query="SELECT ".$update_table.".ID, ".$update_table.".Name, ".$update_table.".Start_Date, ".$update_table.".Start_Time, wm_cities.Name AS CityName, wm_places.Name AS PlaceName 
	FROM ".$update_table." 
	INNER JOIN wm_cities ON wm_cities.ID=".$update_table.".wm_cities 
	INNER JOIN wm_places ON wm_places.ID=".$update_table.".wm_places 
	WHERE 1 AND wm_pages=".intval($page_id);

if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%')";
}

$query.=" ORDER BY ".$update_table.".Start_Date DESC, ".$update_table.".Start_Time DESC";



$limit=$numItemsPerPage;

if(!$page){
	$page=1;
}

$p = new Pager;
$start = $p->findStart($limit); 
$count = $db->getNumRecords($query);
$pages = $p->findPages($count, $limit); 

$pagelist = $p->pageList($page, $pages); 
$arr=$db->getArray($query." LIMIT ".$start.", ".$limit);
?>
<?php require_once('common/header.php');?>
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
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
		$("#info").load("<?php echo $folderName;?>/order_jquery.php?"+order);
		
      }
    });
});
</script>
<?php require_once('common/body.php');?>
<div class="navigator_line">

<a style="color: #ffffff;" href="index.php?show=pages/pages&id=55246"><?php echo $pageName;?></a> -> <?php echo $text["Items"];?>
<?php /*<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index&page_id=<?php echo $page_id;?>"><?php echo $pageName;?></a> -> <?php echo $text["Items"];?>*/?>
</div>
<div class="listPagePaddingItems">

<h3><?php echo $page_row["Name"];?></h3>

<div class="itemsListPageHeader">

	<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>

	<form name="searchItems" method="get" class="searchItemsForm">
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="text" name="search" value="" />
		<input type="submit" name="submit" value="<?php echo $text["Search"];?>" />
	</form>
</div>


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">

<?php for($i=0;$i<count($arr);$i++){?>
<li id="listItem_<?php echo $arr[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemContent">
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<?php echo $arr[$i]["Name"];?>
			<br />
			<?php echo date("d/m/Y", $dt->timestampFromMysql($arr[$i]["Start_Date"]));?> <?php echo $arr[$i]["CityName"];?>, <?php echo $arr[$i]["PlaceName"];?>  
			
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
		</div>
		<div class="itemSap"></div>

		<div style="clear: both;"></div>
	</div>
</li>
<?php }?>

</ul>
<div class="listItemLast"></div>
</div>
</div>
<br />


הצג 
<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
פריטים בדף

<div class="pager_numbers"><?php echo $pagelist;?></div>
