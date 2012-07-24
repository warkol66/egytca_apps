<?php

class CampaignsEditAction extends BaseAction {

	function CampaignsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Campaigns";
		$smarty->assign("module",$module);
		$section = "Campaigns";
		$smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$types = CampaignPeer::getCampaignTypes();
		$smarty->assign("types",$types);

		if (!empty($_GET["id"])) {
			//voy a editar un campaign

			$campaign = CampaignQuery::create()->findPK($_GET["id"]);

			if (empty($campaign))
				$smarty->assign("notValidId",true);
			else {
				$smarty->assign("campaign",$campaign);

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

				// Busco todos los documentos asociados al campaign
				$documents = $campaign->getDocuments();
				$smarty->assign("documents",$documents);

				if ($_GET["report"]) {
					$this->template->template = "TemplatePrint.tpl";
					$smarty->assign("report",true);
				}
			}
		}
		else
			//voy a crear un campaign nuevo
			$smarty->assign("campaign",new Campaign());

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);


		return $mapping->findForwardConfig('success');
	}

}
