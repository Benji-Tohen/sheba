<?php
class CalendarX{


	var $month;
	var $year;
	var $lastDayOfMonth;
	var $firstDayOfMonthW;
	var $lastDayOfMonthW;

	function CalendarX($month, $year){
		$this->month=$month;
		$this->year=$year;		
		$this->createFirstAndLastDayOfMonth();
	}

	function getLastDay(){
		return $this->lastDayOfMonth;
	}

	function getFirstDayW(){
		return $this->firstDayOfMonthW;
	}

	function getLastDayW(){
		return $this->lastDayOfMonthW;
	}

	function createFirstAndLastDayOfMonth() {
		if (empty($this->month)) {
			$this->month = date('m');
		}
		if (empty($this->year)) {
			$this->year = date('Y');
		}
		$year=$this->year;
		$month=$this->month;
		$result = strtotime("{$year}-{$month}-01");
		$result = strtotime('-1 second', strtotime('+1 month', $result));
		$this->lastDayOfMonth=date('d', $result);
		$ldom=$this->lastDayOfMonth;
		$this->lastDayOfMonthW=date('w', strtotime("{$year}-{$month}-{$ldom}"))+1;
		$this->firstDayOfMonthW=date("w", strtotime("{$year}-{$month}-01"))+1;
	}

}
?>
