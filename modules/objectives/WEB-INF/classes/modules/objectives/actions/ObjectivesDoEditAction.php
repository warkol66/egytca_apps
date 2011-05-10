<?php

require_once("ObjectivesEditBaseAction.php");

class ObjectivesDoEditAction extends ObjectivesEditBaseAction {

	function ObjectivesDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$smarty = $this->prepareSmarty($mapping,$smarty);
		
		$paramsObjective = $_POST['paramsObjective'];

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un objective existente
			$objective = ObjectivePeer::get($_POST["id"]);

		} else {
			//estoy creando un nuevo objective
			$objective = new Objective();
								
			//caso administrador
			if (Common::isAdmin()) {
				$valores = TableroDependencyPeer::getAll();
				$smarty->assign("dependencyId_valores",$valores);
			}

			//caso afiliado
			if (Common::isAffiliatedUser()) {
				$affiliateId = Common::getAffiliatedId();
				$valores = TableroDependencyPeer::get($affiliateId);
				$smarty->assign("dependency",$valores);
			}

			$this->prepareRegionsAndCommunes($mapping,$smarty,$objective);	
		}
		$objective = Common::setObjectFromParams($objective,$paramsObjective);
		
		if (!$objective->save())
			return $this->returnFailure($mapping,$smarty,$objective);
				
		if (isset($_POST['show']))
			return $mapping->findForwardConfig('success-show');

		return $mapping->findForwardConfig('success');
	}

}
