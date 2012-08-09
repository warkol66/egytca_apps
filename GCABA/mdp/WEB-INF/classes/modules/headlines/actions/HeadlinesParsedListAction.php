<?php
/**
 * HeadlinesParsedListAction
 *
 * Listado de Titulares parseados
 *
 * @package    headlines
 */
require_once 'BaseListAction.php';

class HeadlinesParsedListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('HeadlineParsed');
	}

	protected function preList() {
		//Reviso si se solicito desde campaing
		
		$params["campaignId"] = $campaignId;
		$campaignId = $_GET['campaignId'];
		//$campaignId = $request->getParameter('campaignId');
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
			$parseStategies = $contentProviders["strategies_options"];
			$smarty->assign('parseStategies', $parseStategies);

			$params["campaignId"] = $campaignId;
			$params["status"] = array('max' => HeadlineParsedQuery::STATUS_PROCESSING);
		}
		else {
			$this->smarty->assign('campaign', new Campaign());
			$_GET['filters']['dateTo'] = date();
			$_GET['filters']['dateFrom'] = date();
		}
		parent::preList();
		$this->module = "Headlines";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
	}
}
