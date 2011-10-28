<?php

if (!file_exists("config/config.xml"))
	echo "No existe config.xml";
else {
	if (file_exists("config/config.data"))
		$timeData = filemtime("config/config.data");
	else
		$timeData = 0;
	$timeXML = filemtime("config/config.xml");
	//Si el XML fue modificado despues de crear el data, tengo que generar el data
	if ($timeXML > $timeData) {
		require_once('WEB-INF/classes/includes/assoc_array2xml.php');
		$converter= new assoc_array2xml;
	  $xml = file_get_contents("config/config.xml");
	  $system = $converter->xml2array($xml);
	  file_put_contents("config/config.data",serialize($system));
	  //echo "data creado";
	}
	// sino uso el data guardado
	else {
		$data = file_get_contents("config/config.data");
		$system = unserialize($data);
		//echo "data cargado";
	}
}
require "config_module.php";
?>
