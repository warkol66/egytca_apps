<?php

class CommonBlockedIpsListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('BlockedIp');
	}
	
	protected function preList() {
		parent::preList();

		//aplicar filtro
		$this->filters['selectDistinctIp'] = true;
		$this->filters['unblocked'] = 'false';
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Common";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("message",$_GET["message"]);

	}

}

