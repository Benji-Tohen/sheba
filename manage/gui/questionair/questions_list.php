<?php
require_once("../../classes/tree/class.new_tree_data.php");
require_once("../../classes/questionair/class.questionair.php");

$questionair_id=$_GET["questionair_id"];

$gui=new Gui("he");

$qn=new Questionnaire($db, "wm_questionnaire", "wm_questionnaire_players");


if($_GET["do"]=="del" && $_GET["id"]){
	$qn->removeQuestion($_GET["id"]);
}

$arrQuestions=$qn->getQuestions($questionair_id);

$row=$qn->getQuestionair($questionair_id);

//	calculate Votes
//$arrOptions=$qn->getQuestions($questionair_id);

$totalClicks=0;
for($i=0;$i<count($arrQuestions);$i++){
	$query="SELECT COUNT(answer) AS numClicks FROM wm_questionnaire_players WHERE question_id=".$arrQuestions[$i]["tree_id"];
	$arrQuestions[$i]["numberOfClicks"]=$db->getField($query, "numClicks");
	$totalClicks+=$arrQuestions[$i]["numberOfClicks"];
}
if(!$totalClicks){
	$totalClicks=1;
}


?>
<?php require_once('common/header.php');?>
<style type="text/css">
.pager_numbers{
	color: #ffffff;
}
</style>
<?php require_once('common/body.php');?>
<div class="navigator_line">
<a style="color: #ffffff;" href="index.php?show=questionair/index"><?php echo $text["Questionair"];?></a> -> 
<?php echo $row["tree_name"];?> -> 
<a style="color: #ffffff;" href="index.php?show=questionair/questions_list&questionair_id=<?php echo $questionair_id;?>"><?php echo $text["Questionair options"];?></a>
</div>
<div class="editPagePadding">
<table cellspacing="0" class="list_table">
	<tr>
		<td colspan="3"><a href="index.php?show=questionair/question_edit&amp;questionair_id=<?php echo $questionair_id;?>&amp;page_id=<?php echo $page_id;?>"><img border="0" src="images/icons/add.gif" style="cursor: pointer;" alt="Add a Question" /></a><br />
	  </td>
	</tr>
	<tr>
		<td colspan="3" align="center"><div class="pager_numbers"><?php echo $pagelist;?></div></td>
	</tr>
	
<?php for($i=0;$i<count($arrQuestions);$i++){?>	
	<tr id="list_<?php echo $i;?>" class="list_tr_<?php echo ($i%2==0?0:1);?>">
		<td width="30"><?php echo $db->getField("SELECT COUNT(tree_id) AS num FROM wm_questionnaire_players WHERE question_id=".$arrQuestions[$i]["tree_id"], "num");?></td>
		<td>
		<?php $arrQuestions[$i]["precent"]=round($arrQuestions[$i]["numberOfClicks"]*100/$totalClicks);
				echo $arrQuestions[$i]["precent"];?>%
		</td>
		<td width="200" valign="top">&nbsp;<?php echo $arrQuestions[$i]["tree_name"];?>&nbsp;</td>


		
		<!--<td valign="top"><a href="index.php?show=questionair/question_edit&amp;page_id=<?php echo $page_id;?>&amp;id=<?php echo $arrQuestions[$i]["tree_id"];?>"><img border="0" src="images/icons/edit.gif" alt="Edit" /></a></td>-->

		<td valign="top"><a href="index.php?show=questionair/questions_list&amp;do=del&amp;page_id=<?php echo $page_id;?>&id=<?php echo $arrQuestions[$i]["tree_id"];?>&questionair_id=<?php echo $questionair_id;?>" onclick="highlight('list_<?php echo $i;?>');return confirm1('list_<?php echo $i;?>', 'list_tr_<?php echo ($i%2==0?0:1);?>', '<?php echo $text["Are you shure you want to delete?"];?>');"><img border="0" src="images/icons/delete.gif" alt="Delete" /></a></td>
	</tr>
<?php }?>
</table>
</div>
