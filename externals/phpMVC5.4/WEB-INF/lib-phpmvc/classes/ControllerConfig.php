<?php
class ControllerConfig {
	var $configured = False;
	var $bufferSize = 4096;
	var $contentType = 'text/html';
	var $debug = 0;
	var $locale = False;
	var $maxFileSize = '2M';
	var $multipartClass = 'DiskMultipartRequestHandler';
	var $nocache = False;
	var $processorClass = 'RequestProcessor';
	var $tempDir = NULL;
	function getBufferSize() {
		return $this -> bufferSize;
	}
	function setBufferSize($bufferSize) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> bufferSize = $bufferSize;
	}
	function getContentType() {
		return $this -> contentType;
	}
	function setContentType($contentType) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> contentType = $contentType;
	}
	function getDebug() {
		return ($this -> debug);
	}
	function setDebug($debug) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> debug = $debug;
	}
	function getLocale() {
		return $this -> locale;
	}
	function setLocale($locale) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> locale = $locale;
	}
	function getMaxFileSize() {
		return $this -> maxFileSize;
	}
	function setMaxFileSize($maxFileSize) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> maxFileSize = $maxFileSize;
	}
	function getMultipartClass() {
		return $this -> multipartClass;
	}
	function setMultipartClass($multipartClass) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> multipartClass = $multipartClass;
	}
	function getNocache() {
		return $this -> nocache;
	}
	function setNocache($nocache) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> nocache = $nocache;
	}
	function getProcessorClass() {
		return $this -> processorClass;
	}
	function setProcessorClass($processorClass) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> processorClass = $processorClass;
	}
	function getTempDir() {
		return $this -> tempDir;
	}
	function setTempDir($tempDir) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> tempDir = $tempDir;
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
	function freeze() { $this -> configured = True;
	}
	function toString() { $strBuff = 'ControllerConfig[';
		$strBuff .= 'bufferSize=';
		$strBuff .= $this -> bufferSize;
		if ($this -> contentType != NULL) { $strBuff .= ',contentType=';
			$strBuff .= $this -> contentType;
		} $strBuff .= ',locale=';
		$strBuff .= $this -> locale;
		if ($this -> maxFileSize != NULL) { $strBuff .= ',maxFileSzie=';
			$strBuff .= $this -> maxFileSize;
		} $strBuff .= ',nocache=';
		$strBuff .= $this -> nocache;
		$strBuff .= ',processorClass=';
		$strBuff .= $this -> processorClass;
		if ($this -> tempDir != NULL) { $strBuff .= ',tempDir=';
			$strBuff .= $this -> tempDir;
		} $strBuff .= ']';
		return $strBuff;
	}
	function getClassID() { $className = 'ControllerConfig';
		$fileName = 'ControllerConfig.php';
		$versionID = '20021025-0955';
		return "$className:$fileName:$versionID";
	}

}
?>
