<?php
/*
* Filename        : Boot-php.inc.php
* @package phpMVCconfig
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

// Verifico existencia del bootup config file, si no existe, lo creo a partir del template
if (!file_exists("$appDir/config/boot.config.php")) {
	$configBase = "$appDir/config/boot.config.ini.php";
	$config = "$appDir/config/boot.config.php";
	header("Content-type: text/html; charset=utf-8;");
	if (copy($configBase, $config))
		echo "<p style='color:green'>Archivo de configuracion 'boot.config.php' creado! Editelo con su configuracion.</p>";
	else
		echo "<p style='color:red'>No se encuentra el archivo de configuracion 'boot.config.php' y fue imposible crearlo!</p>";
	die();
}

// Include the bootup config file
require_once("boot.config.php");

// Timer start
if($timerRun == True) $start = utime();

// Setup the module paths
require_once("$appDir/" . $modulePath);
$modulePaths = ModulePaths::getModulePaths();

if(defined('PHPMVC_PERFORM')) {
	// Include the bundled phpmvc library
	require_once("$appDir/WEB-INF/lib-phpmvc/" . $globalPrependFiles);
	$gPath = ClassPath::setClassPath("$appDir/", $modulePaths, $osType);	
	$propelVersionPath = "WEB-INF/lib-phpmvc/Propel/$propelVersion/runtime";
	array_push($modulePaths,$propelVersionPath);
}
else {
	// Setup application class paths first
	include $appServerRootDir.'/WEB-INF/classes/phpmvc/utils/ClassPath.php';
	
	// Setup the app server paths
	include $appServerRootDir.'/WEB-INF/GlobalPaths.php';
	$globalPaths = GlobalPaths::getGlobalPaths();
	$propelVersionPath = "WEB-INF/lib/pear/propel/$propelVersion/runtime";
	array_push($globalPaths,$propelVersionPath);
	$gPath = ClassPath::getClassPath($appServerRootDir, $globalPaths, $osType);
}

$mPath = ClassPath::getClassPath("$appDir/", $modulePaths, $osType);
$cPath = ClassPath::concatPaths($gPath, $mPath, $osType);

// Set the 'include_path' variables, as used by the file functions
ini_set('include_path', $cPath);
define('CLASSPATH', True);

// Include application specific classes - Always
$localPrependFiles	= $prependFile;

// Include the framework specific classes - Always
$globalPrependFiles	= $appServerRootDir.'/WEB-INF/'.$globalPrepend;
include_once $globalPrependFiles;

// Include the xml digester classes - On demand:
// If the config data file is out-of-date or we are requesting a Force-Compile
$phpmvcConfigXMLFile	= $appXmlCfgs['config']['name'];					// 'phpmvc-config.xml'
$phpmvcConfigDataFile= substr($phpmvcConfigXMLFile, 0, -3).'data';// 'phpmvc-config.data'
$initXMLConfig = CheckConfigDataFile("$appDir/" . $configPath, $phpmvcConfigDataFile, $phpmvcConfigXMLFile);
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

if(defined('PHPMVC_PERFORM'))
	$appServerRootDir = "$appDir/";

// Load Application Configuration
$bootUtils = new BootUtils;

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
} else {
	// No application config array - so try a default startup.
	$oApplicationConfig = $bootUtils->loadAppConfig($actionServer, $appServerConfig, "$appDir/" . $configPath);
}

if($oApplicationConfig == NULL) {
	exit;
}

// Setup HTTP Request and add request attributes
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

// Setup HTTP Response and add request attributes
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
