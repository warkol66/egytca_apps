<?php
/*
 * Genera el archivo de configuracion de la aplicacion si el mismo no existe.
 *
 */

if (file_exists("$appDir/config/config.php"))
	require_once("$appDir/config/config.php");
else {
	if ($handle = fopen("$appDir/config/config.php",w)) {
		fwrite($handle,"<?php\n");
    fwrite($handle,"//Archivo de configuracion de directorio de phpmvc\n");
    fwrite($handle,"\n");
    fwrite($handle,"//Directorio donde se encuentra phpmvc\n");
    fwrite($handle,'$appServerRootDir	= "";');
    fwrite($handle,"\n\n");
    fwrite($handle,"//Directorio donde se encuentra la aplicacion (sin barra al final)\n");
    fwrite($handle,'$moduleRootDir = "";');
    fwrite($handle,"\n\n");
    fwrite($handle,"//Directorio donde se encuentra PEAR\n");
    fwrite($handle,'$pearDir = "";');
    fwrite($handle,"\n\n");
    fwrite($handle,"//Sistema operativo [UNIX|WINDOWS|MAC]\n");
    fwrite($handle,'$osType = "";');
    fwrite($handle,"// Action por defecto\n");
    fwrite($handle,'$welcomePath = "";');
    fwrite($handle,"\n\n");
		fwrite($handle,"//Codigo del idioma actual.\n");
		fwrite($handle,'$mluse = "";');
    fwrite($handle,"\n\n");
		fwrite($handle,"//Cantidad de licencias de usuarios.\n");
		fwrite($handle,'$licenses = "";');
    fwrite($handle,"\n\n");
    fwrite($handle,"?>\n");
    fclose($handle);
    echo "<p style='color:green'>Archivo de configuracion 'config.php' creado! Editelo con su configuracion.</p>";
	}
	else
		echo "<p style='color:red'>No se encuentra el archivo de configuracion 'config.php' y fue imposible crearlo!</p>";
}

?>
