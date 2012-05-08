<?php
/**
* ObjectivesStrategicObjectivesShowHistoryXAction
* 
* Permite mediante Ajax recuperar un log.
* 
*/

class ObjectivesStrategicObjectivesShowHistoryXAction extends BaseAction {

	function ObjectivesStrategicObjectivesShowHistoryXAction() {
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

		$module = "Objectives";
		
		$version = PositionPeer::getLatestVersion();
		$types = ConfigModule::get("projects","positionsTypes");
		$positions = PositionPeer::getAllResponsiblesByPositionType($types,$version);
		$smarty->assign("positions",$positions);
		
		$policyGuidelines = PolicyGuidelinePeer::getAll();
		$smarty->assign("policyGuidelines",$policyGuidelines);
		
		$logId = $_GET['logId'];
		$objectiveId = $_GET['id'];
		
		if (!empty($logId)) {
			$objective = StrategicObjectiveLogQuery::create()->findPK($logId);
		}
		else if (!empty($objectiveId)) {
			$objective = StrategicObjectiveQuery::create()->findPK($objectiveId);
		}
		else {
			return $mapping->findForwardConfig('failure');
		}
		
		//caso administrador
		if (Common::isAdmin() && ($moduleConfig['useDependencies']['value'] == "YES")) {
			$dependencies = TableroDependencyPeer::getAll();
			$smarty->assign("dependencies",$dependencies);
		}
		else if ($useDependencies == "YES") {
		}

		//caso afiliado
		if (Common::isAffiliatedUser()) {
			$affiliateId = Common::getAffiliatedId();
		}
			
		$smarty->assign("objective", $objective); //se pasa el objectiveLog como si fuera un objetivo comun y correinte.
		$smarty->assign("action", "showLog");
		return $mapping->findForwardConfig('success');

	}

}
