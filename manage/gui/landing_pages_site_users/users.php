<?php
require_once('../../classes/pager/class.pager.php');
require_once('../../classes/site_users/class.site_users.php');

$userId=intval($_SESSION["LPMEDIA"]["USER_DATA"]["ID"]);

$user_table="wm_landing_pages_site_users_customer_$userId";

$page=		intval($_REQUEST["page"]);
$formPage=	intval($_REQUEST["formPage"]);
$landingPage=	intval($_REQUEST["landingPage"]);

$siteUsers=new SiteUsers($db, $user_table);

if($_REQUEST["delete"]){
	$siteUsers->delete(intval($_REQUEST["id"]));
}



$startDate=$endDate=NULL;

if($_GET["export"]){
$_GET["export"]=1;
require_once("landing_pages_export_users/index.php");
exit;
/*
	?>
	<script type="text/javascript">
	//window.open("<?php echo $cfg["WM"]["Server"];?>/manage/gui/landing_pages_export_users/index.php?export=1&landPage=1&startDate=<?php echo $_GET["startDate"];?>&endDate=<?php echo $_GET["endDate"];?>")
	</script>
	<?php
	*/
}
if($_GET["startDate"]){
	list($d,$m,$y)=explode("/", $_GET["startDate"]);
	$startDate=$y."-".$m."-".$d;
	$startDateFormat=$d."/".$m."/".$y;
}

if($_GET["endDate"]){
	list($d,$m,$y)=explode("/", $_GET["endDate"]);
	$endDate=$y."-".$m."-".$d;
	$endDateFormat=$d."/".$m."/".$y;
}



$limit=30;

if(!$page){
	$page=1;
}


/*
$query="
SELECT $user_table.* 
FROM $user_table 
LEFT JOIN wm_landing_pages_site_users_values_customer_post_$userId ON wm_landing_pages_site_users_values_customer_post_$userId.wm_landing_pages_site_users_customer_$userId=$user_table.ID
WHERE 1";

if($landingPage){
	$query.=" AND wm_landing_pages_site_users_values_customer_post_$userId.wm_landing_pages=".intval($landingPage);	
}

if($startDate){
	$query.=" AND wm_landing_pages_site_users_values_customer_post_$userId.JoiningDate>='".$startDate." 00:00:00'";
}

if($endDate){
	$query.=" AND wm_landing_pages_site_users_values_customer_post_$userId.JoiningDate<='".$endDate." 23:59:59'";
}

$query.=" 
GROUP BY $user_table.ID 
ORDER BY wm_landing_pages_site_users_values_customer_post_$userId.JoiningDate DESC";

$p = new Pager;
$start = $p->findStart($limit); 
$count = $db->getNumRecords($query);
$pages = $p->findPages($count, $limit); 
$pagelist = $p->pageList($page, $pages); 
$users=$db->getArray($query." LIMIT ".$start.", ".$limit);
*/



if(!$count){
	$query="
	SELECT $user_table.* 
	FROM $user_table 
	LEFT JOIN wm_landing_pages_site_users_values_customer_$userId ON wm_landing_pages_site_users_values_customer_$userId.wm_landing_pages_site_users_customer_$userId=$user_table.ID
	WHERE 1";

	if($landingPage){
		//$query.=" AND $user_table.LandingPage=".intval($landingPage);
		$query.=" AND wm_landing_pages_site_users_values_customer_$userId.wm_landing_pages=".intval($landingPage);		
	}

	if($startDate){
		$query.=" AND wm_landing_pages_site_users_values_customer_$userId.JoiningDate>='".$startDate." 00:00:00'";
	}

	if($endDate){
		$query.=" AND wm_landing_pages_site_users_values_customer_$userId.JoiningDate<='".$endDate." 23:59:59'";
	}

	$query.=" 
	GROUP BY $user_table.ID 
	ORDER BY wm_landing_pages_site_users_values_customer_$userId.JoiningDate DESC";

//echo $query;

	$p = new Pager;
	$start = $p->findStart($limit); 
	$count = $db->getNumRecords($query);
	$pages = $p->findPages($count, $limit); 
	$pagelist = $p->pageList($page, $pages); 
	$users=$db->getArray($query." LIMIT ".$start.", ".$limit);
}






