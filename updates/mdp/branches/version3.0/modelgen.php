<?php

error_reporting(E_ALL);
ini_set('display_errors',1);


function generate() {

$output = '';

$projectHome = shell_exec('echo $PWD');
$projectHome = substr($projectHome, 0, -1);

$command = './migrate';

exec($command, $output, $return_var);
foreach ($output as $index => $lineContent) {
	echo $lineContent.'<br>';
}
echo "<br>";

exec($command.' diff', $output, $return_var);
foreach ($output as $index => $lineContent) {
	echo $lineContent.'<br>';
}
echo "<br>";

exec($command.' migrate', $output, $return_var);
foreach ($output as $index => $lineContent) {
	echo $lineContent.'<br>';
}
echo "<br>";

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
