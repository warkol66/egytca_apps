<?php

class SecurityDoEditPermissionsV2Action extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		/* ****** params ****** */
		if ( empty($_POST['access']) || ($_POST['access'] != 'yes' && $_POST['access'] != 'no') )
			throw new Exception('access must be [yes|no]');
		else
			$access = $_POST['access'] == 'yes';
		
		if (empty($_POST['action']))
			$actions = array();
		elseif (is_array($_POST['action']))
			$actions = $_POST['action'];
		else
			$actions = array($_POST['action']);
		
		if (empty($_POST['module']))
			$modules = array();
		elseif (is_array($_POST['module']))
			$modules = $_POST['module'];
		else
			$modules = array($_POST['module']);
		
		// bit level no puede ser 1: el supervisor siempre tiene permiso
		if (empty($_POST['bitLevel']) || intval($_POST['bitLevel']) <= 1)
			throw new Exception('bitLevel must be > 1');
		else
			$bitLevel = intval($_POST['bitLevel']);
		/* **** end params **** */
		
		try {
			
			foreach ($actions as $action) {
				
				$securityAction = SecurityActionQuery::create()
						->filterByAction($action)
					->_or()
						->filterByPair($action)
					->findOne();
				
				if (!$securityAction)
					$securityAction = SecurityAction::createFromAction($action);
				
				$securityAction->setAccessForBitLevel($access, $bitLevel);
				$securityAction->save();
			}
			
			foreach ($modules as $module) {
				$securityModule = SecurityModuleQuery::create()->findOneByModule($module);
				if (!$securityModule)
					$securityModule = SecurityModule::createFromModule($module);
				$securityModule->setAccessForBitLevel($access, $bitLevel);
				$securityModule->save();
			}
		}
		catch(Exception $e) {
			$errors = array('someErrorCode' => 'someErrorDescription');
		}
		
		header('Content-Type: text/json');
		
		$smarty->assign('errors', $errors);
		
		if (!$errors) {
			$smarty->assign('actions', $actions);
			$smarty->assign('modules', $modules);
		}
		
		return $mapping->findForwardConfig('success');
	}
}
