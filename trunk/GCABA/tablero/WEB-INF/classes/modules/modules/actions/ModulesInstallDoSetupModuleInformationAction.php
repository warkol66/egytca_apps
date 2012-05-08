<?php
/**
 * InstallDoSetupModuleInformationAction
 *
 * @package install
 */

class ModulesInstallDoSetupModuleInformationAction extends BaseAction {

	function ModulesInstallDoSetupModuleInformationAction() {
		;
	}

	function executeSuccess($mapping) {

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&moduleName='.$_POST["moduleName"];
		if (isset($_POST['mode']))
			$queryData .= '&mode=' . $_POST['mode'];
		foreach ($_POST["languages"] as $languageId)
			$queryData .= '&languages[]=' . $languageId;
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

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

		//asigno modulo
		$moduleLabel = "Install";
		$smarty->assign("moduleLabel",$moduleLabel);
		$modulePeer = new ModulePeer();

		if (!isset($_POST['moduleName'])) {
			return $mapping->findForwardConfig('failure');
		}

		//salto de paso
		if (isset($_POST['skip']))
			return $this->executeSuccess($mapping);

		$modulePath = "WEB-INF/classes/modules/" . $_POST['moduleName'] . '/setup';
		if (!is_dir($modulePath))
			mkdir($modulePath,0755);

		$modulePath .= '/';


		//guardado de informacion de descripcion del modulo

		$fd = fopen($modulePath . 'information.sql','w');

		if ($fd == false)
			return $mapping->findForwardConfig('failure');

		$fds = Array();
		foreach ($_POST["languages"] as $languageCode)
			$fds[$languageCode] = fopen($modulePath . 'modulesLabel_'.$languageCode.'.sql','w');

		$moduleLabelPeer = new ModuleLabelPeer();

		foreach ($_POST["languages"] as $languageCode)
			fprintf($fds[$languageCode],"%s\n",ModuleLabelPeer::getSQLCleanup($_POST['moduleName'],$languageCode));

		foreach ($_POST["labels"] as $languageCode => $label) {
			$moduleLabel = new ModuleLabel();
			$moduleLabel->setName($_POST['moduleName']);
			$moduleLabel->setLabel($label);
			$moduleLabel->setLanguage($languageCode);
			$moduleLabel->setDescription($_POST['descriptions'][$languageCode]);
			$sql = $moduleLabel->getSQLInsert();
			fprintf($fds[$languageCode],"%s\n",$sql);
		}

		foreach ($_POST["languages"] as $languageCode)
			fclose($fds[$languageCode]);

		$moduleObj = new Module();
		$moduleObj->setName($_POST['moduleName']);
		$moduleObj->setAlwaysActive($_POST['alwaysActive']);
		$moduleObj->setHasCategories($_POST['hasCategories']);

		fprintf($fd,"%s\n",$moduleObj->getSQLCleanup());
		$sqlAlwaysActive = $moduleObj->getSQLInsert();
		fprintf($fd,"%s\n",$sqlAlwaysActive);


		//generacion de sql de las dependencias
		$moduleDependency = new ModuleDependency();
		$moduleDependency->setModuleName($_POST['moduleName']);
		fprintf($fd,"%s\n",$moduleDependency->getSQLCleanup());

		if (isset($_POST['dependencies'])) {

			if ($fd == false)
				return $mapping->findForwardConfig('failure');

			foreach($_POST['dependencies'] as $dependencyName) {

				$moduleDependency = new ModuleDependency();
				$moduleDependency->setModuleName($_POST['moduleName']);
				$moduleDependency->setDependence($dependencyName);
				$sql = $moduleDependency->getSQLInsert();
				fprintf($fd,"%s\n",$sql);
			}


		}


		fclose($fd);

		//solamente se ejecuta este paso
		if (isset($_POST['stepOnly']))
			return $mapping->findForwardConfig('success-step');

		return $this->executeSuccess($mapping);

	}

}
