<?php

/**
 * Listado de Usuario registrados
 *
 * @package    planning
 * @subpackage    planningPlanningConstructions *
 * @property RegistrationUserQUERY $query
 */
class RegistrationListAction extends BaseListAction {

	function __construct() {
		parent::__construct('RegistrationUser');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Registration";
		if(!isset($this->filters["includeDeleted"]))
			$this->query=$this->query->filterByDeleted(0);
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
	}

}
