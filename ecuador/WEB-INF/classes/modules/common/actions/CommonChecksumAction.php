<?php
/**
* CommonChecksumAction
*
* Genera un listado con checksum de las tablas del sistema
*
* @package common
*/

class CommonChecksumAction extends BaseAction {

	function CommonChecksumAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		$conf = include('config/application-classmap.php');
		foreach ($conf as $key => $each)
			if (substr($key, -8) == "TableMap") {
				
				$peerName = substr($key, 0, strlen($key)-8) . "Peer";
				$tableName = $peerName::getTableMap()->getName();

				$sql = "CHECKSUM TABLE `$tableName`";
				$con = Propel::getConnection();
				$stmt = $con->prepare($sql);
				$stmt->execute();

				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$tableNames[] = $result;
			}

		if (count($tableNames) == 0)
			$smarty->assign("noTables",true);
		else
			$smarty->assign("results",$tableNames);

		return $mapping->findForwardConfig('success');
	}
}
