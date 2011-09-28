<?php
/**
* ActionlogsPurgeAction
*
*  Borra desde una determinada fecha, hasta otra, datos de la base de datos
*  Los datos a borrar requieren confirmacion, una vez confirmado, borra
*  determinados datos y reconfigura la tabla
*
* @package actionlogs
*/

require_once("BaseAction.php");

class CommonActionLogsPurgeAction extends BaseAction {

	function CommonActionLogsPurgeAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "actionlogs";
		$smarty->assign("module",$module);

		$oldestLogDate = ActionLogPeer::oldestLogDate();

		///////
		/// usado para mostrar 2 fechas a listar, que seran primer registro y hace un mes
		$smarty->assign("dateFrom",$oldestLogDate);        
		$smarty->assign("dateTo",date('d-m-Y',mktime(0,0,0,date("m")-1,date("d"),date("Y"))));        
		
		return $mapping->findForwardConfig('success');

	}

}
