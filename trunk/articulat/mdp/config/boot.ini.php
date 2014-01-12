<?php
/*
* Filename        : WEB-INF/boot.ini
* @package phpMVCconfig
*/

// Timer reporting. 1=on, 0=off
$timerRun = 0;

// The application XML configuration data set:
// array[config-key] => array(config-name, force-compile)
// Eg: $appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=>True);
// TO-DO Multi config files
$appXmlCfgs = array();
//$appXmlCfgs['config/admin']	= array('name'=>'phpmvc-config-admin.xml', 'fc'=>False);
//$appXmlCfgs['config/sales']	= array('name'=>'phpmvc-config-sales.xml', 'fc'=>True);
$appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=>False);

require_once("$appDir/config/generate_config.php");
require_once("$appDir/config/load_config.php");

// En archivo config.php
// Set php.MVC library root directory (no trailing slash).
//$appServerRootDir = 'D:\Lib\php\phpmvc';

// Set the framework prepend file and XML (Digester) prepend file to use.
#$globalPrepend		= 'globalPrepend.php';				// <<< DEPRECIATED
$globalPrepend			= 'GlobalPrependEx.php';			// <<< NEW
#$globalPrepend		= 'GlobalPrependEx_Perform.php';	// <<< PERFORMANCE
$globalPrependXML		= 'GlobalPrependXMLEx.php';		// XML (Digester) prepend file

// Set the application path (no trailing slash).
$moduleRootDir = $appDir.'/'; 

// Setup the application specific ActionDispatcher (RequestDispatcher)
require_once("$moduleRootDir/WEB-INF/classes/SmartyActionDispatcher.php");
$actionDispatcher = 'SmartyActionDispatcher';

// Relative path to the phpmvc configuration files
$configPath = 'WEB-INF'; // ['./WEB-INF'] no trailing slash

// Setup the module paths
$modulePath = 'WEB-INF/ModulePaths.php';

// Include application specific classes
$prependFile = 'WEB-INF/Prepend.php';

// Action ID [do]
$actionID = 'do';
