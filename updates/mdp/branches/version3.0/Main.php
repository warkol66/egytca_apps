<?php
/*
* Main
* Dispatcher del phpMVC
* @package phpMVCconfig
*/

// Set error reporting level. See PHP manual: XXVI. Error Handling and Logging Functions
// Note: E_STRICT  (PHP5 compliance) will cause the PHP4 code base to fail.
error_reporting(E_ALL -E_NOTICE -E_WARNING);
ini_set('display_errors',0);


// The application root directory
$appDir = NULL;
$appDir = dirname(__FILE__);

//processing using commandline
if (!empty($argc)) {
	foreach ($argv as $value) {
		if ($value != 'Main.php') {
			$parts = split('=',$value);
			$_REQUEST[$parts[0]] = $parts[1];
			$_POST[$parts[0]] = $parts[1];
			$_GET[$parts[0]] = $parts[1];
		} 
	}
	$_ENV['PHPMVC_MODE_CLI'] = true;
}
else
	$_ENV['PHPMVC_MODE_CLI'] = false;

// Comment out this define to use the regular (external) phpmvc library
//define('PHPMVC_PERFORM', "1");

// Load the application bootup file
if(defined('PHPMVC_PERFORM'))
	// Load the compressed performance phpmvc library (bundled)
	include ("$appDir/config/boot-php-perform.inc.php");
else
	// Load the regular phpmvc library (external)
	include ("$appDir/config/boot-php.inc.php");
