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

		$user = Common::getLoggedUser();

		if (!empty($user) && is_object($user)) {

			if(method_exists($user,"setSession"))
				$user->setSession(null)->save();

			if(method_exists($user,"getUsername"))
				Common::doLog('success','username: ' . $user->getUsername());

		}

		session_destroy();

		return $mapping->findForwardConfig('success');

	}

}
