<?php

error_reporting(E_ALL);
ini_set('display_errors',1);


if (isset($_POST["modelgen"])) {

	$projectHome = shell_exec('echo $PWD');
	$projectHome = substr($projectHome, 0, -1);

	$command = './migrate';

	// Borrar salidas viejas
	shell_exec('"" > stdout.txt');
	shell_exec('"" > stderr.txt');

	putenv('MIGRATION_DEBUG=1');

	if (isset($_POST["modelgen"]["normal"]))
		shell_exec($command.' >> stdout.txt 2>> stderr.txt');
	
	if (isset($_POST["modelgen"]["diff"]))
		shell_exec($command.' diff >> stdout.txt 2>> stderr.txt');
	
	if (isset($_POST["modelgen"]["migrate"]))
		shell_exec($command.' migrate >> stdout.txt 2>> stderr.txt');

}

?>

<form action="modelgen.php" method="post" >
	<input type="checkbox" name="modelgen[normal]" value="true" checked="true" />modelgen<br />
	<input type="checkbox" name="modelgen[diff]" value="true" checked="true" />modelgen diff<br />
	<input type="checkbox" name="modelgen[migrate]" value="true" />modelgen migrate<br />
	<input type="submit" value="correr" />
</form>
