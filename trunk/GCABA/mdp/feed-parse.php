<?php

error_reporting(0);
ini_set('display_errors', 0);

if (!$argc) {
	die("must call from command line\n");
}

set_include_path("WEB-INF/lib-phpmvc/" . PATH_SEPARATOR . get_include_path());
require_once 'initializers/propel.php'; // Initializer de propel
require_once 'config/config_module.php';
set_include_path("$appDir/WEB-INF/classes/includes/" . PATH_SEPARATOR . get_include_path());
require_once 'headlines/classes/contentProvider/HeadlineFeedParser.php';


$options = array(
	'debug' => false,
	'type' => ''
);

foreach ($argv as $arg) {
	preg_match('/^--(?P<name>[^=]+)=(?P<value>.+)$/', $arg, $matches);
	if (in_array($matches['name'], array_keys($options))) {
		$options[$matches['name']] = $matches['value'];
	}
}

$typeMap = ConfigModule::get('headlines', 'typeMap');

$type = $options['type'];
$debug = $options['debug'];

if (!in_array($type, array_keys($typeMap))) {
	if ($type == "")
		$type = "(empty string)";
	die("$type is not a valid type\n");
}

$headlinesFeed = $typeMap[$type]['url'];

$headlineParser = new HeadlineFeedParser($typeMap[$type]['class']);
$headlines = $headlineParser->debugMode($debug)->parse($headlinesFeed);

if ($debug) {
	$notSavedHeadlines = array();
}

$savedHeadlines = array();
foreach ($headlines as $h) {
	try {
		$h->save();
		$savedHeadlines []= $h;
	} catch (Exception $e) {
		if ($debug) {
			$notSavedHeadlines []= $h;
		}
	}
}

/* ********************* debug ******************** */
if ($debug) {
	echo "\n---------------------------\n";
		echo "guardados: ".count($savedHeadlines);
		echo "\n";
		echo "no guardados (por repetidos supuestamente): ".count($notSavedHeadlines);
		echo "\n";
		echo "total: ".count($headlines);
	echo "\n---------------------------\n";
}
/* ******************* end debug ****************** */
