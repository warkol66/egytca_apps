<?php
/*
 * Genera el archivo de configuracion de la aplicacion si el mismo no existe.
 *
 */

if (file_exists("$appDir/config/config.php"))
	require_once("$appDir/config/config.php");
else {
	$configBase = "$appDir/config/config.php.ini";
	$config = "$appDir/config/config.php";
	header("Content-type: text/html; charset=utf-8;");
	if (copy($configBase, $config))
		echo "<p style='color:green'>Archivo de configuracion 'config.php' creado! Editelo con su configuracion.</p>";
	else
		echo "<p style='color:red'>No se encuentra el archivo de configuracion 'config.php' y fue imposible crearlo!</p>";
	die();

}
