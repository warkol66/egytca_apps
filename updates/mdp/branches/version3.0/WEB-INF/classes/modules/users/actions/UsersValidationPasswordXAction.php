<?php
/**
 * UsersValidationPasswordXAction
 *
 * @package users
 */

class UsersValidationPasswordXAction extends BaseAction {

	function UsersValidationPasswordXAction() {
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

			$name = 'currentPass';
			$match = 1;

			$user = $_SESSION['loginUser'];

			$currentPass = Common::md5($_POST['currentPass']);
			if ($currentPass == $user->getPassword() )
				$match = 0;

			$smarty->assign('name',$name);
			$smarty->assign('value',$match);

			return $mapping->findForwardConfig('success');

	}

}
