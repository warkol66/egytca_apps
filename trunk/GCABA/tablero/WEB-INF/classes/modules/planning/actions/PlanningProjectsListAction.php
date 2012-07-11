<?php
/**
 * PlanningProjectsListAction
 *
 * Listado de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseListAction.php';

class PlanningProjectsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningProject');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Projects");

		if ($_GET["nav"])
			$this->smarty->assign("nav", true);

	}
}
