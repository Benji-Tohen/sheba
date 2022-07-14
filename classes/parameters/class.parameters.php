<?php
class Parameters{
	
	var $db;
	var $params;
	
	function Parameters($db){
		$this->db=$db;
		$this->params=array();

		if(!isset($_SESSION["siteParams"])){
			$paramsArray=$this->getValues();
		
			foreach($paramsArray as $var){
				$this->params[$var["Name"]]=$var["Value"];
			}
		
			$_SESSION["siteParams"]=$this->params;
		}else{
			$this->params=$_SESSION["siteParams"];
		}

	}

	function getValue($var){
		$result=null;
/*
		$query="
			SELECT Value 
			FROM wm_parameters 
			WHERE Name='".mysqli_real_escape_string($this->db->conn, $var)."'  
			LIMIT 0,1
		";
		return $this->db->getField($query, "Value");
*/



		if(isset($this->params[$var])){
			$result=$this->params[$var];
		}

		return $result;
	}

	function getValues(){
		$query="SELECT 
			Name, Value 
			FROM wm_parameters 
		";
		return $this->db->getArray($query);		
	}

	function setParameter($var, $value){
		$_SESSION["siteParams"][$var]=$value;
		$this->params[$var]=$value;
		$query="
			UPDATE wm_parameters 
			SET Value=".mysqli_escape_string($this->db->conn, $value)." 
			WHERE Name='".mysqli_real_escape_string($this->db->conn, $var)."'
		";
		return $this->db->runQuery($query);
	}

	function dynamicValue($array,$value){
		$result = array();
		foreach ($array as $key => $val) {
			if($val['Name'] === $value){
				$result['Value'] = $val['Value'];
			}
		}
		return $result;
	}

	function getScriptChat($name){
		$query="SELECT Value FROM wm_elad_scripts WHERE Name = '".mysqli_escape_string($this->db->conn, $name)."'";
		$res = $this->db->getRow($query);	
		return $res["Value"];
	}
}
?>
