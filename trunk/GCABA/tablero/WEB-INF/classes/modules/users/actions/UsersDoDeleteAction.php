<?php
/** 
 * UsersDoDeleteAction
 *
 * @package users 
 */

require_once("BaseAction.php");
require_once("UserPeer.php");

class UsersDoDeleteAction extends BaseAction {

	function UsersDoDeleteAction() {
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

		$userPeer = new UserPeer();

//		if ( $userPeer->recoverDelete($_GET["user"]) ) {
		if ( $userPeer->softDelete($_GET["user"]) ) {
//		if ( $userPeer->hardDelete($_GET["user"]) ) {
//		if ( $userPeer->delete($_GET["user"]) ) {
//		if ( $userPeer->deleteOnCascade($_GET["user"]) ) {
			Common::doLog('success','userId: ' . $_GET["user"]);
			return $mapping->findForwardConfig('success');
		}
		else {
			Common::doLog('failure','userId: ' . $_GET["user"]);
			return $mapping->findForwardConfig('failure');
		}

	}

}