//echo "<div style=\"display: none;\">$query</div>";

//$users=$siteUsers->getArray($query);


//echo $query;










































/*
$queryLandingPages="	SELECT DISTINCT LandingPage, LandingPageName 
			FROM ".$user_table." 
			ORDER BY LandingPageName";
*/

/*
$queryLandingPages="	SELECT DISTINCT LandingPage, wm_pages.Name AS LandingPageName 
			FROM ".$user_table." 
			INNER JOIN wm_pages ON wm_pages.ID=".$user_table.".LandingPage 
			ORDER BY LandingPageName";
*/
//echo ($queryLandingPages);


$queryLandingPages="
SELECT DISTINCT wm_pages.ID AS LandingPage, wm_pages.Name AS LandingPageName  
FROM wm_pages 
INNER JOIN wm_landing_pages_site_users_values_customer_$userId ON wm_landing_pages_site_users_values_customer_$userId.wm_landing_pages=wm_pages.ID 
";


$arrLandingPages=$db->getArray($queryLandingPages);
?>
<?php require_once('common/header.php');?>
<!--
<script type="text/javascript" src="JS/calendar/js/datepicker/datepicker.js"></script>
<script type="text/javascript" src="JS/calendar/js/datepicker/lang/he.js"></script> 
<link type="text/css" href="JS/calendar/css/datepicker.css" rel="stylesheet" />
-->
<script language="javascript" type="text/javascript" src="JS/jquery-latest.js"></script>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery-ui-1.8.23.custom.min.js"></script>
<?php if ($gui->getDir()=="rtl"){?>
<script language="javascript" type="text/javascript" src="JS/jquery-ui/js/jquery.ui.datepicker-he.js"></script>
<?php }?>
<link type="text/css" href="JS/jquery-ui/css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />

