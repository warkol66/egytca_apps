<?php

include_once 'BaseEditAction.php';

class PlanningConstructionsShowHistoryXAction extends BaseEditAction {
    
	function __construct() {
		parent::__construct('PlanningConstructionLog','Planning');
	}

	protected function postEdit() {
		parent::postEdit();

		// Si esta seteada $this->entity (PlanningConstructionLog), se pasa en smarty a Project
		// para utilizar el mismo form de edicion
		if (!empty($this->entity))
			$this->smarty->assign("planningConstruction", $this->entity);

		$this->smarty->assign("showLog", true);
		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
	}
    
}
