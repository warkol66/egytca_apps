<?php
/**
* ActionlogsDoPurgeAction
*
*  Borra desde una determinada fecha, hasta otra, datos de la base de datos
*  Los datos a borrar requieren confirmacion, una vez confirmado, borra
*  determinados datos y reconfigura la tabla
*
* @package actionlogs
*/

class CommonActionLogsDoPurgeAction extends BaseAction {

	function CommonActionLogsDoPurgeAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$dateFrom = Common::convertToMysqlDateFormat($_GET["dateFrom"]);
		$dateTo = Common::convertToMysqlDateFormat($_GET["dateTo"]);

		ActionLogPeer::deleteLogs($dateFrom,$dateTo);

		Common::doLog('success',$_GET["dateFrom"] . "_" . $_GET["dateTo"]);
		return $mapping->findForwardConfig('success');

	}

}
