<?php

echo "autoprocessing: ".$argv[1]."\n"; // debug *******************

$data = unserialize(file_get_contents($argv[1]));

/* ************** debug ********** */
echo "file content:\n";
print_r($data);
/* ************* end debug ************** */

$script = $data['script'];
if (file_exists($script)) {
	try {
		$run = require $script;
		$result = $run($data['data']);
		echo "estoy en el try y result es $result\n"; // debug *******************
		exit($result);
	} catch(Exception $e) {
		echo $e->getMessage()."\n";
		exit(1);
	}
} else {
	echo "script $script not found\n";
	exit(1);
}
