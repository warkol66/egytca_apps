<?php
class DataSourceConfig {
	var $configured = False;
	var $key = NULL;
	var $properties = array();
	var $type = 'BasicDataSource';
	function getKey() {
		return $this -> key;
	}
	function setKey($key) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> key = $key;
	}
	function getProperties() {
		return $this -> properties;
	}
	function getType() {
		return $this -> type;
	}
	function setType($type) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> type = $type;
	}
	function DataSourceConfig() { $this -> key = Action::getKey('DATA_SOURCE_KEY');
	}
	function getProperty($name) {
		if (array_key_exists($name, $this -> properties)) {
			return $this -> properties[$name];
		} else {
			return NULL;
		}
	}
	function addProperty($name, $value) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		}
		if (strtolower($value) == 'true') { $value = True;
		} elseif (strtolower($value) == 'false') { $value = False;
		}
		$beanUtils = new PhpBeanUtils();
		if ($beanUtils -> setProperty($this, $name, $value) == 0) { $this -> properties[$name] = $value;
		}
	}
	function freeze() { $this -> configured = True;
	}
	function toString() { $strBuff = 'DataSourceConfig[';
		$strBuff .= 'key="';
		$strBuff .= $this -> key;
		$strBuff .= ',type=';
		$strBuff .= $this -> type;
		foreach ($this->properties as $name => $value) { $strBuff .= ',';
			$strBuff .= $name;
			$strBuff .= '=';
			$strBuff .= $value;
		} $strBuff .= ']';
		return $strBuff;
	}
	function getClassID() { $className = 'DataSourceConfig';
		$fileName = 'DataSourceConfig.php';
		$versionID = '20021025-0955';
		return "$className:$fileName:$versionID";
	}

}
?>
