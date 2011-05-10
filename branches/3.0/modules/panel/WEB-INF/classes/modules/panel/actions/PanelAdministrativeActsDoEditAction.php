<?php

class PanelAdministrativeActsDoEditAction extends BaseAction {

	function PanelAdministrativeActsDoEditAction() {
		;
	}

	function prepareSmarty($params,$filters,$mapping,$smarty,$administrativeAct,$action) {

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$types = AdministrativeActPeer::getAdministrativeActTypes();
		$smarty->assign("types",$types);

		$projects = ProjectPeer::getAll();
		$smarty->assign("projects",$projects);

		$smarty->assign("action",$action);
		$smarty->assign("administrativeAct",$administrativeAct);

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

		$smarty = Common::assignParamsAndFiltersToSmarty($smarty,$params,$filters);

		return $smarty;

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

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		if ($_POST["action"] == "edit") { // Existing administrativeAct

			$params["id"] = $_POST["id"];

			$administrativeAct = AdministrativeActPeer::get($_POST["id"]);
			$administrativeAct = Common::setObjectFromParams($administrativeAct,$_POST["params"]);
			
			$smarty = $this->prepareSmarty($params,$filters,$mapping,$smarty,$administrativeAct,'edit');

			if ($administrativeAct->isModified() && !$administrativeAct->save()) 
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');

			$smarty->assign("message","ok");
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');

		}
		else { // New administrativeAct

			$administrativeAct = new AdministrativeAct();
			$administrativeAct = Common::setObjectFromParams($administrativeAct,$_POST["params"]);

			if ($administrativeAct->save()){
				$params["id"] = $administrativeAct->getId();

				$logSufix = ', ' . Common::getTranslation('action: create','common');
				Common::doLog('success', $_POST["params"]["name"] . $logSufix);
	
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-add');
			}
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
		}

	}

}
