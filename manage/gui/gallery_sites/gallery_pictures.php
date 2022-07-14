<?php
require_once('../../classes/pager/class.pager.php');

$update_table="wm_sites_gallery";

$id=$_REQUEST["id"];
$page_id=$_REQUEST["page_id"];

$content_update=new ContentUpdater($db, $update_table);

if(strcmp($_REQUEST["do"], "del")==0 && $id){
	$file_to_delete=$content_update->get($id, "File_Name");
	@unlink("../../".$file_to_delete);
	$content_update->delete($id);
}


$page_row=$wm->db->getRow("SELECT * FROM wm_sites WHERE ID=".$page_id);


$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

//$arr_pictures=$wm->getRelatedTableArray($page_id);
$query="SELECT * FROM ".$update_table." WHERE WM_Pages=".$page_id." ORDER BY Ordering";

$limit=7;
$page=$_REQUEST["page"];
if(!$page){
	$page=1;
}

/*************************************************************************************************************
*	Pager Attributes																						 *
*	Requires:
*				pager.php	
*/
/* 	Show many results per page? 																			*/ 
/* 	Instantiate class 																						*/ 
/*	require_once("../Union_Members/class.pager.php");														*/ 	
	$p = new Pager;
/* 	Find the start depending on $_GET['page'] (declared if it's null) 										*/ 
	$start = $p->findStart($limit); 
/* 	Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query 			*/ 
	$count = $db->getNumRecords($query);
/* 	Find the number of pages based on $count and $limit 													*/ 
	$pages = $p->findPages($count, $limit); 
/* 	Now we use the LIMIT clause to grab a range of rows 													*/ 

/*	Now get the page list and echo it 																		*/ 
	$pagelist = $p->pageList($page, $pages); 
	$arr_pictures=$db->getArray($query." LIMIT ".$start.", ".$limit);
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
<a style="color: #ffffff;" href="index.php?id=<?php echo $page_row["Parent"];?>"><?php echo $page_row["Name"];?></a> -> <?php echo $text["Items"];?>
</div>
<div style="padding-left: 30px;padding-right: 30px; padding-top: 10px; color: #ffffff; font-weight: bold;">
<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><a href="index.php?show=gallery_sites/gallery_pictures_edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add a Picture" /></a><br />
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
		<?php if(!$picturesTree->isOnBottom($arr_pictures[$i]["ID"])){?>
		<a href="../interface/tree_operations/order_other.php?order=down&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/down.gif" alt="Move Down" /></a>
		<?php }?>		</td>
		<td valign="top">
		<?php if(!$picturesTree->isOnTop($arr_pictures[$i]["ID"])){?>
		<a href="../interface/tree_operations/order_other.php?order=up&amp;id=<?php echo $arr_pictures[$i]["ID"];?>&amp;table=<?php echo $update_table;?>"><img border="0" src="images/icons/up.gif" alt="Move Up" /></a>
		<?php }?>		</td>		
		<td valign="top"><a href="index.php?show=gallery_sites/gallery_pictures_edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr_pictures[$i]["ID"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>
		<td valign="top"><a href="index.php?show=gallery_sites/gallery_pictures&amp;do=del&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arr_pictures[$i]["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
</table>
</div>
