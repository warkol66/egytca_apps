<?php
/*
* Filename        : boot.config.php
* @package phpMVCconfig
*
*/

// Config
//====================================================================
// Set error reporting level.
if(!$_ENV['PHPMVC_MODE_CLI']) {
	error_reporting(E_ALL -E_STRICT);
	ini_set('display_errors',1);
}

//Sistema operativo [UNIX|WINDOWS|MAC]
$osType = PHP_OS;

//Codigo del idioma por defecto (ej: es_ES.UTF-8);
$useLocale = "es_ES.UTF-8";

//Welcome path
$welcomePath = "usersWelcome";

//Login path
$loginPath = "usersLogin";

//Codigo del idioma actual
$mluse = "";

//Cantidad de licencias de usuarios
$licenses = "";

// Action ID [do]
$actionID = 'do';

// Timer reporting. 1=on, 0=off
$timerRun = 0;

//====================================================================
