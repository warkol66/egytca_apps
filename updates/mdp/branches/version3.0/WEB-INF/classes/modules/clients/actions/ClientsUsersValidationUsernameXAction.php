<?php

class ClientsUsersValidationUsernameXAction extends BaseAction {

	function ClientsUsersValidationUsernameXAction() {
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

		$fieldname = 'clientUser[username]';
		$exist = 1;

		if ($_POST['clientUser']['username'] == $_POST['actualclientUser']['username'])
			$exist = 0;
		else {
			if (strlen($_POST['clientUser']['username']) >= 4) {
				$usernameExists = ClientUserPeer::getByUsername($_POST['clientUser']['username']);
				if (!empty($usernameExists))
					$exist = 1;
				else if (Common::hasUnifiedUsernames()) {
					if (class_exists(UserPeer))
						$usersUsernameExists = UserPeer::getByUsername($_POST['clientUser']['username']);
					if (class_exists(AffiliateUserPeer))
						$affiliateUsernameExists = AffiliateUserPeer::getByUsername($_POST['clientUser']['username']);
					if (empty($usersUsernameExists) && empty($affiliateUsernameExists))
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
