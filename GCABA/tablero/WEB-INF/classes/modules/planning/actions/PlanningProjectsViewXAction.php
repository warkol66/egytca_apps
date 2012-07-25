<?php
/**
 * PlanningProjectsViewXAction
 *
 * Vista via AJAX de Proyectos (PlanningProject)
 *
 * @package    planning
 * @subpackage    planningProjects
 */
require_once 'BaseEditAction.php';

class PlanningProjectsViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningProject');
	}
	
	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);

		$this->smarty->assign("show", true);

		$this->smarty->assign("startingYear", ConfigModule::get("planning","startingYear"));
		$this->smarty->assign("endingYear", ConfigModule::get("planning","endingYear"));
		if ($_GET["showGantt"]) {
			$this->smarty->assign("showGantt",true);
			$this->template->template = "TemplateAjax.tpl";
		}
	}
}
