<?php
/**
 * PlanningConstructionsFixAction
 *
 * Listado de Obras (PlanningConstruction)
 *
 * @package    planning
 * @subpackage    planningPlanningConstructions
 */

class PlanningConstructionsFixAction extends BaseListAction {

	function __construct() {
		parent::__construct('PlanningConstruction');
	}

	protected function preList() {
		parent::preList();
		$this->notPaginated = true;
	}

	protected function postList() {
		parent::postList();
		foreach ($this->results as $construction) {
			$construction->doUpdateRealDates();
		}
		die('Ejecutado sobre ' . $this->results->count() . ' registros');	

	}

}
