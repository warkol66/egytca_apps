<?php


class VialidadConstructionsReportAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Construction');
	}
	protected function preList() {
		parent::preList();
		
		$constructions = ConstructionQuery::create()->find();
		$this->smarty->assign('constructions', $constructions);
		
		$time = time();
		$this->smarty->assign('date', $time);
		require_once 'Period.php';
		$period = new Period(date('Y-m-d', $time), 'Y-m-d');
		$this->smarty->assign('period', $period);

		$this->smarty->assign("types",ConstructionTypeQuery::create()->find());
		
	}

	protected function postList() {
		parent::postList();
		
		if ($_REQUEST['report']) {
			$this->smarty->assign('report', true);
			$this->template->template = 'TemplatePlain.tpl';
		}

	}

}
