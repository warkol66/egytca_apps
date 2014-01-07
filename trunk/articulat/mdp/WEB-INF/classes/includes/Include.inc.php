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
		$_SESSION["loginUser"] = $user;
	}

	require_once 'ErrorHandling/ErrorHandling.old.php';
//	require_once 'ErrorHandling/ErrorHandling.php';

	/**
	* lcfirst
	* lcfirst para php < 5.3.0
	* @return primer caracter de string en minuscula
	*/
	if (false === function_exists('lcfirst')) {
		function lcfirst( $str ) {
			return (string)(strtolower(substr($str,0,1)).substr($str,1));
		}
	}