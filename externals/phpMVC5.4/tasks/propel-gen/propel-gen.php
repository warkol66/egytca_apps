<?php

require_once 'make-config.php';


$webinf = __DIR__.'/../../WEB-INF';
$propelPath = "$webinf/lib-phpmvc/Propel/1.6.7";

$propelBinPath = "$propelPath/generator/bin";
$phingBinPath = "$webinf/lib-phpmvc/phing-2.4.12/bin";

switch (PHP_OS) {

	case 'Linux':
		$propelGenCmd = realpath("$propelBinPath/propel-gen");
		$phingCmd = realpath("$phingBinPath/phing");
		break;

	case 'Windows':
		$propelGenCmd = realpath("$propelBinPath/propel-gen.bat");
		$phingCmd = realpath("$phingBinPath/phing.bat");
		break;

	default:
		throw new Exception('OS not supported. Configure it at '.__FILE__);
}

$projectDir = realpath("$webinf/propel");
$buildXml = realpath("$propelPath/generator/build.xml");

$cmd = "$phingCmd -f $buildXml -Dusing.propel-gen=true -Dproject.dir=$projectDir -logger phing.listener.AnsiColorLogger";


$output = shell_exec("$cmd");
echo "$output\n";
$output = shell_exec("$cmd diff");
echo "$output\n";
$output = shell_exec("$cmd migrate");
echo "$output\n";
