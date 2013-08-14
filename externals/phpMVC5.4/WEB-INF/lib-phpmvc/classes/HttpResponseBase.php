<?php
class HttpResponseBase extends ResponseBase {
	var $cookies = array();
	var $format = array("EEE, dd MMM yyyy HH:mm:ss zzz", 'AU');
	var $headers = array();
	var $info = 'phpmvc.connector.HttpResponseBase/1.0';
	function HttpResponseBase() {
	}
	function getCookies() {
		return $this -> cookies;
	}
	function getHeader($name) { $values = NULL;
		$values = $this -> headers[$name];
		if (values != NULL)
			return $values;
		else
			return NULL;
	}
	function recycle() { parent::recycle();
		$this -> cookies = array();
		$this -> headers = array();
	}
	function getStatusMessage($status) {
		switch ($status) { case SC_OK :
				return ("OK");
			case SC_ACCEPTED :
				return ("Accepted");
			case SC_BAD_GATEWAY :
				return ("Bad Gateway");
			case SC_BAD_REQUEST :
				return ("Bad Request");
			case SC_CONFLICT :
				return ("Conflict");
			case SC_CONTINUE :
				return ("Continue");
			case SC_CREATED :
				return ("Created");
			case SC_EXPECTATION_FAILED :
				return ("Expectation Failed");
			case SC_FORBIDDEN :
				return ("Forbidden");
			case SC_GATEWAY_TIMEOUT :
				return ("Gateway Timeout");
			case SC_GONE :
				return ("Gone");
			case SC_HTTP_VERSION_NOT_SUPPORTED :
				return ("HTTP Version Not Supported");
			case SC_INTERNAL_SERVER_ERROR :
				return ("Internal Server Error");
			case SC_LENGTH_REQUIRED :
				return ("Length Required");
			case SC_METHOD_NOT_ALLOWED :
				return ("Method Not Allowed");
			case SC_MOVED_PERMANENTLY :
				return ("Moved Permanently");
			case SC_MOVED_TEMPORARILY :
				return ("Moved Temporarily");
			case SC_MULTIPLE_CHOICES :
				return ("Multiple Choices");
			case SC_NO_CONTENT :
				return ("No Content");
			case SC_NON_AUTHORITATIVE_INFORMATION :
				return ("Non-Authoritative Information");
			case SC_NOT_ACCEPTABLE :
				return ("Not Acceptable");
			case SC_NOT_FOUND :
				return ("Not Found");
			case SC_NOT_IMPLEMENTED :
				return ("Not Implemented");
			case SC_NOT_MODIFIED :
				return ("Not Modified");
			case SC_PARTIAL_CONTENT :
				return ("Partial Content");
			case SC_PAYMENT_REQUIRED :
				return ("Payment Required");
			case SC_PRECONDITION_FAILED :
				return ("Precondition Failed");
			case SC_PROXY_AUTHENTICATION_REQUIRED :
				return ("Proxy Authentication Required");
			case SC_REQUEST_ENTITY_TOO_LARGE :
				return ("Request Entity Too Large");
			case SC_REQUEST_TIMEOUT :
				return ("Request Timeout");
			case SC_REQUEST_URI_TOO_LONG :
				return ("Request URI Too Long");
			case SC_REQUESTED_RANGE_NOT_SATISFIABLE :
				return ("Requested Range Not Satisfiable");
			case SC_RESET_CONTENT :
				return ("Reset Content");
			case SC_SEE_OTHER :
				return ("See Other");
			case SC_SERVICE_UNAVAILABLE :
				return ("Service Unavailable");
			case SC_SWITCHING_PROTOCOLS :
				return ("Switching Protocols");
			case SC_UNAUTHORIZED :
				return ("Unauthorized");
			case SC_UNSUPPORTED_MEDIA_TYPE :
				return ("Unsupported Media Type");
			case SC_USE_PROXY :
				return ("Use Proxy");
			case 207 :
				return ("Multi-Status");
			case 422 :
				return ("Unprocessable Entity");
			case 423 :
				return ("Locked");
			case 507 :
				return ("Insufficient Storage");
			default :
				return ("HTTP Response Status " . $status);
		}
	}
	function sendHeaders() {
		return;
		$this -> committed = True;
	}
	function flushBuffer() {
	}
	function reset($status = '', $message = '') { parent::reset();
		$this -> cookies = array();
		$this -> headers = array();
	}
	function setContentType($type) {
		if ($this -> isCommitted())
			return;
		parent::setContentType($type);
	}
	function setLocale($locale) {
		if ($this -> isCommitted())
			return;
		parent::setLocale($locale);
	}
	function addCookie($cookie) {
		if ($this -> isCommitted())
			return;
		$this -> cookies[] = $cookie;
	}
	function setHeader($name, $value) {
		if ($this -> isCommitted())
			return;
		$values = array();
		$values[] = $value;
		$this -> headers[$name] = $values;
		$match = strtolower($name);
		if ($match == "content-length") { $contentLength = -1;
			$contentLength = (int)$value;
			;
			if ($contentLength >= 0)
				$this -> setContentLength($contentLength);
		} elseif ($match == "content-type") { $this -> setContentType($value);
		}
	}
	function setIntHeader($name, $value) {
		if ($this -> isCommitted())
			return;
		$this -> setHeader($name, "" . $value);
	}

}
?>
