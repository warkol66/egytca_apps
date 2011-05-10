<?php

require_once("ReportGenerator.php");

class LausiReportsInclude extends ReportGenerator {


	function getAvailableBillboards($options) {
		
		$result = parent::getAvailableBillboardsReport();
		
		return $result;
		
	}

	
} // end of class