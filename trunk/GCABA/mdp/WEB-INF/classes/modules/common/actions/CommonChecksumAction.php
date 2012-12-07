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
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		global $osType;
		require_once('config/DBConnection.inc.php');
		$db = new DBConnection();

		$query = ('SHOW TABLES;');
		$tables = $db->table_names();
		if (count($tables) > 0) {
			foreach ($tables as $table)
				$results[] = $db->checksum($table['table_name']);
			$smarty->assign("results",$results);
		}
		else
			$smarty->assign("noTables",true);

		return $mapping->findForwardConfig('success');
	}
}
