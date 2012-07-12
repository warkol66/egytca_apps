<?php

class VialidadContractsEditAction extends BaseAction {

	function VialidadContractsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Contracts";
		$smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		$smarty->assign("types",Contract::getTypes());
		$smarty->assign("termTypes",Contract::getTermTypes());


		if ($_GET['id']) {
			$contract =  ContractPeer::get($_GET['id']);
			if (empty($contract)) {
				$smarty->assign("notValidId","true");
				return $mapping->findForwardConfig('success');
			}
			else
				$smarty->assign("action","edit");

			$constructions = $contract->getConstructions();
			$smarty->assign("constructions",$constructions);

		}
		else {
			$contract = new Contract();
			$smarty->assign("action","create");
		}


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

			// Busco todos los documentos asociados al contract
			$documents = $contract->getDocuments();
			$smarty->assign("documents",$documents);


		$smarty->assign("contract",$contract);
		$smarty->assign("currencies",CurrencyQuery::create()->find());
		return $mapping->findForwardConfig('success');
	}
}