<script type="text/javascript">
$(document).ready(function() {
    $(function() {
        $( ".startDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( ".endDate" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
});
</script>


<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Site Users"];?></div>







<div class="listPagePaddingItems">


<a href="index.php?show=landing_pages_export_users/index&export=1">ייצא תוצאות</a>

<div class="itemsListPageHeader">
	<!--<a href="/manage/gui/index.php?show=landing_pages_site_users/edit_user&page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add_Page01.png" style="cursor: pointer; float: left;" alt="Add" /></a>-->



<form name="search" method="get">
<input type="hidden" name="show" value="<?php echo $show;?>" />

<select name="landingPage">
	<option value="">הכל</option>
	<?php for($i=0;$i<count($arrLandingPages);$i++){?>
		<option value="<?php echo $arrLandingPages[$i]["LandingPage"];?>" <?php echo ($arrLandingPages[$i]["LandingPage"]==$landingPage && $arrLandingPages[$i]["LandingPage"]!="")?"selected":"";?>>
			<?php $parent=$wm->getParent($arrLandingPages[$i]["LandingPage"]); echo $wm->get($parent, "Name");?> -> 
			<?php echo $arrLandingPages[$i]["LandingPageName"];?>

		</option>
	<?php }?>
</select>


<input type="text" name="startDate" 	class="startDate"	style="width: 70px;" value="<?php echo $startDateFormat;?>"  />
<input type="text" name="endDate" 	class="endDate"		style="width: 70px;" value="<?php echo $endDateFormat;?>"  />


<?php
/*
<select name="formPage">
	<option value="">הכל</option>
	<?php for($i=0;$i<count($arrPages);$i++){?>
		<option value="<?php echo $arrPages[$i]["FormPage"];?>" <?php echo ($arrPages[$i]["FormPage"]==$formPage && $arrPages[$i]["FormPage"]!=0)?"selected":"";?>><?php echo $arrPages[$i]["FormPageName"];?></option>
	<?php }?>
</select>
*/
?>
<input type="submit" name="submit" value="חפש" />
<?php if ($landingPage){?>
<input type="submit" name="export" value="ייצא תוצאות" />
<?php }?>
</form>





<!--
	<form name="searchForms" method="get">
	<input type="hidden" name="show" value="<?php echo $show;?>" />
	<input type="text" name="keywords" value="<?php echo $keywords;?>" style="width: 100px;" />
	<select name="formPageId">
		<option value="0">הכל</option>
		<?php foreach($arrForms as $form){?>
			<option value="<?php echo $form["form_id"];?>" <?php echo ($form["form_id"]==$formPageId)?"selected":"";?>><?php echo $form["form_name"];?></option>
		<?php }?>
		</select>
		
		<input type="text" name="startDate" 	class="format-d-m-y no-transparency"	style="width: 70px;" value="<?php echo $_GET["startDate"];?>"  />
		<input type="text" name="endDate" 	class="format-d-m-y no-transparency"	style="width: 70px;" value="<?php echo $_GET["endDate"];?>"  />

		<input type="submit" name="submit" value="חפש לפי טופס" />
		<input type="submit" name="export" value="ייצא תוצאות" />
	</form>
-->
</div>

<div class="results">מציג <?php echo count($users);?> מתוך <?php echo $count;?> תוצאות</div>


<div class="listItemsScroller" dir="ltr">
<div class="listItemsContainer" dir="<?php echo $gui->getDir();?>">
<ul id="test-list" dir="ltr">

<?php for($i=0;$i<count($users);$i++){

if(!$users[$i]["Name"] && ($users[$i]["First_Name"] || $users[$i]["Last_Name"])){
	$users[$i]["Name"]=$users[$i]["First_Name"]." ".$users[$i]["Last_Name"];
}
	$name=$users[$i]["Name"];

	list($date, $time)=	split(" ", $users[$i]["JoiningDate"]);
	list($y,$m,$d)=		split("-", $date);
	$users[$i]["JoiningDate"]="$d/$m/$y";
?>
<li id="listItem_<?php echo $users[$i]["ID"];?>" class="listItem_<?php echo ($i%2==0?0:1);?>">

	<img src="images/icons/handel_<?php echo $gui->getDir();?>_<?php echo $_REQUEST["search"]?"2":"0";?>.png" class="<?php if(!$_REQUEST["search"]){?>handle<?php }else{?>handleoff<?php }?>" alt="Sort" border="0" onmousedown="this.src='images/icons/handel_<?php echo $gui->getDir();?>_1.png';" />

	<div class="listItemContent">
		<div class="listItemText" dir="<?php echo $gui->getDir();?>">
			<div style="width: 300px; font-weight: bold;"><?php echo $name;?>&nbsp;</div>
			<div style="width: 150px; float: <?php echo $gui->getLeft();?>;"><?php echo $users[$i]["Email"];?></div>
			<div style="width: 150px; float: <?php echo $gui->getLeft();?>;"><?php echo $users[$i]["JoiningDate"];?></div>
			<div style="clear: both;"></div>
		</div>

		<div class="listItemIcon">
			<a href="index.php?show=landing_pages_site_users/users&id=<?php echo $users[$i]["ID"];?>&delete=true" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/DelletPage01.png" alt="Delete" /></a>
		</div>
		<div class="itemSap"></div>

		<div class="listItemIcon">
			<a href="index.php?show=landing_pages_site_users/edit_user&amp;user_id=<?php echo $users[$i]["ID"];?>"><img border="0" src="images/icons/Edit01.png" alt="Edit" /></a>
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

<!--
הצג 
<select name="num_items" onchange="document.location='index.php?show=landing_pages_site_users/users&num_items='+this.value;">
	<option value="5" <?php echo ($numItemsPerPage==5)?"selected":"";?>>5</option>
	<option value="10" <?php echo ($numItemsPerPage==10)?"selected":"";?>>10</option>
	<option value="50" <?php echo ($numItemsPerPage==50)?"selected":"";?>>50</option>
	<option value="100" <?php echo ($numItemsPerPage==100)?"selected":"";?>>100</option>
</select>
פריטים בדף
-->
<div class="pager_numbers"><?php echo $pagelist;?></div>
