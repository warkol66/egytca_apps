<?php
/**
* Prepend
*
* $author Modulos Empresarios / Egytca
* @package phpMVCconfig
*/

if( defined('PHPMVC_PERFORM') ) {
	require_once("$smartyVersion/Smarty.class.php");
	require_once("$smartyVersion/SmartyML.class.php");
}
else {
	require_once("$appServerRootDir/WEB-INF/classes/phpmvc/utils/ActionDispatcher.php");
	require_once("$appDir/WEB-INF/classes/SmartyActionDispatcher.php");
}

if (!empty($propelVersion)) {
	require_once("lib/Propel.php");
	Propel::init("$appDir/config/application-conf.php");
}

//ponemos el server en UTC
date_default_timezone_set('UTC');

require_once("BaseAction.php");
