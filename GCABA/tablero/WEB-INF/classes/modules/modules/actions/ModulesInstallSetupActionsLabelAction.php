<?php
/**
 * InstallSetupActionsLabelAction
 *
 * @package install
 */

require_once("includes/assoc_array2xml.php");

class ModulesInstallSetupActionsLabelAction extends BaseAction {

	function ModulesInstallSetupActionsLabelAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		global $PHP_SELF;

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Install";
		$smarty->assign("module",$module);

		$modulePeer = new ModulePeer();

		if (!isset($_GET['moduleName']))
			return $mapping->findForwardConfig('failure');

		$languages = Array();
		foreach ($_GET["languages"] as $languageCode) {
			$language = MultilangLanguagePeer::getLanguageByCode($languageCode);
			$languages[] = $language;
		}

		//buscamos todos los actions sin instalar.

		$modulePath = "WEB-INF/classes/modules/" . $_GET['moduleName'] . "/actions/";
		$directoryHandler = opendir($modulePath);
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

		$totalActions = array_merge($withPair,$withoutPair);


		if (isset($_GET['mode']) && $_GET['mode'] == 'reinstall') {

			$smarty->assign('mode',$_GET['mode']);
			$actualLabels = array();
			foreach ($totalActions as $action) {
				foreach ($languages as $language) {
					$actionLabel = SecurityActionLabelPeer::getByActionAndLanguage($action,$language->getCode());
					if (!empty($actionLabel))
						$actualLabels[$action][$language->getCode()] = $actionLabel->getLabel();
				}
			}
			$smarty->assign('actualLabels',$actualLabels);
		}

		$smarty->assign("languages",$languages);

		$smarty->assign('actions',$totalActions);
		$smarty->assign('messages',$filteredMessages);
		$smarty->assign('moduleName',$_GET['moduleName']);
		return $mapping->findForwardConfig('success');
	}

}
