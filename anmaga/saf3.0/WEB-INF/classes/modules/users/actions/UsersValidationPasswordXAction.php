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

			$name = 'currentPass';
			$match = 1;

			$user = $_SESSION['loginUser'];

			$currentPass = $_POST['currentPass'] . "ASD";
			if ( md5($currentPass) == $user->getPassword() )
				$match = 0;

			$smarty->assign('name',$name);
			$smarty->assign('value',$match);
			$smarty->assign('message',$message);

			return $mapping->findForwardConfig('success');

	}

}
