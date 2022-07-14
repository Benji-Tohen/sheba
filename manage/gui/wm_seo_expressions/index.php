<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$id=	intval($_REQUEST["id"]);
$page=	intval($_REQUEST["page"]);

$content_update=new ContentUpdater($db, $update_table);


if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");

if($_REQUEST["runCheck"]){

	$cur_date=date("Y-m-d H:i:s", time());

	$query="SELECT ID, Name FROM wm_seo_expressions ORDER BY Ordering";
	$arr=$db->getArray($query);

	foreach($arr as $item){
/*
		$query="
			INSERT INTO wm_seo_expressions_occurrences (wm_seo_expressions, num_occurences, check_date) 
			SELECT ".$item["ID"].", COUNT(*) AS num_occurences, '".$cur_date."' 
			FROM wm_pages 
			WHERE wm_pages.Name LIKE '%".mysqli_real_escape_string($db->conn, $item["Name"])."%' OR wm_pages.Sub_Title LIKE '%".mysqli_real_escape_string($db->conn, $item["Name"])."%' OR wm_pages.Content LIKE '%".mysqli_real_escape_string($db->conn, $item["Name"])."%'
			";	
*/
/*
		$query="
			INSERT INTO wm_seo_expressions_occurrences (wm_seo_expressions, num_occurences, check_date) 
			SELECT ".$item["ID"].", SUM(
(LENGTH(wm_pages.Name) - LENGTH(REPLACE(wm_pages.Name, '".mysqli_real_escape_string($db->conn, $item["Name"])."', ''))) 
+
(LENGTH(wm_pages.Content) - LENGTH(REPLACE(wm_pages.Content, '".mysqli_real_escape_string($db->conn, $item["Name"])."', ''))) 
+
(LENGTH(wm_pages.Sub_Title) - LENGTH(REPLACE(wm_pages.Sub_Title, '".mysqli_real_escape_string($db->conn, $item["Name"])."', ''))) 
) AS num_occurences, '".$cur_date."'    
			FROM wm_pages 
			WHERE Deleted=0
		";
*/

		$query="
			INSERT INTO wm_seo_expressions_occurrences (wm_seo_expressions, num_occurences, check_date) 
			VALUES(".$item["ID"].", (
					SELECT COUNT(*) 
					FROM wm_pages
					WHERE					
					wm_pages.Content LIKE '%".mysqli_real_escape_string($db->conn, $item["Name"])."%'
					OR
					wm_pages.Sub_Title LIKE '%".mysqli_real_escape_string($db->conn, $item["Name"])."%'					
					AND Deleted=0 AND noindex=0
			), '".$cur_date."')
			
		";




/*
+
(LENGTH(wm_pages.Content) - LENGTH(REPLACE(wm_pages.Content, '".mysqli_real_escape_string($db->conn, $item["Name"])."', '')))
 + 

(LENGTH(wm_pages.Sub_Title) - LENGTH(REPLACE(wm_pages.Content, '".mysqli_real_escape_string($db->conn, $item["Name"])."', ''))) 
*/
/*
 + 
(LENGTH(wm_pages.Name) - LENGTH(REPLACE(wm_pages.Content, '".mysqli_real_escape_string($db->conn, $item["Name"])."', ''))) +
(LENGTH(wm_pages.Sub_Title) - LENGTH(REPLACE(wm_pages.Content, '".mysqli_real_escape_string($db->conn, $item["Name"])."', ''))) 
*/
		$db->runQuery($query);
	}

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





$page_row=$wm->getValues($page_id);


//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

$query="SELECT ID, Name FROM ".$update_table." WHERE 1";

if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%')";
}

$query.=" ORDER BY wm_seo_expressions.Ordering";

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
	<input type="button" name="check" value="<?php echo $text["Run Check"];?>" onclick="document.location='index.php?show=<?php echo $folderName;?>/index&runCheck=true';" style="cursor: pointer; float: left;" />
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
		<div class="listItemText" dir="<?php echo $gui->getDir();?>" style="width: 400px;">
			<?php echo $arr[$i]["Name"];?>
		</div>





		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
		</div>
		<div class="itemSap"></div>


<?php 
$query="
		SELECT ID, num_occurences, DATE_FORMAT(check_date, '%d/%m/%Y %H:%i:%s') AS check_date 
		FROM wm_seo_expressions_occurrences 
		WHERE wm_seo_expressions=".$arr[$i]["ID"]."
		ORDER BY check_date DESC 
		LIMIT 0,1
";
$arrOcc=$db->getArray($query);
?>



		<div class="listItemIcon" style="width: 100px; float: right;" dir="rtl">
		<?php echo intval($arrOcc[0]["num_occurences"]);?> 
			Appearances 
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
Items In Page

<div class="pager_numbers"><?php echo $pagelist;?></div>






















<?php
/*




<div class="editPagePadding">

<br /><br />
<form name="search">
	<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
	<input type="text" name="search" value="" />
	<input type="submit" name="submit" value="<?php echo $text["Search"];?>" />
</form>
<br />


<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add" /></a>







<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><br />
	  </td>
	</tr>
	<tr>
		<td colspan="3" align="center"><div class="pager_numbers"><?php echo $pagelist;?></div></td>
	</tr>
	
<?php for($i=0;$i<count($arr);$i++){?>	
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
	
		<td valign="top">
		<?php if($arr[$i]["File_Name"] && file_exists("../../".$arr[$i]["File_Name"])){?>
			<img src="<?php echo "../../".$arr[$i]["File_Name"];?>" width="70" border="1" />
		<?php };?>		</td>
		<td width="200" valign="top">&nbsp;<?php echo $arr[$i]["Name"];?>&nbsp;</td>


<?php 
$query="
		SELECT ID, num_occurences, DATE_FORMAT(check_date, '%d/%m/%Y %H:%i:%s') AS check_date 
		FROM wm_seo_expressions_occurrences 
		WHERE wm_seo_expressions=".$arr[$i]["ID"]."
		ORDER BY check_date DESC 
		LIMIT 0,1
";
$arrOcc=$db->getArray($query);
?>

	

<td>
	<?php echo $arrOcc[0]["num_occurences"];?> הופעות
	
</td>
		
		




		
		<td valign="top"><a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>


		<td valign="top"><a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
</table>
</div>

*/
