<?php
/**
 * PlanningActivitiesListAction
 *
 * Listado de Obras (PlanningActivities)
 *
 * @package    planning
 * @subpackage    planningPlanningActivities
 */

class PlanningActivitiesListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningActivity');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";

		if (!empty($_GET['filters']['positionCode'])) {
			if (empty($_GET['filters']['getPositionBrood']))
				$this->filters["responsiblecode"] = $_GET['filters']['positionCode'];
			else
				$this->filters["broodPositions"] = $_GET['filters']['positionCode'];
		}

		if (!empty($_GET['filters']['projectId'])) {
			$this->filters["objecttype"] = "Project";
			$this->filters["objectid"] = $_GET['filters']['projectId'];
		}

		//Si es csv: no paginado, external vacio y para descargar
		if ($_GET["csv"]) {
			$this->notPaginated = true;
			$this->smarty->assign("csv", true);
			$this->template->template = 'TemplateAjax.tpl';
			header('Content-type: text/csv');
			header('Content-disposition: attachment;filename=export_' . time() . '.csv');
		}

	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Activities");
	}
}
