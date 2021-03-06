<?php
/*
 * Definición de la Conexión a la Base de Datos
 *
 * @package Config
 */

require_once("WEB-INF/classes/includes/db_mysql.inc.php");

class DBConnection extends DB_Sql {

	function DBConnection() {

		//Para utilizar conexión de Propel
		global $moduleRootDir;		
		$configDbFromPropel = include("$moduleRootDir/config/application-conf.php");
		
		$configDbData = $configDbFromPropel["datasources"]["application"]["connection"];
		$dsnParts = explode("=",$configDbData["dsn"]);
		$database = $dsnParts[2];
		$dsnParts2 = explode(";",$dsnParts[1]);
		$host = $dsnParts2[0];
		$user = $configDbData["user"];
		$password = $configDbData["password"];
		$port = "";

		$charSet = $configDbData["settings"]["charset"]["value"];

		//Para conectar directamente, cargar valores en esta sección
		$this->Database = $database;
		$this->Host = $host;
		$this->User = $user;
		$this->Password = $password;
		$this->Port = $port;

    if (!empty($charSet))
			$this->CharSet = $charSet;

		//Verifico que se puede conectar a la base, de lo contrario die
		if (!$this->connect())
			die("No db conection!!!");

	}

}
