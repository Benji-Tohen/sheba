<?php
require_once('../../classes/pager/class.pager.php');

$update_table="wm_pages_gallery";

$id=			intval($_REQUEST["id"]);
$page_id=		intval($_REQUEST["page_id"]);
$gallery_id=	intval($_REQUEST["gallery_id"]);

$content_update=new ContentUpdater($db, $update_table);

if(strcmp($_REQUEST["do"], "del")==0 && $id){
	$file_to_delete=$content_update->get($id, "File_Name");
	@unlink("../../".$file_to_delete);
	$content_update->delete($id);
}

if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}

if($page_id){
	$page_row=$wm->getValues($page_id);
} else {
	$page_row = [];
}

if($gallery_id){
	$galleryRow = $db->getRow('SELECT * FROM wm_galleries WHERE ID = '.intval($gallery_id));
} else {
	$galleryRow = [];
}


$picturesTree=new TreeData($db, $update_table);

$gui=new Gui($page_row["Lang"]);

//$arr_pictures=$wm->getRelatedTableArray($page_id);
if($page_id){
	$query="SELECT * FROM wm_pages_gallery WHERE WM_Pages=".$page_id." ORDER BY Ordering";
} else if($gallery_id){
	$query="SELECT * FROM wm_pages_gallery WHERE wm_gallery_id=".$gallery_id." ORDER BY Ordering";
}


$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");
$limit=$numItemsPerPage;
$page=$_REQUEST["page"];
if(!$page){
	$page=1;
}

$p = new Pager;
$start = $p->findStart($limit); 
$count = $db->getNumRecords($query);
$pages = $p->findPages($count, $limit); 
$pagelist = $p->pageList($page, $pages); 
$arr_pictures=$db->getArray($query." LIMIT ".$start.", ".$limit);

?>
<?php require_once('common/header.php');?>
<style type="text/css">
.pager_numbers{
	color: #ffffff;
}
</style>
<script type="text/javascript" src="JS/sort/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="JS/sort/jquery-ui-personalized-1.6rc4.min.js"></script>
<link rel='stylesheet' href='JS/sort/styles.css' type='text/css' media='all' />
<script type="text/javascript">
  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {
    $("#test-list").sortable({
      handle : '.handle',
      update : function () {
		var order = $('#test-list').sortable('serialize');
		$("#info").load("../interface/tree_operations/order_jquery_gallery.php?"+order);
      }
    });
});
</script>

<?php require_once('common/body.php');?>
<div class="navigator_line">
<?php 
	if($page_id){
		$wm_page_id = $page_id;
		require_once("pages/navigator.php");
	} else if($gallery_id){ ?>
		<a href="index.php?show=wm_galleries/index">
			<?php echo $trans->getText('Galleries');?>
		</a>
		&nbsp; / &nbsp;
		<span><?php echo $galleryRow['Name'];?></span>
	<?php }
?>
</div>
<div class="listPagePaddingItems">


<a href="index.php?show=gallery/gallery_pictures_edit&amp;page_id=<?php echo $page_id;?>&amp;gallery_id=<?php echo $gallery_id;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer;" alt="Add a Picture" /></a>




