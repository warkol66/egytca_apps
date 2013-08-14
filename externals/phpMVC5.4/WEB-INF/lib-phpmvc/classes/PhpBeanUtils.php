<?php
class PhpBeanUtils {
	var $log = NULL;
	function PhpBeanUtils() { $this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function cloneBean($object) {
	}
	function copyProperties($dest, $orig) {
	}
	function copyProperty($object, $name, $value) {
	}
	function describe($object) {
	}
	function getArrayProperty($object, $name) {
	}
	function getIndexedProperty($object, $name, $index = 0) {
	}
	function getMappedProperty($object, $name, $key = NULL) {
	}
	function getNestedProperty($object, $name) {
	}
	function getProperty($object, $name) {
	}
	function getSimpleProperty($object, $name) {
	}
	function populate(&$object, $properties) { $debug = $this -> log -> getLog('isDebugEnabled');
		if (($object == NULL) || ($properties == NULL)) {
			return;
		}
		if ($debug) { $this -> log -> debug('PhpBeanUtils->populate(' . get_class($object) . ', ' . $properties . ')[' . __LINE__ . ']');
		}
		foreach ($properties as $name => $value) {
			if ($name == NULL) {
				continue;
			} $this -> setProperty($object, $name, $value);
		}
	}
	function setProperty(&$object, $methodName, $value) { $trace = $this -> log -> getLog('isTraceEnabled');
		$classMethods = get_class_methods($object);
		$methodName = 'set' . ucfirst($methodName);
		$res = NULL;
		foreach ($classMethods as $val) {
			if (strtolower($methodName) == strtolower($val)) { $res = True;
			}
		}
		if (is_null($res)) {
			return 0;
		} $strBuff = '';
		if ($trace) { $strBuff = '  setProperty(';
			$strBuff .= get_class($object);
			$strBuff .= ', ';
			$strBuff .= $methodName;
			$strBuff .= ', ';
			if (value == NULL) { $strBuff .= '<NULL>';
			} else if (is_string($value)) { $strBuff .= $value;
			} else { $strBuff .= (string)$value;
			}
			$strBuff .= ")";
			$this -> log -> trace($strBuff);
		} $object -> $methodName($value);
		return 1;
	}

}
?>
