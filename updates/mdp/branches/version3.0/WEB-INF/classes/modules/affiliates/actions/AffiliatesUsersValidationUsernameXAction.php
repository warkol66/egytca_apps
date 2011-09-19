<?php

class AffiliatesUsersValidationUsernameXAction extends BaseAction {

	function AffiliatesUsersValidationUsernameXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Validation";
		$smarty->assign('module',$module);

		$exist = 1;

		if (strlen($_POST['affiliateUser']['username']) >= 4) {
			$affiliateUsernameExists = AffiliateUserPeer::getByUsername($_POST['affiliateUser']['username']);
			if (empty($affiliateUsernameExists))
				$exist = 0;
			if (Common::hasUnifiedUsernames() && $exist == 0) {
				if (class_exists(UserPeer))
					$usernameExists = UserPeer::getByUsername($_POST['affiliateUser']['username']);
				else
					$usernameExists = NULL;
				if (!empty($usernameExists))
					$exist = 1;
			} 
		}
		else
			$minLength = 1;
		$smarty->assign('minLength',$minLength);

		$smarty->assign('name','affiliateUser[username]');
		$smarty->assign('value',$exist);
		$smarty->assign('message',$message);

		return $mapping->findForwardConfig('success');

	}

}
