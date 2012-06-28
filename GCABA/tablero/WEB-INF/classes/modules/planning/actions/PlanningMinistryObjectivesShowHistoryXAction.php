<?php

include_once 'BaseEditAction.php';

class PlanningMinistryObjectivesShowHistoryXAction extends BaseEditAction {
    
	function __construct() {
		parent::__construct('MinistryObjectiveLog','Planning');
	}

	protected function postEdit() {
		parent::postEdit();

		// Si esta seteada $this->entity (MinistryObjectiveLog), se pasa en smarty a MinistryObjective
		// para utilizar el mismo form de edicion
		if (!empty($this->entity))
			$this->smarty->assign("ministryObjective", $this->entity);

		$this->smarty->assign("showLog", true);
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));

	}
    
}
