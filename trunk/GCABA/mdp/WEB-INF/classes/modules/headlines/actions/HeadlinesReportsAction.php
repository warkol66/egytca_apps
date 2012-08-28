<?php
/**
 * HeadlinesReportsAction
 *
 * Listado de Actores extendiendo BaseListAction
 *
 * @package    actors
 */

class HeadlinesReportsAction extends BaseListAction {
	
	function __construct() {
		parent::__construct('Headline');
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
			$fromDate = Common::convertToMysqlDateFormat($_GET['filters']['fromDate']);

		if (!empty($_GET['filters']['toDate']))
			$toDate = Common::convertToMysqlDateFormat($_GET['filters']['toDate']);

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

			$this->filters = $filters;


	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Reports");
	}
}
