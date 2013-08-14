<?php
class FormBeanConfig {
	var $configured = False;
	var $formProperties = array();
	var $dynamic = False;
	var $name = NULL;
	var $type = NULL;
	function getDynamic() {
		return $this -> dynamic;
	}
	function setDynamic($dynamic) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> dynamic = $dynamic;
	}
	function getName() {
		return $this -> name;
	}
	function setName($name) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> name = $name;
	}
	function getType() {
		return $this -> type;
	}
	function setType($type) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> type = $type;
		if ('phpmvc.action.DynaActionForm' == $type) { $this -> dynamic = True;
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
		$beanUtils -> setProperty($this, $name, $value);
	}
	function addFormPropertyConfig($config) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> formProperties[$config -> getName()] = $config;
	}
	function findFormPropertyConfig($name) {
		return $this -> formProperties[$name];
	}
	function findFormPropertyConfigs() {
		return array_values($this -> formProperties);
	}
	function freeze() { $this -> configured = True;
		$fpconfigs = array();
		$fpconfigs = $this -> findFormPropertyConfigs();
		foreach ($fpconfigs as $fpconfig) { $fpconfig -> freeze();
		}
	}
	function removeFormPropertyConfig($config) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> formProperties -> remove($config -> getName());
	}
	function toString() { $sb = 'FormBeanConfig[';
		$sb .= 'name=';
		$sb .= $this -> name;
		$sb .= ',type=';
		$sb .= $this -> type;
		$sb .= ']';
		return $sb;
	}
	function getClassID() { $className = 'FormBeanConfig';
		$fileName = 'FormBeanConfig.php';
		$versionID = '20021025-0955';
		return "$className:$fileName:$versionID";
	}

}
?>
