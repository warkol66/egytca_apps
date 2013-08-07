<?php

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

			$actionNames = $this->getActions($moduleName);
			$accessToActions = $securityActionPeer->getAccessToActions($actionNames);
			foreach ($actionNames as $actionName) {
				$modules[$moduleName]['actions'][$actionName] = $accessToActions[$actionName];
			}

//				//separacion entre actions con par y acciones sin par
//				foreach ($actions as $action) {
//
//					//separamos los pares de aquellos que no tienen pares
//					if (preg_match("/(.*)([a-z]Do[A-Z])(.*)/",$action,$parts)) {
//						//armamos el nombre de la posible action sin do
//						$actionWithoutDo = $parts[1].$parts[2][0].$parts[2][3].$parts[3];
//
//						if (in_array($actionWithoutDo,$actions))
//							$pairActions[$actionWithoutDo] = $action;
//					}
//				}
//
//				if (!empty($pairActions)) {
//
//					$withPair = array_keys($pairActions);
//					$arrays = array_diff($actions,$withPair);
//
//					$actionsToDelete = array_merge(array_keys($pairActions), array_values($pairActions));
//					$withoutPair = array_diff($actions,$actionsToDelete);
//
//				}
//				else {
//					$withoutPair = $actions;
//					$withPair = array();
//				}
		}
		
		$smarty->assign('modules', $modules);
		
		return $mapping->findForwardConfig('success');
	}
	
	function getActions($module) {
		
		$modulePath = "WEB-INF/classes/modules/$module/actions/";
		$actions = array();
		if ($directoryHandler = opendir($modulePath)) { //Si el directorio existe
			
			while (false !== ($filename = readdir($directoryHandler))) {
				//verifico si es un archivo php
				if (is_file($modulePath . $filename) && (preg_match('/(.*)Action.php$/', $filename, $matches)))
					array_push($actions, $matches[1]);
			}
			closedir($directoryHandler);
		}
		return $actions;
	}
}
