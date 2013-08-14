<?php
class RequestBase {
	var $attributes = array();
	var $authorization = NULL;
	var $characterEncoding = NULL;
	var $contentLength = -1;
	var $contentType = NULL;
	var $context = NULL;
	var $defaultLocale = NULL;
	var $info = 'phpmvc.connector.RequestBase/1.0';
	var $locales = array();
	var $protocol = NULL;
	var $remoteAddr = NULL;
	var $remoteHost = NULL;
	var $response = NULL;
	var $scheme = NULL;
	var $secure = False;
	var $serverName = NULL;
	var $serverPort = -1;
	var $socket = NULL;
	var $wrapper = NULL;
	function getAuthorization() {
		return $this -> authorization;
	}
	function setAuthorization($authorization) { $this -> authorization = $authorization;
	}
	function getContext() {
		return $this -> context;
	}
	function setContext($context) { $this -> context = $context;
	}
	function getInfo() {
		return $this -> info;
	}
	function getRequest() {
		return $this -> facade;
	}
	function getResponse() {
		return $this -> response;
	}
	function setResponse($response) { $this -> response = $response;
	}
	function getWrapper() {
		return $this -> wrapper;
	}
	function setWrapper($wrapper) { $this -> wrapper = $wrapper;
	}
	function addLocale($locale) { $this -> locales[] = $locale;
	}
	function finishRequest() {
		if ($this -> reader != NULL) { $this -> reader -> close();
		}
		if ($this -> stream != NULL) { $this -> stream -> close();
		}
	}
	function recycle() { $this -> attributes = array();
		$this -> authorization = NULL;
		$this -> characterEncoding = NULL;
		$this -> contentLength = -1;
		$this -> contentType = NULL;
		$this -> context = NULL;
		$this -> input = NULL;
		$this -> locales = array();
		$this -> notes = array();
		$this -> protocol = NULL;
		$this -> reader = NULL;
		$this -> remoteAddr = NULL;
		$this -> remoteHost = NULL;
		$this -> response = NULL;
		$this -> scheme = NULL;
		$this -> secure = False;
		$this -> serverName = NULL;
		$this -> serverPort = -1;
		$this -> socket = NULL;
		$this -> stream = NULL;
		$this -> wrapper = NULL;
	}
	function setContentLength($length) { $this -> contentLength = $length;
	}
	function setContentType($type) { $this -> contentType = $type;
	}
	function setProtocol($protocol) { $this -> protocol = $protocol;
	}
	function setRemoteAddr($remoteAddr) { $this -> remoteAddr = $remoteAddr;
	}
	function setRemoteHost($remoteHost) { $this -> remoteHost = $remoteHost;
	}
	function setScheme($scheme) { $this -> scheme = $scheme;
	}
	function setSecure($secure) { $this -> secure = $secure;
	}
	function setServerName($name) { $this -> serverName = $name;
	}
	function setServerPort($port) { $this -> serverPort = $port;
	}
	function getAttribute($name) {
		if (array_key_exists($name, $this -> attributes))
			return $this -> attributes[$name];
		else
			return NULL;
	}
	function getAttributeNames() {
		return array_keys($this -> attributes);
	}
	function getCharacterEncoding() {
		return $this -> characterEncoding;
	}
	function getContentLength() {
		return $this -> contentLength;
	}
	function getContentType() {
		return $this -> contentType;
	}
	function getLocale() {
		if (count($locales) > 0)
			return $locales[0];
		else
			return $this -> defaultLocale;
	}
	function getLocales() {
		if (count($locales) > 0)
			return $this -> locales;
		$results = array();
		$results[] = $this -> defaultLocale;
		return $results;
	}
	function getParameter($name) {
	}
	function getParameterMap() {
	}
	function getParameterNames() {
	}
	function getParameterValues($name) {
	}
	function getProtocol() {
		return $this -> protocol;
	}
	function getRemoteAddr() {
		return $this -> remoteAddr;
	}
	function getRemoteHost() {
		return $this -> remoteHost;
	}
	function getRequestDispatcher($path) {
	}
	function getScheme() {
		return $this -> scheme;
	}
	function getServerName() {
		return $this -> serverName;
	}
	function getServerPort() {
		return $this -> serverPort;
	}
	function isSecure() {
		return $this -> secure;
	}
	function removeAttribute($name) { HelperUtils::zapArrayElement($name, $this -> attributes);
	}
	function setAttribute($name, $value) {
		if ($name == NULL) {
			return;
		}
		if ($value == NULL) { $this -> removeAttribute($name);
			return;
		} $this -> attributes[$name] = $value;
	}
	function setCharacterEncoding($enc) { $this -> characterEncoding = $enc;
	}

}
?>
