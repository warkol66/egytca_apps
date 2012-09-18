<?php

require_once 'BaseListAction.php';

class AffiliatesUsersListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('AffiliateUser');
	}
	
	protected function post() {
		parent::post();
		$this->smarty->assign("module", "Affiliates");
		$this->smarty->assign("section", "Users");
	}
}
