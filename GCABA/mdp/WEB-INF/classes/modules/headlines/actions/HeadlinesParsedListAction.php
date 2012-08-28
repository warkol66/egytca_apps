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
		parent::preList();

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

		if (!empty($_GET['filters']['mediaId']))
			$filters = array_merge_recursive($filters, array('Media' => array('entityFilter' => array(
				'entityType' => "Media",
				'entityId' => $_GET['filters']['mediaId']
			))));

		if (isset($fromDate) || isset($toDate))
			$filters['rangePublished'] = array('range' => Common::getPeriodArray($fromDate,$toDate));
		
		if (!isset($filters["perPage"]))
			$perPage = Common::getRowsPerPage();
		else
			$perPage = $filters["perPage"];

		//Reviso si se solicito desde campaing		
		$campaignId = $_GET['campaignId'];
		//$campaignId = $request->getParameter('campaignId');
		$campaign = CampaignQuery::create()->findOneById($campaignId);
		if ($campaign) {
			$params["campaignId"] = $campaignId;
			$headlinesParsedQuery = HeadlineParsedQuery::create()
					->filterByCampaign($campaign)
					->orderByStatus();
			if (!empty($filters['discarded']))
				$headlinesParsedQuery->filterByStatus(HeadlineParsed::STATUS_DISCARDED);
			else
				$headlinesParsedQuery->filterByStatus(array('max' => HeadlineParsed::STATUS_PROCESSING));
			$headlinesParsed = $headlinesParsedQuery->find();

			$this->smarty->assign('campaign', $campaign);
			$this->smarty->assign('campaignId', $campaignId);
			$this->smarty->assign('headlinesParsed', $headlinesParsed);

			$contentProviders = ConfigModule::get("headlines","contentProvider");
			$parseStategies = $contentProviders["strategies_options"];
			$this->smarty->assign('parseStategies', $parseStategies);

			$params["campaignId"] = $campaignId;
			$params["status"] = array('max' => HeadlineParsed::STATUS_PROCESSING);
		}
		else {

			$this->perPage = $perPage;
//			$filters["status"] = array('max' => HeadlineParsed::STATUS_PROCESSING);
			if (!empty($filters['discarded']))
				$this->query->filterByStatus(HeadlineParsed::STATUS_DISCARDED);
			else
				$this->query->filterByStatus(array('max' => HeadlineParsed::STATUS_PROCESSING));
//			$filters["status"] = HeadlineParsed::STATUS_IDLE;

			$this->filters = $filters;
			$this->smarty->assign('campaign', new Campaign());
		}

		$this->module = "Headlines";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
	}
}
