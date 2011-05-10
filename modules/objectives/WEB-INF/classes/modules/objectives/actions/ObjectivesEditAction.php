<?php

require_once("ObjectivesEditBaseAction.php");

class ObjectivesEditAction extends ObjectivesEditBaseAction {

	function ObjectivesEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$smarty = $this->prepareSmarty($mapping,$smarty);

		if ( !empty($_GET["id"]) ) {

			$objective = ObjectivePeer::get($_GET["id"]);
			$this->prepareDependencies($mapping,$smarty,$objective);
			
			//esto se hace afuera del if, no se por qué esta acá.
			//$this->prepareStrategicObjectives($mapping,$smarty,$objective);
			
			if (Common::isAffiliatedUser() && (!$objective->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
				return $mapping->findForwardConfig('failure');
			}
			$smarty->assign("objective",$objective);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un objective nuevo
			$objective = new Objective();
			$smarty->assign("objective",$objective);
			$smarty->assign("action","create");
		}

		$this->prepareRegionsAndCommunes($mapping,$smarty,$objective);
		$this->prepareStrategicObjectives($mapping,$smarty,$objective);

		return $mapping->findForwardConfig('success');
	}

}
