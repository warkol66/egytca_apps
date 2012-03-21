<?php

class UsersValidationUsernameXAction extends BaseAction {

	function UsersValidationUsernameXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Validation";
		$smarty->assign('module',$module);

		$fieldname = 'userParams[username]';
		$exist = 1;

		if (strlen($_POST['userParams']['username']) >= 4) {
			if (Common::hasUnifiedUsernames()) {
				$usernameExists = UserPeer::getByUsername($_POST['userParams']['username']);
				if (class_exists(AffiliateUserPeer))
					$AffiliateUsernameExists = AffiliateUserPeer::getByUsername($_POST['userParams']['username']);
				else
					$AffiliateUsernameExists = NULL;
				if (empty($usernameExists) && empty($AffiliateUsernameExists))
					$exist = 0;
			}
			else {
				$usernameExists = UserPeer::getByUsername($_POST['userParams']['username']);
				if (empty($usernameExists))
					$exist = 0;
			}
		}
		else
			$minLength = 1;

		$smarty->assign('minLength',$minLength);

		$smarty->assign('name',$fieldname);
		$smarty->assign('value',$exist);
		$smarty->assign('message',$message);

		return $mapping->findForwardConfig('success');

	}

}
