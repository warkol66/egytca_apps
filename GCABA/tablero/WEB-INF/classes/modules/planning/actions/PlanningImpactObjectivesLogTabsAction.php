<?php
/**
 * PlanningImpactObjectivesLogTabsAction
 *
 * Acceso a vista de versiones de Objetivos de Impacto (ImpactObjective)
 *
 * @package    planning
 * @subpackage    planningImpactObjectives
 */
require_once 'BaseEditAction.php';

class PlanningImpactObjectivesLogTabsAction extends BaseEditAction {

	function __construct() {
		parent::__construct('ImpactObjective');
	}
	
	protected function preEdit() {
		parent::preEdit();
		$this->module = "Planning";
	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "ImpactObjectives");

		$this->smarty->assign("showLog", true);
		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());
		$this->smarty->assign("policyGuidelines", ImpactObjective::getPolicyGuidelines());
		$this->smarty->assign("expectedResults", ImpactObjective::getExpectedResults());

		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		if (!$this->entity->isNew())
			$this->smarty->assign("impactObjectiveVersionsPager", $this->entity->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage));

	}

}
