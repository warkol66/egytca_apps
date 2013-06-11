<?php

include_once 'BaseEditAction.php';

class PlanningOperativeObjectivesShowHistoryXAction extends BaseEditAction {
    
	function __construct() {
		parent::__construct('OperativeObjectiveLog');
	}

	protected function postEdit() {
		parent::postEdit();

		// Si esta seteada $this->entity (ImpactObjectiveLog), se pasa en smarty a OperativeObjective
		// para utilizar el mismo form de edicion
		if (!empty($this->entity))
			$this->smarty->assign("operativeObjective", $this->entity);

		$this->smarty->assign("showLog", true);

		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());

		$this->smarty->assign("productKinds", OperativeObjective::getProductKinds());
		$this->smarty->assign("populationGenders", OperativeObjective::getPopulationGender());

	}
    
}
