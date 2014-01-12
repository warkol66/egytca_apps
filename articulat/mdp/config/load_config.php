<?php
/*
* Filename        : load_config.php
* @package phpMVCconfig
*
*/
global $appDir;

$xmlFile					= NULL;	// XML config file
$xmlData					= NULL;	// Serialized config file

// En entornos de desarrollo se puede utilizar archivo de 
// configuracion propio generando un config.dev.xml
if (file_exists($appDir . "/config/config.dev.xml")) {
	$xmlFile = $appDir . "/config/config.dev.xml";
	$xmlData = $appDir . "/config/config.dev.data";
}
else {
	$xmlFile = $appDir . "/config/config.xml";
	$xmlData = $appDir . "/config/config.data";
}
if (!file_exists($xmlFile))
	echo "No existe config.xml";
else {
	if (file_exists($xmlData))
		$timeData = filemtime($xmlData);
	else
		$timeData = 0;
	$timeXML = filemtime($xmlFile);

	//Si el XML fue modificado despues de crear el data, tengo que generar el data
	if ($timeXML > $timeData) {
		require_once(realpath($appDir . "/WEB-INF/classes/includes/assoc_array2xml.php"));
		$converter = new assoc_array2xml;
	  $xml = file_get_contents($xmlFile);
	  $configArray = $converter->xml2array($xml);
	  file_put_contents($xmlData,serialize($configArray));
	}

	$data = file_get_contents($xmlData);
	$system = unserialize($data);

}
// Se carga el archivos de ocnfiguracion de los modulos, si se quiere un entorno de
// desarrollo generar un archivo config_module.dev.php
if (file_exists($appDir . "/config/config_module.dev.php"))
	require_once($appDir . "/config/config_module.dev.php");
else
	require_once($appDir . "/config/config_module.php");
