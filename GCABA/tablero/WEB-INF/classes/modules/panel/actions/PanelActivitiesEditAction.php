<?php

require_once 'BaseEditAction.php';

class PanelActivitiesEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('PlanningActivity');
	}
	
	protected function postEdit() {
		parent::postEdit();
		$this->smarty->assign("startingYear", Common::getStartingYear());
		$this->smarty->assign("endingYear", Common::getEndingYear());
		$this->smarty->assign("tenderTypes", PlanningConstruction::getTenderTypes());
	}
}
