<?php

class PropelUtils {

	private static function checkEnv($env) {
		if ($env != 'dev')
			throw new Exception("environment \"$env\" sin implementar");
	}

	static function makeConfig($env) {

		self::checkEnv($env);

		require_once __DIR__.'/../../../WEB-INF/lib-phpmvc/renameme-smarty/RenameMeSmarty.php';

		$propelConfPath = realpath(__DIR__.'/../../../WEB-INF/propel');
		$buildtimeConfFile = "$propelConfPath/buildtime-conf.xml";
		$runtimeConfFile = "$propelConfPath/runtime-conf.xml";

		require_once __DIR__.'/../../../boot/db-config.php';
		$dbConfig = DBConfig::get($env);

		$smarty = self::makeSmarty();
		$smarty->assign('database', $dbConfig['database']);
		$smarty->assign('username', $dbConfig['username']);
		$smarty->assign('password', $dbConfig['password']);
		$contents = $smarty->fetch('PropelConfig.tpl');

		file_put_contents($buildtimeConfFile, $contents);
		file_put_contents($runtimeConfFile, $contents);
	}

	private static function makeSmarty() {
		$smarty = new RenameMeSmarty();
		$smarty->setTemplateDir(__DIR__);
		return $smarty;
	}

	static function propelGen($env) {

		self::checkEnv($env);

		$webinf = __DIR__.'/../../../WEB-INF';
		$propelPath = "$webinf/lib-phpmvc/Propel/1.6.7";

		$propelBinPath = "$propelPath/generator/bin";
		$phingBinPath = "$webinf/lib-phpmvc/phing-2.4.12/bin";

		switch (PHP_OS) {

			case 'Linux':
				$propelGenCmd = realpath("$propelBinPath/propel-gen");
				$phingCmd = realpath("$phingBinPath/phing");
				break;

			case 'WINNT':
				$propelGenCmd = realpath("$propelBinPath/propel-gen.bat");
				$phingCmd = realpath("$phingBinPath/phing.bat");
				break;

			default:
				throw new Exception('OS not supported - configure it at '.__FILE__);
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
	}
}
