<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');

$domain = $_SERVER['SERVER_NAME'];
$domain_parent = $wm->getHomePageByDomain($domain);

$id=	intval($_REQUEST["id"]);
$page=	intval($_REQUEST["page"]);
$parent=	intval($_REQUEST["parent"]);

if(isset($_REQUEST["searchFilter"]) && $_REQUEST["searchFilter"]){
	$searchFilter = intval($_REQUEST["searchFilter"]);
}

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

if($_REQUEST["num_items"]){
	//$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=20;//$params->getValue("pages_list_num_items_per_page");

$page_row=$wm->getValues($page_id);

//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

if(isset($searchFilter)){
	$domain_parent = $searchFilter;
}


$query="SELECT * FROM ".$update_table." WHERE Parent = ".$domain_parent;

if($_REQUEST["search"]){
	if(isset($searchFilter) && $searchFilter == 1){
		$query="SELECT * FROM ".$update_table;
		$query.=" WHERE (Name LIKE '%".$_REQUEST["search"]."%')";
	} else {
		$query="SELECT * FROM ".$update_table." WHERE Parent = ".$domain_parent;
		$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%')";
	}
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
$homePagesArr = $db->getArray("SELECT ID,Name FROM wm_pages WHERE Page_Type=5 ORDER BY Name");

$arr=$db->getArray($query); // " WHERE Domain_Parent=$domain_parent AND 1"
?> 
<?php require_once('common/header.php');?>
<script type="text/javascript" src="JS/sort/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="JS/sort/jquery-ui-personalized-1.6rc4.min.js"></script>

<script type="text/javascript">
	const gui_wm_phones = {
		data:{
			getItem: 0,
			dropItem: 0,
			buttonClass: ".move-item"
		},
		init: function(){
			$(this.data.buttonClass).click( this.toggleItem );
		},
		toggleItem: function(event){
			event.preventDefault();
			if( gui_wm_phones.data.getItem == 0 ){
				gui_wm_phones.data.getItem = this.dataset.id;
			} else {
				gui_wm_phones.data.dropItem = this.dataset.id;
				const 	getItem = $("#listItem_"+gui_wm_phones.data.getItem),
						dropItem = $("#listItem_"+gui_wm_phones.data.dropItem),
						nextItem = getItem.next(),
						getItemClass = getItem.attr("class"),
						dropItemClass = dropItem.attr("class");

				if( nextItem.attr("id") == dropItem.attr("id") ){
					dropItem.after(getItem);
				} else{
					dropItem.before(getItem);
				}
				$('#test-list > li:even').attr("class", "listItem_0");
				$('#test-list > li:odd').attr("class", "listItem_1");
				const order = $('#test-list').sortable('serialize');
				$.get("<?php echo $folderName;?>/order_jquery.php?"+order);
				gui_wm_phones.data.getItem = 0;
				gui_wm_phones.data.dropItem = 0;
			}
			gui_wm_phones.toggleText();
		},
		toggleText: function(){
			$(this.data.buttonClass).each(function(index, button){
				const actual = $(button).text();
				$(button).text(button.dataset.text);
				button.dataset.text = actual;
			});
		},
		update: function(){
			var order = $('#test-list').sortable('serialize');
			$("#info").load("<?php echo $folderName;?>/order_jquery.php?"+order);
		}

	};

  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {
	gui_wm_phones.init();
    $("#test-list").sortable({
		handle : '.handle',
		update : function () {
			var order = $('#test-list').sortable('serialize');
			$("#info").load("<?php echo $folderName;?>/order_jquery.php?"+order);

		}
    });
});
</script>
<style>
	.title-flag{
		background-color:orange;
		border-radius: 8px;
		padding: 2px 5px;
		border: 1px solid #000000;
		inline-size: max-content;
	}
	.move-item{
		margin-top: .5em;
	}
</style>
<?php require_once('common/body.php');?>
<div class="navigator_line">
<a style="color: #ffffff;" href="index.php?show=<?php echo $folderName;?>/index"><?php echo $pageName;?></a><?php echo $text["Items"];?>
</div>
<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
	<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>

	<form name="searchItems" method="get" class="searchItemsForm">
		<input type="hidden" name="show" value="<?php echo $folderName;?>/index" />
		<input type="text" name="search" value="" />
		
		<select name="searchFilter">
			<option value="1"><?php echo $text["All"];?></option>
			<?php foreach ($homePagesArr as $key => $value) {?>
			<option value="<?php echo $value["ID"];?>" <?php if($_REQUEST["searchFilter"] == $value["ID"]){ echo 'selected'; }?>><?php echo $value["Name"];?></option>
			<?php }?>
		</select>
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
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<?php $domainName = $wm->get($arr[$i]["Parent"],"Name"); ?>
			<div>
				<?php if($arr[$i]["Title"] == 1){ ?>
					<span class="title-flag"><?php echo $text["Title"]; ?></span>
				<?php } ?>
				<?php echo $text["Name"];?><?php echo ":  ".$arr[$i]["Name"];?><?php echo "  ,".$text["Phone"];?><?php echo ":  ".$arr[$i]["AudioFile"]."   ".$domainName;?></div>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm1('listItem_<?php echo $arr[$i]["ID"];?>', 'listItem_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<button type="button" class="move-item" data-id="<?php echo $arr[$i]["ID"];?>" data-text="<?php echo $text["Drop"]; ?>"><?php echo $text["Get"]; ?></button>
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
<select name="num_items" onchange="document.location='index.php?show=<?php echo $folderName;?>/index&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
<?php echo $text["Items on page"];?>

<div class="pager_numbers"><?php echo $pagelist;?></div>
