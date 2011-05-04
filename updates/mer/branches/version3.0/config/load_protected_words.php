<?php

if (!file_exists("config/protected_words.xml"))
	echo "No existe protected_words.xml";
else {
	if (file_exists("config/protected_words.data"))
		$timeData = filemtime("config/protected_words.data");
	else
		$timeData = 0;
	$timeXML = filemtime("config/protected_words.xml");
	//Si el XML fue modificado despues de crear el data, tengo que generar el data
	if ($timeXML > $timeData) {
		require_once('WEB-INF/classes/includes/assoc_array2xml.php');
		$converter= new assoc_array2xml;
	  $xml = file_get_contents("config/protected_words.xml");
	  $protectedWordsXML = $converter->xml2array($xml);
    $protectedWords = $protectedWordsXML["protectedWords"];
	  file_put_contents("config/protected_words.data",serialize($protectedWordsXML));
	  //echo "data creado";
	}
	// sino uso el data guardado
	else {
		$data = file_get_contents("config/protected_words.data");
		$protectedWordsXML = unserialize($data);
    $protectedWords = $protectedWordsXML["protectedWords"];
		//echo "data cargado";
	}
}

?>
