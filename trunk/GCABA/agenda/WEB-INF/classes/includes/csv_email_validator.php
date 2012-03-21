<?php

	
	require_once('Common.class.php');

	function usage() {
		echo "Validador de Emails:\n";
		echo "Sintaxis: csv_email_validator.php archivo_de_entrada.csv\n";
	}
	
	#verificacion de parametros
	if ($argc != 2) {
		usage();
		echo "Error de Sintaxis.\n";
		return -1;
	}


	$filenameInput = $argv[1];

	#verificacion de existencia del archivo
	if (!is_file($filenameInput)) {
		usage();
		echo "El archivo de entrada es invalido\n";
		return -2;
	}

	#armado de nombres de archivos de salida, se guardan en el mismo path que el de entrada
	$filenameOk = preg_replace("/(.*)(\.)(.*)/", "\\1-ok\\2\\3", $filenameInput);
	$filenameNotExist = preg_replace("/(.*)(\.)(.*)/", "\\1-email-not-exist\\2\\3", $filenameInput);
	$filenameWrongFormat = preg_replace("/(.*)(\.)(.*)/", "\\1-email-wrong-format\\2\\3", $filenameInput);

	$fdIn = fopen($filenameInput,'r');
	$fdOk = fopen($filenameOk,'w');
	$fdNotExist = fopen($filenameNotExist,'w');
	$fdWrongFormat = fopen($filenameWrongFormat,'w');
	
	while (!feof($fdIn)) {
		$line = fgets($fdIn);
		$parsedLine = explode(';',$line);
		$email = rtrim($parsedLine[3]);
		echo 'Procesando Email: ' . $email;
		$fdOutput = $fdOk;
		
		if (!Common::validateEmail($email))	{
			echo " - invalido\n";
			#el email del registro es invalido
			$fdOutput = $fdWrongFormat;
		
		} else {

			if (!Common::verifyMailbox($email,'gflamerich@gmail.com')) {
				#el email del registro es invalido
				echo " - no existe\n";
				$fdOutput = $fdNotExist;
			}
			else {
				echo " - ok\n";
			}
		}
		
		fwrite($fdOutput,$line);
		
	}

	fclose($fdIn);
	fclose($fdOk);
	fclose($fdNotExist);
	fclose($fdWrongFormat);

	echo "Se han generado los siguientes archivos de salida: \n";
	echo "Registros OK: $filenameOk \n";
	echo "Registros con formato erroneo de Email: $filenameWrongFormat \n";
	echo "Registros con email con formato correcto pero no existente: $filenameNotExist: \n";

	return 0;
