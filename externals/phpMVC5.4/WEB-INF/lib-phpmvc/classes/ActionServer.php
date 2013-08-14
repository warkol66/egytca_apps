<?php
class ActionServer extends HttpAppServer {
	var $configPath = './WEB-INF/phpmvc-config.xml';
	var $digester = NULL;
	var $parserCaseFolding = False;
	var $dataSources = array();
	var $debug = 0;
	var $detail = 0;
	var $internalRes = NULL;
	var $internalResName = 'ActionResources';
	var $log = NULL;
	var $processor = NULL;
	var $validating = False;
	var $appServerConfig = NULL;
	var $plugIns = array();
	function setConfigPath($configPath) { $this -> configPath = $configPath;
	}
	function ActionServer() { $this -> log = new PhpMVC_Log();
		$this -> log -> setLog('isDebugEnabled', False);
		$this -> log -> setLog('isTraceEnabled', False);
	}
	function destroy() { $debug = $this -> log -> getLog('isDebugEnabled');
		if ($debug) { $this -> log -> debug(" Finalising ...");
		} $this -> destroyApplications();
		$this -> destroyDataSources();
		$appContext = AppServer::getAppserverContext();
		$appContext -> removeAttribute(Action::getKey('ACTION_SERVER_KEY'));
	}
	function init(&$appServerConfig) { $this -> appServerConfig = $appServerConfig;
		$this -> initInternal();
		$this -> initOther();
		$this -> initServlet();
		$applConfig = $this -> initApplicationConfig('', $this -> configPath);
		$this -> initApplicationMessageResources($applConfig);
		/* $this->initApplicationDataSources($applConfig); */$this -> initApplicationPlugIns($applConfig);
		$this -> destroyConfigDigester();
		return $applConfig;
	}
	function doGet(&$request, &$response, $GET = '') {
		if ($GET == '') { $GET = $_GET;
		} $request -> setMethod('GET');
		$this -> doPost($request, $response, '', '', $GET);
	}
	function doPost(&$request, &$response, $POST = '', $FILES = '', $GET = '') {
		if ($POST == '') { $POST = $_POST;
		}
		if ($FILES == '') { $FILES = $_FILES;
		}
		if ($GET == '') { $GET = $_GET;
		} $request -> setMethod('POST');
		$request -> setPostVars($POST);
		$request -> setFilesVars($FILES);
		$request -> setGetVars($GET);
		$this -> process($request, $response);
	}
	function getDebug() {
		return $this -> debug;
	}
	function getInternalRes() {
		return ($this -> internalRes);
	}
	function log($message, $level) {
		if ($this -> debug >= $level) { $this -> log($message);
		}
	}
	function & getDataSource($dataSourceKey) {
		if (array_key_exists($dataSourceKey, $this -> dataSources)) { $db = &$this -> dataSources[$dataSourceKey];
			$db -> open();
			return $db;
		} else { $debug = $this -> log -> getLog('isDebugEnabled');
			if ($debug) { $this -> log -> debug('No datasource found: ActionServer->getDataSource(...)' . '[' . __LINE__ . ']');
			} $ret = NULL;
			return $ret;
		}
	}
	function & getPlugIn($plugInKey) { $config = NULL;
		if (array_key_exists($plugInKey, $this -> plugIns)) { $plugIn = &$this -> plugIns[$plugInKey];
			$plugIn -> init($config);
			return $plugIn -> plugIn;
		} else { $debug = $this -> log -> getLog('isDebugEnabled');
			if ($debug) { $this -> log -> debug('No plugin found: ActionServer->getPlugIn(' . $plugInKey . ')' . '[' . __LINE__ . ']');
			} $ret = NULL;
			return $ret;
		}
	}
	function destroyApplications() {
		return NULL;
	}
	function destroyConfigDigester() { $this -> digester = NULL;
	}
	function destroyInternal() { $this -> internalRes = NULL;
	}
	function getApplicationConfig($request) { $appConfig = $request -> getAttribute(Action::getKey('APPLICATION_KEY'));
		if ($appConfig == NULL) { $appContext = $this -> appServerConfig -> getAppServerContext();
			$appConfig = $appContext -> getAttribute(Action::getKey('APPLICATION_KEY'));
		}
		return $appConfig;
	}
	function initApplicationConfig($prefix = NULL, $configPath) { $debug = $this -> log -> getLog('isDebugEnabled');
		if ($debug) { $this -> log -> debug("Initializing application path '" . $prefix . "' configuration from '" . $configPath . "'");
		} $applConfig = NULL;
		$mapping = NULL;
		$applConfig = new ApplicationConfig($prefix, $this);
		$mapping = $this -> appServerConfig -> getInitParameter('mapping');
		if ($mapping != NULL) { $applConfig -> setActionMappingClass($mapping);
		} $this -> initConfigDigester();
		$this -> digester -> push($applConfig);
		$applConfig = $this -> digester -> parse($configPath);
		$appContext = $this -> appServerConfig -> getAppServerContext();
		$appContext -> setAttribute(Action::getKey('APPLICATION_KEY') . $prefix, $applConfig);
		$applConfig -> freeze();
		return $applConfig;
	}
	function initApplicationDataSources($config) { $debug = $this -> log -> getLog('isDebugEnabled');
		$trace = $this -> log -> getLog('isTraceEnabled');
		if ($trace) { $this -> log -> trace('Start: ActionServer->initApplicationDataSources(...)' . '[' . __LINE__ . ']');
		}
		if ($debug) { $this -> log -> debug(" ActionServer->initApplicationDataSources()[" . __LINE__ . "]: Initializing application path: '" . $config -> getPrefix() . "' data sources.");
		} $dataSources = array();
		$dataSources = $config -> findDataSourceConfigs();
		if ($dataSources == NULL) { $dataSources[0] = new DataSourceConfig;
		}
		foreach ($dataSources as $dataSource) { $error = NULL;
			if ($debug) { $this -> log -> debug("  ActionServer->initApplicationDataSources()[" . __LINE__ . "]: Initializing application path: '" . $config -> getPrefix() . "' DataSourceConfig: '" . get_class($dataSource) . "'");
			} $oDataSource = NULL;
			$dataSourceType = $dataSource -> getType();
			$oDataSource = new $dataSourceType;
			$beanUtils = new PhpBeanUtils;
			$beanUtils -> populate($oDataSource, $dataSource -> getProperties());
			if ($error) { $msg = $this -> internalRes -> getMessage("dataSource->init", $dataSource -> getKey());
				$this -> log -> error($msg, $error);
			} $appContext = $this -> appServerConfig -> getAppserverContext();
			$appContext -> setAttribute($dataSource -> getKey(), $oDataSource);
			$this -> dataSources[$dataSource -> getKey()] = $oDataSource;
		}
	}
	function initApplicationPlugIns($config) { $debug = $this -> log -> getLog('isDebugEnabled');
		if ($debug) { $this -> log -> debug("Initializing application path '" . $config -> getPrefix() . "' plug ins");
		} $plugIns = array();
		$plugIns = $config -> findPlugIns();
		if ($plugIns == NULL) {
			return 'No PlugIns loaded';
		}
		foreach ($plugIns as $idx => $plugIn) { $keyStr = $plugIn -> getKey();
			$this -> plugIns[$keyStr] = &$plugIns[$idx];
		}
	}
	function initApplicationMessageResources($config) { $error = NULL;
		$msgResrs = array();
		$msgResrs = $config -> findMessageResourcesConfigs();
		if ($msgResrs == NULL) {
			return 'No MessageResourcesConfigs found.';
		}
		foreach ($msgResrs as $msgRes) {
			if (($msgRes -> getFactory() == NULL) || ($msgRes -> getParameter() == NULL)) {
				continue;
			} $debug = $this -> log -> getLog('isDebugEnabled');
			if ($debug) { $this -> log -> debug("Initializing application path '" . $config -> getPrefix() . "' message resources from '" . $msgRes -> getParameter() . "'");
			} $factory = $msgRes -> getFactory();
			MessageResourcesFactory::setFactoryClass($factory);
			$factoryObject = MessageResourcesFactory::createFactory();
			$resources = $factoryObject -> createResources($msgRes -> getParameter());
			$resources -> setReturnNull($msgRes -> getNull());
			$appContext = AppServer::getAppserverContext();
			$appContext -> setAttribute($msgRes -> getKey() . $config -> getPrefix(), $resources);
			if ($error) { $msg = $this -> internalRes -> getMessage("applicationResources", $msgRes -> getParameter());
				$this -> log -> error($msg, $error);
			}
		}
	}
	function initConfigDigester() {
		if ($this -> digester != NULL) {
			return $this -> digester;
		} $digester = new Digester();
		$digester -> setValidating($this -> validating);
		$digester -> parserSetOption(XML_OPTION_CASE_FOLDING, $this -> parserCaseFolding);
		$digester -> addRuleSet(new ConfigRuleSet());
		$this -> digester = $digester;
	}
	function initInternal() { $error = NULL;
		return;
		$error = 'in ActionServer->initInternal()';
		if ($this -> internalRes == NULL) { $this -> log -> error("Cannot load internal resources from '" . $this -> internalResName . "'", $error);
		}
	}
	function initOther() { $error = NULL;
		$value = NULL;
	}
	function initServlet() {
	}
	function process($request, $response) { $appContext = $this -> appServerConfig -> getAppServerContext();
		$reqUtils = new RequestUtils;
		$reqUtils -> selectApplication($request, $appContext);
		$appConfig = $this -> getApplicationConfig($request);
		$requestProcessor = $appConfig -> getProcessor();
		$requestProcessor -> process($request, $response);
	}

}
?>
