<?php
/**
 * PlanningProjectTagsListAction
 *
 * Listado de Etiquetas de proyectos extendiendo BaseListAction
 *
 * @package    actors
 */

class PlanningProjectTagsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('PlanningProjectTag');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Planning";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "PlanningProjectTags");
	}
}
