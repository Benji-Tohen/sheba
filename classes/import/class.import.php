<?php
class Import{

	var $db;

	function Import($db){
		$this->db=$db;
	}

	function isValidEmail($email){
	    return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}	

	function importData($fileName, $dbTable, $dbFields){
		$affectedRows=0;
		$row = 0;
		$handle = fopen($fileName, "r");
		
		$values=array();
		
		$time=time();
	

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		    if($row<1){
                        $row++;
			continue;
		    }
		    $num = count($data);
			
	    		$data[0]=trim($data[0]);

			if($data[0]==""){continue;}
			if(!$this->isValidEmail($data[0])){continue;}
			if($this->db->getExist($dbTable, "Email", "'".$data[0]."'")){
				continue;
			}
			
		    
		    for ($c=0;$c<$num; $c++) {
				$values[$dbFields[$c]]=trim($data[$c]);
		    }
 			$values["JoiningDate"]=$time;

		    $affectedRows++;
		    $this->db->updateData($dbTable, $values);
		}
		fclose($handle);

		return $affectedRows;
	}

	function importPrograms($fileName){
		$dbTable="wm_programs";
		$affectedRows=0;
		$modifiedRows=0;
		$row = 0;
		$handle = fopen($fileName, "r");
		
		$values=array();
		
		$time=time();
	

		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$id=NULL;

			if($row<1){
				$row++;
				continue;
			}
			$num = count($data);

			$data[0]=trim($data[0]);
			if($data[0]==""){continue;}

/*
			for ($c=0;$c<$num; $c++) {
				$values[$dbFields[$c]]=trim($data[$c]);
			}
*/	


			list($d,$m,$y)=	explode("/", $data[0]);
			list($h,$i)=	explode(":", $data[1]);

			$y="20".$y;
			$dateTimestamp=mktime($h,$i,0,$m,$d,$y);


			$exists=$this->db->getExist("wm_programs", "Start_date", $dateTimestamp);
			if($exists){
				$id=$exists;
				$modifiedRows++;
			}



			$values=array(
				"Start_Date"		=>	$dateTimestamp,
				"Start_Date_Date"	=>	$y."-".$m."-".$d,
				"Start_Date_Time"	=>	$h.":".$i.":00",
				"Name"	=>	$data[2],
				"Value"	=>	$data[6],
				"date_updated"	=>	$time				
			);

			$affectedRows++;
			$this->db->updateData($dbTable, $values, $id);
		}
		fclose($handle);

		$results["affectedRows"]=$affectedRows;
		$results["modifiedRows"]=$modifiedRows;

		if(!$results["affectedRows"]){
			$results=false;
		}
		return $results;
	}
}
?>
