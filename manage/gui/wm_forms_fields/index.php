<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');




$id=		intval($_REQUEST["id"]);
$page=		intval($_REQUEST["page"]);
$form_id=	intval($_REQUEST["form_id"]);

$content_update=new ContentUpdater($db, $update_table);

$form_content_update=new ContentUpdater($db, "wm_forms");

if(strcmp($_REQUEST["do"], "del")==0 && $id){
/*
	$file_to_delete=$content_update->get($id, "File_Name");
	if($file_to_delete){
		@unlink("../../".$file_to_delete);
	}
*/
	$content_update->delete($id);
}

if($_REQUEST["num_items"]){
	//$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=isset($_REQUEST["num_items"]) ? $_REQUEST["num_items"]: 100;//$params->getValue("pages_list_num_items_per_page");

$page_row=$wm->getValues($page_id);

//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

$query="SELECT ID, Name FROM ".$update_table." WHERE 1 AND wm_forms=".intval($form_id);

if($_REQUEST["search"] && !intval($_REQUEST["form_id"])){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%' OR Value LIKE '%".$_REQUEST["search"]."%')";
}

$query.=" ORDER BY Ordering, ID Asc";




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
<script type="text/javascript" src="JS/sort/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="JS/sort/jquery-ui-personalized-1.6rc4.min.js"></script>

<script type="text/javascript">
  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {
    $("#test-list").sortable({
      handle : '.handle',
      update : function () {		
		var order = $('#test-list').sortable('serialize');
		$("#info").load("<?php echo $folderName;?>/order_jquery.php?form_id=<?php echo $form_id;?>&"+order);
		
      }
    });
});
</script>
<?php require_once('common/body.php');?>
<div class="navigator_line">
    <a style="color: #ffffff;" href="index.php?show=wm_forms/index"><?php echo $text['all forms'];?></a>
<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index&form_id=<?php echo $form_id;?>"><?php echo $pageName;?></a> "<?php echo $form_content_update->get($form_id, "Name");?>" -> <?php echo $text["Items"];?>
</div>
<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
	<a href="javascript:history.back()"><img border="0" src="images/icons/back.gif" style="cursor: pointer; float: left; margin-top:8px; margin-right:30px" alt="Back" /></a>
	<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;form_id=<?php echo $form_id;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>

<?php /*
	<form name="searchItems" method="get" class="searchItemsForm">
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="text" name="search" value="" />
		<input type="submit" name="submit" value="<?php echo $text["Search"];?>" />
	</form>

	*/?>
</div>

<a target="_blank" style="    float: right;    margin: 2px 20px 0px 0px;    text-decoration: underline;" href="<?php echo $cfg["WM"]["Server"]?>/item/57328/1000/<?php echo $form_id?>">לצפייה בטופס</a>
<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">
    
<?php for($i=0;$i<count($arr);$i++){?>
<li id="listItem_<?php echo $arr[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemContent">
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<?php echo $arr[$i]["Name"];?>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;form_id=<?php echo $form_id;?>&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/edit&amp;form_id=<?php echo $form_id;?>&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
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


<?php echo $text["Display"];?>
<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value+'&form_id=<?php echo $form_id;?>'">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
<?php echo $text["Items on page"];?>

<div class="pager_numbers"><?php echo $pagelist;?></div>
