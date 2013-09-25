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

		$types = CampaignPeer::getCampaignTypesTranslated();
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
				
				// Busco los tweets aceptados, estados, valores y relevancias
				if($campaign->geTtwitterCampaign()){
					
					// seteo los filtros para los tweets de esta campaign
					$twitterFilters = $_GET['twitter']['filters'];
					$twitterFilters['campaignId'] = $_GET["id"];
					$twitterFilters['status'] = TwitterTweet::ACCEPTED;
					if(isset($_GET['twitter']['filters']['processed'])){
						if($_GET['filters']['processed'] == -1)
							$twitterFilters['maxStatus'] = TwitterTweet::DISCARDED;
					}
					// hago la busqueda
					$tweetsQuery = BaseQuery::create('TwitterTweet');
					$tweets = $tweetsQuery->addFilters($twitterFilters)->find();
					$smarty->assign('twitterFilters', $twitterFilters);
					
					$smarty->assign('acceptedTweets', $tweets);
					$smarty->assign('tweetValues',TwitterTweet::getValues());
					$smarty->assign('tweetRelevances',TwitterTweet::getRelevances());
					$smarty->assign('tweetStatuses',TwitterTweet::getStatuses());
					$smarty->assign('latestTopics',TwitterTrendingTopic::getLatest(10));
					
				}
			}
		}
		else
			//voy a crear un campaign nuevo
			$smarty->assign("campaign",new Campaign());

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		$smarty->assign("actor",new Actor());

		return $mapping->findForwardConfig('success');
	}

}
