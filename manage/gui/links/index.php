<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$id=	intval($_REQUEST["id"]);
$page=	intval($_REQUEST["page"]);

$content_update=new ContentUpdater($db, $update_table);

if (isset($_GET['Hide_On_Menu']))
{
		$arrFields=array(
			"Hide_On_Menu"				=>	$_GET["Hide_On_Menu"]
		);
		$new_id=$content_update->update($id, $arrFields);
		//die("id:".$id.", value:".$_GET["Hide_On_Menu"]);
}

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
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");

$page_row=$wm->getValues($page_id);

//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

$query="SELECT ID, Name, Hide_On_Menu, File_Name FROM ".$update_table." WHERE 1";

if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%')";
}

$query.=" ORDER BY Ordering";



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
		$("#info").load("<?php echo $folderName;?>/order_jquery.php?"+order);
		
      }
    });
});
</script>
<?php require_once('common/body.php');?>
<div class="navigator_line">
<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> -> <?php echo $text["Items"];?>
</div>
<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
	<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>

	<form name="searchItems" method="get" class="searchItemsForm">
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="text" name="search" value="" />
		<input type="submit" name="submit" value="<?php echo $text["Search"];?>" />
	</form>
</div>

<div class="listItemsScroller" dir="ltr" style="width: 810px;">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">
<?php for($i=0;$i<count($arr);$i++){?>
<li id="listItem_<?php echo $arr[$i]["ID"];?>" class="listItemImage_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemImageContent">

		<div class="listItemImageImage">
			<?php if($arr[$i]["File_Name"] && file_exists("../../".$arr[$i]["File_Name"])){?>
				<img src="<?php echo $cfg["WM"]["Server"]."/".$arr[$i]["File_Name"];?>" border="1" />
			<?php };?>
		</div>

		<div class="listItemText" dir="<?php echo $gui->getDir();?>" style="width: 400px;">
			<?php echo $arr[$i]["Name"];?>
		</div>

		<div class="listItemIcon">
				<a href="index.php?show=<?php echo $folderName;?>/index&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;Hide_On_Menu=<?php echo ($arr[$i]["Hide_On_Menu"]==1)?"0":"1";?>"><img border="0" src="images/icons/Eye0<?php echo $arr[$i]["Hide_On_Menu"]?"0":"1";?>.png" alt="Hide On Menu" /></a>
		</div>
		
		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlightImage('listItem_<?php echo $arr[$i]["ID"];?>');return confirm2('listItem_<?php echo $arr[$i]["ID"];?>', 'listItemImage_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
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

<?php echo $text["Showing"];?>
<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
<?php echo $text["items on page"];?>

<div class="pager_numbers"><?php echo $pagelist;?></div>
