<?php
/*
* Filename        : Boot.php
* Build Date      : 24-Feb-2006
* 
*/

// Variable definitions
$mPath					= NULL;	// Application defined class paths
$gPath					= NULL;	// App server defined class paths
$cPath					= NULL;	// All class paths
$moduleRootDir			= NULL;	// Application location. Like: 'C:/WWW/MyApplEx/'
$appServerRootDir		= NULL;	// App server library location. Like: 'D:\Dev\PHP\phpmvc-base'
$contextPath			= NULL;	// The application context path
$modulePath				= NULL;	// The module paths file
$prependFile			= NULL;	// The module prepends file
$modulePaths			= NULL;	// Application defined class paths
$globalPaths			= NULL;	// App server library defined class paths
$globalPrepend			= NULL;	// The framework prepend file. Like: 'GlobalPrependEx.php'
$globalPrependXML		= NULL;	// The XML (Digester) classes)prepend file. 'GlobalPrependXMLEx.php
$localPrependFiles	= NULL;	// Application defined prepend files
$globalPrependFiles	= NULL;	// App server defined prepend files
$appServerContext		= NULL;	// App server context class
$appServerConfig		= NULL;	// App server config class
$actionServer			= NULL;	// App server ActionServer class
$oApplicationConfig	= NULL;	// Application Config class - ApplicationConfig
$bootUtils				= NULL;	// App server boot utilities class
$request					= NULL;	// The HTTP request object
$response				= NULL;	// The HTTP response object
$actionID				= NULL;	// The Action ID [do]. As in "Main.php?do=myPath"
$doPath					= NULL;	// The Action path. As in "Main.php?do=[logonForm]"
$welcomePath			= NULL;	// The default application path
$timerRun				= NULL;	// Timer switch. Boolean 1=on, 0=off
$start					= NULL;	// Timer start time
$end						= NULL;	// Timer end time
$run						= NULL;	// Timer run time
$propelVersion  = NULL; // Version de propel

// Include the bootup config file [WEB-INF\boot.xml]
include 'boot-perform.ini.php';

// Timer start
if($timerRun == True) $start = utime();

// Include the bundled phpmvc library - Always:
include_once 'WEB-INF/lib-phpmvc/'.$globalPrependFiles;

$gPath = ClassPath::setClassPath($moduleRootDir, $modulePaths, $osType);

// Setup the module paths
include $moduleRootDir.$modulePath;
$modulePaths = ModulePaths::getModulePaths();

$mPath = ClassPath::getClassPath($moduleRootDir, $modulePaths, $osType);
$cPath = ClassPath::concatPaths($gPath, $mPath, $osType);

// Set the 'include_path' variables, as used by the file functions
ini_set('include_path', $cPath);
define('CLASSPATH', True);

// Include application specific classes - Always
$localPrependFiles	= $prependFile;

// Include the xml digester classes - On demand:
// If the config data file is out-of-date or we are requesting a Force-Compile
$phpmvcConfigXMLFile	= $appXmlCfgs['config']['name'];					// 'phpmvc-config.xml'
$phpmvcConfigDataFile = substr($phpmvcConfigXMLFile, 0, -3).'data';// 'phpmvc-config.data'
$initXMLConfig = CheckConfigDataFile($configPath, $phpmvcConfigDataFile, $phpmvcConfigXMLFile);

if($initXMLConfig == True OR $appXmlCfgs['config']['fc'] == True ) {
	echo '<br><b>Loading XML Parser ...</b>';
}

// Timer - Base Classes Load Time
if($timerRun == True) printTime($start, 'Base Classes Load Time');

// Now the local application specific classes
include_once $localPrependFiles;

// Timer - Application Classes Load Time
if($timerRun == True) printTime($start, 'Application Classes Load Time');

// Startup configuration information for an php.MVC Web app
$appServerContext	= new AppServerContext;
$appServerConfig	= new AppServerConfig;
$appServerContext->setInitParameter('ACTION_DISPATCHER', $actionDispatcher);
$appServerConfig->setAppServerContext($appServerContext);

// Setup the php.MVC Web application controller
$actionServer = new ActionServer;

$GlobalPrependXML = "PhpMvcOneXML.php.ws";

