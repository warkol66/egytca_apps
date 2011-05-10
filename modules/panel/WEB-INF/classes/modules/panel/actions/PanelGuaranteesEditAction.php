<?php

class PanelGuaranteesEditAction extends BaseAction {

	function PanelGuaranteesEditAction() {
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
		$section = "Guarantees";
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$types = GuaranteePeer::getGuaranteeTypes();
		$smarty->assign("types",$types);

		$expirationTypes = GuaranteePeer::getExpirationTypes();
		$smarty->assign("expirationTypes",$expirationTypes);

		$currencies = GuaranteePeer::getCurrencies();
		$smarty->assign("currencies",$currencies);

		$projects = ProjectPeer::getAll();
		$smarty->assign("projects",$projects);

		$smarty->assign("contractors",ContractorPeer::getAll());

		if (!empty($_GET["id"])) {
			//voy a editar un guarantee

			$guarantee = GuaranteePeer::get($_GET["id"]);

			$smarty->assign("guarantee",$guarantee);
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

			// Busco todos los documentos asociados al guarantee
			$documents = $guarantee->getDocuments();
			$smarty->assign("documents",$documents);

		}
		else {
			//voy a crear un project nuevo
			$guarantee = new Guarantee();
			$smarty->assign("guarantee",$guarantee);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
