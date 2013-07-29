<?php

// path to Log.php
$libPhpmvcPath = realpath(__DIR__.'/../WEB-INF/lib-phpmvc');
set_include_path($libPhpmvcPath . PATH_SEPARATOR . get_include_path());
// ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . $libPhpmvcPath);

require_once __DIR__.'/../WEB-INF/lib-phpmvc/Propel/1.6.7/runtime/lib/Propel.php';
Propel::init(__DIR__.'/../config/application-conf.php');
