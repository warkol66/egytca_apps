<?php
/**
 * InstallSetupModuleInformationAction
 *
 * @package install
 */

require_once("includes/assoc_array2xml.php");

class ModulesInstallSetupModuleInformationAction extends BaseAction {

	function ModulesInstallSetupModuleInformationAction() {
		;
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

		//Por defecto si no existen idiomas, se carga el español
		if (empty($languages)) {
			$language = new MultilangLanguage();
			$language->setCode("esp");
			$language->setName("Español");
			$languages[] = $language;
		}

		$smarty->assign('languages',$languages);

		//obtengo todos los modulos para analizar sus dependencias
		$modules = $modulePeer->getAll();

		if (isset($_GET['mode']) && ($_GET['mode'] == 'reinstall')) {

			$smarty->assign('mode',$_GET['mode']);

			//tengo que obtener la informacion del modulo

			$moduleObj = $modulePeer->get($_GET['moduleName']);

			if (empty($moduleObj))
				return $mapping->findForwardConfig('failure');

			//sus labels correspondientes

			$moduleLabelPeer = new ModuleLabelPeer();

			$labels = Array();
			foreach ($languages as $language) {
				$label = $moduleLabelPeer->getByModuleAndLanguage($_GET['moduleName'],$language->getCode());
				$labels[$language->getCode()] = $label;
			}

			// y sus dependencias
			$moduleDependencyPeer = new ModuleDependencyPeer();
			$dependencies = $moduleDependencyPeer->get($_GET['moduleName']);

			// y los asignamos a smarty
			$smarty->assign('moduleObj',$moduleObj);
			$smarty->assign('labels',$labels);

			if (!empty($dependencies)) {

				$assigned = array();
				$all = array();

				foreach ($dependencies as $dependency) {
					$module = $modulePeer->get($dependency->getDependence());
					$assigned[$module->getName()] = $module;
				}

				foreach ($modules as $module)
					$all[$module->getName()] = $module;

				$modules = array_diff_key($all,$assigned);
				$smarty->assign('assignedDependencyModules',$assigned);
			}

		}

		$smarty->assign('dependencyModules',$modules);
		$smarty->assign('moduleName',$_GET['moduleName']);
		return $mapping->findForwardConfig('success');
	}

}
