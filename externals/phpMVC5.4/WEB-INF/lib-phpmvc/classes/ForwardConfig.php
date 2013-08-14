<?php
class ForwardConfig {
	var $configured = False;
	var $contextRelative = False;
	var $name = NULL;
	var $path = NULL;
	var $nextActionPath = NULL;
	var $redirect = False;
	var $properties = array();
	function getContextRelative() {
		return $this -> contextRelative;
	}
	function setContextRelative($contextRelative) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> contextRelative = $contextRelative;
	}
	function getName() {
		return $this -> name;
	}
	function setName($name) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> name = $name;
	}
	function getPath() {
		return $this -> path;
	}
	function setPath($path) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $URLDecodedPath = '';
		$URLDecodedPath = urldecode($path);
		$this -> path = $URLDecodedPath;
	}
	function getNextActionPath() {
		return $this -> nextActionPath;
	}
	function setNextActionPath($nextActionPath) {
		if ($this -> configured) {
		} $this -> nextActionPath = $nextActionPath;
	}
	function getRedirect() {
		return $this -> redirect;
	}
	function setRedirect($redirect) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> redirect = $redirect;
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
	function ForwardConfig($path = '', $redirect = '') { $this -> setName(NULL);
		$this -> setPath($path);
		$this -> setRedirect($redirect);
	}
	function freeze() { $this -> configured = True;
	}
	function toString() { $sb = 'ForwardConfig[';
		$sb .= 'name=';
		$sb .= $this -> name;
		$sb .= ',path=';
		$sb .= $this -> path;
		$sb .= ',redirect=';
		$sb .= $this -> redirect;
		$sb .= ']';
		return $sb;
	}
	function getClassID() { $className = 'ForwardConfig';
		$fileName = 'ForwardConfig.php';
		$versionID = '20021025-0955';
		return "$className:$fileName:$versionID";
	}

}
?>
