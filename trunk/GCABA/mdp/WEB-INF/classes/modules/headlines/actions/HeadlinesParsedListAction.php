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
			$smarty->assign("page",$page);
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
			$headlinesParsed = HeadlineParsedQuery::create()
					->filterByCampaign($campaign)
					->filterByStatus(array('max' => HeadlineParsed::STATUS_PROCESSING))
					->orderByStatus()
					->find();

			$smarty->assign('campaign', $campaign);
			$smarty->assign('campaignId', $campaignId);
			$smarty->assign('headlinesParsed', $headlinesParsed);

			$contentProviders = ConfigModule::get("headlines","contentProvider");
			$parseStategies = $contentProviders["strategies_options"];
			$smarty->assign('parseStategies', $parseStategies);

			$params["campaignId"] = $campaignId;
			$params["status"] = array('max' => HeadlineParsed::STATUS_PROCESSING);
		}
		else {

			$this->perPage = $perPage;
//			$params["status"] = array('max' => HeadlineParsed::STATUS_PROCESSING);
			$filters["status"] = HeadlineParsed::STATUS_IDLE;

			$this->filters = $filters;
			$this->smarty->assign('campaign', new Campaign());
			$_GET['filters']['dateTo'] = date();
			$_GET['filters']['dateFrom'] = date();
		}

		$this->module = "Headlines";
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
	}
}
