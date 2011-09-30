<?php
/**
* Prepend
*
* $author Modulos Empresarios / Egytca
* @package phpMVCconfig
*/

if( defined('PHPMVC_PERFORM') ) {
	require_once 'smarty/Smarty.class.php';
	require_once 'smarty/SmartyML.class.php';
}
else {
	require_once("$appServerRootDir/WEB-INF/classes/phpmvc/utils/ActionDispatcher.php");
	require_once("$moduleRootDir/WEB-INF/classes/SmartyActionDispatcher.php");
//includes del phpMVC1.1
//  include_once 'Locale.php';
//  include_once 'PropertyMessageResources.php';
}

if (!empty($propelVersion)) {
	if (defined('PHPMVC_PERFORM'))
		require_once $propelVersion.'/runtime/lib/Propel.php';
	else
		require_once 'lib/Propel.php';
	Propel::init("$moduleRootDir/config/application-conf.php");
}

//ponemos el server en UTC
date_default_timezone_set('UTC');

require_once("BaseAction.php");
