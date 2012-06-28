<?php

require_once 'BaseEditAction.php';

class PlanningOperativeObjectivesLogTabsAction extends BaseEditAction {


	function __construct() {
		parent::__construct('OperativeObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("showLog", true);

		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));

		$this->smarty->assign("productKinds", OperativeObjective::getProductKinds());
		$this->smarty->assign("populationGenders", OperativeObjective::getPopulationGender());

		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		if (!$this->entity->isNew())
			$this->smarty->assign("operativeObjectiveVersionsPager", $this->entity->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage));

	}

}
