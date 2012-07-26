<?php
/**
 * PlanningIndicatorsEditAction
 *
 * Formulario de modificacion de Indicadores de Planeamiento (PlanningIndicator) extendiendo BaseEditAction
 *
 * @package    planning
 * @subpackage    planningIndicators
 */
require_once 'BaseEditAction.php';

class PlanningIndicatorsViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningIndicator','Planning');
	}

	protected function preEdit() {
		parent::preEdit();
		$this->module = "Planning";
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Indicators");
		$this->smarty->assign("indicatorTypes", PlanningIndicator::getIndicatorTypes());
		$this->smarty->assign("measureFrecuencyTypes", PlanningIndicator::getMeasureFrecuencyTypes());
		$this->smarty->assign("expectedResultsTypes", PlanningIndicator::getExpectedResultsTypes());
		$this->smarty->assign("goalTypes", PlanningIndicator::getGoalTypes());
		$this->smarty->assign("trendTypes", PlanningIndicator::getTrendTypes());
		if (!$this->isAjax())
			$this->template->template = "TemplateBasic.tpl";
		$this->smarty->assign("show", true);
	}
}
