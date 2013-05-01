<?php

class BoardDatesValidateXAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BoardChallenge');
	}
	
	protected function preList() {
		parent::preList();
		
		if(isset($_POST['id']))
			$this->filters['selectBetweenDates'] = array($_POST['id'],$_POST['params']['endDate'],$_POST['params']['startDate']);
		else
			$this->filters['selectBetweenDates'] = array(null,$_POST['params']['endDate'],$_POST['params']['startDate']);
		
		//ver como arreglar el tema de los filtros
		if(!empty($_POST['params']['endDate']) && !empty($_POST['params']['startDate'])){
			$this->filters['dateRange']['startdate']['max'] = $_POST['params']['startDate'];
            $this->filters['dateRange']['enddate']['min'] = $_POST['params']['endDate'];
		}
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Board";
		$this->smarty->assign("module", $module);
		
		if(empty($_POST['params']['endDate']) || empty($_POST['params']['startDate']))
			$this->smarty->assign("dateMessage","error");
		else
			if(is_object($this->results))
				$this->smarty->assign("dateMessage","invalid");

	}

}
