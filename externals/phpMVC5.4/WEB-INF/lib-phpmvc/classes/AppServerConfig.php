<?php
class AppServerConfig {
	var $mapping = 'ActionConfig';
	var $context = NULL;
	var $parameter = array();
	function AppServerConfig() {;
	}
	function getInitParameter($name) {
		if (array_key_exists($name, $this -> parameter))
			return $this -> parameter[$name];
		else
			return NULL;
	}
	function setInitParameter($key, $value) { $this -> parameter[$key] = $value;
	}
	function getAppServerContext() {
		return $this -> context;
	}
	function setAppServerContext(&$context) { $this -> context = $context;
	}

}
?>
