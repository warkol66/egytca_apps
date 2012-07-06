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

class PlanningConstructionsLogTabsAction extends BaseEditAction {

	function __construct() {
		parent::__construct('PlanningConstruction');
	}
	
	protected function preEdit() {
		parent::preEdit();
		$this->module = "Planning";
	}

	protected function postEdit() {
		parent::postEdit();

		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "PlanningConstruction");

		$this->smarty->assign("showLog", true);

		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));

		$maxPerPage = ConfigModule::get("planning","logsPerPage");

		if (!$this->entity->isNew())
			$this->smarty->assign("planningConstructionVersionsPager", $this->entity->getVersionsOrderedByUpdatedPaginated(Criteria::DESC, 1, $maxPerPage));

	}

}
