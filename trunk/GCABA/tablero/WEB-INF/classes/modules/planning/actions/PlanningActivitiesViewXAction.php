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

		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}
}
