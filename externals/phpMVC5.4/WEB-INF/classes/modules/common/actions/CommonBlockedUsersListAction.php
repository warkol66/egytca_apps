<?php

class CommonBlockedUsersListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('User');
	}
	
	protected function preList() {
		parent::preList();

		//aplicar filtro
		$this->filters['selectBlocked'] = true;
		
	}

	protected function postList() {
		parent::postList();
		
		$module = "Common";
		$this->smarty->assign("module",$module);
		
		$blockedAffiliates = AffiliateUserQuery::create()->where('AffiliateUser.BlockedAt IS NOT NULL')->find();
		$this->smarty->assign("blockedAffiliates",$blockedAffiliates);

		$this->smarty->assign("message",$_GET["message"]);

	}

}