// Load Application Configuration
$bootUtils = new BootUtils;
if( is_array($appXmlCfgs) && count($appXmlCfgs) > 0 ) {
	foreach($appXmlCfgs as $cfgId => $cfgValue) {
		// config-key => array(config-name, force-compile)
		$oApplicationConfig
			= $bootUtils->loadAppConfig($actionServer, $appServerConfig,
												$configPath, $cfgId, $cfgValue,
												$moduleRootDir);
		break; // Only one config file allowed for now
	}
} else {
	// No application config array - so try a default startup.
	$oApplicationConfig = $bootUtils->loadAppConfig($actionServer, $appServerConfig, $configPath);
}

if($oApplicationConfig == NULL) {
	exit;
}

// Setup HTTP Request and add request attributes
$request = new HttpRequestBase;
$request->setAttribute(Action::getKey('APPLICATION_KEY'), $oApplicationConfig);
$request->setRequestURI($_SERVER['PHP_SELF']);

// Set the application context path:
// Note: $_SERVER was introduced in 4.1.0. In earlier versions, use $HTTP_SERVER_VARS.
$contextPath = substr($_SERVER["SCRIPT_NAME"], 0, strrpos($_SERVER["SCRIPT_NAME"], '/'));
$request->setContextPath($contextPath);

// Note: $_REQUEST was introduced in 4.1.0. There is no equivalent array in earlier versions.
if($_REQUEST != '') {
	// Retrieve the 'action path'. Eg: index.php?do=[logonForm]
	$doPath = BOOTUtils::getActionPath($_REQUEST, $actionID, 2, 64);
} else {
	//	kill !!!
}

// If we have no path query string, try the application default path
if($doPath == NULL) {
	$doPath = $welcomePath;
}

// See: RequestProcessor->processPath(...) !!!
// <action    path = "/stdLogon" ...> => "LogonAction"
// Note: We should catch any dodgy 'do=badHackerFile' path hacks
//       in RequestProcessor->processMapping(...)
$request->setAttribute('ACTION_DO_PATH', $doPath);

// Setup HTTP Response and add request attributes
$response = new HttpResponseBase;


// Start processing the php.MVC Web application
// Note: Usage of depreciated $HTTP_POST_VARS type variables
//       will be eventually replaced with the new PHP Superglobals.
//       Eg: $_GET, $_POST, $_FILES. See: PHP manual- Predefined Variables
// Note: Consider ALL input data as tainted (insecure). All inputs should be
//       checked for correctness and valid character/numeric ranges.
//       Eg: "username "=> "^[a-z0-9]{8}$".

// Detect PHP 4/5 
if((int)phpversion() > 4) {
	// PHP 5
	if( isset($_GET) ) {
		$actionServer->doGet($request, $response, $_GET);
	} elseif( isset($_POST) ) {
		$actionServer->doPost($request, $response, $_POST, $_FILES);
	}
} else {
	// PHP 4
	if( $HTTP_SERVER_VARS['REQUEST_METHOD'] == 'GET' ) {
		$actionServer->doGet($request, $response, $HTTP_GET_VARS);
	} elseif( $HTTP_SERVER_VARS['REQUEST_METHOD'] == 'POST' ) {
		$actionServer->doPost($request, $response, $HTTP_POST_VARS, $HTTP_POST_FILES);
	}
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
	#echo '<br><b>Base Classes Load: </b>'.substr($run, 0, 5) . " secs.";
	echo '<br><b>'.$strMsg.': </b>'.substr($run, 0, 5) . ' secs.';
}

// Check if we need to (re)initialise the application
function CheckConfigDataFile($configPath, $phpmvcConfigDataFile, $phpmvcConfigXMLFile) {

	$initXMLConfig = False;

	if( ! file_exists($configPath.'/'.$phpmvcConfigDataFile) ) {	
		// No config data file
		$initXMLConfig = True;
	} else {
		// Check the config file timestamps
		$cfgDataMTime	= filemtime($configPath.'/'.$phpmvcConfigDataFile);
		$cfgXMLMTime	= filemtime($configPath.'/'.$phpmvcConfigXMLFile);
		if($cfgXMLMTime > $cfgDataMTime) {
			// The 'phpmvc-config.xml' has been modified, so we need to reinitialise
			// the application
			$initXMLConfig = True;
		}
	}

	return $initXMLConfig;
}
