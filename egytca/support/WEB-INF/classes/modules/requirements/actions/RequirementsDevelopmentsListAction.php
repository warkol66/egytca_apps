<?php
/**
 * RequirementsDevelopmentsListAction
 *
 * Listado de Desarrollos (Development)
 *
 * @package    requirements
 * @subpackage    development
 */

class RequirementsDevelopmentsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Development');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Requirements";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
	}
}
