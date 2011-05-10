<?php

require_once("ObjectivesEditBaseAction.php");

class ObjectivesViewXAction extends ObjectivesEditBaseAction {

	function ObjectivesViewXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

    /**
    * Use a different template
    */
		$this->template->template = "TemplateAjax.tpl";

		$smarty = $this->prepareSmarty($mapping,$smarty);

		if ( !empty($_GET["id"]) ) {

			$objective = ObjectivePeer::get($_GET["id"]);
			$this->prepareDependencies($mapping,$smarty,$objective);
			
			if (Common::isAffiliatedUser() && (!$objective->isOwner(Common::getAffiliatedId()))) {
				//se estaba intentando modificar algo que no le pertenecia
			}
			$smarty->assign("objective",$objective);
			$smarty->assign("action","showLog");
		}
		else
				return $mapping->findForwardConfig('failure');

		$this->prepareRegionsAndCommunes($mapping,$smarty,$objective);
		$this->prepareStrategicObjectives($mapping,$smarty,$objective);

		return $mapping->findForwardConfig('success');
	}

}
