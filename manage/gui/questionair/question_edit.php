<?php
require_once("../../classes/tree/class.new_tree_data.php");
require_once("../../classes/questionair/class.questionair.php");

$qn=new Questionnaire($db, "wm_questionnaire", "wm_questionnaire_players");

$id=				$_REQUEST["id"];
$page_id=			$_REQUEST["page_id"];
$questionair_id=	$_REQUEST["questionair_id"];

$qn_row=$qn->getQuestionair($questionair_id);

if($_POST){

	$qn->addQuestion($questionair_id, $_POST["Name"]);
	
	header("location: index.php?show=questionair/questions_list&questionair_id=".$questionair_id);
	exit;

}

if($id){
	$row=$qn->getQuestionair($id);
}

$gui=new Gui("he");
?>
<?php require_once('common/header.php');?>

<?php require_once('common/body.php');?>
<div class="navigator_line">

<a style="color: #ffffff;" href="index.php?show=questionair/index"><?php echo $text["Questionair"];?></a> ->
<?php echo $qn_row["tree_name"];?> -> 
<a style="color: #ffffff;" href="index.php?show=questionair/questions_list"><?php echo $text["Questionair options"];?></a> ->
 <?php echo $row?$row["tree_name"]:$text["Add Item"];?>
</div>

<div class="editPagePadding">

<br /><br />
<form action="index.php" name="edit" method="post" enctype="multipart/form-data">
<input type="hidden" name="show" value="questionair/question_edit" />
<input type="hidden" name="id" value="<?php echo $row["tree_id"];?>" />
<input type="hidden" name="questionair_id" value="<?php echo $questionair_id;?>" />
<input type="hidden" name="page_id" value="<?php echo $page_id;?>" />

<table>		
	<tr>
		<td><?php echo $text["Name"];?>:</td>
		<td><input type="text" name="Name" value="<?php echo $row["tree_name"];?>" /></td>		
	</tr>
	<tr>
		<td colspan="2" align="<?php echo $gui->getRight();?>"><input type="Submit" name="Submit" value="<?php echo $text["Update"];?>" /><input type="Submit" name="SubmitAdd" value="<?php echo $text["Update And Add"];?>" /></td>		
	</tr>		
</table>
</form>
</div>
