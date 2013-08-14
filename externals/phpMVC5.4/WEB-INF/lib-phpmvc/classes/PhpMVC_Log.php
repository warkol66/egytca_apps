<?php
class PhpMVC_Log {
	var $attribute = array();
	var $logPtr = NULL;
	function PhpMVC_Log($key = '', $val = '') {
		if ($key != '' && $val != '') { $this -> setLog($key, $val);
		}
	}
	function setLog($key, $val) { $this -> attribute[$key] = $val;
	}
	function getLog($key) {
		if (array_key_exists($key, $this -> attribute))
			return $this -> attribute[$key];
		else
			return NULL;
	}
	function clearLog() { unset($this -> attribute);
		$this -> attribute = array();
	}
	function debug($msgString) { echo 'Debug: ' . $msgString . "\n";
	}
	function warn($msgString) { echo 'Warning: ' . $msgString . "\n";
	}
	function error($msgString, $error = '') { echo 'Error: ' . $msgString . ' (' . $error . ")\n";
	}
	function trace($msgString) { echo 'Trace: ' . $msgString . "\n";
	}
	function write($msgString, $logFile = 'log.txt', $mode = 'w') {
		if ($logFile != '' && $this -> logPtr == NULL) { $this -> logPtr = @fopen($logFile, $mode);
		}
		if ($this -> logPtr != NULL) { fwrite($this -> logPtr, $msgString);
		} else { echo 'Error writing log file: [' . $logFile . ']<br>';
		}
	}
	function closeLogFile() {
		if ($this -> logPtr != NULL) { fclose($this -> logPtr);
		}
	}

}
?>
