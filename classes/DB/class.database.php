<?php
class DB{
	
	var $conn;
	var $DBName;
	var $DBServer;
	var $DBUserName;
	var $DBPassword;

	function DB($DBServer, $DBName, $DBUserName, $DBPassword){
		$this->DBServer=$DBServer;
		$this->DBUserName=$DBUserName;
		$this->DBPassword=$DBPassword;						
		$this->DBName=$DBName;
	}

	function connect(){
		if(!$this->conn){
			$this->conn = mysqli_connect($this->DBServer, $this->DBUserName, $this->DBPassword) or die("An internal server error.");
			mysqli_select_db($this->conn, $this->DBName) or die("An internal server error.");
			mysqli_query($this->conn, "SET CHARACTER SET utf8") or die('ERROR1');
			mysqli_query($this->conn, "SET character_set_results=UTF8;") or die('ERROR21');
			mysqli_query($this->conn, "SET character_set_connection=UTF8;") or die('ERROR22');
			mysqli_query($this->conn, "SET character_set_client=UTF8") or die('ERROR23');
/*
			mysql_query('SET character_set_results=UTF8');
			mysql_query('SET character_set_connection=UTF8');
			mysql_query('SET character_set_client=UTF8');		
*/
		}
	}
	
	function disconnect(){
		// Closing connection
		//mysql_close($this->conn);
	}
	
	function getDBName(){
		return $this->DBName;
	}
	
	function getNumRecords($query){
		$this->connect();
		$result=mysqli_query($this->conn, $query);
		if($err=mysqli_error($this->conn)){
			error_log($query);
			error_log($err);
			$this->disconnect();
			return false;
		}
		$count=mysqli_num_rows($result);
		$this->disconnect();
		return $count;
	}
	
	/********************************************************************************
	*	getArray($query) function													*
	*		*	Gets a SQL query													*
	*		*	Returns rows and cols array											*
	*/
		function getArray($query){

			$this->connect();

			$result=mysqli_query($this->conn, $query);
			
			if($error=mysqli_error($this->conn)){
				error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
				$this->disconnect();
				return false;
			}

			$arr=array();														

			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {			
				array_push($arr, $row);
			}
			
			$this->disconnect();

			return $arr;
		}
	/*																				*
	********************************************************************************/
	
	/********************************************************************************
	*	getArray($query) function													*
	*		*	Gets a SQL query													*
	*		*	Returns rows and cols array											*
	*/
		function getArrayForField($query, $field){	
			
			$this->connect();
			
			$result=mysqli_query($this->conn, $query);
			if($error=mysqli_error($this->conn)){
				error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
				$this->disconnect();
				return false;
			}
			
			$arr=array();
			$rowC=0;															
			while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {			
				$arr[$rowC]=$row[$field];
				$rowC++;
			}
			
			mysqli_free_result($result);
			$this->disconnect();
			

			//error_log( "query: ".round((microtime(true)-time_start)*1000)." ".$query );


			return $arr;
		}
	/*																				*
	********************************************************************************/
	
	
	/************************************************************
	*	For MySQL database										*
	*	get a MySql DB row						*
	************************************************************/
	function getRow($query){
		$this->connect();
		$result=mysqli_query($this->conn, $query);
		if($error=mysqli_error($this->conn)){
				error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
				$this->disconnect();
				return false;
		}

		if($result){
			$row=mysqli_fetch_assoc($result);
		}
		
		mysqli_free_result($result);
		$this->disconnect();

		//error_log( "query: ".round((microtime(true)-time_start)*1000)." ".$query );

		return $row;
	}

	/************************************************************
	*	Runs a query on MySQL database
	************************************************************/
	function runQuery($query){
		
		$this->connect();

		mysqli_query($this->conn, $query);

		if($error=mysqli_error($this->conn)){
				error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
				$this->disconnect();
				return false;
		}

		$this->disconnect();

		//error_log( "query: ".round((microtime(true)-time_start)*1000)." ".$query );

		return true;
	}

	function numRows($query){

		$this->connect();
		
		$result=mysqli_query($this->conn, $query);
		if($error=mysqli_error($this->conn)){
				error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
				$this->disconnect();
				return false;
		}

		$num= mysqli_num_rows($result);

		if(mysqli_error($this->conn)){
			$num=0;
		}		
		
		mysqli_free_result($result);
		$this->disconnect();		
		
		return $num;
	}
	

