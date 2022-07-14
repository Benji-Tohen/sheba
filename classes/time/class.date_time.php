<?php
class DateTime1{

	function DateTime(){
		
	}

	function addSeconds($time, $toAdd){
		return $time+$toAdd;
	}
	
	function addMinutes($time, $toAdd){
		return $this->addSeconds($time, $toAdd*60);
	}
	
	function addHours($time, $toAdd){
		return $this->addMinutes($time, $toAdd*60);
	}
	
	function addDays($time, $toAdd){
		return $this->addHours($time, $toAdd*24);
	}

	function addWeeks($time, $toAdd){
		return $this->addDays($time, $toAdd*7);
	}
	
	function addMonths($time, $toAdd){
		return $this->addDays($time, $toAdd*30);
	}
	
	function addYears($time, $toAdd){
		return $this->addMonths($time, $toAdd*12);
	}
	
	function addTime($time, $h=0, $i=0, $s=0, $d=0, $m=0, $y=0){
		$time=$this->addSeconds(addMinutes(addHours(addDays(addMonths($time, $m), $d), $h), $i), $s);
		return $time;
	}

	function timestampFromMysql($mysqlDate){
		list($year, $month, $day)=explode("-", $mysqlDate);
		return mktime(0, 0, 0, intval($month), intval($day), intval($year));
	}

	function timestampFromText($textDate){
		list($day, $month, $year)=explode("/", $textDate);
		return mktime(0, 0, 0, intval($month), intval($day), intval($year));
	}
	
	function getHebDay($d=1){
		$arrDays=array("ראשון","שני","שלישי","רביעי","חמישי","שישי","שבת");
		return $arrDays[$d-1];
	}

	function dateFromDateTime($mysqlDateTime){
		list($date, $time)=explode(" ", $mysqlDateTime);
		return $date;
	}

	function timeFromDateTime($mysqlDateTime){
		list($date, $time)=explode(" ", $mysqlDateTime);
		return $time;
	}

	function showFullTimeFomDateTime($mysqlDateTime){
		return $this->show_date($this->dateFromDateTime($mysqlDateTime))." ".$this->timeFromDateTime($mysqlDateTime);
	}


	/************************************************
	*	gets a MySQL date format					*
	*	and returns the presentation				*
	*	( gets 2003-12-25 returns 25.12.2003 )		*
	/***********************************************/
	function show_date($theDate, $lang="he"){
		list ($year, $month, $day) = explode ('-', $theDate);
		if(strcmp($lang, "en")==0){
			return date("d F Y", mktime (0,0,0,$month,$day,$year));
		}else{
			return date("d.m.y", mktime (0,0,0,$month,$day,$year));
		}
	}
	
	function WorkDays( $startTime, $endTime ){
	   $workdays = 0 ;
	   while( $startTime <= $endTime )
	   {
		   if( date('w', $startTime ) != 6 && date( 'w', $startTime) != 0 )
		   {
			   $workdays++ ;
		   }
		   $startTime += 86400 ;
	   }
	   return $workdays ;
	}
	
	function datediff($start_date,$end_date="now",$unit="D")
		{
			$unit = strtoupper($unit);
			$start=strtotime($start_date);
			if ($start === -1) {
				print("invalid start date");
			}
			
			$end=strtotime($end_date);			
			if ($end === -1) {
				print("invalid end date");
			}
			
			if ($start > $end) {
				$temp = $start;
				$start = $end;
				$end = $temp;
			}
			
			$diff = $end-$start;
			
			$day1 = date("j", $start);
			$mon1 = date("n", $start);
			$year1 = date("Y", $start);
			$day2 = date("j", $end);
			$mon2 = date("n", $end);
			$year2 = date("Y", $end);
			
			switch($unit) {
				case "D":
					print(intval($diff/(24*60*60)));
					break;
				case "M":
					if($day1>$day2) {
						$mdiff = (($year2-$year1)*12)+($mon2-$mon1-1);
					} else {
						$mdiff = (($year2-$year1)*12)+($mon2-$mon1);
					}
					print($mdiff);
					break;
				case "Y":
					if(($mon1>$mon2) || (($mon1==$mon2) && ($day1>$day2))){
						$ydiff = $year2-$year1-1;
					} else {
						$ydiff = $year2-$year1;
					}
					print($ydiff);
					break;
				case "YM":
					if($day1>$day2) {
						if($mon1>=$mon2) {
							$ymdiff = 12+($mon2-$mon1-1);
						} else {
							$ymdiff = $mon2-$mon1-1;
						}
					} else {
						if($mon1>$mon2) {
							$ymdiff = 12+($mon2-$mon1);
						} else {
							$ymdiff = $mon2-$mon1;
						}
					}
					print($ymdiff);
					break;
				case "YD":
					if(($mon1>$mon2) || (($mon1==$mon2) &&($day1>$day2))) {
						$yddiff = intval(($end - mktime(0, 0, 0, $mon1, $day1, $year2-1))/(24*60*60));						
					} else {
						$yddiff = intval(($end - mktime(0, 0, 0, $mon1, $day1, $year2))/(24*60*60));
					}
					print($yddiff);
					break;
				case "MD":
					if($day1>$day2) {
						$mddiff = intval(($end - mktime(0, 0, 0, $mon2-1, $day1, $year2))/(24*60*60));						
					} else {
						$mddiff = intval(($end - mktime(0, 0, 0, $mon2, $day1, $year2))/(24*60*60));
					}
					print($mddiff);
					break;
				default:
     			print("{Datedif Error: Unrecognized \$unit parameter. Valid values are 'Y', 'M', 'D', 'YM'. Default is 'D'.}");
				
			}

		}		
}
?>
