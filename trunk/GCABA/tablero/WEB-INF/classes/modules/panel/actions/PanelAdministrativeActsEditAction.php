<?php

class PanelAdministrativeActsEditAction extends BaseAction {

	function PanelAdministrativeActsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Panel";
		$smarty->assign("module",$module);
		$section = "AdministrativeActs";
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$types = AdministrativeActPeer::getAdministrativeActTypes();
		$smarty->assign("types",$types);

		$projects = ProjectPeer::getAll();
		$smarty->assign("projects",$projects);



		if (!empty($_GET["id"])) {
			//voy a editar un administrativeAct

			$administrativeAct = AdministrativeActPeer::get($_GET["id"]);


			$smarty->assign("administrativeAct",$administrativeAct);
			$smarty->assign("action","edit");

			//Adjuntar documentos
			$smarty->assign("documentsUpload", true); //en el template se realizan subidas de documentos
			$documentTypes = DocumentPeer::getDocumentsTypesConfig();
			$smarty->assign("documentTypes",$documentTypes);

			$maxUploadSize =  Common::maxUploadSize();
			$smarty->assign("maxUploadSize",$maxUploadSize);

			$moduleConfig = Common::getModuleConfiguration($module);
			if ($moduleConfig["usePasswords"]["value"] == "YES")
				$usePasswords = true;
			$smarty->assign("usePasswords",$usePasswords);

			// Busco todos los documentos asociados al administrativeAct
			$documents = $administrativeAct->getDocuments();
			$smarty->assign("documents",$documents);
		}
		else {
			//voy a crear un project nuevo
			$administrativeAct = new AdministrativeAct();
			$smarty->assign("administrativeAct",$administrativeAct);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
