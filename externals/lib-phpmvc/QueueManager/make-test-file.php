<?php

$testFile = uniqid('queue/test-');

$data = array(
	'script' => 'test-process.php',
	'data' => array(
		'qwe' => 123,
		'asd' => 'sometext'
	)
);

file_put_contents($testFile, serialize($data));
