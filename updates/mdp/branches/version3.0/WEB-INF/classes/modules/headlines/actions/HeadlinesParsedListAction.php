<?php

class HeadlinesParsedListAction extends BaseAction {

	function HeadlinesParsedListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$campaignId = $request->getParameter('campaignId');
		$campaign = CampaignQuery::create()->findOneById($campaignId);
		if ($campaign) {
			$headlinesParsed = HeadlineParsedQuery::create()
					->filterByCampaign($campaign)
					->filterByStatus(array('max' => HeadlineParsedQuery::STATUS_PROCESSING))
					->orderByStatus()
					->find();
	
			$smarty->assign('campaign', $campaign);
			$smarty->assign('campaignId', $campaignId);
			$smarty->assign('headlinesParsed', $headlinesParsed);

			$contentProviders = ConfigModule::get("headlines","contentProvider");
			$parseStategies = $contentProviders["strategies"];
			$smarty->assign('parseStategies', $parseStategies);
		}
		else
			$smarty->assign('notValidId',true);
		return $mapping->findForwardConfig('success');
	}

}
