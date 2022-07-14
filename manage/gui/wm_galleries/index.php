<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$gui=new Gui("he");
$id=intval($_REQUEST["id"]);
$content_update=new ContentUpdater($db, $update_table);

if(strcmp($_REQUEST["do"], "del")==0 && $id){
	// Delete gallery connections
	$db->runQuery("DELETE FROM wm_gallery_page WHERE wm_gallery_id = ".$id);

	// Delete gallery items
	$galleryItemsToDelete = $db->getArray('SELECT * FROM wm_pages_gallery WHERE wm_gallery_id = '.$id);
	if(!empty($galleryItemsToDelete)){
		// Delete images files
		foreach ($galleryItemsToDelete as $galleryItemKey => $galleryItem) {
			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$galleryItem['File_Name'])){
				unlink($_SERVER['DOCUMENT_ROOT'].'/'.$galleryItem['File_Name']);
			}

			if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$galleryItem['File_Name_Mobile'])){
				unlink($_SERVER['DOCUMENT_ROOT'].'/'.$galleryItem['File_Name_Mobile']);
			}
		}
		// Delet gallery items rows
		$db->runQuery("DELETE FROM wm_pages_gallery WHERE wm_gallery_id = ".$id);
	}
	

	// Delete gallery
	$content_update->delete($id);
}

if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");


$query="SELECT wm_galleries.ID, wm_galleries.Name FROM ".$update_table;
$query.=" WHERE 1";
if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%')";
}
$query.=" ORDER BY wm_galleries.Ordering";
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
<script language="JavaScript" type="text/javascript" src="JS/ajax.js"></script>

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
<script type="text/javascript" src="JS/sort/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="JS/sort/jquery-ui-personalized-1.6rc4.min.js"></script>

<?php require_once('common/body.php');?>
<div class="navigator_line">
<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $text["Items"];?>
</div>
<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
	<a href="index.php?show=<?php echo $folderName;?>/edit&amp;gallery_id=0"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="text" name="search" value="" />
		<input type="submit" name="submit" id="form_submit" value="<?php echo $text["Search"];?>" />
	</form>
</div>


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">

<?php for($i=0;$i<count($arr);$i++){?>
<li id="listItem_<?php echo $arr[$i]["ID"];?>" class="listItemImage_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemImageContent">

		<div class="listItemImageImage">
			<?php if($arr[$i]["File_Name"] && file_exists("../../".$arr[$i]["File_Name"])){ ?>
				<img src="<?php echo $cfg["WM"]["Server"]."/".$arr[$i]["File_Name"];?>" border="1" width="80" height="80" />
			<?php };?>
		</div>

		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<?php echo $arr[$i]["Name"];?>
		</div>
                
		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;gallery_id=<?php echo $arr[$i]["ID"];?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlightImage('listItem_<?php echo $arr[$i]["ID"];?>');return confirm2('listItem_<?php echo $arr[$i]["ID"];?>', 'listItemImage_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/edit&amp;gallery_id=<?php echo $arr[$i]["ID"];?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
		</div>
		<div class="itemSap"></div>
			<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/connect&amp;gallery_id=<?php echo $arr[$i]["ID"];?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Links00.png" alt="Connect" /></a>
		</div>
		<div class="itemSap"></div>
		<div class="itemSap"></div>
			<div class="listItemIcon">
			<a href="index.php?show=gallery/gallery_pictures&gallery_id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/site_integration/top_menu/gallery.png" alt="Gallery" /></a>
		</div>
              
		<div style="clear: both;"></div>
	</div>
</li>
<?php }?>

</ul>
<div class="listItemLast"></div>
</div>
</div>
<br />

<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
פריטים בדף

<div class="pager_numbers"><?php echo $pagelist;?></div>

<style>
    .listItemText{width: 400px !important;}
</style>