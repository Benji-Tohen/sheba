<?php
class SiteUsers extends ContentUpdater{
	
	function addUser($fieldsArray){
		$exists=$this->isExists("Email", $fieldsArray["Email"]);
		
		if($exists){
			$id=$exists;
		}else{
			$id=$this->add();
			$fieldsArray["JoiningDate"]=date("Y-m-d H:i:s", time());
		}
		$this->update($id, $fieldsArray);

		return $id;
	}
	
	function isExists($field, $val){
		return $this->db->getExist($this->table, $field, $val);
	}

	function isExistsText($field, $val){
		return $this->db->getExistText($this->table, $field, $val);
	}

	function delete($id){
		$this->deleteByField("id", $id);

		$queryDelete="
				DELETE 
				FROM wm_siteusers_forms 
				WHERE wm_siteusers=".intval($id)."
		";
		$this->db->runQuery($queryDelete);
	}	

	function getSearchQuery($fields="*", $formPageId=NULL, $keywords=NULL, $startDate=NULL, $endDate=NULL){
		$query="SELECT $fields  
			FROM wm_siteusers 
			";
		if($formPageId){
			$query.=" INNER JOIN wm_siteusers_forms ON wm_siteusers_forms.wm_siteusers=wm_siteusers.ID ";
		}

		$query.=" WHERE 1";
		
		if($startDate){
			$query.=" AND JoiningDate>='".mysqli_real_escape_string($this->db->conn, $startDate)." 00:00:00'";
		}

		if($endDate){
			$query.=" AND JoiningDate<='".mysqli_real_escape_string($this->db->conn, $endDate)." 00:00:00'";
		}

		if($formPageId){
			$query.=" AND wm_siteusers_forms.form_id=".intval($formPageId);
		}

		if($keywords){
			$searchKeysArr=	explode(" ", $keywords);
			foreach($searchKeysArr as $val){
				if($val==" "){
					continue;
				}
				$query.=" AND (
							First_Name LIKE '%".mysqli_real_escape_string($this->db->conn, $val)."%' OR 
							Last_name  LIKE '%".mysqli_real_escape_string($this->db->conn, $val)."%' OR 
							Email LIKE '%".mysqli_real_escape_string($this->db->conn, $val)."%' 
						 )
				";
			}
		}

		$query.=" ORDER BY JoiningDate DESC, Name, First_Name, Last_Name";

		return $query;
	}

	function getFormArray(){
		$queryForms="
			SELECT DISTINCT form_id, form_name  
			FROM wm_siteusers_forms 
			ORDER BY form_name
		";
		$arrForms=$this->db->getArray($queryForms);
		return $arrForms;
	}

	function userDeleteForm($user_id, $form_id){
		if($this->userInForm($user_id, $form_id)){
			$query="
				DELETE FROM wm_siteusers_forms WHERE wm_siteusers=".intval($user_id)." AND form_id=".intval($form_id)."
			";
			$this->db->runQuery($query);
		}
	}

	function userAddForm($user_id, $form_id){
		global $wm;
		if(!$this->userInForm($user_id, $form_id)){
			$fieldsArr=array(
				"wm_siteusers"	=>	$user_id,
				"form_id"	=>	$form_id,
				"form_name"	=>	$wm->get($form_id, "Name"),
				"content"	=>	"Added by admin"
			);
			$this->db->updateData("wm_siteusers_forms", $fieldsArr);
		}		
	}

	function userInForm($user_id, $form_id){
		$query="
			SELECT COUNT(*) AS num 
			FROM wm_siteusers_forms 
			WHERE wm_siteusers=".intval($user_id)." AND form_id=".intval($form_id)."
		";
		return $this->db->getField($query, "num");
	}

	function activate($activationCode){
		$exists=$this->isExistsText("mail_activation_code", md5($activationCode));
		if(!$exists){
			return false;
		}

		$arrFields=array(
			"mail_activation_code"	=>	"",
			"user_activated"	=>	1
		);

		$this->setValues($exists, $arrFields);

		return $exists;
	}

}
?>
