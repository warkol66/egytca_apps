<?php

class CommonBlockedIpsDoUnblockXAction extends BaseListAction {

	function __construct() {
		parent::__construct('BlockedIp');
	}
	
	protected function preList(){
		parent::preList();
		
		$this->filters['ip'] = $_POST['ip'];
		$this->notPaginated = true;

	}
	
	protected function postList(){
		parent::postList();
		
		$module = "Common";
		$this->smarty->assign("module",$module);
		
		foreach($this->results as $ip){
			$ip->setUnblocked(true);
			$ip->save();
		}
	}
	
}
