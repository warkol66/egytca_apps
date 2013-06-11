<?php
/**
 * PlanningImpactObjectivesViewXAction
 *
 * Vista via AJAX de Objetivos de Impacto (ImpactObjective)
 *
 * @package    planning
 * @subpackage    planningImpactObjectives
 */
require_once 'BaseEditAction.php';

class PlanningImpactObjectivesViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('ImpactObjective');
	}
	
	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());
		$this->smarty->assign("policyGuidelines", ImpactObjective::getPolicyGuidelines());
		$this->smarty->assign("expectedResults", ImpactObjective::getExpectedResults());
	}
}
