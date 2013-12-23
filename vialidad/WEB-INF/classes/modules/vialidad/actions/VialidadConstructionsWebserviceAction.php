<?php
/**
 * VialidadConstructionsWebserviceAction
 *
 * Servicio de ocnsulta de contratos extendiendo BaseListAction
 *
 * @package    vialidad
 */


class VialidadConstructionsWebserviceAction extends BaseListAction {

	function __construct() {
		parent::__construct('Construction');
	}

	protected function preList() {
		parent::preList();
		$this->module = "Headlines";

		$this->notPaginated = true;
		$this->template->template = "TemplatePlain.tpl";

		if (!empty($_GET['filters']['issueId']))
			if (empty($_GET['filters']['getIssueBrood']))
				$this->filters['Issue']['entityFilter'] = array(
					'entityType' => "Issue",
					'entityId' => $_GET['filters']['issueId']
				);
			else
				$this->filters["broodIssues"] = $_GET['filters']['issueId'];

		if (!empty($_GET['filters']['mediaId']))
			$this->filters['Media']['entityFilter'] = array(
				'entityType' => "Media",
				'entityId' => $_GET['filters']['mediaId']
			);

		if (!empty($_GET['filters']['actorId']))
			$this->filters['Actor']['entityFilter'] = array(
				'entityType' => "Actor",
				'entityId' => $_GET['filters']['actorId']
			);

		if (!empty($_GET['filters']['fromDate']) || !empty($_GET['filters']['toDate']))
			$this->filters['rangePublished'] = Common::getPeriodArray(
				$_GET['filters']['fromDate'], $_GET['filters']['toDate']
			);

	}

	protected function postList() {
		parent::postList();

		header('Content-type: application/json; charset=UTF-8');

		}
}
