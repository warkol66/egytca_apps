<?php
/** 
 * CommonUsersDoUnblock
 *
 * @package users 
 */

class CommonUsersDoUnblockXAction extends BaseAction {

	function CommonUsersDoUnblockXAction() {
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
		
		if(Common::unblockUser($_POST["type"], $_POST["id"])) {
			$smarty->assign("message","success");
			$smarty->assign("id",$_POST["id"]);
		} else
			$smarty->assign("message","error");

		return $mapping->findForwardConfig('success');
	}

}
