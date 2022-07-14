<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$id=		intval($_REQUEST["id"]);
$page=		intval($_REQUEST["page"]);
$page_id=	intval($_REQUEST["page_id"]);

$content_update=new ContentUpdater($db, $update_table);


if($_REQUEST["changeEnable"] && $id){
	$content_update->setValue($id, "enabled", ($_REQUEST["enable"]?1:0));
}

if(strcmp($_REQUEST["do"], "del")==0 && $id){
	$content_update->delete($id);
}

if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");



$page_row=$wm->getValues($page_id);


//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

$query="SELECT ID, Name, enabled, post_date FROM ".$update_table." WHERE 1 ";
if($page_id){
	$query.=" AND wm_pages=".intval($page_id);
}

if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%' OR Comments LIKE '%".$_REQUEST["search"]."%' OR Subject LIKE '%".$_REQUEST["search"]."%' OR Email LIKE '%".$_REQUEST["search"]."%')";
}

$query.=" ORDER BY post_date DESC";

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

<?php require_once('common/body.php');?>
<div class="navigator_line">
<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $text["Items"];?>
</div>


<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
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

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_2.png" class="handleoff" alt="Sort" border="0" />

	<div class="listItemContent">
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<div style="width: 300px; font-weight: bold;"><?php echo $arr[$i]["Name"];?></div>
			<div style="width: 150px; float: <?php echo $gui->getRight;?>"><?php echo date("m/d/Y H:i", $arr[$i]["post_date"]);?></div>
			<div style="width: 200px; float: <?php echo $gui->getRight;?>"><?php echo $arr[$i]["Subject"];?></div>
			<div style="clear: both;"></div>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>



		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>&amp;changeEnable=1&amp;enable=<?php echo $arr[$i]["enabled"]?"0":"1";?>"><img border="0" src="images/icons/Eye0<?php echo $arr[$i]["enabled"]?"1":"0";?>.png" alt="Show" /></a>
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
<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value+'&page_id=<?php echo $page_id;?>';">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
פריטים בדף

<div class="pager_numbers"><?php echo $pagelist;?></div>