	function getAllTableFields($table, $returnAsList=false){

		$this->connect();			

		if($returnAsList){
			$arr="";
		}else{
			$arr=array();
		}

		$query="SELECT * FROM ".$table." LIMIT 0,1";
		$result = mysqli_query($this->conn, $query);
		if($error=mysqli_error($this->conn)){
				error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
				$this->disconnect();
				return false;
		}
		$finfo = mysqli_fetch_fields($result);


		foreach ($finfo as $val) {

			if($returnAsList){
				$arr.=",";
				$arr.=$val->name;			
			}else{
				array_push($arr, $val->name);
			}
/*
			printf("Name:     %s\n", $val->name);
			printf("Table:    %s\n", $val->table);
			printf("max. Len: %d\n", $val->max_length);
			printf("Flags:    %d\n", $val->flags);
			printf("Type:     %d\n\n", $val->type);
*/
		}


		if($returnAsList){
			$arr=trim($arr, ",");
		}

		return $arr;
	}
		

		
	function getFieldType($table, $fieldName){
		$this->connect();		
		$fields = mysqli_list_fields($this->DBName, $table, $this->conn); 
		$columns = mysqli_num_fields($fields); 
		for ($i = 0; $i < $columns; $i++) { 
			if(strcmp(mysqli_field_name($fields, $i), $fieldName)==0){
				$ft=mysqli_field_type($fields, $i);
				$this->disconnect();				
				return $ft;
			}
		}
		$this->disconnect();
	}
	
	
	/****************************************************************************
	*	getRowByID																*
	*	gets table, ID, returned rowNUM											*
	*																			*
	*/
		function getRowByID($table, $id, $rowNum){

			return false;
/*		

			$query="SELECT * FROM ". $table ." WHERE ID=".$id;

			$this->connect();
			
			$result=mysqli_query($this->conn, $query);
			if(mysql_error($this->conn)){
				$this->disconnect();
				return false;
			}

			$row=mysqli_fetch_array($result, MYSQL_ASSOC);
			$data=$row[$rowNum];

			mysqli_free_result($result);
			$this->disconnect();		

			return $data;
*/
		}
	/*																			*
	****************************************************************************/


	function getExistQuery($query){
		if($id=$this->getField($query, "ID")){
			return $id;
		}
		
		return false;
	}
	
	function getExist($table, $field, $val){
        if(is_numeric($val)){
            $query="SELECT ID FROM ". $table ." WHERE ". $field ."=". mysqli_real_escape_string($this->conn, $val);
        }else{
            $query="SELECT ID FROM ". $table ." WHERE ". $field ."='". mysqli_real_escape_string($this->conn, $val)."'";
        }
        //echo $query;exit;
		if($id=$this->getField($query, "ID")){
			return $id;
		}
		
		return false;
	}
	
	function getExistText($table, $field, $val){
		$query="SELECT ID FROM ". $table ." WHERE ". $field ."='". mysqli_real_escape_string($this->conn, $val) ."'";
		if($id=$this->getField($query, "ID")){
			return $id;
		}
		
		return false;
	}	

	
	function getField($query, $field){
		$row=$this->getRow($query);
		return $row[$field];
	}


	function updateData($table, $fieldsArray, $id=NULL, $index_field_name="ID", $useIdAsString=false){
		$this->connect();
                $querupdate=null;
                if($id){
                      if($useIdAsString){
                          $idSecured=  "'".mysqli_real_escape_string($this->conn, $id)."'";                        
                      }else{
                          $idSecured= intval($id);
                      }                  
                }
        
        //6155cdcec26d6e49cca85ea1251589ff18514a575e8
		if($id!=null){
				$query = "UPDATE " .$table ." SET ";
				foreach ($fieldsArray as $key => $value) {
				   if (get_magic_quotes_gpc()) {
					   $value = stripslashes($value);
				   }					
				   
					$querupdate.= $key ."='". mysqli_real_escape_string($this->conn, $value) ."',";
				}
				$querupdate=substr($querupdate, 0, strlen($querupdate)-1);
				$query = $query.$querupdate." WHERE ".$index_field_name."=".$idSecured;

				mysqli_query($this->conn, $query);
				if($error=mysqli_error($this->conn)){
					error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
					$this->disconnect();
					return false;
				}

/*
				echo mysqli_error($this->conn);
				exit;
*/		
				

		}else{	//	new
				$vars="";
				$vals="";
				foreach ($fieldsArray as $key => $value) {
					$vars.=$key.",";
				   if (get_magic_quotes_gpc()) {
					   $value = stripslashes($value);
				   }					
				   
					$vals.="'".mysqli_real_escape_string($this->conn, $value)."',";
				}
				$vars=substr($vars, 0, strlen($vars)-1);
				$vals=substr($vals, 0, strlen($vals)-1);
				$query="INSERT INTO ". $table ." (". $vars .") VALUES (". $vals .")";
				mysqli_query($this->conn, $query);
				if($error=mysqli_error($this->conn)){
					error_log($error." ".print_r(debug_backtrace(), 1)." ".$query);
					$this->disconnect();
					return false;
				}

			

				$id=mysqli_insert_id($this->conn);
				
			

		}
			
		$this->disconnect();

		return $id;
	}
}
?>
