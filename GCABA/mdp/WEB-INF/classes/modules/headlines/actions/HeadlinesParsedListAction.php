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

		$this->module = "Headlines";

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

		$contentProviders = ConfigModule::get("headlines","contentProvider");
		$parseStategies = $contentProviders["strategies_options"];
		$this->smarty->assign('parseStategies', $parseStategies);

		$this->smarty->assign('campaign', $campaign);
		if (!empty($filters['discarded']))
			$this->query->filterByStatus(HeadlineParsed::STATUS_DISCARDED);
		else
			$this->query->filterByStatus(array('max' => HeadlineParsed::STATUS_PROCESSING));

		$this->filters = $filters;
		$this->smarty->assign('tags', HeadlineTagQuery::create()->select('Name')->find()->toArray());

	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Parsed");
	}
}
