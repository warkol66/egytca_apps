<?php
class ResponseBase {
	var $appCommitted = False;
	var $buffer = '';
	var $bufferCount = 0;
	var $responseBuffer = NULL;
	var $committed = False;
	var $contentCount = 0;
	var $contentLength = -1;
	var $contentType = NULL;
	var $context = NULL;
	var $encoding = NULL;
	var $included = False;
	var $info = 'phpmvc.connector.ResponseBase/1.0';
	var $locale = NULL;
	var $output = NULL;
	var $request = NULL;
	var $suspended = False;
	var $error = False;
	function setResponseBuffer(&$responseBuffer) { $this -> responseBuffer = $responseBuffer;
	}
	function getResponseBuffer() {
		return $this -> responseBuffer;
	}
	function isAppCommitted() {
		return ($this -> appCommitted || $this -> committed);
	}
	function getIncluded() {
		return $this -> included;
	}
	function setIncluded($included) { $this -> included = $included;
	}
	function getInfo() {
		return $this -> info;
	}
	function getRequest() {
		return $this -> request;
	}
	function setRequest($request) { $this -> request = $request;
	}
	function getStream() {
		return $this -> output;
	}
	function setStream($stream) { $this -> output = $stream;
	}
	function getContentLength() {
		return $this -> contentLength;
	}
	function getContentType() {
		return $this -> contentType;
	}
	function recycle() { $this -> bufferCount = 0;
		$this -> committed = False;
		$this -> appCommitted = False;
		$this -> suspended = False;
		$this -> contentCount = 0;
		$this -> contentLength = -1;
		$this -> contentType = NULL;
		$this -> context = NULL;
		$this -> encoding = NULL;
		$this -> included = False;
		$this -> locale = Locale . getDefault();
		$this -> output = NULL;
		$this -> request = NULL;
		$this -> stream = NULL;
		$this -> writer = NULL;
		$this -> error = False;
	}
	function flushBuffer() { $this -> committed = True;
		if (bufferCount > 0) { $this -> bufferCount = 0;
		}
	}
	function getBufferSize() {
		return strlen($this -> buffer);
	}
	function getCharacterEncoding() {
		if (encoding == null)
			return ("ISO-8859-1");
		else
			return (encoding);
	}
	function getLocale() {
		return $this -> locale;
	}
	function isCommitted() {
		return $this -> committed;
	}
	function reset() {
		if ($this -> committed)
			return '"responseBase.reset.ise"';
		if ($this -> included)
			return;
		$this -> bufferCount = 0;
		$this -> contentLength = -1;
		$this -> contentType = NULL;
	}
	function resetBuffer() {
		if ($this -> committed) {
			return 'responseBase.resetBuffer.ise';
		} $this -> bufferCount = 0;
		return NULL;
	}
	function setContentType($type) {
		return;
	}
	function setLocale($locale) {
	}

}
?>
