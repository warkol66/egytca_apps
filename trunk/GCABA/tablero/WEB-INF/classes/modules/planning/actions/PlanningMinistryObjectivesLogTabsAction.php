<?php

require_once 'BaseEditAction.php';

class PlanningMinistryObjectivesLogTabsAction extends BaseEditAction {


	function __construct() {
		parent::__construct('MinistryObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("showLog", true);
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));

		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		if (!$this->entity->isNew())
			$this->smarty->assign("ministryObjectiveVersionsPager", $this->entity->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage));

	}

}
