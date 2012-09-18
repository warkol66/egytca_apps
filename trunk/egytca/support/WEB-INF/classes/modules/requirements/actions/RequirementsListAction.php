<?php
/**
 * RequirementsListAction
 *
 * Listado de Obras (ImpactObjective)
 *
 * @package    planning
 * @subpackage    planningImpactObjectives
 */
require_once 'BaseListAction.php';

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
