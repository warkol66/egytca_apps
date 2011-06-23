<?php

class SecurityEditPermissionsAction extends BaseAction {

	function SecurityEditPermissionsAction() {
		;
	}

	function evaluateBitlevel($level,$bitlevel) {
		//si el valor que queda al restarle el nivel a evaluar es mayor o igual a cero, ese
		//nivel esta seteado

		if ($level == SecurityModulePeer::LEVEL_ALL)
			return ($bitlevel == $level);

		return ((intval($level) & intval($bitlevel)) > 0);

	}

	function getAccessToActions($actions) {

		$access = array();

		foreach ($actions as $action) {
			$lcAction = lcfirst($action);

			$securityAction = SecurityActionPeer::getByNameOrPair($lcAction);
			if (!empty($securityAction)) {
	
				$access[$action] = array();
				$access[$action]['noCheckLogin'] = $securityAction->getNoCheckLogin();
	
				$bitLevel = $securityAction->getAccess();
				if ($bitLevel == SecurityModulePeer::LEVEL_ALL) {
					$access[$action]['bitLevel'] = 0;
					$access[$action]['all'] = 1;
				}
				else
					$access[$action]['bitLevel'] = $bitLevel;
	
				if (class_exists("AffiliateLevelPeer")) {
	
					$bitLevelAffiliate = $securityAction->getAccessAffiliateUser();
					if ($bitLevelAffiliate == SecurityModulePeer::LEVEL_ALL) {
						$access[$action]['bitLevelAffiliate'] = 0;
						$access[$action]['affiliateAll'] = 1;
					}
					else
						$access[$action]['bitLevelAffiliate'] = $bitLevelAffiliate;

				}
	
				if (class_exists("RegistrationUser"))
					$access[$action]['permissionRegistration'] = $securityAction->getAccessRegistrationUser();

			}

		}

		return $access;
	}

	function getAccessToModule($module) {

		$access = array();
		$securityModule = SecurityModulePeer::getAccess($module);

		if (!empty($securityModule)) {

			//Permisos para usuarios
			$bitLevel = $securityModule->getAccess();
			if ($bitLevel == (SecurityModulePeer::LEVEL_ALL)) {		
				$access['permissionGeneral'][all] = 1;
				$bitLevel = 0;
			}
			$userLevels = LevelPeer::getAll();
			foreach ($userLevels as $level)
				$access['permissionGeneral'][$level->getBitLevel()] = $this->evaluateBitlevel($level->getBitLevel(),$bitLevel);


			//Permisos para usuarios por afiliado
			if (class_exists("AffiliateLevelPeer")) {
				$bitLevelAffiliate = $securityModule->getAccessAffiliateUser();
				$affiliateUserLevels = AffiliateLevelPeer::getAll();
				foreach ($affiliateUserLevels as $level)
					$access['permissionAffiliateGeneral'][$level->getBitLevel()] = $this->evaluateBitlevel($level->getBitLevel(),$bitLevelAffiliate);
				$access['permissionAffiliateGeneral'][all] = $this->evaluateBitlevel(SecurityModulePeer::LEVEL_ALL,$bitLevelAffiliate);
			}
			//Permisos para usauarios por registro
			if (class_exists("RegistrationUser"))
				$access['permissionRegistrationGeneral'] = $securityModule->getAccessRegistrationUser();

		}
		return $access;
	}


	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		global $PHP_SELF;
		//////////
		// Call our business logic from here

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Security";
		$smarty->assign("module",$module);

		$modulePeer = new ModulePeer();

		$modules = ModulePeer::getActiveAndPresent();
		$smarty->assign("modules",$modules);
		if (!isset($_GET['moduleName']))
			return $mapping->findForwardConfig('success');

		$languages = Array();
		foreach ($_GET["languages"] as $languageCode) {
			$language = MultilangLanguagePeer::getLanguageByCode($languageCode);
			$languages[] = $language;
		}

		//buscamos todos los modulos sin instalar.

		$modulePath = "WEB-INF/classes/modules/" . $_GET['moduleName'] . "/actions/";
		if ($directoryHandler = opendir($modulePath)) { //Si el directorio existe
			$actions = array();
	
			while (false !== ($filename = readdir($directoryHandler))) {
				//verifico si es un archivo php
				if (is_file($modulePath . $filename) && (preg_match('/(.*)Action.php$/',$filename,$regs)))
					array_push($actions,$regs[1]);
			}
			closedir($directoryHandler);
	
			//separacion entre accions con par y acciones sin par
			foreach ($actions as $action) {
	
				//separamos los pares de aquellos que no tienen pares
				if (preg_match("/(.*)([a-z]Do[A-Z])(.*)/",$action,$parts)) {
					//armamos el nombre de la posible action sin do
					$actionWithoutDo = $parts[1].$parts[2][0].$parts[2][3].$parts[3];
	
					if (in_array($actionWithoutDo,$actions))
						$pairActions[$actionWithoutDo] = $action;
				}
			}
	
			if (!empty($pairActions)) {
	
				$withPair = array_keys($pairActions);
				$arrays = array_diff($actions,$withPair);
	
				$actionsToDelete = array_merge(array_keys($pairActions), array_values($pairActions));
				$withoutPair = array_diff($actions,$actionsToDelete);
	
			}
			else {
				$withoutPair = $actions;
				$withPair = array();
			}
		}
		else
			unset($_GET['moduleName']);

		$moduleSelected = new SecurityModule();
		$smarty->assign('moduleSelected',$moduleSelected);

		$moduleSelected = SecurityModulePeer::getAccess($_GET['moduleName']);
		if (empty($moduleSelected))
			$moduleSelected = new SecurityModule();

		$generalAccess = $this->getAccessToModule($_GET['moduleName']);

		$withoutPairAccess = $this->getAccessToActions($withoutPair);
		$withPairAccess = $this->getAccessToActions($withPair);

		$smarty->assign('moduleSelected',$moduleSelected);
		$smarty->assign('withoutPairAccess',$withoutPairAccess);
		$smarty->assign('withPairAccess',$withPairAccess);
		$smarty->assign('generalAccess',$generalAccess);


		$levels = LevelPeer::getAllWithBitLevelGreaterThan(1);
		$smarty->assign('levels',$levels);

		if (class_exists("AffiliateLevelPeer")) {
			$affiliateLevels = AffiliateLevelPeer::getAll();
			$smarty->assign('affiliateLevels',$affiliateLevels);
		}

		if (class_exists("RegistrationUser"))
			$smarty->assign('registrationAvailable',1);

		$levelSave = SecurityModulePeer::LEVEL_ALL;
		$smarty->assign("levelsave",$levelSave);

		$smarty->assign('withoutPair',$withoutPair);
		$smarty->assign('withPair',$withPair);
		$smarty->assign('pairActions',$pairActions);
		$smarty->assign('moduleName',$_GET['moduleName']);
		$smarty->assign('languages',$languages);

		$smarty->assign('message',$_GET['message']);

		return $mapping->findForwardConfig('success');
	}

}
