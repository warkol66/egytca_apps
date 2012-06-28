<?php

require_once 'BaseEditAction.php';

class PlanningImpactObjectivesLogTabsAction extends BaseEditAction {


	function __construct() {
		parent::__construct('ImpactObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("showLog", true);
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		$this->smarty->assign("policyGuidelines", ImpactObjective::getPolicyGuidelines());
		$this->smarty->assign("expectedResults", ImpactObjective::getExpectedResults());


		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		if (!$this->entity->isNew())
			$this->smarty->assign("impactObjectiveVersionsPager", $this->entity->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage));

	}

}