<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">
<?php for($i=0;$i<count($arr_pictures);$i++){?>
<li id="listItem_<?php echo $arr_pictures[$i]["ID"];?>" class="listItemImage_<?php echo ($i%2==0?0:1);?>">


<img src="images/icons/handel_<?php echo $gui->getDir();?>_0.png" class="handle" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

<div class="listItemImageContent">
	<div class="listItemImageImage">
	<?php if(file_exists("../../".$arr_pictures[$i]["File_Name"])){?>
        <?php if(strpos($arr_pictures[$i]['File_Name'], '.mp4') !== false){ ?>
            <?php echo $text['Video'];?>
        <?php } else { ?>
            <img src="<?php echo $cfg["WM"]["Server"]."/classes/thumb/phpThumb.php?zc=1&amp;w=150&amp;h=90&amp;src=../../".$arr_pictures[$i]["File_Name"];?>" border="1" />
        <?php }?>
	<?php };?>
	</div>
	<div class="listItemImageText" dir="<?php echo $gui->getDir();?>">
		<?php echo $arr_pictures[$i]["Name"];?>
	</div>

	<div class="listItemIcon">
		<a href="index.php?show=gallery/gallery_pictures&amp;do=del&amp;gallery_id=<?php echo $gallery_id;?>&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arr_pictures[$i]["ID"];?>" onclick="highlightImage('listItem_<?php echo $arr_pictures[$i]["ID"];?>');return confirm2('listItem_<?php echo $arr_pictures[$i]["ID"];?>', 'listItemImage_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
	</div>
	<div class="itemSap"></div>	

	<div class="listItemIcon">
		<a href="index.php?show=gallery/gallery_pictures_edit&amp;gallery_id=<?php echo $gallery_id;?>&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
	</div>
	<div class="itemSap"></div>

	<div style="clear: both;"></div>
</div>

<?php
/*
<img src="JS/sort/arrow.png" alt="move" width="16" height="16" class="handle" style="padding-left: 5px;" />
<table cellspacing="0" class="list_table">
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
		<td valign="top">
		<?php if(file_exists("../../".$arr_pictures[$i]["File_Name"])){?>
			<img src="<?php echo "../../".$arr_pictures[$i]["File_Name"];?>" width="70" border="1" />
		<?php };?>
		</td>
		<td width="100" valign="top">&nbsp;<?php echo $arr_pictures[$i]["Name"];?>&nbsp;</td>
		<td valign="top" style="width: 22px">
		<?php if(!$picturesTree->isOnBottom($arr_pictures[$i]["ID"], "WM_Pages=".$page_id)){?>
		<a href="../interface/tree_operations/order_other.php?order=down&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/down.gif" alt="Move Down" /></a>
		<?php }?>		
		</td>
		<td valign="top" style="width: 22px">
		<?php if(!$picturesTree->isOnTop($arr_pictures[$i]["ID"], "WM_Pages=".$page_id)){?>
		<a href="../interface/tree_operations/order_other.php?order=up&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/up.gif" alt="Move Up" /></a>
		<?php }?>		
		</td>		
		<td valign="top" style="width: 22px"><a href="index.php?show=gallery/gallery_pictures_edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>
		<td valign="top" style="width: 22px"><a href="index.php?show=gallery/gallery_pictures&amp;do=del&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arr_pictures[$i]["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
</table>
*/
?>

</li>
<?php }?>

</ul>
<div class="listItemLast"></div>
</div>
</div>



<br />
<?php echo $text["Showing"];?> 
<select name="num_items" onchange="document.location='index.php?show=gallery/gallery_pictures&page_id=<?php echo $page_id;?>&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
<?php echo $text["items on page"];?>

<div class="pager_numbers"><?php echo $pagelist;?></div>

<?php
/*

<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><a href="index.php?show=gallery/gallery_pictures_edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add a Picture" /></a><br />
	  </td>
	</tr>
	<tr>
		<td colspan="3" align="center"><div class="pager_numbers"><?php echo $pagelist;?></div></td>
	</tr>
	
<?php for($i=0;$i<count($arr_pictures);$i++){?>	
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
		<td valign="top">
		<?php if(file_exists("../../".$arr_pictures[$i]["File_Name"])){?>
			<img src="<?php echo "../../".$arr_pictures[$i]["File_Name"];?>" width="70" border="1" />
		<?php };?>		</td>
		<td width="100" valign="top">&nbsp;<?php echo $arr_pictures[$i]["Name"];?>&nbsp;</td>
		
		<td valign="top">
		<?php if(!$picturesTree->isOnBottom($arr_pictures[$i]["ID"], "WM_Pages=".$page_id)){?>
		<a href="../interface/tree_operations/order_other.php?order=down&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/down.gif" alt="Move Down" /></a>
		<?php }?>		</td>
		<td valign="top">
		<?php if(!$picturesTree->isOnTop($arr_pictures[$i]["ID"], "WM_Pages=".$page_id)){?>
		<a href="../interface/tree_operations/order_other.php?order=up&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/up.gif" alt="Move Up" /></a>
		<?php }?>		</td>		
		<td valign="top"><a href="index.php?show=gallery/gallery_pictures_edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>
		<td valign="top"><a href="index.php?show=gallery/gallery_pictures&amp;do=del&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arr_pictures[$i]["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
</table>

*/
?>
</div>

