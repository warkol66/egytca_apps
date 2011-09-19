<?php

class UsersValidationUsernameXAction extends BaseAction {

	function UsersValidationUsernameXAction() {
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

		$fieldname = 'userParams[username]';
		$exist = 1;

		if ($_POST['userParams']['username'] == $_POST['actualuserParams']['username'])
			$exist = 0;
		else {
			if (strlen($_POST['userParams']['username']) >= 4) {
				$usernameExists = UserPeer::getByUsername($_POST['userParams']['username']);
				if (!empty($usernameExists))
					$exist = 1;
				else if (Common::hasUnifiedUsernames()) {
					if (class_exists(AffiliateUserPeer))
						$affiliateUsernameExists = AffiliateUserPeer::getByUsername($_POST['userParams']['username']);
					if (class_exists(ClientUserPeer))
						$clientUsernameExists = ClientUserPeer::getByUsername($_POST['userParams']['username']);
					if (empty($affiliateUsernameExists) && empty($clientUsernameExists))
						$exist = 0;
				}
				else
					$exist = 0;
			}
			else {
				$minLength = 1;
				$smarty->assign('minLength',$minLength);
			}
		}

		$smarty->assign('name',$fieldname);
		$smarty->assign('value',$exist);

		return $mapping->findForwardConfig('success');
	}
}
