<?php

$projectHome = shell_exec('echo $PWD');
$projectHome = substr($projectHome, 0, -1);

putenv('PHP_CLASSPATH='.$projectHome.'/WEB-INF/lib-phpmvc');

if (getenv('PHP_CLASSPATH')) {
    if (!defined('PHP_CLASSPATH')) { define('PHP_CLASSPATH',  getenv('PHP_CLASSPATH') . PATH_SEPARATOR . get_include_path()); }
    ini_set('include_path', PHP_CLASSPATH);
} else {
    if (!defined('PHP_CLASSPATH')) { define('PHP_CLASSPATH',  get_include_path()); }
}

require_once 'phing/Phing.php';

try {
	Phing::startup();
	
	Phing::setProperty('phing.home', getenv('PHING_HOME'));
	
	$optionalArgs = isset($argv) ? $argv : $_SERVER['argv']; // $_SERVER['argv'] seems to not work (sometimes?) when argv is registered
	array_shift($optionalArgs); // 1st arg is script name, so drop it
	
	$fixedArgs = array('-f', $projectHome.'/WEB-INF/lib-phpmvc/Propel/1.6.0/generator/build.xml',
	    '-Dusing.propel-gen=true', '-Dproject.dir='.$projectHome.'/WEB-INF/propel');
	
	Phing::fire(array_merge($fixedArgs, $optionalArgs));
	
	Phing::shutdown();
	
} catch (ConfigurationException $x) {
	
	Phing::printMessage($x);
	exit(-1); // This was convention previously for configuration errors.
    
} catch (Exception $x) {
	
	// Assume the message was already printed as part of the build and
	// exit with non-0 error code.
	exit(1);

}

?>
