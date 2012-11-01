<?php

class SecurityEditPermissionsAction extends BaseAction {

	function SecurityEditPermissionsAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

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

		$generalAccess = SecurityModulePeer::getAccessToModule($_GET['moduleName']);

		$withoutPairAccess = SecurityActionPeer::getAccessToActions($withoutPair);
		$withPairAccess = SecurityActionPeer::getAccessToActions($withPair);

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
