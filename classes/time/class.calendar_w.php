<?php
class CalendarW{

        var $month;
        var $year;
	var $timestamp;
	var $dayOfWeek;
	var $firstDayOfWeek;
	var $lastDayOfWeek;
        var $weekDays;
        var $dayToString = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");

	function CalendarW($timestamp){
            $this->timestamp = $timestamp;
            $this->month=date("n",$timestamp);
            $this->year=date("Y",$timestamp);		
            $this->createFirstAndLastDayOfWeek();
	}

	function getDayOfWeek(){
            return $this->dayOfWeek;
	}

	function getFirstDayWeek(){
            return $this->firstDayOfWeek;
	}

	function getLastDayWeek(){
            return $this->lastDayOfWeek;
	}

	function createFirstAndLastDayOfWeek() {
            $dayOfWeek = $this->dayOfWeek = date("w", $this->timestamp);        // extract day of week
            $firstDayOfWeek = strtotime("-$dayOfWeek day", $this->timestamp);   // get timestamp of first day of week
            $lastDayOfWeek = strtotime("+".(6-$dayOfWeek)." day", $this->timestamp);      // get timestamp of last day of week
            $this->weekDays = array();                                          // prepare predefined array of all days of this week
            for ($i=0; $i<7; $i++) {
                $day_timestamp = $firstDayOfWeek + ($i*86400);
                $this->weekDays[$i] = array(
                    "timestamp" => $day_timestamp,
                    "day"       => $this->dayToString[$i],
                    "date"      => date("Y-m-d", $day_timestamp),
                    "dom"       => date("j", $day_timestamp),
                    "month"     => date("m", $day_timestamp),
                    "month_num" => date("n", $day_timestamp),
                    "year"      => date("Y", $day_timestamp),
                    "current"   => ($i==$dayOfWeek)
                );
            }
	}

}
?>
