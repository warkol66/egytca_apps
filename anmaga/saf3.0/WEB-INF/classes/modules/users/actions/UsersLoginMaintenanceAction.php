<?php
/** 
 * UsersLoginMaintenanceAction
 *
 * @package users 
 */

class UsersLoginMaintenanceAction extends BaseAction {

	function UsersLoginMaintenanceAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);
  	/**
   	* Use a different template
   	*/
		$this->template->template = "TemplateLogin.tpl";
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Users";
		
		$smarty->assign("onlyAdmin",true);

		return $mapping->findForwardConfig('success');
	}

}
