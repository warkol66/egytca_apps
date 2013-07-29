<?php

// path to Log.php
$libPhpmvcPath = realpath(__DIR__.'/../WEB-INF/lib-phpmvc');
set_include_path($libPhpmvcPath . PATH_SEPARATOR . get_include_path());

require_once __DIR__.'/../WEB-INF/lib-phpmvc/Propel/1.6.7/runtime/lib/Propel.php';
Propel::init(__DIR__.'/../config/application-conf.php');
