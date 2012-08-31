<?php

class HeadlinesEditAction extends BaseAction {

	function HeadlineEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Headlines";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET["id"])) {

			$headline = HeadlineQuery::create()->findPK($request->getParameter("id"));
			if (!empty($headline)) {

				//Adjuntar documentos
				$smarty->assign("documentsUpload", true); //en el template se realizan subidas de documentos
				$documentTypes = DocumentPeer::getDocumentsTypesConfig();
				$smarty->assign("documentTypes",$documentTypes);

				$maxUploadSize =  Common::maxUploadSize();
				$smarty->assign("maxUploadSize",$maxUploadSize);

				// Busco todos los documentos asociados al headline
				$documents = $headline->getDocuments();
				$smarty->assign("documents",$documents);

			}
			else
				$smarty->assign("notValidId",true);


		}
		else {
			//voy a crear un objeto nuevo
			$headline = new Headline();
			$campaignId = $request->getParameter('campaignId');
			if (!empty($campaignId)) {
				$campaign = CampaignQuery::create()->findOneById($campaignId);
				if (!empty($campaign))
					$headline->setCampaignId($campaignId);
			}
		}

		$smarty->assign("mediaTypes", MediaTypeQuery::create()->find());
		$smarty->assign("headlineTypes", Headline::getHeadlineTypes());
		$smarty->assign("headlineAgendas", Headline::getHeadlineAgendas());

		$smarty->assign("headline",$headline);
		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		$smarty->assign("actor",new Actor());

		return $mapping->findForwardConfig('success');
	}

}
