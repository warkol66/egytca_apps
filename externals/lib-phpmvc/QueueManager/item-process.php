<?php

$data = unserialize(file_get_contents($argv[1]));

$script = $data['script'];
if (file_exists($script)) {
	try {
		$run = require $script;
		$result = $run($data['data']);
		exit($result);
	} catch(Exception $e) {
		printError($e->getMessage());
		exit(1);
	}
} else {
	printError("script $script not found");
	exit(1);
}

function printError($message) {
	$datetime = date('Y-m-d H:i:s');
	$script = __FILE__;
	file_put_contents('php://stderr', "$datetime - $script: $message\n");
}
