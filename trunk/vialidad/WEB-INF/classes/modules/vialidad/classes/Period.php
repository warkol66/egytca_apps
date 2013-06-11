<?php

class Period {
	private $date;
	
	function Period($date, $format  = "d-m-Y") {
		$dateTime = DateTime::createFromFormat($format, $date);
		$this->date = strtotime("01-".$dateTime->format("m-Y"));
	}
	
	static function getPeriodsInRange($from, $to, $format = "d-m-Y") {
		$first = new Period($from, $format);
		$last = new Period($to, $format);
		
		$periods = array();
		for ($aPeriod = clone $first; $aPeriod->isLessEqualThan($last); $aPeriod = $aPeriod->getNextPeriod())
			$periods[] = $aPeriod;
		
		return $periods;
	}
	
	public function __toString() {
		return date("m-Y", $this->date);
	}
	
	function getMin($format = "d-m-Y") {
		return date($format, strtotime("1-".date("m-Y", $this->date)));
	}
	
	function getMax($format = "d-m-Y") {
		return date($format, strtotime(date("t-m-Y", $this->date)));
	}
	
	function getLimits($format = "d-m-Y") {
		return array("min" => $this->getMin($format), "max" => $this->getMax($format));
	}
	
	function getNextPeriod() {
		return new Period(date("d-m-Y", strtotime(date("d-m-Y", $this->date)." + 1 month")));
	}
	
	function getPreviousPeriod(){
		return new Period(date("d-m-Y", strtotime(date("d-m-Y", $this->date)." - 1 month")));
	}
	
	function isGreaterThan($other) {
		return ($this->date - $other->date) > 0 ? true : false;
	}
	
	function isGreaterEqualThan($other) {
		return ($this->date - $other->date) >= 0 ? true : false;
	}
	
	function isLessThan($other) {
		return ($this->date - $other->date) < 0 ? true : false;
	}
	
	function isLessEqualThan($other) {
		return ($this->date - $other->date) <= 0 ? true : false;
	}
	
	function isEqualTo($other) {
		return ($this->date - $other->date) == 0 ? true : false;
	}
}
