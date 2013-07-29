<?php
/*
* Main
* Dispatcher del phpMVC
* @package phpMVCconfig
*/

//processing using commandline
if (!empty($argc)) {

	//if called by commandline don't want any error display o reporting
	error_reporting(0);
	ini_set('display_errors',0);

	foreach ($argv as $value) {
		// Exclude call to dispatcher as param
		if (!strpos($value,'Main.php')) {
			$parts = explode('=',$value);
			$_REQUEST[$parts[0]] = $parts[1];
			$_POST[$parts[0]] = $parts[1];
			$_GET[$parts[0]] = $parts[1];
		} 
	}
	$_ENV['PHPMVC_MODE_CLI'] = true;
}
else
	$_ENV['PHPMVC_MODE_CLI'] = false;

// The application root directory
$appDir = __DIR__;

require_once 'boot/app.php';
