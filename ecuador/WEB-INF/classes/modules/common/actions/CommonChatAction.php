<?php

class CommonChatAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$loggedUser = Common::getLoggedUser();
		$smarty->assign('userName', $loggedUser->getUserName());
		$smarty->assign('password', $loggedUser->getPassword());
		return $mapping->findForwardConfig('success');
	}
}