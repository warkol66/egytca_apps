<?php
class AppServerContext {
	var $appAttributes = array();
	var $parameter = NULL;
	function AppServerContext() {;
	}
	function getInitParameter($name) {
		if (array_key_exists($name, $this -> parameter))
			return $this -> parameter[$name];
		else
			return NULL;
	}
	function setInitParameter($key, $value) { $this -> parameter[$key] = $value;
	}
	function getAttribute($name) {
		if (array_key_exists($name, $this -> appAttributes))
			return $this -> appAttributes[$name];
		else
			return NULL;
	}
	function setAttribute($name, &$object) {
		return $this -> appAttributes[$name] = $object;
	}

}
?>
