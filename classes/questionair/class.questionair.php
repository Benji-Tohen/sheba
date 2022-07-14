<?php
class Questionnaire{
	
	var $db;
	var $questsTree;
	var $playersTree;
	
	function Questionnaire($db, $questsTable, $playersTable){
		$this->db=$db;
		$this->questsTree=new NewTreeData($db, $questsTable);
		$this->playersTree=new NewTreeData($db, $playersTable);			
	}
	
/*	Get	*/
	
	function getQuestionairs($id=0){
		return $this->questsTree->getArray($id, " ORDER BY tree_id");
	}
	
	function getQuestionair($id){
		return $this->questsTree->getValues($id);
	}
	
	function getQuestions($id){
		return $this->questsTree->getArray($id, " AND questionnaire_type='question' ORDER BY tree_id");
	}

	function getAnswers($id){
		return $this->questsTree->getArray($id, " AND questionnaire_type='answer' ORDER BY from_value");
	}
	
	function getCurrentQuestionairId(){
		return $this->db->getField("SELECT tree_id FROM ".$this->questsTree->table." WHERE current=1", "tree_id");
	}
	
/*	Actions	*/
	
	/*
		Admin Create Questionair
	*/

	/*	Questionair	*/	
	function addQuestionnaire($name=NULL, $parent=0){
		$new_id=$this->questsTree->add($parent, $name);
		$this->questsTree->setValue($new_id, "questionnaire_type", 'questionnaire');
		return $new_id;
	}
	
	function removeQuestionnaire($id){
		if(!$id){return;}
		return $this->questsTree->delete($id);
	}
	
	function editQuestionair($id, $values){
		return $this->questsTree->setValues($id, $values);
	}
	
	function addQuestion($parent, $name){
		$new_id=$this->questsTree->add($parent, $name);
		$this->questsTree->setValue($new_id, "questionnaire_type", 'question');
		return $new_id;
	}
	
	function removeQuestion($id){
		if(!$id){return;}
		return $this->questsTree->delete($id);
	}

	function addAnswer($parent, $name, $arrValues){
		$new_id=$this->questsTree->add($parent, $name);
		$this->questsTree->setValues($new_id, $arrValues);
		return $new_id;
	}
	
	function removeAnswer($id){
		if(!$id){return;}
		return $this->questsTree->delete($id);
	}
	
	function setCurrent($id){
		$query="UPDATE ".$this->questsTree->table." SET current=0 WHERE current=1";
		$this->db->runQuery($query);
		
		$query="UPDATE ".$this->questsTree->table." SET current=1 WHERE tree_id=".intval($id);
		$this->db->runQuery($query);		
	}
	
	/*
		User data enter
	*/
	
	function userAnswer($user_id, $question_id, $answer, $time){
		$answer_date=date("Y-m-d", $time);
		$arrValues=array(
			"user_id"		=>	$user_id
			,"questionnaire_id"	=>	$this->questsTree->getParent($question_id)
			,"question_id"	=>	$question_id
			,"answer"		=>	$answer
			,"answer_time"	=>	$time
			,"answer_date"	=>	$answer_date
		);
		$new_id=$this->playersTree->add(NULL);
		$this->playersTree->setValues($new_id, $arrValues);
	}
	
	function getNextQuestion($user_id, $questionnaire_id, $date){
		
		$query="SELECT MAX(question_id) AS max_question_id FROM ".$this->playersTree->getTable()." WHERE answer_date='".$date."' AND questionnaire_id=".$questionnaire_id;

		$max_question_id=$this->db->getField($query, "max_question_id");
		$max_question_id=($max_question_id?$max_question_id:0);

		$query="SELECT * FROM ".$this->questsTree->getTable()." WHERE tree_parent=".$questionnaire_id." AND questionnaire_type='question' AND tree_id>".$max_question_id." ORDER BY tree_id LIMIT 0, 1";
		
		$question_row=$this->db->getRow($query);
		return $question_row;
	}
	
	function getPlayerQuestionnairePoints($user_id, $questionnaire_id, $date){
		//	Possible of a bug if the date is replaced during filling the questions
		//	Will not happen if the user filled all the questions in one session
		$query="SELECT SUM(answer) AS sum_answers FROM ".$this->playersTree->getTable()." WHERE questionnaire_id=".$questionnaire_id." AND answer_date='".$date."'";
		return $this->db->getField($query, "sum_answers");
	}

	function getUserAnswer($user_id, $questionnaire_id, $date){
		if(!$sum_answers){
			$sum_answers=$this->getPlayerQuestionnairePoints($user_id, $questionnaire_id, $date);
		}
		$query="SELECT tree_name FROM ".$this->questsTree->getTable()." WHERE tree_parent=".$questionnaire_id." AND from_value<=".$sum_answers." AND to_value>=".$sum_answers." LIMIT 0, 1";
		return $this->db->getField($query, "tree_name");
	}
	
	function getPlayerRecentAnswersDates($user_id, $questionnaire_id){
		$query="SELECT DISTINCT answer_date FROM ".$this->playersTree->getTable()." WHERE questionnaire_id=".$questionnaire_id." AND user_id=".$user_id;
		return $this->db->getArrayForField($query, "answer_date");
	}
	
	function getPlayerPrevQuestions($user_id, $questionnaire_id, $answer_date=NULL){
		$query="SELECT HI_Questionnaire.tree_name AS Question, HI_Questionnaire_Players.answer AS Answer  
				FROM HI_Questionnaire_Players 
				INNER JOIN HI_Questionnaire ON HI_Questionnaire_Players.question_id=HI_Questionnaire.tree_id 
				INNER JOIN HI_Players ON HI_Questionnaire_Players.user_id=HI_Players.ID  
				WHERE HI_Questionnaire_Players.user_id=$user_id AND HI_Questionnaire_Players.questionnaire_id=$questionnaire_id AND HI_Questionnaire_Players.answer_date='$answer_date' 
				ORDER BY HI_Questionnaire_Players.tree_ordering";
		$arr=$this->db->getArray($query);
		return $arr;
	}
	
}
?>