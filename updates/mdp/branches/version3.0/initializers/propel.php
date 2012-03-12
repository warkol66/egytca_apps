<?php

$appDir = realpath(dirname(__FILE__) . '/../');

//require_once 'MyLogger.php';
//$logger = new MyLogger();

// Include the main Propel script
require_once $appDir . '/WEB-INF/lib-phpmvc/Propel/1.6.0/runtime/lib/Propel.php';

//Propel::setLogger($logger);

// Initialize Propel with the runtime configuration
Propel::init("$appDir/config/application-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("$appDir/WEB-INF/classes/modules/" . PATH_SEPARATOR . get_include_path());
