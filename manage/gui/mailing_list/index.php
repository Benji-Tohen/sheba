<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$id=	intval($_REQUEST["id"]);

$content_update=new ContentUpdater($db, $update_table);

if(strcmp($_REQUEST["do"], "del")==0 && $id){
/*
	$file_to_delete=$content_update->get($id, "File_Name");
	if($file_to_delete){
		@unlink("../../".$file_to_delete);
	}
*/
	$content_update->delete($id);
}


$page_row=$wm->getValues($page_id);


//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui($cfg["WM"]["Default_Language"]);

$query="SELECT * FROM ".$update_table." WHERE 1";
if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%')";
}
$query.=" ORDER BY Created_Date DESC";

$limit=10;
$page=$_REQUEST["page"];
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
<style type="text/css">
.pager_numbers{
	color: #ffffff;
}
</style>
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






<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">

<?php for($i=0;$i<count($arr);$i++){?>
<li id="listItem_<?php echo $arr[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_2.png" class="handleoff" alt="Sort" border="0" />

	<div class="listItemContent">
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<?php echo $arr[$i]["Name"];?>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>


		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/mailing_form&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>"><img border="0" src="images/icons/send.png" alt="Send" /></a>
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





















<?php
/*

<div class="editPagePadding">
<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add" /></a><br />
	  </td>
	</tr>

	
<?php for($i=0;$i<count($arr);$i++){?>	
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
	

		<td width="200" valign="top">&nbsp;<?php echo $arr[$i]["Name"];?>&nbsp;</td>

		
		<td valign="top"><a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>
		<td valign="top"><a href="index.php?show=<?php echo $folderName;?>/mailing_form&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>"><img border="0" src="images/icons/send.gif" alt="Send" /></a></td>

		<td valign="top"><a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arr[$i]["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
	<tr>
		<td colspan="3" align="center"><div class="pager_numbers"><?php echo $pagelist;?></div></td>
	</tr>
</table>
</div>
*/

?>
