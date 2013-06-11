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

class PlanningMinistryObjectivesLogTabsAction extends BaseEditAction {

	function __construct() {
		parent::__construct('MinistryObjective');
	}
	
	protected function preEdit() {
		parent::preEdit();
		$this->module = "Planning";
	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "MinistryObjective");

		$this->smarty->assign("showLog", true);

		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());

		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		if (!$this->entity->isNew())
			$this->smarty->assign("ministryObjectiveVersionsPager", $this->entity->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage));

	}

}
