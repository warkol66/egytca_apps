<?php
/*
 * load_config.php
 * Carga archivos de configuracion de la aplicacion.
 * Lo hace a dos niveles, el config.xml que se pued emodificar desde la aplicacion y el config_module
 * que no se tien eacceso desde al aplicacion
 * @package config
*/

function loadConfig($xmlFile, $dataFile) {
	
	global $appDir;
	
	if (!file_exists($xmlFile))
		echo "No existe $xmlFile";
	else {
		
		if (file_exists($dataFile))
			$timeData = filemtime($dataFile);
		else
			$timeData = 0;
		
		$timeXML = filemtime($xmlFile);
		
		//Si el XML fue modificado despues de crear el data, tengo que generar el data
		if ($timeXML > $timeData) {
			require_once(realpath($appDir . "/WEB-INF/classes/includes/assoc_array2xml.php"));
			$converter = new assoc_array2xml;
			$xml = file_get_contents($xmlFile);
			$configArray = $converter->xml2array($xml);
			file_put_contents($dataFile,serialize($configArray));
		}
		
		$data = file_get_contents($dataFile);
		return unserialize($data);
	}
}

global $appDir;

$xmlFile = $appDir . "/config/config.xml";
$dataFile = $appDir . "/config/config.data";

$system = loadConfig($xmlFile, $dataFile);

if (file_exists($appDir . "/config/config.local.xml")) {
	$localConfig = loadConfig($appDir . "/config/config.local.xml", $appDir . "/config/config.local.data");
	$system = array_replace_recursive($system, $localConfig);
}

require_once($appDir . "/config/config_module.php");
