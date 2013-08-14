<?php
class ApplicationConfig {
	var $classID = '';
	var $actionConfigs = array();
	var $dataSources = array();
	var $exceptions = NULL;
	var $formBeans = array();
	var $forwards = NULL;
	var $messageResources = NULL;
	var $plugIns = NULL;
	var $viewResourcesConfig = NULL;
	var $configured = False;
	var $controllerConfig = NULL;
	var $prefix = NULL;
	var $reqProcessor = NULL;
	var $actionServer = NULL;
	var $actionMappingClass = 'ActionMapping';
	function getConfigured() {
		return $this -> configured;
	}
	function & getControllerConfig() {
		if ($this -> controllerConfig == NULL) { $this -> controllerConfig = new ControllerConfig();
		} $controllerConfig = &$this -> controllerConfig;
		return $controllerConfig;
	}
	function setControllerConfig($controllerConfig) {
		if ($this -> getConfigured()) {
			return;
		} $this -> controllerConfig = $controllerConfig;
	}
	function & getViewResourcesConfig() {
		if ($this -> viewResourcesConfig == NULL) { $this -> viewResourcesConfig = new ViewResourcesConfig();
		}
		return $this -> viewResourcesConfig;
	}
	function setViewResourcesConfig(&$viewResourcesConfig) {
		if ($this -> getConfigured()) {
			return "Configuration is frozen";
		} $this -> viewResourcesConfig = &$viewResourcesConfig;
	}
	function getPrefix() {
		return $this -> prefix;
	}
	function getProcessor() {
		if ($this -> reqProcessor == NULL) { $controllerConfig = $this -> getControllerConfig();
			$reqProcessorClass = $controllerConfig -> getProcessorClass();
			$this -> reqProcessor = new $reqProcessorClass;
			$this -> reqProcessor -> init($this -> actionServer, $this);
		}
		return $this -> reqProcessor;
	}
	function getActionServer() {
		return $this -> actionServer;
	}
	function getActionMappingClass() {
		return $this -> actionMappingClass;
	}
	function setActionMappingClass($actionMappingClass) { $this -> actionMappingClass = $actionMappingClass;
	}
	function ApplicationConfig($prefix = NULL, &$actionServer) { $this -> prefix = $prefix;
		$this -> actionServer = &$actionServer;
		$this -> classID = $this -> _getClassID();
	}
	function getAppContext() {;
	}
	function addActionConfig($config) {  $config -> setApplicationConfig($this);
		$path = $config -> getPath();
		$this -> actionConfigs[$path] = $config;
	}
	function addDataSourceConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} $key = $config -> getKey();
		$this -> dataSources[$key] = $config;
	}
	function addExceptionConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} $this -> exceptions -> put($config -> getType(), $config);
	}
	function addFormBeanConfig($config) {
		if ($this -> getConfigured()) {
			return "Configuration is frozen";
		} $this -> formBeans[$config -> getName()] = $config;
	}
	function addForwardConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} $this -> forwards -> put($config -> getName(), $config);
	}
	function addMessageResourcesConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} $this -> messageResources -> put($config -> getKey(), $config);
	}
	function addPlugIn($plugIn) {
		if ($this -> getConfigured()) {
			return;
		} $this -> plugIns[] = $plugIn;
	}
	function findActionConfig($path) {
		if ($this -> actionConfigs == NULL) {
			return NULL;
		} $actionConfig = NULL;
		if (array_key_exists($path, $this -> actionConfigs)) { $actionConfig = $this -> actionConfigs[$path];
		}
		return $actionConfig;
	}
	function & findActionConfigs() {
		if ($this -> actionConfigs == NULL) { $ret = NULL;
			return $ret;
		} $actionConfigs = array();
		$actionConfigs = &$this -> actionConfigs;
		return $actionConfigs;
	}
	function findDataSourceConfig($key) {
		if ($this -> dataSources == NULL) {
			return NULL;
		}
		return $this -> dataSources[$key];
	}
	function & findDataSourceConfigs() {
		if ($this -> dataSources == NULL) { $ret = NULL;
			return $ret;
		} $dataSources = array();
		$dataSources = &$this -> dataSources;
		return $dataSources;
	}
	function findExceptionConfig($type) {
		if ($this -> exceptions == NULL) {
			return NULL;
		}
		return $this -> exceptions -> get($type);
	}
	function findExceptionConfigs() {
		if ($this -> exceptions == NULL) {
			return NULL;
		} $results = $this -> exceptions -> values();
		return $results;
	}
	function findFormBeanConfig($name) {
		if ($this -> formBeans == NULL || $name == NULL) {
			return NULL;
		}
		if (array_key_exists($name, $this -> formBeans)) {
			return $this -> formBeans[$name];
		} else {
			return NULL;
		}
	}
	function & findFormBeanConfigs() {
		if ($this -> formBeans == NULL) { $ret = NULL;
			return $ret;
		} $formBeans = array();
		$formBeans = &$this -> formBeans;
		return $formBeans;
	}
	function findForwardConfig($name) {
		if ($this -> forwards == NULL) {
			return NULL;
		}
		return $this -> forwards -> get($name);
	}
	function & findForwardConfigs() {
		if ($this -> forwards == NULL) { $ret = NULL;
			return $ret;
		} $forwards = array();
		$forwards = &$this -> forwards;
		return $forwards;
	}
	function findMessageResourcesConfig($key) {
		if ($this -> messageResources == NULL) {
			return NULL;
		}
		return $this -> messageResources -> get($key);
	}
	function & findMessageResourcesConfigs() {
		if ($this -> messageResources == NULL) { $ret = NULL;
			return $ret;
		} $messageResources = array();
		$messageResources = &$this -> messageResources;
		return $messageResources;
	}
	function findPlugIns() {
		if ($this -> plugIns == NULL) {
			return NULL;
		}
		return $this -> plugIns;
	}
	function freeze() { $this -> configured = True;
		$aconfigs = array();
		$aconfigs = &$this -> findActionConfigs();
		if ($aconfigs != NULL) {
			foreach ($aconfigs as $key => $val) { $aconfigs[$key] -> freeze();
			}
		} $controllerConfig = &$this -> getControllerConfig();
		if ($controllerConfig != NULL) { $controllerConfig -> freeze();
		} $dsconfigs = array();
		$dsconfigs = &$this -> findDataSourceConfigs();
		if ($dsconfigs != NULL) {
			foreach ($dsconfigs as $key => $val) { $dsconfigs[$key] -> freeze();
			}
		} $econfigs = array();
		$econfigs = $this -> findExceptionConfigs();
		if ($econfigs != NULL) {
			foreach ($econfigs as $econfig) { $econfig -> freeze();
			}
		} $fbconfigs = array();
		$fbconfigs = &$this -> findFormBeanConfigs();
		if ($fbconfigs != NULL) {
			foreach ($fbconfigs as $key => $val) { $fbconfigs[$key] -> freeze();
			}
		} $fconfigs = array();
		$fconfigs = &$this -> findForwardConfigs();
		if ($fconfigs != NULL) {
			foreach ($fconfigs as $key => $val) { $fconfigs[$key] -> freeze();
			}
		} $mrconfigs = array();
		$mrconfigs = &$this -> findMessageResourcesConfigs();
		if ($mrconfigs != NULL) {
			foreach ($mrconfigs as $key => $val) { $mrconfigs[$key] -> freeze();
			}
		} $viewResourceConfig = &$this -> getViewResourcesConfig();
		if ($viewResourceConfig != NULL) { $viewResourceConfig -> freeze();
		}
	}
	function removeActionConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} $config -> setApplicationConfig(NULL);
		HelperUtils::zapArrayElement($config -> getPath(), $this -> actionConfigs);
	}
	function removeExceptionConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} HelperUtils::zapArrayElement($config -> getType(), $this -> exceptions);
	}
	function removeDataSourceConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} HelperUtils::zapArrayElement($config -> getKey(), $this -> dataSources);
	}
	function removeFormBeanConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} HelperUtils::zapArrayElement($config -> getName(), $this -> formBeans);
	}
	function removeForwardConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} HelperUtils::zapArrayElement($config -> getName(), $this -> forwards);
	}
	function removeMessageResourcesConfig($config) {
		if ($this -> getConfigured()) {
			return;
		} HelperUtils::zapArrayElement($config -> getKey(), $this -> messageResources);
	}
	function _getClassID() { $className = 'ApplicationConfig';
		$fileName = 'ApplicationConfig.php';
		$versionID = '20040811-1100';
		return "$className:$fileName:$versionID";
	}
	function getClassID() {
		return $this -> classID;
	}

}
?>
