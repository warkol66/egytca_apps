<?php
/**
 * PlanningProjectsListAction
 *
 * Listado de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningProjects
 */

class PlanningUpdateProjectsAction extends BaseListAction {

	function __construct() {
		parent::__construct('PlanningProject');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
		$this->notPaginated = true;
	}

	protected function postList() {
		parent::postList();
		foreach($this->results as $project)
			$project->doUpdateRealDates();

		die("Se actualizaron " . count($this->results) . " proyectos");

	}
}
