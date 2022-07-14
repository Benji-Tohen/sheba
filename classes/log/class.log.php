<?php
class Log{

	var $db;
	var $table;

	function Log($db, $table){
		$this->db=	$db;
		$this->table=	$table;
	}

	function write($desc, $operation="", $level=1){
		$fieldsArray=array(
			"log_level"	=>	$level,
			"log_desc"	=>	$desc,
			"log_user"	=>	$_SESSION["User_Data"]["First_Name"]." ".$_SESSION["User_Data"]["Last_Name"],
			"log_session_id"=>	session_id(),
                        "log_operation" =>      $operation
		);
		$this->db->updateData($this->table, $fieldsArray);
	}
	
	function getLog($limit="0, 100", $level=1){
		$query="
			SELECT * 
			FROM ".$this->table." 
			WHERE log_level=".intval($level)."
			ORDER BY log_time DESC 
			LIMIT ".mysqli_real_escape_string($this->db->conn, $limit)."
		";
		
		return $this->db->getArray($query);
	}
        
        function filterLog($limit="0, 100", $level=1, $fromDate="", $toDate="", $operation="", $user="") {
                $fromDate = mysqli_real_escape_string($this->db->conn, $fromDate);
                $toDate = mysqli_real_escape_string($this->db->conn, $toDate);
                $operation = mysqli_real_escape_string($this->db->conn, $operation);
                $user = mysqli_real_escape_string($this->db->conn, $user);
                $limit = mysqli_real_escape_string($this->db->conn, $limit);
		$query="
			SELECT * 
			FROM ".$this->table." 
			WHERE log_level=".intval($level)." 
                        ".(($fromDate)?"AND log_time>='$fromDate 00:00:00' ":"")." 
                        ".(($toDate)?"AND log_time<='$toDate 23:59:59' ":"")." 
                        ".(($operation)?"AND log_operation='$operation' ":"")." 
                        ".(($user)?"AND log_user='$user' ":"")." 
			ORDER BY log_time DESC 
			LIMIT ".$limit."
		";
		
		return $this->db->getArray($query);
        }

	function delAll(){
		$query="DELETE FROM ".$this->table;
		$this->db->runQuery($query);
	}
}
?>
