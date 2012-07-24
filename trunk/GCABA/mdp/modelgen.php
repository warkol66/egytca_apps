<?php

//processing using commandline
if (!empty($argc)) {

	//if called by commandline don't want any error display o reporting
	error_reporting(0);
	ini_set('display_errors',0);

	foreach ($argv as $value) {
		// Exclude call to dispatcher as param
		if (strpos($value,'modelgen.php') === false) {
			$parts = explode('=',$value);
			$_POST["modelgen"][$parts[0]] = $parts[1];
		} 
	}
	$_ENV['PHPMVC_MODE_CLI'] = true;
} else {
	
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	
	$_ENV['PHPMVC_MODE_CLI'] = false;
}

if (isset($_POST["modelgen"])) {
	
	$sqlDir = realpath('./WEB-INF/propel/sql/');
	$migrationsDir = realpath('./WEB-INF/propel/migrations/');
	$root = realpath('.');
	
	$permissionsError = false;
	
	require_once 'WEB-INF/classes/modules/common/classes/Common.class.php';
	error_reporting(0);
	ini_set('display_errors',0);
	
	if (!Common::isWritable($root)) {
		$permissionsError = true;
		echo "No se puede escribir en el directorio $root. Verifique la configuraci&oacute;n de permisos.<br />";
	}
	
	if (!Common::isWritable($sqlDir)) {
		$permissionsError = true;
		echo "No se puede escribir en el directorio $sqlDir. Verifique la configuraci&oacute;n de permisos.<br />";
	}
	
	if (!Common::isWritable($migrationsDir)) {
		$permissionsError = true;
		echo "No se puede escribir en el directorio $migrationsDir. Verifique la configuraci&oacute;n de permisos.<br />";
	}
	
	$modulesDir = realpath('./WEB-INF/classes/modules');
	foreach (scandir($modulesDir) as $module) {
		$omDir = realpath("$modulesDir/$module/classes/om");
		$mapDir = realpath("$modulesDir/$module/classes/map");
		
		if (file_exists($omDir)) {
			if (!Common::isWritable($omDir)) {
				$permissionsError = true;
				echo "No se puede escribir en el directorio $omDir. Verifique la configuraci&oacute;n de permisos.<br />";
			}
		}
		
		if (file_exists($mapDir)) {
			if (!Common::isWritable($mapDir)) {
				$permissionsError = true;
				echo "No se puede escribir en el directorio $mapDir. Verifique la configuraci&oacute;n de permisos.<br />";
			}
		}
	}
	
	// Borrar salidas viejas
	shell_exec('"" > stdout.txt');
	shell_exec('"" > stderr.txt');
	
	if (!$permissionsError) {
		
		$projectHome = shell_exec('echo $PWD');
		$projectHome = substr($projectHome, 0, -1);
		
		$command = './migrate';
		
//		putenv('MIGRATION_DEBUG=1');
		
		if (isset($_POST["modelgen"]["normal"]))
			shell_exec($command.' >> stdout.txt 2>> stderr.txt');
		
		if (isset($_POST["modelgen"]["diff"]))
			shell_exec($command.' diff >> stdout.txt 2>> stderr.txt');
		
		if (isset($_POST["modelgen"]["migrate"]))
			shell_exec($command.' migrate >> stdout.txt 2>> stderr.txt');
	}
}

?>

<script type="text/javascript">
	function formSubmit() {
		document.getElementById('p_status').innerHTML='Corriendo';
		document.getElementById('button_run').disabled=true;
		document.getElementById('form_commands').submit();
	}
</script>

<form id="form_commands" action="modelgen.php" method="post" >
	<input type="checkbox" name="modelgen[normal]" value="true" checked="true" />modelgen<br />
	<input type="checkbox" name="modelgen[diff]" value="true" checked="true" />modelgen diff<br />
	<input type="checkbox" name="modelgen[migrate]" value="true" />modelgen migrate<br />
	<input type="button" id="button_run" value="correr" onClick="formSubmit()" />
</form>

<p id="p_status"></p>

<div><?php echo file_get_contents('stdout.txt');?></div>
