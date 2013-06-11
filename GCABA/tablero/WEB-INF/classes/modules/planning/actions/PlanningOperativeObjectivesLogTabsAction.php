<?php
/**
 * PlanningProjectsLogTabsAction
 *
 * Acceso a vista de versiones de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseEditAction.php';

class PlanningOperativeObjectivesLogTabsAction extends BaseEditAction {

	function __construct() {
		parent::__construct('OperativeObjective');
	}
	
	protected function preEdit() {
		parent::preEdit();
		$this->module = "Planning";
	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "PlanningProject");

		$this->smarty->assign("showLog", true);

		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());

		$this->smarty->assign("productKinds", OperativeObjective::getProductKinds());
		$this->smarty->assign("populationGenders", OperativeObjective::getPopulationGender());

		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		if (!$this->entity->isNew())
			$this->smarty->assign("operativeObjectiveVersionsPager", $this->entity->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage));

	}

}
