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

		$fieldname = 'params[username]';
		$exist = 1;

		if ($_POST['params']['username'] == $_POST['actualparams']['username'])
			$exist = 0;
		else {
			if (strlen($_POST['params']['username']) >= 4) {
				$usernameExists = UserQuery::create()->findOneByUsername($_POST['params']['username']);
				if (!empty($usernameExists))
					$exist = 1;
				else if (Common::hasUnifiedUsernames()) {
					if (class_exists('AffiliateUser'))
						$affiliateUsernameExists = AffiliateUserQuery::create()->findOneByUsername($_POST['params']['username']);
					if (class_exists('ClientUser'))
						$clientUsernameExists = ClientUserQuery::create()->findOneByUsername($_POST['params']['username']);
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
