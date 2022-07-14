<?php
require_once('../../classes/pager/class.pager.php');
require_once('data.php');
$query="
SELECT ID, Content  
FROM wm_pages 
WHERE 1 AND Deleted=0 AND noindex=0 AND
Content LIKE '%<a%'
";
$arr=$db->getArray($query);

$arrLinks=array();

foreach($arr as $row){
	//echo "<br />".$row["Content"];
/*
	$regex = "/<a.*?href=[\"']?([-a-z\x{5D0}-\x{5EA}0-9_\ -])[\"']?.*?>(.*?)<\/a>/iu";
	$regex = "/<a.*?href=[\"']?(.*?)[\"']?.*?>(.*?)<\/a>/iu";
*/
	
	$regex = "/<a.*?href=[\"']?(.*?)[\"']?.*?>(.*?)<\/a>/i";

	preg_match_all($regex, $row["Content"], $matches);

	foreach($matches[0] as $match){

		$a = new SimpleXMLElement($match);

		$link=urldecode($a["href"]);

		if(!$string->startsWith($link, "mailto:") && !$string->startsWith($link, "geo") && !$string->startsWith($link, "tel")){

			$ch = curl_init($link); 
			curl_setopt($ch, CURLOPT_HEADER, 1); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$c = curl_exec($ch); 
			$arrValues=explode(" ", curl_getinfo($ch, CURLINFO_HTTP_CODE));
			$status=$arrValues[0];
			
			if($status!=200){
				array_push($arrLinks, array(
					"ID"	=>	$row["ID"],	
					"Link"	=>	$link,
					"Status"=>	$status
				));
			}
		}
	}
}


/*
$id=	intval($_REQUEST["id"]);
$page=	intval($_REQUEST["page"]);



if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");

$page_row=$wm->getValues($page_id);

//$picturesTree=new TreeData($db, $update_table);

$gui=new Gui("he");

$query="SELECT ID, Name, File_Name FROM ".$update_table." WHERE 1";

if($_REQUEST["search"]){
	$query.=" AND (Name LIKE '%".$_REQUEST["search"]."%')";
}

$query.=" ORDER BY Name";



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

*/
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


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">





<?php for($i=0;$i<count($arrLinks);$i++){?>
<li id="listItem_<?php echo $arrLinks[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemContent">

		
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<?php echo $arrLinks[$i]["Link"];?>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=pages/page_edit&amp;id=<?php echo $arrLinks[$i]["ID"];?>"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>

		<div class="itemSap"></div>

		<div class="listItemIcon" style="padding-top: 10px; font-size: 16px; text-align: center;">
			<?php echo $arrLinks[$i]["Status"];?>
		</div>







<!--
		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>" onclick="highlight('listItem_<?php echo $arr[$i]["ID"];?>');return confirm2('listItem_<?php echo $arr[$i]["ID"];?>', 'listItemImage_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=<?php echo $folderName;?>/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arr[$i]["ID"];?>&amp;search=<?php echo $_REQUEST["search"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
		</div>
		<div class="itemSap"></div>

		<div style="clear: both;"></div>
-->
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
פריטים בדף

<div class="pager_numbers"><?php echo $pagelist;?></div>
