<?php
/**
 * InstallSetupModuleInformationAction
 *
 * @package install
 */

class ModulesInstallSetupModuleInformationAction extends BaseAction {

	function ModulesInstallSetupModuleInformationAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Install";
		$smarty->assign("module",$module);

		if (!isset($_GET['moduleName']))
			return $mapping->findForwardConfig('failure');

		$languages = Array();
		$languages = MultilangLanguageQuery::create()->filterByCode($_GET["languages"],Criteria::IN)->find();
		
		//Por defecto si no existen idiomas, se carga el español
		if (empty($languages)) {
			$language = new MultilangLanguage();
			$language->setCode("esp");
			$language->setName("Español");
			$languages[] = $language;
		}

		$smarty->assign('languages',$languages);

		//tengo que obtener la informacion del modulo
		$moduleObj = ModuleQuery::create()->findOneByName($_GET['moduleName']);
		$smarty->assign('moduleObj',$moduleObj);

		//obtengo todos los modulos para analizar sus dependencias
		$modules = ModuleQuery::create()->select('Name')->filterByName($_GET['moduleName'], Criteria::NOT_EQUAL)->find();

		if (isset($_GET['mode']) && ($_GET['mode'] == 'reinstall')) {

			$smarty->assign('mode',$_GET['mode']);

			if (empty($moduleObj))
				return $mapping->findForwardConfig('failure');

			//sus labels correspondientes
			$labels = Array();
			foreach ($languages as $language)
				$labels[$language->getCode()] = ModuleLabelQuery::create()
					->filterByModule($moduleObj)
					->filterByLanguage($language->getCode())
					->findOne();
			$smarty->assign('labels',$labels);

			// y sus dependencias
			$dependencies = ModuleDependencyQuery::create()->select('Dependence')->findByModule($moduleObj);

			if (!empty($dependencies)) {
				$smarty->assign('assignedDependencyModules', $dependencies);

				$modules = array();
				$modules = ModuleQuery::create()->select('Name')
						->filterByName($_GET['moduleName'], Criteria::NOT_IN)				
					->_and()
						->filterByName($dependencies, Criteria::NOT_IN)
					->find();
			}

		}

		$smarty->assign('dependencyModules', $modules);
		$smarty->assign('moduleName', $_GET['moduleName']);
		return $mapping->findForwardConfig('success');
	}

}
