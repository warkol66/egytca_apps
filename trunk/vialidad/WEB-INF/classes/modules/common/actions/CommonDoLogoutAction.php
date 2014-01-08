<?php
/**
 * CommonDoLogoutAction
 *
 * @package common
 */

class CommonDoLogoutAction extends BaseAction {

	function CommonDoLogoutAction() {
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

			Common::doLog('success', get_class($user) . 'name: ' . $user->getUsername());

		}

		session_destroy();

		return $mapping->findForwardConfig('success');

	}

}
