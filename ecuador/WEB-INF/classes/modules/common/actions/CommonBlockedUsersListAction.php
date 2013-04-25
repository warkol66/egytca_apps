<?php
//Probar
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

/*class CommonBlockedUsersListAction extends BaseAction {
	
	function CommonBlockedUsersListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);

		$smarty->assign("message",$_GET["message"]);
		
		$blockedUsers = UserQuery::create()->where('User.BlockedAt IS NOT NULL')->find();
		
		$blockedAffiliates = AffiliateUserQuery::create()->where('AffiliateUser.BlockedAt IS NOT NULL')->find();
		
		$smarty->assign("blockedUsers",$blockedUsers);
		$smarty->assign("blockedAffiliates",$blockedAffiliates);
		
		return $mapping->findForwardConfig('success');
	}

}*/
