<?php

include_once 'BaseEditAction.php';

class PlanningProjectsShowHistoryXAction extends BaseEditAction {
    
	function __construct() {
		parent::__construct('PlanningProjectLog','Planning');
	}

	protected function postEdit() {
		parent::postEdit();

		// Si esta seteada $this->entity (PlanningProjectLog), se pasa en smarty a Project
		// para utilizar el mismo form de edicion
		if (!empty($this->entity))
			$this->smarty->assign("planningProject", $this->entity);

		$this->smarty->assign("showLog", true);
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}
    
}
