<?php
require_once('../../classes/pager/class.pager.php');
require_once('../../classes/site_users/class.site_users.php');
require_once('../../classes/export/class.export.php');
require_once('../../classes/file/class.file.php');


if($_POST["relate"]){

	$currentGroup=	$_POST["currentGroup"];
	$groupId=	intval($_POST["toGroup"]);
	$groupName=	$db->getField("SELECT Name FROM wm_pages WHERE ID=".intval($groupId), "Name");
	


	$where=	"";
	$join=	"";

	if($currentGroup=="ALL"){
		$join="LEFT JOIN wm_siteusers_forms ON wm_siteusers_forms.wm_siteusers=wm_siteusers.ID ";
	}elseif($currentGroup=="ALL UNRELATED"){
		$where.=	"AND wm_siteusers.ID NOT IN (SELECT DISTINCT wm_siteusers FROM wm_siteusers_forms) ";
	}else{
		$where.="AND sf1.form_id=".intval($currentGroup)." ";
		$join="INNER JOIN wm_siteusers_forms sf1 ON sf1.wm_siteusers=wm_siteusers.ID ";
	}

	$where.="AND wm_siteusers.ID NOT IN (SELECT DISTINCT wm_siteusers su FROM wm_siteusers_forms sf WHERE sf.form_id=".intval($groupId).")";
	

	$querySearch="
			SELECT DISTINCT wm_siteusers.ID, ".$groupId.", '".$groupName."', 'Added By Admin' 
			FROM wm_siteusers 
			$join 
			WHERE 1 $where 	
	";
	
	

	$queryRelate="
			INSERT INTO wm_siteusers_forms (wm_siteusers, form_id, form_name, content) 
			(".$querySearch.")
	";

	$db->runQuery($queryRelate);
	
}



$queryForms="	
		SELECT DISTINCT sf.form_id AS fid, sf.form_name AS fname  
		FROM wm_siteusers_forms sf 
		ORDER BY fname 
";

$formsArr=$db->getArray($queryForms);

$queryForms="	
		SELECT ID, Name 
		FROM wm_pages 
		WHERE Page_Type=6 
		ORDER BY Name
";

$formsCurrentArr=$db->getArray($queryForms);
?>
<?php require_once('common/header.php');?>
<?php require_once('common/body.php');?>
<div class="navigator_line"><?php echo $text["Site Users"];?></div>
<div class="editPagePadding">


<?php if($_POST["relate"]){?>
השיוך בוצע בהצלחה
<?php }else{?>
<form name="relations" method="post">
<input type="hidden" name="show" value="<?php echo $show;?>" />
<?php echo $text["Relate From Group"];?>: 
<select name="currentGroup">
<option value="ALL"><?php echo $text["All"];?></option>
<option value="ALL UNRELATED"><?php echo $text["All Unrelated"];?></option>
<?php foreach($formsArr as $form){?>
	<option value="<?php echo $form["fid"];?>"><?php echo $form["fname"]." ".$form["num"];?></option>
<?php }?>
</select>


<br />

<?php echo $text["Relate To Group"];?>: 
<select name="toGroup">
<?php foreach($formsCurrentArr as $form){?>
	<option value="<?php echo $form["ID"];?>"><?php echo $form["Name"];?></option>
<?php }?>
</select>
<br /><br />

<input type="submit" name="relate" value="<?php echo $text["Relate"];?>" />
</form>

<?php }?>

</div>
