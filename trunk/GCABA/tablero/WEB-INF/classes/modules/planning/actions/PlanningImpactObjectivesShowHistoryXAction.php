<?php

include_once 'BaseEditAction.php';

class PlanningImpactObjectivesShowHistoryXAction extends BaseEditAction {
    
	function __construct() {
		parent::__construct('ImpactObjectiveLog','Planning');
	}

	protected function postEdit() {
		parent::postEdit();

		// Si esta seteada $this->entity (ImpactObjectiveLog), se pasa en smarty a ImpactObjective
		// para utilizar el mismo form de edicion
		if (!empty($this->entity))
			$this->smarty->assign("impactObjective", $this->entity);

		$this->smarty->assign("showLog", true);
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("policyGuidelines", ImpactObjective::getPolicyGuidelines());
		$this->smarty->assign("expectedResults", ImpactObjective::getExpectedResults());
	}
    
}
