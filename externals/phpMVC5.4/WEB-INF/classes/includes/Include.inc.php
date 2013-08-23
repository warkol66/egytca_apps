<?php
/*
 * Funciones y variables comunes al sistema
 *
 * @package Config
 */

	if (headers_sent($filename, $linenum))
		echo "Debug: Headers already sent in $filename on line $linenum\n";

	ini_set("show_errors",true);
	session_cache_limiter('nocache');
	session_start();

	//Configuracion de Usuario en Caso de ejecucion por linea de comando
	if ($_ENV['PHPMVC_MODE_CLI'] == true) {
		//cargamos el usuario system modo supervisor para login de los actions
		$user = UserPeer::getByUsername('system');
		$_SESSION["login_user"] = $user;
		$_SESSION["loginUser"] = $user;
	}

//	if (version_compare(PHP_VERSION, '5.4.0') < 0)
		require_once 'ErrorHandling/ErrorHandling.old.php';
//	else
//		require_once 'ErrorHandling/ErrorHandling.php';
