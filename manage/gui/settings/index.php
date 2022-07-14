<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');


$id=		intval($_REQUEST["id"]);
$page=		intval($_REQUEST["page"]);
$parent=	intval($_REQUEST["parent"]);

if(!$parent){
	$parent=0;
}

$content_update=new ContentUpdater($db, $update_table);

/*
if(strcmp($_POST["do"], "duplicate")==0){
	$query="
		SELECT * 
		FROM ".$update_table." 
		WHERE Parent=0 AND wm_template=".intval($_POST["duplicateFrom"])."
	";
	$arr=$db->getArray($query);

	foreach($arr as $item){
		$itemId=$item["ID"];
		unset($item["ID"]);
		$item["wm_template"]=intval($_POST["duplicateTo"]);

		$newId=$db->updateData($update_table, $item, NULL);

		$query="
			SELECT * 
			FROM ".$update_table." 
			WHERE Parent=".$itemId." AND wm_template=".intval($_POST["duplicateFrom"])."
		";
		$arrInner=$db->getArray($query);
		foreach($arrInner as $inner){
			unset($inner["ID"]);
			$inner["Parent"]=$newId;
			$inner["wm_template"]=intval($_POST["duplicateTo"]);
			$newInnerId=$db->updateData($update_table, $inner, NULL);
		}

		
	}
}
*/

if(strcmp($_REQUEST["do"], "reset")==0){
	$queryReset="
		UPDATE ".$update_table." SET closed=0
	";
	$db->runQuery($queryReset);
}

if(strcmp($_REQUEST["do"], "closed")==0 && $id){
	$closed=$content_update->get($id, "closed");
	$fieldsArray=array(
		"closed"	=>	($closed?0:1)
	);


	$content_update->update($id, $fieldsArray);
}


if(strcmp($_REQUEST["do"], "del")==0 && $id){
/*
	$file_to_delete=$content_update->get($id, "File_Name");
	if($file_to_delete){
		@unlink("../../".$file_to_delete);
	}
*/
	$queryDelete="
		DELETE FROM $update_table WHERE Parent=".intval($id)."
	";

	$db->runQuery($queryDelete);

	$content_update->delete($id);
}

if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");

$page_row=$wm->getValues($page_id);




//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

$query="SELECT ID, Parent, Name, nice_name, Closed FROM ".$update_table." WHERE 1";

if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%') ";
}else{
	$query.=" AND Parent=".intval($parent);
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
<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a> 
<?php if($parent){echo " -> ".$db->getField("SELECT Name FROM ".$update_table." WHERE ID=".$parent, "Name");
}?>
 -> <?php echo $text["Items"];?>
</div>
<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
	<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;parent=<?php echo $parent;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>

	<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=reset" style="float: left;">אפס השלמות</a>

<?php
//$templates=$db->getArray("SELECT ID, Name FROM wm_template ORDER BY ID");
?>
	<form name="searchItems" method="get" class="searchItemsForm">
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="text" name="search" value="" />
<?php
/*
		<select name="template">
			<?php foreach($templates as $item){?>
				<option value="<?php echo $item["ID"];?>" <?php echo $item["ID"]==$template?"selected":"";?>><?php echo $item["Name"];?></option>
			<?php }?>
		</select>
*/
?>
		<input type="submit" name="submit" value="<?php echo $text["Search"];?>" />
	</form>
</div>


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">

<?php
/*
$templates=$db->getArray("SELECT ID, Name FROM wm_template ORDER BY ID");
?>
	<form name="searchItems" method="post" class="searchItemsForm">
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="hidden" name="do" value="duplicate" />		
		<input type="hidden" name="duplicateTo" value="<?php echo $template;?>" />
		<select name="duplicateFrom">
			<?php foreach($templates as $item){
				if($item["ID"]==$template){
					continue;
				}
			?>
				<option value="<?php echo $item["ID"];?>" <?php echo $item["ID"]==$template?"selected":"";?>><?php echo $item["Name"];?></option>
			<?php }?>
		</select>
		<input type="submit" name="submit" value="Duplicate" />
	</form>
<?php
*/
?>

<?php for($i=0;$i<count($arr);$i++){?>
<li id="listItem_<?php echo $arr[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>" style="<?php echo $arr[$i]["Closed"]?"background-color: #ff0000;":"";?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemContent">
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;parent=<?php echo $arr[$i]["ID"];?>"><?php echo $arr[$i]["Name"];?> <?php echo ($arr[$i]["Parent"]>0)?" / ".$arr[$i]["nice_name"]:"";?></a>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;parent=<?php echo $parent;?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
		</div>

		<div class="itemSap"></div>
		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=closed&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;parent=<?php echo $parent;?>"><img border="0" src="images/icons/closed.gif" alt="Closed" style="margin-top: 5px;" /></a>
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


הצג 
<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
פריטים בדף

<div class="pager_numbers"><?php echo $pagelist;?></div>
