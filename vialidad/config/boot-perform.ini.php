<?php
/*
* Filename        : WEB-INF/boot.ini.php
* @package phpMVCconfig
*
*/

// Timer reporting. 1=on, 0=off
$timerRun = 0;

// The application XML configuration data set:
// array[config-key] => array(config-name, force-compile)
// Eg: $appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=>True);
$appXmlCfgs = array();
$appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=>False);

require_once("$appDir/config/generate_config.php");
require_once("$appDir/config/load_config.php");

// Set the application path (no trailing slash).
$moduleRootDir = $appDir.'/'; 

// Note: If 'PHPMVC_PERFORM' is defined, then the app server is bundled
if( defined('PHPMVC_PERFORM') ) {
	$globalPrependXML		= 'PhpMvcOneXML.php.ws';	
	$globalPrependFiles	= 'PhpMvcOneBase.php.ws';
} 
else {
	$globalPrepend			= 'GlobalPrependEx.php';			// <<< NEW
	$globalPrependXML		= 'GlobalPrependXMLEx.php';		// XML (Digester) prepend file
	require_once("$moduleRootDir/WEB-INF/classes/SmartyActionDispatcher.php");
}


// Setup the application specific ActionDispatcher (RequestDispatcher)
$actionDispatcher = 'SmartyActionDispatcher';

// Relative path to the phpmvc configuration files
$configPath = 'WEB-INF';											// ['./WEB-INF'] no trailing slash

// Setup the module paths
$modulePath = 'WEB-INF/ModulePaths.php';

// Include application specific classes
$prependFile = 'WEB-INF/Prepend.php';

// Action ID [do]
$actionID = 'do';

