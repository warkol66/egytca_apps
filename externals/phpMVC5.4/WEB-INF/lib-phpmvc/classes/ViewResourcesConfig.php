<?php
class ViewResourcesConfig {
	var $configured = False;
	var $appTitle = 'My Web Application';
	var $appVersion = '1.0';
	var $copyright = 'Copyright � YYYY My Name. All rights reserved.';
	var $contactInfo = 'webmaster@myhost.com';
	var $processTags = False;
	var $compileAll = False;
	var $tagL = '<@';
	var $tagR = '@>';
	var $tplDir = './WEB-INF/tpl';
	var $tplDirC = './WEB-INF/tpl_C';
	var $extC = 'C';
	var $maxFileLength = 250000;
	var $tagFlagStr = '.ssp';
	var $tagFlagCnt = -4;
	function setAppTitle($appTitle) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> appTitle = $appTitle;
	}
	function getAppTitle() {
		return $this -> appTitle;
	}
	function setAppVersion($appVersion) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> applVersion = $appVersion;
	}
	function getAppVersion() {
		return $this -> appVersion;
	}
	function setCopyright($copyright) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> copyright = $copyright;
	}
	function getCopyright() {
		return $this -> copyright;
	}
	function setContactInfo($contactInfo) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> contactInfo = $contactInfo;
	}
	function getContactInfo() {
		return $this -> contactInfo;
	}
	function setProcessTags($process) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> processTags = $process;
	}
	function getProcessTags() {
		return $this -> processTags;
	}
	function setCompileAll($compileAll) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> compileAll = $compileAll;
	}
	function getCompileAll() {
		return $this -> compileAll;
	}
	function setTagLeft($tagL) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> tagL = $tagL;
	}
	function getTagLeft() {
		return $this -> tagL;
	}
	function setTagRight($tagR) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> tagL = $tagR;
	}
	function getTagRight() {
		return $this -> tagR;
	}
	function setTplDir($tplDir) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> tplDir = $tplDir;
	}
	function getTplDir() {
		return $this -> tplDir;
	}
	function setTplDirC($tplDirC) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> tplDir = $tplDirC;
	}
	function getTplDirC() {
		return $this -> tplDirC;
	}
	function setComplieExtChar($extC) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> extC = $extC;
	}
	function getComplieExtChar() {
		return $this -> extC;
	}
	function setMaxFileLength($maxFileLength) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> maxFileLength = $maxFileLength;
	}
	function getMaxFileLength() {
		return $this -> maxFileLength;
	}
	function setTagFlagStr($tagFlagStr) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> tagFlagStr = $tagFlagStr;
	}
	function getTagFlagStr() {
		return $this -> tagFlagStr;
	}
	function setTagFlagCnt($tagFlagCnt) {
		if ($this -> configured) {
			return "Configuration is frozen";
		} $this -> tagFlagCnt = $tagFlagCnt;
	}
	function getTagFlagCnt() {
		return $this -> tagFlagCnt;
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
	function toString() { $sb = 'ViewResourcesConfig[';
		$sb .= 'configured=';
		($this -> configured == True) ? $sb .= "True" : $sb .= "False";
		$sb .= ', appTitle=';
		$sb .= $this -> appTitle;
		$sb .= ', appVersion=';
		$sb .= $this -> appVersion;
		$sb .= ', copyright=';
		$sb .= $this -> copyright;
		$sb .= ', contactInfo=';
		$sb .= $this -> contactInfo;
		$sb .= ', processTags=';
		($this -> processTags == True) ? $sb .= "True" : $sb .= "False";
		$sb .= ', compileAll=';
		($this -> compileAll == True) ? $sb .= "True" : $sb .= "False";
		$sb .= ', tagL=';
		$sb .= $this -> tagL;
		$sb .= ', tagR=';
		$sb .= $this -> tagR;
		$sb .= ', tplDir=';
		$sb .= $this -> tplDir;
		$sb .= ', tplDirC	=';
		$sb .= $this -> tplDirC;
		$sb .= ', extC=';
		$sb .= $this -> extC;
		$sb .= ', maxFileLength=';
		$sb .= $this -> maxFileLength;
		$sb .= ', tagFlagStr=';
		$sb .= $this -> tagFlagStr;
		$sb .= ', tagFlagCnt=';
		$sb .= $this -> tagFlagCnt;
		$sb .= ']';
		return $sb;
	}
	function getClassID() { $className = 'ViewResourcesConfig';
		$fileName = 'ViewResources.php';
		$versionID = '20040811-1200';
		return "$className:$fileName:$versionID";
	}

}
?>
