<?php

require_once 'BaseEditAction.php';

class PlanningActivitiesViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningActivity');
	}
	
	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());
	}
}
