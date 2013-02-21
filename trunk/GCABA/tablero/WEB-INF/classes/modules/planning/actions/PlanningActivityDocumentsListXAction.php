<?php

class PlanningActivityDocumentsListXAction extends BaseListAction {
	
	public function __construct() {
		parent::__construct('PlanningActivityDocument');
	}
	
	protected function preList() {
		parent::preList();
		$this->query->filterByPlanningActivityId($_GET['id']);
		$this->template->template = 'TemplateAjax.tpl';
	}
}