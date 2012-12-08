<?php


require_once 'BaseListAction.php';

/**
 * LIstado de Usuario registrados
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
	    $this->perPage=2;
        $this->module = "Registration";
		$this->template->template = 'TemplateJQuery.tpl';
	    if(!isset($this->filters["includeDeleted"]))
	    $this->query=$this->query->filterByDeleted(0);
    }

    protected function postList() {
        parent::postList();
        $this->smarty->assign("module", $this->module);
    }

}
