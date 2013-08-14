<?php
class ActionConfig {
	var $configured = False;
	var $exceptions = array();
	var $forwards = array();
	var $applicationConfig = NULL;
	var $attribute = NULL;
	var $forward = NULL;
	var $include = NULL;
	var $input = NULL;
	var $multipartClass = NULL;
	var $name = NULL;
	var $parameter = NULL;
	var $path = NULL;
	var $prefix = NULL;
	var $roles = NULL;
	var $roleNames = '';
	var $scope = "session";
	var $suffix = NULL;
	var $type = NULL;
	var $unknown = False;
	var $validate = True;
	function getApplicationConfig() {
		return $this -> applicationConfig;
	}
	function setApplicationConfig(&$applicationConfig) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> applicationConfig = &$applicationConfig;
	}
	function getAttribute() {
		if ($this -> attribute == NULL) {
			return $this -> name;
		} else {
			return $this -> attribute;
		}
	}
	function setAttribute($attribute) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> attribute = $attribute;
	}
	function getForward() {
		return $this -> forward;
	}
	function setForward($forward) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> forward = $forward;
	}
	function getInclude() {
		return $this -> include;
	}
	function setInclude($include) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> include = $include;
	}
	function getInput() {
		return $this -> input;
	}
	function setInput($input) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> input = $input;
	}
	function getMultipartClass() {
		return $this -> multipartClass;
	}
	function setMultipartClass($multipartClass) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> multipartClass = $multipartClass;
	}
	function getName() {
		return $this -> name;
	}
	function setName($name) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> name = $name;
	}
	function getParameter() {
		return $this -> parameter;
	}
	function setParameter($parameter) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> parameter = $parameter;
	}
	function getPath() {
		return $this -> path;
	}
	function setPath($path) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> path = $path;
	}
	function getPrefix() {
		return $this -> prefix;
	}
	function setPrefix($prefix) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> prefix = $prefix;
	}
	function getRoles() {
		return $this -> roles;
	}
	function setRoles($roles) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> roles = $roles;
		if ($this -> roles == NULL) { $this -> roleNames = '';
			return;
		} $list = array();
		while (True) { $comma = strpos($roles, ',');
			if ($comma === False) {
				break;
			} $list[] = trim(substr($roles, 0, $comma));
			$roles = substr($roles, $comma + 1);
		} $roles = trim($roles);
		if (strlen($roles) > 0) { $list[] = $roles;
		} $this -> roleNames = $list;
	}
	function getRoleNames() {
		return $this -> roleNames;
	}
	function getScope() {
		return $this -> scope;
	}
	function setScope($scope) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> scope = $scope;
	}
	function getSuffix() {
		return $this -> suffix;
	}
	function setSuffix($suffix) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> suffix = $suffix;
	}
	function getType() {
		return $this -> type;
	}
	function setType($type) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> type = $type;
	}
	function getUnknown() {
		return $this -> unknown;
	}
	function setUnknown($unknown) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> unknown = $unknown;
	}
	function getValidate() {
		return $this -> validate;
	}
	function setValidate($validate) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> validate = $validate;
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
	function addExceptionConfig($config) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $this -> exceptions[$config -> getType()] = $config;
	}
	function addForwardConfig($config) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} $key = $config -> getName();
		$this -> forwards[$key] = $config;
	}
	function findExceptionConfig($type) {
		return $this -> exceptions[$type];
	}
	function findExceptionConfigs() {
	}
	function findForwardConfig($name) {
		return $this -> forwards[$name];
	}
	function & findForwardConfigs() { $forwards = array();
		$forwards = &$this -> forwards;
		return $forwards;
	}
	function freeze() { $this -> configured = True;
		$econfigs = $this -> findExceptionConfigs();
		if ($econfigs != NULL) {
			foreach ($econfigs as $econfig) { $econfig -> freeze();
			}
		} $fconfigs = &$this -> findForwardConfigs();
		if ($fconfigs != NULL) {
			foreach ($fconfigs as $key => $val) { $fconfigs[$key] -> freeze();
			}
		}
	}
	function removeExceptionConfig($config) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} HelperUtils::zapArrayElement($config -> getType(), $this -> exceptions);
	}
	function removeForwardConfig($config) {
		if ($this -> configured) {
			return 'Configuration is frozen';
		} HelperUtils::zapArrayElement($config -> getName(), $this -> forwards);
	}
	function toString() { $strBuff = 'ActionConfig[';
		$strBuff .= 'path=';
		$strBuff .= $this -> path;
		if ($this -> attribute != NULL) { $strBuff .= ',attribute=';
			$strBuff .= $this -> attribute;
		}
		if ($this -> forward != NULL) { $strBuff .= ',forward=';
			$strBuff .= $this -> forward;
		}
		if ($this -> include != NULL) { $strBuff .= ',include=';
			$strBuff .= $this -> include;
		}
		if ($this -> input != NULL) { $strBuff .= ',input=';
			$strBuff .= $this -> input;
		}
		if ($this -> multipartClass != NULL) { $strBuff .= ',multipartClass=';
			$strBuff .= $this -> multipartClass;
		}
		if ($this -> name != NULL) { $strBuff .= ',name=';
			$strBuff .= $this -> name;
		}
		if ($this -> parameter != NULL) { $strBuff .= ',parameter=';
			$strBuff .= $this -> parameter;
		}
		if ($this -> prefix != NULL) { $strBuff .= ',prefix=';
			$strBuff .= $this -> prefix;
		}
		if ($this -> roles != NULL) { $strBuff .= ',roles=';
			$strBuff .= $this -> roles;
		}
		if ($this -> scope != NULL) { $strBuff .= ',scope=';
			$strBuff .= $this -> scope;
		}
		if ($this -> suffix != NULL) { $strBuff .= ',suffix=';
			$strBuff .= $this -> suffix;
		}
		if ($this -> type != NULL) { $strBuff .= ',type=';
			$strBuff .= $this -> type;
		}
		return $strBuff;
	}
	function getClassID() { $className = 'ActionConfig';
		$fileName = 'ActionConfig.php';
		$versionID = '20040528-1130';
		return "$className:$fileName:$versionID";
	}

}
?>
