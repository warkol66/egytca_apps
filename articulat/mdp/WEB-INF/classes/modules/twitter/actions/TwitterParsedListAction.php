<?php
/**
 * HeadlinesParsedListAction
 *
 * Listado de Titulares parseados
 *
 * @package    headlines
 */

class TwitterParsedListAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('TwitterTweet');
	}
	
	protected function preList() {
		parent::preList();

		$this->module = "Twitter";

		//Obtencion de filtros
		if (!empty($_GET["page"])) {
			$page = $_GET["page"];
			$this->smarty->assign("page",$page);
		}
		if (!empty($_GET['filters']))
			$filters = $_GET['filters'];
			
		if (!empty($_GET['filters']['fromDate']))
			$fromDate = $_GET['filters']['fromDate'];

		if (!empty($_GET['filters']['toDate']))
			$toDate = $_GET['filters']['toDate'];

		if (!empty($_GET['filters']['campaignId']))
			$filters = array_merge_recursive($filters, array('Campaign' => array('entityFilter' => array(
				'entityType' => "Campaign",
				'entityId' => $_GET['filters']['campaignId']
			))));

		if (isset($fromDate) || isset($toDate))
			$filters['rangePublished'] = Common::getPeriodArray($fromDate,$toDate);
		
		if (!isset($filters["perPage"]))
			$perPage = Common::getRowsPerPage();
		else
			$perPage = $filters["perPage"];

		$this->perPage = $perPage;

		//Reviso si se solicito desde campaing valida
		$campaignId = $_GET['filters']['campaignId'];
		$campaign = CampaignQuery::create()->findOneById($campaignId);
		
		if (!$campaign) {
			unset($filters['Campaign']);
			$campaign = new Campaign();
		}

		$this->smarty->assign('campaign', $campaign);
		if (!empty($filters['discarded']))
			$this->query->filterByStatus(TwitterTweet::DISCARDED);
		else
			$this->query->filterByStatus(array('max' => TwitterTweet::ACCEPTED));

		$this->filters = $filters;

	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
	}
}
