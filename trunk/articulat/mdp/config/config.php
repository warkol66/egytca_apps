<?php
//Archivo de configuración

//Directorio donde se encuentra phpmvc
$appServerRootDir	= "";

//Directorio donde se encuentra la aplicacion (sin barra al final)
$moduleRootDir = substr(dirname(__FILE__), 0, -6) . 'WEB-INF';

//Sistema operativo [UNIX|WINDOWS|MAC]
$osType = PHP_OS;

//Propel Version
$propelConfig = include("application-conf.php");
$propelVersion = $propelConfig["generator_version"];

//Código del idioma por defecto (ej: es_ES.UTF-8);
$useLocale = "es_ES.UTF-8";

//Welcome path
$welcomePath = "usersWelcome";

//Login path
$loginPath = "usersLogin";

//Codigo del idioma actual
$mluse = "esp";

//Cantidad de licencias de usuarios
$licenses = "";


