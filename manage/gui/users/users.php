<?php 
if(!$user_id){
	$user_id=1;
}

$arr=$login->getArray($user_id, " ORDER BY First_Name, Last_Name");
?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Users"];?></div>
<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
	<a href="index.php?show=users/edit_user"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>
<!--
	<form name="searchItems" method="get" class="searchItemsForm">
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="text" name="search" value="" />
		<input type="submit" name="submit" value="<?php echo $text["Search"];?>" />
	</form>
-->

</div>

<br />
<br />


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">
<?php for($i=0;$i<count($arr);$i++){?>
<li id="listItem_<?php echo $arr[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemContent">

		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<?php echo $arr[$i]["First_Name"];?> <?php echo $arr[$i]["Last_Name"];?>
			<div style="font-sie: 10px;"><?php echo ($arr[$i]["Level"]==1)?$text["Administrator"]:$text["Manager"];?></div>
		</div>

<?php
/*
		<div class="listItemIcon">
				<a href="index.php?show=<?php echo $folderName;?>/index&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;Hide_On_Menu=<?php echo ($arr[$i]["Hide_On_Menu"]==1)?"0":"1";?>"><img border="0" src="images/icons/Eye0<?php echo $arr[$i]["Hide_On_Menu"]?"0":"1";?>.png" alt="Hide On Menu" /></a>
		</div>
*/
?>		
		<div class="listItemIcon">
			<a href="../interface/tree_operations/delete_user.php?id=<?php echo $arr[$i]["ID"];?>" onclick="highlightImage('listItem_<?php echo $arr[$i]["ID"];?>');return confirm2('listItem_<?php echo $arr[$i]["ID"];?>', 'listItemImage_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=users/edit_user&amp;user_id=<?php echo $arr[$i]["ID"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
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

<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
<?php echo $text["items on page"];?>

<div class="pager_numbers"><?php echo $pagelist;?></div>




























<table cellspacing="0" class="list_table">
	<tr>
		<td>
			<a href="index.php?show=users/edit_user"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add a user" /></a>
		<br /><br /></td>
	</tr>

<?php for($i=0;$i<count($arr_tree);$i++){?>	
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
		<td width="200" style="padding-left: 3px; padding-right: 3px;" valign="middle">
		&nbsp;<strong><?php echo $arr_tree[$i]["First_Name"];?> <?php echo $arr_tree[$i]["Last_Name"];?></strong>
		</td>
		<td width="200" style="padding-left: 3px; padding-right: 3px;" valign="middle">
			<?php echo ($arr_tree[$i]["Level"]==1)?$text["Administrator"]:$text["Manager"];?>
		</td>
		<td><a href="index.php?show=users/edit_user&amp;user_id=<?php echo $arr_tree[$i]["ID"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>
		<td><a href="../interface/tree_operations/delete_user.php?id=<?php echo $arr_tree[$i]["ID"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
<?php }?>
</table>	
</div>
