<?php
/** 
 * UsersDoActivateXAction
 *
 * @package users 
 */

class UsersDoActivateXAction extends BaseAction {

	function UsersDoActivateXAction() {
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

		//por ser una action ajax.		
		$this->template->template = "TemplateAjax.tpl";

		$module = "Users";

		$userPeer = new UserPeer();

		if ( $userPeer->activate($_GET["user"]) ) {
			Common::doLog('success','userId: ' . $_GET["user"]);
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure','userId: ' . $_GET["user"]);
			return $mapping->findForwardConfig('failure');
		}

	}

}
