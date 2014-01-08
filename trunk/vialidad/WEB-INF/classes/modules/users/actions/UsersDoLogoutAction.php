<?php
/**
 * UsersDoLogoutAction
 *
 * @package users
 */

class UsersDoLogoutAction extends BaseAction {

	function UsersDoLogoutAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$user = Common::getLoggedUser();

		if (!empty($user) && is_object($user)) {

			if(method_exists($user,"setSession"))
				$user->setSession(null)->save();

			Common::doLog('success','username: ' . $user->getUsername());

		}

		session_destroy();

		return $mapping->findForwardConfig('success');

	}

}
