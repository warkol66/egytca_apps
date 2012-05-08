<?php

class ObjectivesStrategicObjectivesShowHistoryAction extends BaseAction {

	function ObjectivesStrategicObjectivesShowHistoryAction() {
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
		$section = "Objectives";

 		$smarty->assign("module",$module);
  	$smarty->assign("section",$section);
    	
  	$policyGuidelines = PolicyGuidelinePeer::getAll();
		$smarty->assign("policyGuidelines",$policyGuidelines);

		$objectiveId = $_GET['id'];
		$objective = StrategicObjectivePeer::get($objectiveId);
		$maxPerPage = ConfigModule::get('objectives','logsPerPage');
		$objectiveLogsPager = $objective->getLogsOrderedByUpdatedPaginated('desc', $_GET['page'], $maxPerPage);
				
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
			$smarty->assign("dependency",$valores);
		}
		
		$smarty->assign("objective",$objective);
		$smarty->assign("objectiveLogsPager", $objectiveLogsPager);
		$smarty->assign("action", "showLog");

		return $mapping->findForwardConfig('success');
	}

}
