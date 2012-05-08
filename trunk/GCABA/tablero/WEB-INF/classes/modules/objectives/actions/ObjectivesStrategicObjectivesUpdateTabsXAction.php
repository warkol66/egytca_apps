<?php
/**
* ObjectivesStrategicObjectivesUpdateTabsXAction
* 
* Permite mediante Ajax actualizar las tabs de los logs al cambiar de pagina.
* 
*/

require_once("BaseAction.php");

class ObjectivesStrategicObjectivesUpdateTabsXAction extends BaseAction {

	function ObjectivesStrategicObjectivesUpdateTabsXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Objectives";
		
		$objectiveId = $_GET['id'];
		$objective = StrategicObjectivePeer::get($objectiveId);
		$maxPerPage = ConfigModule::get('objectives','logsPerPage');
		$objectiveLogsPager = $objective->getLogsOrderedByUpdatedPaginated('desc', $_GET['page'], $maxPerPage);
		
		$smarty->assign("objective", $objective);
		$smarty->assign("objectiveLogsPager", $objectiveLogsPager);

		return $mapping->findForwardConfig('success');
		
	}

}
