<?php
/*
* Filename        : Boot-php.inc.php
* @package phpMVCconfig
*
*/

date_default_timezone_set('UTC');

// Include the bootup config file
require_once("boot.config.php");

// Timer start
if($timerRun == True) $start = utime();

require_once("$appDir/WEB-INF/lib-phpmvc/PhpMvcOneBase.php");

setupIncludePath($appDir);

// Timer - Base Classes Load Time
if($timerRun == True) printTime($start, 'Base Classes Load Time');

require_once("BaseAction.php");

// Timer - Application Classes Load Time
if($timerRun == True) printTime($start, 'Application Classes Load Time');

// Startup configuration information for an php.MVC Web app
$appServerContext	= new AppServerContext;
$appServerConfig	= new AppServerConfig;
$appServerContext->setInitParameter('ACTION_DISPATCHER', $actionDispatcher);
$appServerConfig->setAppServerContext($appServerContext);

// Setup the php.MVC Web application controller
$actionServer = new ActionServer;

$appServerRootDir = "$appDir/";

// Load Application Configuration
$bootUtils = new BootUtils;

// The application XML configuration data set:
// array[config-key] => array(config-name, force-compile)
// Eg: $appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=>True);
$appXmlCfgs = array();
$appXmlCfgs['config'] = array('name'=>'phpmvc-config.xml', 'fc'=> False);

// Include the xml digester classes - On demand:
// If the config data file is out-of-date or we are requesting a Force-Compile
$phpmvcConfigXMLFile	= $appXmlCfgs['config']['name'];					// 'phpmvc-config.xml'
$phpmvcConfigDataFile= substr($phpmvcConfigXMLFile, 0, -3).'data';// 'phpmvc-config.data'
$initXMLConfig = CheckConfigDataFile("$appDir/" . $configPath, $phpmvcConfigDataFile, $phpmvcConfigXMLFile);
if($initXMLConfig == True OR $appXmlCfgs['config']['fc'] == True ) {
	echo '<br><b>Loading XML Parser ...</b>';
}

if( is_array($appXmlCfgs) && count($appXmlCfgs) > 0 ) {
	foreach($appXmlCfgs as $cfgId => $cfgValue) {
		// config-key => array(config-name, force-compile)
		// $cfgId="config",       $cfgValue=array("phpmvc-config.xml", True)
		// $cfgId="config/admin", $cfgValue=array("phpmvc-config-admin.xml", False)
		// echo "$cfgId = " . $cfgValue['name'] . " - ". $cfgValue['fc'] . " <br>";
		$oApplicationConfig = $bootUtils->loadAppConfig($actionServer, $appServerConfig,
																		"$appDir/" . $configPath, $cfgId, $cfgValue,
																		$appServerRootDir, $globalPrependXML);
		break; // Only one config file allowed for now
	}
}

if($oApplicationConfig == NULL) {
	exit;
}

$request = setupRequest($oApplicationConfig, $welcomePath, $actionID);
$response = new HttpResponseBase;

// Start processing the php.MVC Web application
// Note: Consider ALL input data as tainted (insecure). All inputs should be
//       checked for correctness and valid character/numeric ranges.
//       Eg: "username "=> "^[a-z0-9]{8}$".
if( isset($_GET) ) {
	$actionServer->doGet($request, $response, $_GET);
} elseif( isset($_POST) ) {
	$actionServer->doPost($request, $response, $_POST, $_FILES);
}

if($timerRun == True) printTime($start, 'Total Run Time');

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

// Calculates current microtime
function utime() {
	// microtime() = current UNIX timestamp with microseconds
	$time	= explode( ' ', microtime());
	$usec	= (double)$time[0];
	$sec	= (double)$time[1];
	return $sec + $usec;
}

function printTime($start, $strMsg) {
	$end = utime();
	$run = $end - $start;
	echo '<br><b>'.$strMsg.': </b>'.substr($run, 0, 5) . ' secs.';
}

// Check if we need to (re)initialise the application
function CheckConfigDataFile($configPath, $phpmvcConfigDataFile, $phpmvcConfigXMLFile) {

	$initXMLConfig = False;

	if( ! file_exists("$configPath/" . $phpmvcConfigDataFile) ) {
		// No config data file
		$initXMLConfig = True;
	} else {
		// Check the config file timestamps
		$cfgDataMTime	= filemtime("$configPath/" . $phpmvcConfigDataFile);
		$cfgXMLMTime	= filemtime("$configPath/" . $phpmvcConfigXMLFile);
		if($cfgXMLMTime > $cfgDataMTime) {
			// The 'phpmvc-config.xml' has been modified, so we need to reinitialise
			// the application
			$initXMLConfig = True;
		}
	}

	return $initXMLConfig;
}

function setupIncludePath($appDir) {
	
	require_once("$appDir/WEB-INF/ModulePaths.php");
	$modulePathsString = ModulePaths::getModulePathsString($appDir);
	set_include_path($modulePathsString . PATH_SEPARATOR . get_include_path());
	define('CLASSPATH', True); // TODO: sirve?
}

function setupRequest($oApplicationConfig, $welcomePath, $actionID) {
	
	$request = new HttpRequestBase;
	$request->setAttribute(Action::getKey('APPLICATION_KEY'), $oApplicationConfig);
	$request->setRequestURI($_SERVER['PHP_SELF']);

	// Set the application context path:
	$contextPath = substr($_SERVER["SCRIPT_NAME"], 0, strrpos($_SERVER["SCRIPT_NAME"], '/'));
	$request->setContextPath($contextPath);
	
	// Retrieve the 'action path'. Eg: index.php?do=[logonForm]
	$doPath = BOOTUtils::getActionPath($_REQUEST, $actionID, 2, 64);

	// If we have no path query string, try the application default path
	if($doPath == NULL) {
		$doPath = $welcomePath;
	}

	// See: RequestProcessor->processPath(...) !!!
	// <action    path = "/stdLogon" ...> => "LogonAction"
	// Note: We should catch any dodgy 'do=badHackerFile' path hacks
	//       in RequestProcessor->processMapping(...)
	$request->setAttribute('ACTION_DO_PATH', $doPath);
	
	return $request;
}
