<?php

class SecurityDoEditPermissionsV2Action extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		header('Content-Type: text/json');
		
		$errors = rand(0, 1) > 0.5 ? null : array('someErrorCode' => 'someErrorDescription');
		$smarty->assign('errors', $errors);
		
		$smarty->assign('module', null); // hack para usar la variable
		
		if (!$errors) {
			$smarty->assign('action', $_POST['action']);
			$smarty->assign('module', $_POST['module']);
		}
		
		sleep(3); // quiero que quede el spinner un rato para testing
		
		return $mapping->findForwardConfig('success');
	}
}
