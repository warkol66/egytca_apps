<?php
/**
 * PlanningMeasureUnitsListAction
 *
 * Listado de Unidades de Medida basado en BaseListAction
 */
require_once 'BaseListAction.php';

class PlanningMeasureUnitsListAction extends BaseListAction {

	function __construct() {
		parent::__construct('PlanningMeasureUnit');
	}
	protected function preList() {
		parent::preList();

		$this->notPaginated = true;
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Constructions");
	}
}
