<?php

require_once 'ControllerUtils.php';

class securityUsersLevelPermissionsAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$userLevels = LevelQuery::create()->filterByBitlevel(1, Criteria::GREATER_THAN)->find();
		$smarty->assign('userLevels', $userLevels);
		
		$userBitLevel = empty($_GET['userBitLevel']) ? 2 : $_GET['userBitLevel'];
		$smarty->assign('userBitLevel', $userBitLevel);
		
		$securityActionPeer = new SecurityActionPeer();
		$moduleNames = ModulePeer::getActiveAndPresent();
		$modules = array();
		
		foreach ($moduleNames as $moduleName) {
			
			$modules[$moduleName] = array();
			
			$moduleAccess = SecurityModulePeer::getAccess($moduleName);
			if ($moduleAccess) {
				$modules[$moduleName]['access'] = array(
					'all' => $moduleAccess->hasAllUsersAccess(),
					'bitLevel' => $moduleAccess->getAccess(),
					'noCheckLogin' => $moduleAccess->getNochecklogin()
				);
			}
			
			$actionNames = ControllerUtils::getActionsForModule($moduleName);
			$accessToActions = $securityActionPeer->getAccessToActions($actionNames);
			foreach ($actionNames as $actionName) {
				if (ControllerUtils::isPairActionWithDo($actionName))
					continue;
				$modules[$moduleName]['actions'][$actionName] = $accessToActions[$actionName];
			}
			
		}
		
		$smarty->assign('modules', $modules);
		
		return $mapping->findForwardConfig('success');
	}
}
