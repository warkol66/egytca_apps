<?php

$moduleRootDir = dirname(__FILE__);

if (PHP_OS != "WINNT")
	set_include_path('/usr/local/lib/php/phpMVC5.3/WEB-INF/lib/pear/:'.$moduleRootDir.'/WEB-INF/lib-phpmvc/Propel:'.$moduleRootDir.'/WEB-INF/classes/modules');
else
	set_include_path('C:\\apache\\htdocs2\\anmaga\\trunk\\externals\\phpMVC\\WEB-INF\\lib\\pear\\;C:\\apache\\htdocs2\\anmaga\\trunk\\WEB-INF\\classes\\propel\\build\\classes\\');

require_once 'Log.php';

//Propel Version
$propelConfig = include("$moduleRootDir/config/application-conf.php");
$propelVersion = $propelConfig["generator_version"];
require_once $propelVersion.'/runtime/lib/Propel.php';
Propel::init("$moduleRootDir/config/application-conf.php");


if (PHP_OS != "WINNT") {
	Propel::init("$moduleRootDir/config/application-conf.php");
/*	require_once 'WEB-INF/classes/propel/build/classes/anmaga/AffiliatePeer.php';
	require_once 'WEB-INF/classes/propel/build/classes/anmaga/AffiliateInfoPeer.php';
	require_once 'WEB-INF/classes/propel/build/classes/anmaga/Branch.php';
	require_once 'WEB-INF/classes/propel/build/classes/anmaga/BranchPeer.php';*/
}
else{
	Propel::init("$moduleRootDir/config/application-conf.php");
	require_once 'WEB-INF\\classes\\propel\\build\\classes\\anmaga\\AffiliatePeer.php';
	require_once 'WEB-INF\\classes\\propel\\build\\classes\\anmaga\\AffiliateInfoPeer.php';
	require_once 'WEB-INF\\classes\\propel\\build\\classes\\anmaga\\Branch.php';
	require_once 'WEB-INF\\classes\\propel\\build\\classes\\anmaga\\BranchPeer.php';
}

if (is_file("updates/Clientes.txt")) {
	
	$handle = fopen("updates/Clientes.txt", "r");
	$rowNum = 0;
	$errors = "";
	while($row = fgetcsv($handle, 2000, ';')){

	  $clients[$rowNum] = $row;
	
		$row[5] = trim($row[5]);
		$affiliateCode = $row[5];
	
		$affiliate = AffiliatePeer::getByInternalNumber($affiliateCode);
	
		if (!is_object($affiliate)){ // No tiene afiliado válido
			$affiliateCode = "V";
			$affiliateInfo = AffiliatePeer::getByInternalNumber($affiliateCode);
			if (!is_object($affiliate)) // Si no es "V" es "OFI"
				$affiliate = AffiliatePeer::getByInternalNumber('OFI');
			$errors .= "No se encontro mayorista: '$row[5]'\n";
		}

		if (is_object($affiliate)) // No tiene afiliado válido
			$affiliateId = $affiliate->getId();
		else
			$affiliateId = 1;

		$branch = AffiliateBranchPeer::getByCode($row[0]);
		if (empty($branch))
			$branch = New AffiliateBranch();
		
		$branch->setCode($row[0]);
		$branch->setName(iconv("Windows-1252","UTF-8",$row[1]));
		$branch->setPhone($row[2]);
		$branch->setContact(iconv("Windows-1252","UTF-8",$row[3]));
		$branch->setContactEmail($row[4]);
		$branch->setAffiliateId($affiliateId);
		$branch->save();
	
		$rowNum++;
	}
	
	$log  = "=======================================================\n";
	$log .= "Actualizacion de clientes " . date(DATE_RFC822) . "\n\n";
	if (!empty($errors))
		$log .= "Reporte de Errores: \n" . $errors . "\n\n";
	$filename = 'updates/ClientUpdates.log';
	$handle = fopen($filename, 'aw');
	fwrite($handle, $log);
	fclose($handle);

	copy("updates/Clientes.txt","updates/processed/Clientes_". date("YmdHis") . '.txt');
	unlink("updates/Clientes.txt");
}
else {
	$log  = "=======================================================\n";
	$log .= "Actualizacion de clientes " . date(DATE_RFC822) . "\n\n";
	$log .= "No se encontro el archivo Clientes.txt\n\n";
	$filename = 'updates/ClientUpdates.log';
	$handle = fopen($filename, 'aw');
	fwrite($handle, $log);
	fclose($handle);

}

// borrar actualizaciones vijas
shell_exec('/usr/sbin/tmpwatch -m -d 720 ' . $moduleRootDir . '/updates/processed/' );
