<?php

require_once 'BaseEditAction.php';

class PlanningMinistryObjectivesViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('MinistryObjective','Planning');
	}
	
	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

		$this->smarty->assign("regions", RegionQuery::create()->filterByType('11')->find());
		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());
	}
}
