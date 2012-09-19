<?php
/**
 * RequirementsListAction
 *
 * Listado de Reqeurimientos (Requirement)
 *
 * @package    requirement
 */

class RequirementsListAction extends BaseListAction {

	function __construct() {
		parent::__construct('Requirement');
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
