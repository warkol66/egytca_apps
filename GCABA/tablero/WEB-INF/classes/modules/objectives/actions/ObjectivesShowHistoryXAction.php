<?php
/**
* ObjectivesShowHistoryXAction
* 
* Permite mediante Ajax recuperar un log.
* 
* @package  projects
*/

require_once("BaseAction.php");

class ObjectivesShowHistoryXAction extends BaseAction {

	function ObjectivesShowHistoryXAction() {
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
		
		$version = PositionPeer::getLatestVersion();
		$types = ConfigModule::get("projects","positionsTypes");
		$positions = PositionPeer::getAllResponsiblesByPositionType($types,$version);
		$smarty->assign("positions",$positions);
		
		$logId = $_GET['logId'];
		if (!empty($logId)) {
			$objectiveLog = ObjectiveLogQuery::create()->findPK($logId);
		}
		$objectiveId = $_GET['id'];
		if (!empty($objectiveId)) {
			$objective = ObjectiveQuery::create()->findPK($objectiveId);
		}
		if(!empty($objective)) {
			$smarty->assign("objective", $objective);
			$smarty->assign("action", "showLog");
			return $mapping->findForwardConfig('success');
		} elseif(!empty($objectiveLog)) {
			$smarty->assign("objective", $objectiveLog); //se pasa el objectiveLog como si fuera un objetivo comun y correinte.
			$smarty->assign("action", "showLog");
			return $mapping->findForwardConfig('success');
		} else {
			return $mapping->findForwardConfig('failure');
		}
	}

}
