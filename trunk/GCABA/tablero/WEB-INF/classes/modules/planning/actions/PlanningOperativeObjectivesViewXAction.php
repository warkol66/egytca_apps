<?php
/**
 * PlanningOperativeObjectivesViewXAction
 *
 * Vista via AJAX de Objetivos Operativos (OperativeObjective)
 *
 * @package    planning
 * @subpackage    planningOperativeObjectives
 */

require_once 'BaseEditAction.php';

class PlanningOperativeObjectivesViewXAction extends BaseEditAction {

	function __construct() {
		parent::__construct('OperativeObjective');
	}

	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));

		$this->smarty->assign("productKinds", OperativeObjective::getProductKinds());
		$this->smarty->assign("populationGenders", OperativeObjective::getPopulationGender());

	}
}
