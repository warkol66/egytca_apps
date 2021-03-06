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
			$this->filters["setReportOrder"] = true;
			$this->notPaginated = true;
			$this->smarty->assign("report", true);
			$this->template->template = "TemplatePrint.tpl";
			if($_GET["includeContent"])
				$this->smarty->assign("includeContent", true);

		}

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


		if (empty($_GET['filters']['unprocessed']))
			$this->filters["processed"] = true;

	}

	protected function postList() {
		if (!empty($this->filters['Actor']))
			unset($this->filters['Actor']);
		if (!empty($this->filters['Media']))
			unset($this->filters['Media']);
		if (!empty($this->filters['Issue']))
			unset($this->filters['Issue']);
		$this->smarty->assign("filters", $this->filters);
		parent::postList();


		$this->smarty->assign("module", $this->module);
		$this->smarty->assign("section", "Reports");

		$this->smarty->assign("headlineScopes", Headline::getHeadlineScopes());
		$this->smarty->assign("headlineValues", Headline::getHeadlineValues());
		$this->smarty->assign("headlineRelevances", Headline::getHeadlineRelevances());

		if ($this->filters["executiveSummary"]) {
			$query = clone $this->query;

			//Total titulares
			$totalHeadlines = $query->count();
			$this->smarty->assign("totalHeadlines", $totalHeadlines);

			//Resumen por temas
			$issueQuery = IssueQuery::create()->filterByHeadline($query->find(), Criteria::IN)
				->joinHeadlineIssue();
			
			//Resumen por temas
			$byIssueTop = clone $issueQuery;
			$byIssueTop = $byIssueTop
				->groupById()
				->withColumn("COUNT(HeadlineIssue.Issueid)", "HeadlinesCount")
				->orderByHeadlinesCount(Criteria::DESC)
				->limit(10)
				->find();

			//Resumen por temas otros
			foreach ($byIssueTop as $issue)
				$already[] = $issue->getId();

			$byIssueRest = clone $issueQuery;
			$byIssueRest = $byIssueRest
				->filterById($already, Criteria::NOT_IN)
				->orderByName()
				->groupById()
				->find();

			$this->smarty->assign("byIssueTop", $byIssueTop);
			$this->smarty->assign("byIssueRest", $byIssueRest);


			//Resumen por vocero
			$bySpokesman = clone $this->query;
			$bySpokesman = $bySpokesman
				->filterByActorAndType($this->filters['Actor']['entityFilter']['entityId'],HeadlinePeer::SPOKESMAN)
			;
			$this->smarty->assign("bySpokesman", $bySpokesman->count());

		}
	}
}
