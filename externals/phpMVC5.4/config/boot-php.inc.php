<?php
/*
* Filename        : Boot-php.inc.php
* @package phpMVCconfig
*
*/

require_once "$appDir/WEB-INF/classes/includes/BackwardsCompatibility.php";

date_default_timezone_set('UTC');

// Include the bootup config file
require_once("boot.config.php");
require_once "$appDir/config/load_config.php";
require_once "$appDir/WEB-INF/lib-phpmvc/ExecTimer.php";

$timer = new ExecTimer();

// Timer start
if($timerRun == True) $timer->start();

require_once("$appDir/WEB-INF/lib-phpmvc/PhpMvcOneBase.php");

setupIncludePath($appDir);

// Timer - Base Classes Load Time
if($timerRun == True) $timer->printTime('Base Classes Load Time');

require_once("BaseAction.php");

// Timer - Application Classes Load Time
if($timerRun == True) $this->printTime('Application Classes Load Time');

// Startup configuration information for an php.MVC Web app
$appServerContext	= new AppServerContext;
$appServerConfig	= new AppServerConfig;
$appServerContext->setInitParameter('ACTION_DISPATCHER', 'SmartyActionDispatcher');
$appServerConfig->setAppServerContext($appServerContext);

// Setup the php.MVC Web application controller
$actionServer = new ActionServer;

$appServerRootDir = "$appDir/";

// Load Application Configuration
$bootUtils = new BootUtils;

$configPath = "$appDir/WEB-INF";
$cfgId = 'config';
$cfgValue = array('name'=>'phpmvc-config.xml', 'fc'=> False); // fc == force compile
$oApplicationConfig = $bootUtils->loadAppConfig($actionServer, $appServerConfig,
												$configPath, $cfgId, $cfgValue,
												$appServerRootDir);

if($oApplicationConfig == NULL) {
	throw new Exception('$oApplicationConfig is null');
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

if($timerRun == True) $timer->printTime('Total Run Time');

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ //

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

function debugPrint($var) {
	
	if (!$_ENV['PHPMVC_MODE_CLI'])
		echo "<pre>";

	print_r($var);
	
	if (!$_ENV['PHPMVC_MODE_CLI'])
		echo "</pre>";
}
