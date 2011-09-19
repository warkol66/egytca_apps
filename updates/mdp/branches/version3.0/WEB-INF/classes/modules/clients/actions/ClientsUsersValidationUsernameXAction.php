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

		$exist = 1;

		if (strlen($_POST['clientUser']['username']) >= 4) {
			$clientUsernameExists = ClientUserPeer::getByUsername($_POST['clientUser']['username']);
			if (empty($clientUsernameExists))
				$exist = 0;
			if (Common::hasUnifiedUsernames() && $exist == 0) {
				if (class_exists(UserPeer))
					$usernameExists = UserPeer::getByUsername($_POST['clientUser']['username']);
				else
					$usernameExists = NULL;
				if (!empty($usernameExists))
					$exist = 1;
			} 
		}
		else
			$minLength = 1;
		$smarty->assign('minLength',$minLength);

		$smarty->assign('name','clientUser[username]');
		$smarty->assign('value',$exist);
		$smarty->assign('message',$message);

		return $mapping->findForwardConfig('success');

	}

}
