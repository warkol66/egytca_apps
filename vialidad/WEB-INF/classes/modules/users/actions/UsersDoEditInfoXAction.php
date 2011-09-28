<?php
/** 
 * UsersDoDeleteFromGroupXAction
 *
 * @package users 
 * @subpackage groups 
 */

class UsersDoEditInfoXAction extends BaseAction {

	function UsersDoEditInfoXAction() {
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

		$user = UserPeer::get($_POST["id"]);

		if ($userPeer->update($user,$_POST["userParams"]) ) {
			Common::doLog('success','username: ' . $_POST["username"] . ' action: edit');
			return $mapping->findForwardConfig('success');
		 }
		
		$smarty->assign('errorTagId','userInfoMsgField');
		return $mapping->findForwardConfig('failure');
	}

}
