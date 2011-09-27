<?php

error_reporting(E_ALL);
ini_set('display_errors',1);


function generate() {

$output = '';

$projectHome = shell_exec('echo $PWD');
$projectHome = substr($projectHome, 0, -1);

$command = './migrate';

// Borrar salidas viejas
shell_exec('echo estoy vacio > stdout.txt');
shell_exec('echo estoy vacio > stderr.txt');

shell_exec($command.' > stdout.txt 2> stderr.txt');
shell_exec($command.' diff > stdout.txt 2> stderr.txt');
//shell_exec($command.' migrate > stdout.txt 2> stderr.txt');

}

echo '<p>';
echo '<form action="modelgen.php" method="post" >';
echo '<input type="hidden" name="go" value="true" />';
echo '<input type="submit" value="GO!" />';
echo '</form>';
echo '</p>';

if (isset($_POST["go"]) && $_POST["go"] == 'true') {
	generate();
}

?>
