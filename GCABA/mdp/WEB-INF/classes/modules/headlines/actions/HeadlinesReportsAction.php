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
		
		if($_GET["report"]) {
			$this->notPaginated = true;
			$this->smarty->assign("report", true);
			$this->template->template = "TemplatePrint.tpl";
			if($_GET["includeContent"])
				$this->smarty->assign("includeContent", true);

		}

		if (!empty($_GET['filters']['mediaId']))
			$this->filters['entityFilter'] = array(
				'entityType' => "Media",
				'entityId' => $_GET['filters']['mediaId']
			);
		
		if (!empty($_GET['filters']['fromDate']) || !empty($_GET['filters']['toDate']))
			$this->filters['rangePublished'] = array('range' => Common::getPeriodArray(
				$_GET['filters']['fromDate'], $_GET['filters']['toDate']
			));
		
		if (!empty($_GET['filters']["perPage"]))
			$this->perPage = $filters["perPage"];
	}

	protected function postList() {
		parent::postList();
		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Reports");

		$this->smarty->assign("headlineScopes", Headline::getHeadlineScopes());
		$this->smarty->assign("headlineValues", Headline::getHeadlineValues());
		$this->smarty->assign("headlineRelevances", Headline::getHeadlineRelevances());


	}
}
