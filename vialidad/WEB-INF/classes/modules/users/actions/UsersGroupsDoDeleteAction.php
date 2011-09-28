<?php
/** 
 * UsersGroupsDoDeleteAction
 *
 * @package users 
 * @subpackage groups 
 */

class UsersGroupsDoDeleteAction extends BaseAction {

	function UsersGroupsDoDeleteAction() {
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

		$module = "Users";
		$section = "Groups";

		$groupPeer = new GroupPeer();

		if ( $groupPeer->delete($_GET["group"]) ) {
			Common::doLog('success','groupId: ' . $_GET["group"]);
			return $mapping->findForwardConfig('success');
		}		
		else {
			Common::doLog('failure','groupId: ' . $_GET["group"]);
			return $mapping->findForwardConfig('failure');
		}

	}

}
