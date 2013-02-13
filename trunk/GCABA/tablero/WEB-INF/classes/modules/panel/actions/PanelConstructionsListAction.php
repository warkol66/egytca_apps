<?php
/**
 * PanelConstructionsListAction
 *
 * Listado de Obras (PlanningConstruction)
 *
 * @package    panel
 * @subpackage    planningConstructions
 */

class PanelConstructionsListAction extends BaseListAction {

	function __construct() {
		parent::__construct('PlanningConstruction');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Panel";

		$this->smarty->assign("constructionTypes", PlanningConstruction::getConstructionTypes());

		if (!empty($_GET['filters']['positionCode'])) {
			if (empty($_GET['filters']['getPositionBrood']))
				$this->filters["responsiblecode"] = $_GET['filters']['positionCode'];
			else
				$this->filters["broodPositions"] = $_GET['filters']['positionCode'];
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
		$this->smarty->assign("section", "Constructions");

		if ($_GET["nav"])
			$this->smarty->assign("nav", true);
		if (!empty($_GET["filters"]["planningprojectid"]))
			$this->smarty->assign("planningProject", BaseQuery::create('PlanningProject')->findOneById($_GET["filters"]["planningprojectid"]));
	}

}
