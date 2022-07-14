<?php
require_once('../../classes/pager/class.pager.php');

$update_table="wm_sites";

$id=$_REQUEST["id"];

$content_update=new ContentUpdater($db, $update_table);

if(strcmp($_REQUEST["do"], "del")==0 && $id){
	$file_to_delete=$content_update->get($id, "File_Name_1");
	if(file_exists("../../".$file_to_delete)){
		@unlink("../../".$file_to_delete);
	}
	$file_to_delete=$content_update->get($id, "File_Name_2");
	if(file_exists("../../".$file_to_delete)){
		@unlink("../../".$file_to_delete);	
	}
	rmdir("../../".$cfg["WM"]["File_Uploades_Folder"]."Sites/".$id);
	$content_update->delete($id);
}



$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

/**************************************************************************************************************
	Pager	
**************************************************************************************************************/
$query="SELECT * FROM ".$update_table." ORDER BY Ordering";

$limit=7;
$page=$_REQUEST["page"];
if(!$page){
	$page=1;
}
	$p = new Pager;
	$start = $p->findStart($limit); 
	$count = $db->getNumRecords($query);
	$pages = $p->findPages($count, $limit); 
	$pagelist = $p->pageList($page, $pages); 
	$arr_sites=$db->getArray($query." LIMIT ".$start.", ".$limit);
/* 																											 *
*************************************************************************************************************/

?>
<?php require_once('common/header.php');?>
<style type="text/css">
.pager_numbers{
	color: #ffffff;
}
</style>
<?php require_once('common/body.php');?>
<div class="navigator_line">
	<?php echo $text["Sites"];?>
</div>
<div style="padding-left: 30px;padding-right: 30px; padding-top: 10px; color: #ffffff; font-weight: bold;">
<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><a href="index.php?show=sites/edit"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add a Site" /></a><br /><br />
	  </td>
	</tr>
	<?php for($i=0;$i<count($arr_sites);$i++){?>
		<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
			<td style="width: 200px; padding-right: 5px;"><?php echo $arr_sites[$i]["Name"];?></td>			
			<td valign="top">
			<?php if(!$picturesTree->isOnBottom($arr_sites[$i]["ID"])){?>
			<a href="../interface/tree_operations/order_other.php?order=down&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/down.gif" alt="Move Down" /></a>
			<?php }?>		</td>
			<td valign="top">
			<?php if(!$picturesTree->isOnTop($arr_sites[$i]["ID"])){?>
			<a href="../interface/tree_operations/order_other.php?order=up&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/up.gif" alt="Move Up" /></a>
			<?php }?>		</td>		
			<td valign="top"><a href="index.php?show=sites/edit&amp;id=<?php echo $arr_sites[$i]["ID"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>
			<td>			
			<a href="index.php?show=gallery_sites/gallery_pictures&amp;page_id=<?php echo $arr_sites[$i]["ID"];?>"><img border="0" src="images/icons/edit_pictures.gif" alt="Edit pictures" /></a>
			</td>		
			<td>			
			<a href="index.php?show=gallery_personal/gallery_pictures&amp;page_id=<?php echo $arr_sites[$i]["ID"];?>"><img border="0" src="images/icons/edit_pictures.gif" alt="Edit personal" /></a>
			</td>						
			<td valign="top"><a href="index.php?show=sites/index&amp;do=del&amp;id=<?php echo $arr_sites[$i]["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
		</tr>
	<?php }?>
</table>
</div>	