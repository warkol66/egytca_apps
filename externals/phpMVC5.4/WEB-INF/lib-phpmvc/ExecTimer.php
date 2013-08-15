<?php

class ExecTimer {
	
	private $start;
	
	function start() {
		$this->start = $this->utime();
	}
	
	// Calculates current microtime
	function utime() {
		// microtime() = current UNIX timestamp with microseconds
		$time	= explode( ' ', microtime());
		$usec	= (double)$time[0];
		$sec	= (double)$time[1];
		return $sec + $usec;
	}

	function printTime($strMsg) {
		$end = $this->utime();
		$run = $end - $this->start;
		echo '<br><b>'.$strMsg.': </b>'.substr($run, 0, 5) . ' secs.';
	}
}
