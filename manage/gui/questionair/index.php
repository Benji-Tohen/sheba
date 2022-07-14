<?php
require_once("../../classes/tree/class.new_tree_data.php");
require_once("../../classes/questionair/class.questionair.php");

$gui=new Gui("he");

$qn=new Questionnaire($db, "wm_questionnaire", "wm_questionnaire_players");


if($_GET["do"]=="del" && $_GET["id"]){
	$qn->removeQuestionnaire($_GET["id"]);
}

if($_GET["do"]=="current" && $_GET["id"]){
	$qn->setCurrent($_GET["id"]);
}

$arrQn=$qn->getQuestionairs(0);
?>
<?php require_once('common/header.php');?>
<style type="text/css">
.pager_numbers{
	color: #ffffff;
}
</style>
<?php require_once('common/body.php');?>
<div class="navigator_line">
<a style="color: #ffffff;" href="index.php?show=questionair/index"><?php echo $text["Questionair"];?></a> -> <?php echo $text["Items"];?>
</div>
<div class="editPagePadding">
<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><a href="index.php?show=questionair/edit&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add a Questionair" /></a><br />
	  </td>
	</tr>
	<tr>
		<td colspan="3" align="center"><div class="pager_numbers"><?php echo $pagelist;?></div></td>
	</tr>
	
<?php for($i=0;$i<count($arrQn);$i++){?>	
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
		<td width="30"><?php echo $db->getField("SELECT COUNT(tree_id) AS num FROM wm_questionnaire_players WHERE questionnaire_id=".$arrQn[$i]["tree_id"], "num");?></td>		
		<td width="200" valign="top">&nbsp;<a href="index.php?show=questionair/questions_list&questionair_id=<?php echo $arrQn[$i]["tree_id"];?>" style="font-weight: bold;"><?php echo $arrQn[$i]["tree_name"];?></a>&nbsp;</td>

		
		<td valign="top"><a href="index.php?show=questionair/edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arrQn[$i]["tree_id"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>

		<td valign="top"><a href="index.php?show=questionair/index&amp;do=current&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arrQn[$i]["tree_id"];?>"><img border="0" src="images/icons/home_<?php echo $arrQn[$i]["current"]?"1":"0";?>.gif" alt="Show On Homepage" /></a></td>
		

		<td valign="top"><a href="index.php?show=questionair/index&amp;do=del&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arrQn[$i]["tree_id"];?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
</table>
</div>
