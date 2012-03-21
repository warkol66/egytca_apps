<?php
/*
* Filename        : boot.config.php
* @package phpMVCconfig
*
*/

// Config
//====================================================================
// Set error reporting level.
error_reporting(E_ALL -E_NOTICE -E_WARNING);
ini_set('display_errors',1);

// Comment out this define to use the regular (external) phpmvc library
define('PHPMVC_PERFORM', "1");

//Directorio donde se encuentra phpmvc
//Se necesita en caso que no este definido PHPMVC_PERFORM!!!!!
$appServerRootDir	= "/apache/htdocs2/phpMVC5.3";

//Directorio donde se encuentra la aplicacion (sin barra al final)
//!!!! Deprecado, usar $appDir!!!! Se eliminara al reemplazar en uso actual
$moduleRootDir = substr(dirname(__FILE__), 0, -6);

//Sistema operativo [UNIX|WINDOWS|MAC]
$osType = PHP_OS;

//Propel Version
$propelConfig = include("application-conf.php");
$propelVersion = $propelConfig["generator_version"];

//Smarty Version
$smartyVersion = "smarty";

//Codigo del idioma por defecto (ej: es_ES.UTF-8);
$useLocale = "es_ES.UTF-8";

//Welcome path
$welcomePath = "usersWelcome";

//Login path
$loginPath = "usersLogin";

//Codigo del idioma actual
$mluse = "";

//Cantidad de licencias de usuarios
$licenses = "";

// Action ID [do]
$actionID = 'do';

// Timer reporting. 1=on, 0=off
$timerRun = 0;

//====================================================================

require_once("$appDir/config/load_config.php");

// The application XML configuration data set:
// array[config-key] => array(config-name, force-compile)
// Eg: $appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=>True);
$appXmlCfgs = array();
$appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=> False);

// Note: If 'PHPMVC_PERFORM' is defined, then the app server is bundled
if( defined('PHPMVC_PERFORM') ) {
//	$globalPrependXML		= 'PhpMvcOneXML.php.ws';	
	$globalPrependFiles	= 'PhpMvcOneBase.php.ws';
} 
else {
	$globalPrepend			= 'GlobalPrependEx.php';			// <<< NEW
//	$globalPrependXML		= 'GlobalPrependXMLEx.php';		// XML (Digester) prepend file
}

// Setup the application specific ActionDispatcher (RequestDispatcher)
$actionDispatcher = 'SmartyActionDispatcher';

// Relative path to the phpmvc configuration files
$configPath = 'WEB-INF'; // ['./WEB-INF'] no trailing slash

// Setup the module paths
$modulePath = 'WEB-INF/ModulePaths.php';

// Include application specific classes
$prependFile = 'WEB-INF/Prepend.php';
