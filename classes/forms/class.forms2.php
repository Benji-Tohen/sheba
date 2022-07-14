<?php
class Forms{

	var $db;

	function forms($db){
		$this->db=$db;
	}

	function getFormEventTypeId($wmPageId){
		$query="
			SELECT wm_forms.EventType_ID 
			FROM wm_forms  
			INNER JOIN wm_pages ON wm_pages.wm_forms=wm_forms.ID
			WHERE wm_pages.ID=".intval($wmPageId);

		$typeId=$this->db->getField($query, "EventType_ID");
		return $typeId;		
	}

	function getPageFormFields($id){
		$query="
			SELECT wm_forms_fields.ID, wm_forms_fields.Name, wm_forms_field_types.Multiple, wm_forms_field_types.Value AS HTML, wm_forms_fields.Value AS FieldValues, wm_forms_fields.db_name, wm_forms_fields.Mandatory, wm_forms_fields.Mandatory_Text, wm_forms_fields.db_name ,wm_forms_fields.placeholder, wm_forms_fields.validation_Type_ID, wm_forms_fields.default_value, wm_forms_field_types.ID as fieldTypeId
			FROM wm_forms_fields 
			INNER JOIN wm_forms ON wm_forms.ID=wm_forms_fields.wm_forms 
			INNER JOIN wm_forms_field_types ON wm_forms_field_types.ID=wm_forms_fields.wm_forms_field_types 
			INNER JOIN wm_pages ON wm_pages.wm_forms=wm_forms.ID
			WHERE wm_pages.ID=".intval($id)." 
			ORDER BY wm_forms_fields.Ordering, wm_forms_fields.ID ASC
		";

		$arr=$this->db->getArray($query);
		return $arr;
	}




	function getPageFormMandatoryFields($id){
		$query="
			SELECT wm_forms_fields.ID, wm_forms_fields.Name, wm_forms_field_types.Multiple, wm_forms_fields.Mandatory_Text   
			FROM wm_forms_fields 
			INNER JOIN wm_forms ON wm_forms.ID=wm_forms_fields.wm_forms 
			INNER JOIN wm_forms_field_types ON wm_forms_field_types.ID=wm_forms_fields.wm_forms_field_types 
			INNER JOIN wm_pages ON wm_pages.wm_forms=wm_forms.ID 
			WHERE wm_pages.ID=".intval($id)." AND wm_forms_fields.Mandatory=1 
			ORDER BY wm_forms_fields.Ordering	
		";

		$arr=$this->db->getArray($query);
		return $arr;
	}


	function getPageFormValues($wm_page){
		$query="
			SELECT DISTINCT ffv.Value, wm_forms_fields.Name 
			FROM wm_forms_field_values ffv 
			INNER JOIN wm_forms_fields ON ffv.wm_forms_fields=wm_forms_fields.ID 
			WHERE ffv.wm_pages_display=".intval($wm_page)."
			ORDER BY wm_forms_fields.Ordering	
		";

		$arr=$this->db->getArray($query);
		return $arr;
	}


	function getPageFormFieldsValues($customer_id, $user_id){
		$query="
			SELECT ctv.ID, ctv.Name, ctv.Value, ctv.wm_landing_pages AS landPageId, ctv.joiningDate   
			FROM wm_landing_pages_site_users_values_customer_".$customer_id." ctv 
			INNER JOIN wm_landing_pages_site_users_customer_".$customer_id." suc ON suc.ID=ctv.wm_landing_pages_site_users_customer_".$customer_id."
			WHERE suc.ID=".intval($user_id)."
			ORDER BY ctv.wm_landing_pages, ctv.joiningDate
		";

		$arr=$this->db->getArray($query);
		return $arr;
	}


}
?>
