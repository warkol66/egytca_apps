<?php
/**
 * PlanningProjectsListAction
 *
 * Listado de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningProjects
 */

class PlanningUpdateConstructionsAction extends BaseListAction {

	function __construct() {
		parent::__construct('PlanningConstruction');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
		$this->notPaginated = true;
	}

	protected function postList() {
		parent::postList();
		foreach($this->results as $construction)
			$construction->doUpdateRealDates();

		die("Se actualizaron " . count($this->results) . " obras");
	}
}
