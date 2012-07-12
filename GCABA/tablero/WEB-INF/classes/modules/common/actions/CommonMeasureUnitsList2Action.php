<?php
/**
 * CommonMeasureUnitsListAction
 *
 * Listado de Unidades de Medida basado en BaseListAction
 */
require_once 'BaseListAction.php';

class CommonMeasureUnitsList2Action extends BaseListAction {

	function __construct() {
		parent::__construct('MeasureUnit');
	}
	protected function preList() {
		parent::preList();

		$this->notPaginated = true;
		$this->module = "Common";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Constructions");
		$this->template->template = 'TemplateJQuery.tpl';
	}
}
