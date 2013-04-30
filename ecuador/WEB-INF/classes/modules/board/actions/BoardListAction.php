<?php

class BoardListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function preList() {
		parent::preList();
		
		if(!empty($_GET['filters']['minDate']) || !empty($_GET['filters']['maxDate']))
			unset($this->filters['dateRange']);
		if(!empty($_GET['filters']['minDate'])){
            $this->filters['dateRange']['creationdate']['min'] = $_GET['filters']['minDate'];
        }
        if(!empty($_GET['filters']['maxDate'])){
            $this->filters['dateRange']['creationdate']['max'] = $_GET['filters']['maxDate'];
		}
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Board";
		$this->smarty->assign("module", $module);

		if(!empty($_GET['filters']['dateRange']['creationdate']['min']))
            $this->filters['minDate'] = $_GET['filters']['dateRange']['creationdate']['min'];
        if(!empty($_GET['filters']['dateRange']['creationdate']['max']))
            $this->filters['maxDate'] = $_GET['filters']['dateRange']['creationdate']['max'];
		
		$this->smarty->assign("filters",$this->filters);
		
		$this->smarty->assign("boardChallengeStatus",BoardEntry::getStatuses());

	}

}
