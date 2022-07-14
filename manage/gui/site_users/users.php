<?php 
require_once('../../classes/pager/class.pager.php');
require_once('../../classes/site_users/class.site_users.php');
require_once('../../classes/export/class.export.php');
require_once('../../classes/file/class.file.php');

$delete_id=	intval($_REQUEST["id"]);
$formPageId=	intval($_REQUEST["formPageId"]);
$keywords=	$_REQUEST["keywords"];
$export=	($_REQUEST["export"]?1:0);

$siteUsers=new SiteUsers($db, "wm_siteusers");

if($delete_id){
	$siteUsers->delete($delete_id);
}

if($_REQUEST["num_items"]){
	$params->setParameter("pages_list_num_items_per_page", intval($_REQUEST["num_items"]));
}
$numItemsPerPage=$params->getValue("pages_list_num_items_per_page");

$fields="wm_siteusers.ID, Name, First_Name, Last_Name, Email, Enabled, JoiningDate";

$startDate=$endDate=NULL;

if($_GET["startDate"]){
	list($d,$m,$y)=explode("/", $_GET["startDate"]);
	$startDate=$y."-".$m."-".$d;
}

if($_GET["endDate"]){
	list($d,$m,$y)=explode("/", $_GET["endDate"]);
	$endDate=$y."-".$m."-".$d;
}


$query=$siteUsers->getSearchQuery($fields, $formPageId, $keywords, $startDate, $endDate);

//echo $query;



if($export){
	$ex=new Export($cfg["WM"]["DBServer"], $cfg["WM"]["DBName"], $cfg["WM"]["DBUser_Name"], $cfg["WM"]["DBPassword"]);
	$filePath="../../".$cfg["WM"]["File_Uploades_Folder"]."/export/";
	$file=new File();
	$file->checkPath($filePath);
	$fileName=$filePath.$table."__".date("d_m_Y__H_i_s", time()).".csv";
	$ex->exportQueryToFile($query, $fileName, $fields);
	exit;
}


$limit=$numItemsPerPage;
$page=$_REQUEST["page"];
if(!$page){
	$page=1;
}

$p = new Pager;
$start = $p->findStart($limit); 
$count = $db->getNumRecords($query);
$pages = $p->findPages($count, $limit); 
$pagelist = $p->pageList($page, $pages); 
$users=$db->getArray($query." LIMIT ".$start.", ".$limit);


$arrForms=$siteUsers->getFormArray();
?>
<?php require_once('common/header.php');?>
<link rel="stylesheet" href="JS/jquery-ui.css" />
<script src="JS/jquery-latest.js"></script>
<script src="JS/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
    $( "#startDate" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#endDate" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#endDate" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#startDate" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
</script>
<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Site Users"];?></div>



<div class="listPagePaddingItems">

<div class="itemsListPageHeader">
	<a href="index.php?show=site_users/edit_user&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>

	<form name="searchForms" method="get">
	<input type="hidden" name="show" value="<?php echo $show;?>" />
	<input type="text" name="keywords" value="<?php echo $keywords;?>" style="width: 100px;" />
	<select name="formPageId">
		<option value="0"><?php echo $text["All"];?></option>
		<?php foreach($arrForms as $form){?>
			<option value="<?php echo $form["form_id"];?>" <?php echo ($form["form_id"]==$formPageId)?"selected":"";?>><?php echo $form["form_name"];?></option>
		<?php }?>
		</select>
		
		<input type="text" id="startDate" name="startDate"		style="width: 70px;" value="<?php echo $_GET["startDate"];?>"  />
		<input type="text" id="endDate" name="endDate" 	style="width: 70px;" value="<?php echo $_GET["endDate"];?>"  />

		<input type="submit" name="submit" value='<?php echo $text["Search By Form"];?>' />
		<input type="submit" name="export" value='<?php echo $text["Export Results"];?>' />
	</form>
</div>

<div class="results"><?php echo $text["Showing"];?> <?php echo count($users);?> <?php echo $text["From"];?> <?php echo $count;?> <?php echo $text["Results"];?></div>


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">

<?php for($i=0;$i<count($users);$i++){

if(!$users[$i]["Name"] && ($users[$i]["First_Name"] || $users[$i]["Last_Name"])){
	$users[$i]["Name"]=$users[$i]["First_Name"]." ".$users[$i]["Last_Name"];
}
	$name=$users[$i]["Name"];

	list($date, $time)=	explode(" ", $users[$i]["JoiningDate"]);
	list($y,$m,$d)=		explode("-", $date);
	$users[$i]["JoiningDate"]="$d/$m/$y";


$name=$string->shorten($users[$i]["Name"]?$users[$i]["Name"]:$users[$i]["First_Name"]." ".$users[$i]["Last_Name"], 60);
?>
<li id="listItem_<?php echo $users[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemContent">
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<div style="width: 300px; height: 17px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; font-weight: bold;"><?php echo $name;?>&nbsp;</div>
			<div style="width: 450px; height: 17px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; float: <?php echo $gui->getLeft();?>;"><?php echo $string->shorten($users[$i]["Email"], 30);?></div>
			<div style="width: 80px; height: 17px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; float: <?php echo $gui->getRight();?>;"><?php echo $users[$i]["JoiningDate"];?></div>
			<div style="clear: both;"></div>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=site_users/users&id=<?php echo $users[$i]["ID"];?>&delete=true" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=site_users/edit_user&amp;user_id=<?php echo $users[$i]["ID"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
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
<select name="num_items" onchange="document.location='index.php?show=site_users/users&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
<?php echo $text["items on page"];?>

<div class="pager_numbers"><?php echo $pagelist;?></div>
