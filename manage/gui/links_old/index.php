<?php
require_once('../../classes/pager/class.pager.php');

$update_table="wm_links";

$id=intval($_REQUEST["id"]);
$page=intval($_REQUEST["page"]);

$content_update=new ContentUpdater($db, $update_table);

if(strcmp($_REQUEST["do"], "del")==0 && $id){
	$file_to_delete=$content_update->get($id, "File_Name");
	if($file_to_delete){
		@unlink("../../".$file_to_delete);
	}
	$content_update->delete($id);
}


$page_row=$wm->getValues($page_id);


$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

//$arr_brands=$wm->getRelatedTableArray($page_id);
$query="SELECT * FROM ".$update_table." ORDER BY Ordering";

$limit=20;

if(!$page){
	$page=1;
}

$p = new Pager;
$start = $p->findStart($limit); 
$count = $db->getNumRecords($query);
$pages = $p->findPages($count, $limit); 
$pagelist = $p->pageList($page, $pages); 
$arr_brands=$db->getArray($query." LIMIT ".$start.", ".$limit);
?>
<?php require_once('common/header.php');?>

<?php require_once('common/body.php');?>
<div class="navigator_line">
<a href="index.php?show=links/index"><?php echo $text["Links"];?></a> -> <?php echo $text["Items"];?>
</div>
<div class="editPagePadding">
<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><a href="index.php?show=links/edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add a Picture" /></a><br />
	  </td>
	</tr>
	<tr>
		<td colspan="3" align="center"><div class="pager_numbers"><?php echo $pagelist;?></div></td>
	</tr>
	
<?php for($i=0;$i<count($arr_brands);$i++){?>	
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
	
		<td valign="top">
		<?php if(file_exists("../../".$arr_brands[$i]["File_Name"])){?>
			<img src="<?php echo "../../".$arr_brands[$i]["File_Name"];?>" width="70" border="1" />
		<?php };?>		</td>
		<td width="200" valign="top">&nbsp;<?php echo $arr_brands[$i]["Name"];?>&nbsp;</td>
		
		<td valign="top">
		<?php if(!$picturesTree->isOnBottom($arr_brands[$i]["ID"])){?>
		<a href="../interface/tree_operations/order_other.php?order=down&amp;id=<?php echo $arr_brands[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/down.gif" alt="Move Down" /></a>
		<?php }?>		</td>
		<td valign="top">
		<?php if(!$picturesTree->isOnTop($arr_brands[$i]["ID"])){?>
		<a href="../interface/tree_operations/order_other.php?order=up&amp;id=<?php echo $arr_brands[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/up.gif" alt="Move Up" /></a>
		<?php }?>		</td>		
		
		
		
		<td valign="top"><a href="index.php?show=links/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_brands[$i]["ID"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>

<!--
		<td>
		
		<a href="index.php?show=products/gallery_pictures&amp;WM_Links=<?php echo $arr_brands[$i]["ID"];?>"><img border="0" src="images/icons/edit_pictures.gif" alt="Edit pictures" /></a>
		
		</td>
-->
		<td valign="top"><a href="index.php?show=links/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arr_brands[$i]["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
</table>
</div>
