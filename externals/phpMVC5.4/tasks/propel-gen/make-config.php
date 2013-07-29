<?php

require_once __DIR__.'/../../WEB-INF/lib-phpmvc/smartynew/RenameMeSmarty.php';

class PropelGenSmarty extends RenameMeSmarty {

	function __construct() {
		parent::__construct();
		$this->setTemplateDir(__DIR__);
	}
}

$propelConfPath = realpath(__DIR__.'/../../WEB-INF/propel');
$buildtimeConfFile = "$propelConfPath/buildtime-conf.xml";
$runtimeConfFile = "$propelConfPath/runtime-conf.xml";


$smarty = new PropelGenSmarty();
$smarty->assign('database', 'ecuador');
$smarty->assign('username', 'root');
$smarty->assign('password', 'pepitolala');
$contents = $smarty->fetch('PropelConfig.tpl');

file_put_contents($buildtimeConfFile, $contents);
file_put_contents($runtimeConfFile, $contents);
