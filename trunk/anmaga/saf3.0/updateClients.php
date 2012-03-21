<?php

$moduleRootDir = dirname(__FILE__);

if (PHP_OS != "WINNT")
	set_include_path($moduleRootDir.'/externals/phpMVC/WEB-INF/lib/pear/:'.$moduleRootDir.'/WEB-INF/classes/propel/build/classes/');
else
	set_include_path('C:\\apache\\htdocs2\\anmaga\\trunk\\externals\\phpMVC\\WEB-INF\\lib\\pear\\;C:\\apache\\htdocs2\\anmaga\\trunk\\WEB-INF\\classes\\propel\\build\\classes\\');

require_once 'Log.php';
require_once 'propel/Propel.php';

if (PHP_OS != "WINNT") {
	Propel::init("$moduleRootDir/config/anmaga-conf.php");
	require_once 'WEB-INF/classes/propel/build/classes/anmaga/AffiliatePeer.php';
	require_once 'WEB-INF/classes/propel/build/classes/anmaga/AffiliateInfoPeer.php';
	require_once 'WEB-INF/classes/propel/build/classes/anmaga/Branch.php';
	require_once 'WEB-INF/classes/propel/build/classes/anmaga/BranchPeer.php';
}
else{
	Propel::init("C:\\apache\\htdocs2\\anmaga\\trunk\\config\\anmaga-conf.php");
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
	
		$affiliateInfo = AffiliatePeer::getByInternalNumber($affiliateCode);
	
		if (!is_object($affiliateInfo)){ // No tiene afiliado válido
			$affiliateCode = "V";
			$affiliateInfo = AffiliatePeer::getByInternalNumber($affiliateCode);
			if (!is_object($affiliateInfo)) // Si no es "V" es "OFI"
				$affiliateInfo = AffiliatePeer::getByInternalNumber('OFI');
			$errors .= "No se encontro mayorista: '$row[5]'\n";
		}
	
		$affiliateId = $affiliateInfo->getAffiliateId();
			
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
shell_exec('/usr/sbin/tmpwatch -d 720 ' . $moduleRootDir . '/updates/processed/' );
