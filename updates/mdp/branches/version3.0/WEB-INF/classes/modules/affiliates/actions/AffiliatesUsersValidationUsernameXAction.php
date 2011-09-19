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

		$fieldname = 'affiliateUser[username]';
		$exist = 1;

		if ($_POST['affiliateUser']['username'] == $_POST['actualaffiliateUser']['username'])
			$exist = 0;
		else {
			if (strlen($_POST['affiliateUser']['username']) >= 4) {
				$usernameExists = AffiliateUserPeer::getByUsername($_POST['affiliateUser']['username']);
				if (!empty($usernameExists))
					$exist = 1;
				else if (Common::hasUnifiedUsernames()) {
					if (class_exists(UserPeer))
						$usersUsernameExists = UserPeer::getByUsername($_POST['affiliateUser']['username']);
					if (class_exists(ClientUserPeer))
						$clientUsernameExists = ClientUserPeer::getByUsername($_POST['affiliateUser']['username']);
					if (empty($usersUsernameExists) && empty($clientUsernameExists))
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
