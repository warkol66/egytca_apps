<?php


require_once 'BaseListAction.php';

/**
 * LIstado de Usuario registrados
 *
 * @package    planning
 * @subpackage    planningPlanningConstructions
 */
class RegistrationListAction extends BaseListAction {

    function __construct() {
        error_reporting(E_ALL & ~ E_NOTICE);
        parent::__construct('RegistrationUser');
    }

    protected function preList() {
        parent::preList();
        $this->module = "Registration";
		$this->template->template = 'TemplateJQuery.tpl';
    }

    protected function postList() {
        parent::postList();
        $this->smarty->assign("module", $this->module);
    }

}
