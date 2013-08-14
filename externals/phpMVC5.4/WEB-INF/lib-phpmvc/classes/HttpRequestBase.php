<?php
class HttpRequestBase extends RequestBase {
	var $authType = NULL;
	var $contextPath = '';
	var $cookies = array();
	var $empty = array();
	var $headers = array();
	var $locales = array();
	var $languagePriority = array();
	var $info = 'HttpRequestBase/1.0';
	var $method = NULL;
	var $parameters = array();
	var $parsed = False;
	var $pathInfo = NULL;
	var $queryString = NULL;
	var $requestedSessionCookie = False;
	var $requestedSessionId = NULL;
	var $requestedSessionURL = False;
	var $requestURI = NULL;
	var $decodedRequestURI = NULL;
	var $secure = False;
	var $appServerPath = NULL;
	var $session = NULL;
	var $userPrincipal = NULL;
	var $_get_vars = NULL;
	var $_post_vars = NULL;
	var $_files_vars = NULL;
	function getInfo() {
		return $this -> info;
	}
	function setGetVars(&$_get_vars) { $this -> _get_vars = $_get_vars;
	}
	function & getGetVars() {
		return $this -> _get_vars;
	}
	function setPostVars(&$_post_vars) { $this -> _post_vars = $_post_vars;
	}
	function & getPostVars() {
		return $this -> _post_vars;
	}
	function setFilesVars(&$_files_vars) { $this -> _files_vars = $_files_vars;
	}
	function & getFilesVars() {
		return $this -> _files_vars;
	}
	function addCookie($cookie) { $this -> cookies[] = $cookie;
	}
	function addHeader($name, $value) { $name = strtolower($name);
		$values = $this -> headers[$name];
		if ($values == NULL) { $values = array();
		} $values[] = $value;
		$headers[$name] = $values;
	}
	function addParameter($name, $values) { $this -> parameters[$name] = $values;
	}
	function clearCookies() { $this -> cookies = array();
	}
	function clearHeaders() { $this -> headers = array();
	}
	function clearLocales() { $this -> locales = array();
	}
	function clearParameters() {
		if ($this -> parameters != NULL) { $this -> parameters = array();
		} else { $this -> parameters = array();
		}
	}
	function recycle() { $this -> authType = NULL;
		$this -> contextPath = '';
		$this -> cookies = array();
		$this -> headers = array();
		$this -> method = NULL;
		if ($this -> parameters != NULL) { $this -> parameters = array();
		} $this -> parsed = False;
		$this -> pathInfo = NULL;
		$this -> queryString = NULL;
		$this -> requestedSessionCookie = False;
		$this -> requestedSessionId = NULL;
		$this -> requestedSessionURL = False;
		$this -> requestURI = NULL;
		$this -> decodedRequestURI = NULL;
		$this -> secure = False;
		$this -> servletPath = NULL;
		$this -> session = NULL;
		$this -> userPrincipal = NULL;
	}
	function setContextPath($contextPath) {
		if ($contextPath == '') { $this -> contextPath = "";
		} else { $this -> contextPath = $contextPath;
		}
	}
	function setMethod($method) { $this -> method = $method;
	}
	function setPathInfo($path) { $this -> pathInfo = $path;
	}
	function setRequestURI($uri) { $this -> requestURI = $uri;
	}
	function setAppServerPath($path) { $this -> appServerPath = $path;
	}
	function parseParameters() {
		if ($this -> parsed == True) {
			return;
		} $results = array();
		if ((int)phpversion() > 4) { $results = array_merge($_GET, $_POST);
		} else {
			global $HTTP_SERVER_VARS;
			global $HTTP_POST_VARS;
			global $HTTP_GET_VARS;
			if (isset($HTTP_SERVER_VARS)) { $results = array_merge($HTTP_GET_VARS, $HTTP_POST_VARS);
			}
		}
		if (count($this -> parameters) > 0) { $results = array_merge($this -> parameters, $results);
		} $this -> parsed = True;
		$this -> parameters = $results;
	}
	function getParameter($name) {
		if ($this -> parsed == False) { $this -> parseParameters();
		} $values = NULL;
		if (array_key_exists($name, $this -> parameters)) { $values = $this -> parameters[$name];
		}
		if ($values != NULL) {
			if (is_array($values)) {
				return $values[0];
			} else {
				return $values;
			}
		} else {
			return NULL;
		}
	}
	function getParameterNames() {
		if ($this -> parsed == False) { $this -> parseParameters();
		}
		return array_keys($this -> parameters);
	}
	function getParameterValues($name) {
		if ($this -> parsed == False) { $this -> parseParameters();
		} $values = NULL;
		if (array_key_exists($name, $this -> parameters)) { $values = $this -> parameters[$name];
		}
		if ($values != NULL) {
			if (is_array($values)) {
				return $values;
			} else {
				return array($values);
			}
		} else {
			return NULL;
		}
	}
	function isSecure() {
		return $this -> secure;
	}
	function getAuthType() {
		return $this -> authType;
	}
	function getContextPath() {
		return $this -> contextPath;
	}
	function getCookies() {
	}
	function getHeader($name) {
	}
	function getHeaders($name) {
	}
	function getMethod() {
		return $this -> method;
	}
	function getPathInfo() {
		return $this -> pathInfo;
	}
	function getQueryString() {
		return $this -> queryString;
	}
	function getRequestedSessionId() {
		return $this -> requestedSessionId;
	}
	function getRequestURI() {
		return $this -> requestURI;
	}
	function getAppServerPath() {
		return $this -> appServerPath;
	}
	function getSession() {
		return;
	}
	function isUserInRole($role) {
	}

}
?>
