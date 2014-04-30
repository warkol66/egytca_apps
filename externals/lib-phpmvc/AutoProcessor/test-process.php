<?php

$testProcess = function($data) {
	echo "This is test-process. Data:\n";
	print_r($data);
	echo "\n";
	
	return 0;
};

return $testProcess;
