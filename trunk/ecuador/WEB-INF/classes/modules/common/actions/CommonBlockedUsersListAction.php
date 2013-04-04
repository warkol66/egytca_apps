<?php

class CommonBlockedUsersListAction extends BaseAction {
	
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
		
		/*echo('<pre>');
		print_r($blockedAffiliateUsers);
		echo('</pre>');
		die();*/

		return $mapping->findForwardConfig('success');
	}

}
