<?php
/** 
 * UsersDoActivateAction
 *
 * @package users 
 */

class UsersDoActivateAction extends BaseAction {

	function UsersDoActivateAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		$module = "Users";

		if (User::activate($_GET["user"])) {
			Common::doLog('success','userId: ' . $_GET["user"]);
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure','userId: ' . $_GET["user"]);
			return $mapping->findForwardConfig('failure');
		}

	}

}
